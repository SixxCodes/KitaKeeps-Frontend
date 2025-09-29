<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\BranchProduct;
use App\Models\ProductSupplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{   
    // Store
    public function store(Request $request)
    {
        $request->validate([
            'prod_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'prod_description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'unit_cost' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|max:2048',
            'supplier' => 'required|exists:supplier,supplier_id',
        ]);

        // Determine current branch of owner
        $owner = Auth::user();
        $userBranches = $owner->branches;
        $mainBranch = $userBranches->sortBy('branch_id')->first();
        $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first() ?? $mainBranch;

        if (!$currentBranch) {
            return redirect()->back()->withErrors('No active branch found for this owner.');
        }

        $branchId = $currentBranch->branch_id;

        // Create category if it doesn't exist for this branch
        $category = Category::firstOrCreate(
            [
                'cat_name' => $request->category,
                'branch_id' => $branchId, // tie category to branch
            ],
            ['cat_description' => '']
        );

        // Handle image upload
        $imagePath = $request->hasFile('product_image')
            ? $request->file('product_image')->store('products', 'public')
            : null;
        
        // Generate unique SKU
        $latestProduct = Product::orderBy('product_id', 'desc')->first();
        $nextId = $latestProduct ? $latestProduct->product_id + 1 : 1;
        $sku = 'PROD-' . str_pad($nextId, 5, '0', STR_PAD_LEFT);

        // Create product
        $product = Product::create([
            'sku' => $sku, // auto-generated
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'category_id' => $category->category_id,
            'unit_cost' => $request->unit_cost,
            'selling_price' => $request->selling_price,
            'prod_image_path' => $imagePath,
            'is_active' => true,
        ]);

        // Assign to branch
        BranchProduct::create([
            'branch_id' => $branchId,
            'product_id' => $product->product_id,
            'stock_qty' => $request->quantity,
            'reorder_level' => 0,
            'is_active' => true,
        ]);

        // Link supplier
        ProductSupplier::create([
            'product_id' => $product->product_id,
            'supplier_id' => $request->supplier,
            'preferred' => true,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $search  = $request->get('search', '');

        $owner = auth()->user();

        // get current branch from session (or fallback to first branch)
        $userBranches = $owner->branches; 
        $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
            ?? $userBranches->sortBy('branch_id')->first();

        $products = Product::with([
                'product_supplier.supplier',
                'branch_products' => function($q) use ($currentBranch) {
                    $q->where('branch_id', $currentBranch->branch_id);
                }
            ])
            ->whereHas('branch_products', function($q) use ($currentBranch) {
                $q->where('branch_id', $currentBranch->branch_id);
            })
            ->when($search, function ($q) use ($search) {
                $q->where('prod_name', 'like', "%{$search}%");
            })
            ->orderBy('product_id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('products.index', compact('products', 'currentBranch'));
    }

    // Delete
    public function destroy(Product $product)
    {
        // Optional: delete the product image from storage
        if ($product->prod_image_path && \Storage::disk('public')->exists($product->prod_image_path)) {
            \Storage::disk('public')->delete($product->prod_image_path);
        }

        // Delete related branch_products
        $product->branch_products()->delete();

        // Delete related product_supplier
        $product->product_supplier()->delete();

        // Delete the product itself
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    // Update
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'prod_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'prod_description' => 'nullable|string',
            'stock_qty' => 'required|integer|min:0',
            'unit_cost' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|max:2048',
            'supplier' => 'required|exists:supplier,supplier_id',
        ]);

        $owner = auth()->user();
        $currentBranch = $owner->branches
            ->where('branch_id', session('current_branch_id'))
            ->first() ?? $owner->branches->sortBy('branch_id')->first();

        if (!$currentBranch) {
            return redirect()->back()->withErrors('No active branch found.');
        }

        $branchId = $currentBranch->branch_id;

        // Handle image upload
        if ($request->hasFile('product_image')) {
            // Delete old image if exists
            if ($product->prod_image_path && \Storage::disk('public')->exists($product->prod_image_path)) {
                \Storage::disk('public')->delete($product->prod_image_path);
            }
            $imagePath = $request->file('product_image')->store('products', 'public');
            $product->prod_image_path = $imagePath;
        }

        // Update product info
        $product->update([
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'category_id' => \App\Models\Category::firstOrCreate(
                ['cat_name' => $request->category, 'branch_id' => $branchId],
                ['cat_description' => '']
            )->category_id,
            'unit_cost' => $request->unit_cost,
            'selling_price' => $request->selling_price,
        ]);

        // Update branch stock quantity
        $branchProduct = $product->branch_products()->where('branch_id', $branchId)->first();
        if ($branchProduct) {
            $branchProduct->update([
                'stock_qty' => $request->stock_qty
            ]);
        } else {
            // If not exists, create new record for this branch
            \App\Models\BranchProduct::create([
                'branch_id' => $branchId,
                'product_id' => $product->product_id,
                'stock_qty' => $request->stock_qty,
                'reorder_level' => 0,
                'is_active' => true,
            ]);
        }

        // Update supplier
        $productSupplier = $product->product_supplier()->first();
        if ($productSupplier) {
            $productSupplier->update(['supplier_id' => $request->supplier]);
        } else {
            \App\Models\ProductSupplier::create([
                'product_id' => $product->product_id,
                'supplier_id' => $request->supplier,
                'preferred' => true,
            ]);
        }

        return redirect()->back()->with('success', 'Product updated successfully!');
    }

}

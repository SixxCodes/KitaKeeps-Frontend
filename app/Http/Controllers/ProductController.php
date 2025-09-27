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
        $branchId = session('current_branch_id'); // current branch

        // Branch-specific categories for datalist
        $categories = Category::where('branch_id', $branchId)->get();

        // Suppliers belonging to this branch
        $userSuppliers = Supplier::where('branch_id', $branchId)->get();

        return view('inventory.index', compact('categories', 'userSuppliers'));
    }

}

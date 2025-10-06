<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BranchProduct;
use App\Models\ProductSupplier;
use App\Models\UserBranch;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
            'sku' => $sku,
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'category' => $request->category, // directly saved now
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
                $q->where('prod_name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            })
            ->orderBy('product_id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('products.index', compact('products', 'currentBranch'));
    }

    public function destroy(Product $product)
    {
        try {
            \DB::beginTransaction();

            if ($product->prod_image_path && \Storage::disk('public')->exists($product->prod_image_path)) {
                \Storage::disk('public')->delete($product->prod_image_path);
            }

            // Delete related data for each branch_product
            foreach ($product->branch_products as $branchProduct) {
                if ($branchProduct->branch_producthasManysale_item()->exists()) {
                    $branchProduct->branch_producthasManysale_item()->delete();
                }

                if ($branchProduct->branch_producthasManystock_movement()->exists()) {
                    $branchProduct->branch_producthasManystock_movement()->delete();
                }
            }

            // Now delete branch_products
            $product->branch_products()->delete();

            // Delete product_supplier
            $product->product_supplier()->delete();

            // Delete product itself
            $product->delete();

            \DB::commit();

            return redirect()->back()->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
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
            'category' => $request->category, // updated directly
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

    public function exportProducts()
    {
        $userId = auth()->user()->user_id;

        // Get all branch IDs for the authenticated user
        $branchIds = UserBranch::where('user_id', $userId)->pluck('branch_id');

        // Get products for those branches with supplier info
        $branchProducts = BranchProduct::whereIn('branch_id', $branchIds)
            ->with(['product.product_supplier.supplier'])
            ->get();

        // Create spreadsheet manually
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers
        $headers = ['ID', 'Product Name', 'Product Supplier', 'Category', 'Qty.', 'Selling Price', 'Status'];
        $sheet->fromArray([$headers], NULL, 'A1');

        // Fill rows
        $row = 2;
        foreach ($branchProducts as $bp) {
            $product = $bp->product;
            if (!$product) continue; // skip if product missing

            $supplierName = optional($product->product_supplier->first()?->supplier)?->supp_name ?? 'N/A';

            // Determine stock status
            $qty = $bp->stock_qty;
            if ($qty == 0) {
                $status = 'No Stock';
            } elseif ($qty >= 1 && $qty <= 20) {
                $status = 'Low Stock';
            } else {
                $status = 'In Stock';
            }

            $sheet->fromArray([
                $product->product_id,
                $product->prod_name,
                $supplierName,
                $product->category,
                $qty,
                number_format($product->selling_price, 2),
                $status,
            ], NULL, "A{$row}");

            $row++;
        }

        // Style headers
        $headerStyle = $sheet->getStyle('A1:G1');
        $headerStyle->getFont()->setBold(true);
        $headerStyle->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $headerStyle->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('FFE2EFDA');
        $headerStyle->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // Auto widen columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Optional: make the Product Name and Supplier columns wider
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(30);

        // Writer & download
        $writer = new Xlsx($spreadsheet);
        $filename = 'products.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename);
    }

}

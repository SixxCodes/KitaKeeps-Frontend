<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// Models
use App\Models\Branch;
use App\Models\BranchProduct;
use App\Models\Sale;
use App\Models\SaleItem;

class POSController extends Controller
{
    public function index()
    {
        // POSController.php (index)
        $branchId = session('current_branch_id');

        $branch = Branch::with([
            'branchproducts.product.category', // <- load category
            'branchproducts.product.product_supplier.supplier'
        ])
        ->where('branch_id', $branchId)
        ->first();

        return view('pos.index', compact('branch'));

    }

    public function checkout(Request $request)
    {
        DB::beginTransaction();
        try {
            // Create the sale
            $sale = Sale::create([
                'branch_id'      => session('current_branch_id'),
                'total_amount'   => collect($request->items)->sum(fn($i) => $i['quantity'] * $i['price']),
                'payment_method' => $request->payment_method,
                'created_by'     => Auth::id(),
                'sale_date'      => now(),
            ]);

            foreach ($request->items as $item) {
                // Find product in branch
                $branchProduct = BranchProduct::where('product_id', $item['product_id'])
                    ->where('branch_id', session('current_branch_id'))
                    ->lockForUpdate() // prevent race condition
                    ->first();

                if(!$branchProduct || $branchProduct->stock_qty < $item['quantity']) {
                    throw new \Exception("Not enough stock for {$item['name']}");
                }

                // Save sale item
                $sale->items()->create([
                    'branch_product_id' => $branchProduct->branch_product_id,
                    'quantity' => $item['quantity'],
                    'price_each' => $item['price'],
                    'subtotal' => $item['quantity'] * $item['price'],
                ]);

                // Deduct stock
                $branchProduct->decrement('stock_qty', $item['quantity']);
            }

            DB::commit();
            return response()->json(['message' => 'Sale completed successfully!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}

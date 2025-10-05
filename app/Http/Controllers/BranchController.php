<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\UserBranch;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function store(Request $request)
    {
        if (auth()->user()->role !== 'Owner') {
            abort(403, 'Unauthorized'); // only owners allowed
        }

        $request->validate([
            'branch_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $branch = Branch::create([
            'branch_name' => $request->branch_name,
            'location' => $request->location,
        ]);

        UserBranch::create([
            'user_id' => auth()->user()->user_id,
            'branch_id' => $branch->branch_id,
        ]);

        return back()->with('success', 'Branch added successfully!');
    }

    public function index(Request $request)
    {
        $user = auth()->user();

        // Determine number of entries per page
        $perPage = $request->input('per_page', 5); // default 5

        // Search query
        $search = $request->input('search');

        // Fetch branches for this owner
        $branches = $user->branches()
            ->when($search, function($query, $search) {
                $query->where('branch_name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })
            ->orderBy('branch_id', 'asc')
            ->paginate($perPage)
            ->withQueryString(); // keep query parameters for pagination links

        return view('modules.myHardware', compact('branches', 'perPage', 'search'));
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            // 'is_active' => 'required|boolean',
        ]);

        $branch->update([
            'branch_name' => $request->branch_name,
            'location' => $request->location,
            // 'is_active' => $request->is_active,
        ]);

        return back()->with('success', 'Branch updated successfully!');
    }

    public function destroy(Branch $branch)
    {
        try {
            // --- 1. Delete related BranchProducts and all their dependents ---
            foreach ($branch->branchproducts as $branchProduct) {
                // Delete forecasts
                $branchProduct->forecasts()->delete();

                // Delete purchase items
                $branchProduct->branch_producthasManypurchase_item()->delete();

                // Delete stock movements
                $branchProduct->branch_producthasManystock_movement()->delete();

                // Delete sale items
                $branchProduct->branch_producthasManysale_item()->delete();

                // Finally delete the branch product itself
                $branchProduct->delete();
            }

            // --- 2. Delete Purchases and their children ---
            foreach ($branch->purchases as $purchase) {
                // Delete purchase items
                $purchase->purchasehasManypurchase_item()->delete();

                // Delete stock movements for this purchase
                $purchase->purchasehasManystock_movement()->delete();

                $purchase->delete();
            }

            // --- 3. Delete Sales and their children ---
            foreach ($branch->sales as $sale) {
                // Delete sale items
                $sale->sale_items()->delete();

                // Delete payment_sale
                $sale->salehasManypayment_sale()->delete();

                // Delete stock movements
                $sale->salehasManystock_movement()->delete();

                $sale->delete();
            }

            // --- 4. Delete Customers ---
            foreach ($branch->customers as $customer) {
                // Sales already deleted above, so just delete customer
                $customer->delete();
            }

            // --- 5. Delete Employees and their related data ---
            foreach ($branch->employees as $employee) {
                // Delete attendance
                $employee->attendance()->delete();

                // Delete payroll
                \App\Models\Payroll::where('employee_id', $employee->employee_id)->delete();

                // Delete employee
                $employee->delete();
            }

            // --- 6. Delete Suppliers ---
            foreach (\App\Models\Supplier::where('branch_id', $branch->branch_id)->get() as $supplier) {
                // Delete product_supplier relations
                $supplier->supplierhasManyproduct_supplier()->delete();

                // Delete purchases (should already be gone, but just in case)
                $supplier->supplierhasManypurchase()->delete();

                $supplier->delete();
            }

            // --- 7. Detach Users from pivot table ---
            $branch->users()->detach();

            // --- 8. Delete the branch itself ---
            $branch->delete();

            return redirect()->back()->with('success', 'Branch and all related records deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete branch: ' . $e->getMessage());
        }
    }

    public function switch(Request $request, $branchId)
    {
        $user = Auth::user(); // now works

        if ($user->branches->contains('branch_id', $branchId)) {
            session(['current_branch_id' => $branchId]);
            return back()->with('success', 'Branch switched successfully.');
        }

        return back()->with('error', 'Unauthorized to switch to this branch.');
    }

}

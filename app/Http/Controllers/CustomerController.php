<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Sale;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cust_name'       => 'required|string|max:255',
            'cust_contact'    => 'nullable|string|max:50',
            'cust_address'    => 'nullable|string|max:255',
            'notes'           => 'nullable|string|max:255',
            'cust_image_path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $branchId = session('current_branch_id');
        if (!$branchId) {
            return redirect()->back()->with('error', 'No branch selected.');
        }

        $validated['branch_id'] = $branchId;

        // Handle image upload
        if ($request->hasFile('cust_image_path')) {
            $imagePath = $request->file('cust_image_path')->store('customers', 'public');
            $validated['cust_image_path'] = $imagePath; // ✅ Save path into DB
        }

        Customer::create($validated);

        return redirect()->back()->with('success', 'Customer added successfully.');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'cust_name' => 'required|string|max:255',
            'cust_contact' => 'nullable|string',
            'cust_address' => 'nullable|string',
            'cust_image_path' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('cust_image_path')) {
            $imagePath = $request->file('cust_image_path')->store('customers', 'public');
            $validated['cust_image_path'] = $imagePath;
        }

        $customer->update($validated);

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete(); // cascade handled by DB or events
        return redirect()->back()->with('success', 'Customer deleted successfully with all related records.');
    }

    public function credits(Customer $customer)
    {
        $creditSales = $customer->sales()->where('payment_type', 'Credit')->get();

        $credits = $creditSales->map(function($sale){
            return [
                'id' => $sale->sale_id,
                'due_date' => $sale->due_date->format('Y-m-d'),
                'sale_date' => $sale->sale_date->format('Y-m-d'),
                'amount' => '₱' . number_format($sale->total_amount, 2),
            ];
        });

        return response()->json([
            'customer_name' => $customer->cust_name,
            'credits' => $credits
        ]);
    }

}

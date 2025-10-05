<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    // Display suppliers list (paginated, branch-aware)
    public function index(Request $request)
    {
        $user = Auth::user();
        $perPage = $request->query('per_page', 5);
        $search = $request->query('search');

        $branchIds = $user->branches->pluck('branch_id');

        $query = Supplier::whereIn('branch_id', $branchIds);

        if ($search) {
            $query->where('supp_name', 'like', "%{$search}%")
                ->orWhere('supp_contact', 'like', "%{$search}%")
                ->orWhere('supp_address', 'like', "%{$search}%");
        }

        $suppliers = $query->paginate($perPage)->withQueryString();

        return view('modules.mySuppliers', compact('suppliers'));
    }

    // Store new supplier
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'supp_name' => 'required|string|max:255',
                'supp_contact' => 'nullable|string|max:20',
                'supp_address' => 'nullable|string|max:255',
                'supp_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);
                
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('supp_image')) {
                $imagePath = $request->file('supp_image')->store('suppliers', 'public');
            }

            $user = Auth::user();

            // Determine branch assignment
            $branchId = ($user->role === 'Owner' && $request->branch_id)
                        ? $request->branch_id       // Owner can select a branch
                        : $user->branches->first()->branch_id; // Admin/Cashier auto assigned

            Supplier::create([
                'supp_name' => $validated['supp_name'],
                'supp_contact' => $validated['supp_contact'] ?? null,
                'supp_address' => $validated['supp_address'] ?? null,
                'supp_image_path' => $imagePath,
                'branch_id' => $branchId,
            ]);

            return redirect()->back()->with('success', 'Supplier added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supp_name' => 'required|string|max:255',
            'supp_contact' => 'nullable|string|max:20',
            'supp_email' => 'nullable|email|max:255',
            'supp_address' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('supp_image')) {
            $imagePath = $request->file('supp_image')->store('suppliers', 'public');
            $validated['supp_image_path'] = $imagePath;
        }

        $supplier->update($validated);

        return redirect()->back()->with('success', 'Supplier updated successfully!');
    }

    public function destroy(Supplier $supplier)
    {
        try {
            \DB::beginTransaction();

            // Delete related product_supplier records
            if ($supplier->supplierhasManyproduct_supplier()->exists()) {
                $supplier->supplierhasManyproduct_supplier()->delete();
            }

            // Now delete supplier
            $supplier->delete();

            \DB::commit();

            return redirect()->back()->with('success', 'Supplier deleted successfully!');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete supplier: ' . $e->getMessage());
        }
    }

}

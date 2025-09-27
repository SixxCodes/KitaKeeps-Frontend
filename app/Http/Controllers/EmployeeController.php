<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\UserBranch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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

        // Determine current branch of owner/admin
        $owner = Auth::user();
        $userBranches = $owner->branches;
        $mainBranch = $userBranches->sortBy('branch_id')->first();
        $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
            ?? $mainBranch;

        if (!$currentBranch) {
            return redirect()->back()->withErrors('No active branch found for this owner.');
        }

        $branchId = $currentBranch->branch_id; // use this for category, product, and branch_product

        // Create category if it doesn't exist for this branch
        $category = Category::firstOrCreate(
            [
                'cat_name' => $request->category,
                'branch_id' => $branchId,
            ],
            [
                'cat_description' => ''
            ]
        );

        // Handle image upload
        $imagePath = $request->hasFile('product_image')
            ? $request->file('product_image')->store('products', 'public')
            : null;

        // Create product
        $product = Product::create([
            'prod_name' => $request->prod_name,
            'prod_description' => $request->prod_description,
            'category_id' => $category->category_id,
            'unit_cost' => $request->unit_cost,
            'selling_price' => $request->selling_price,
            'prod_image_path' => $imagePath,
            'is_active' => true,
        ]);

        // Assign product to branch
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

    public function index()
    {
        $owner = Auth::user();

        // Determine current branch
        $userBranches = $owner->branches;
        $perPage = $request->query('per_page', 5);
        $search = $request->query('search');

        $mainBranch = $userBranches->sortBy('branch_id')->first();
        $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
            ?? $mainBranch;

        if (!$currentBranch) {
            return redirect()->back()->withErrors('No active branch found for this owner.');
        }

        // Get employees scoped by branch
        $employees = Employee::with('person.user')
            ->where(function($query) use ($currentBranch) {
                // Login employees → filtered via user branches
                $query->whereHas('person.user.branches', function($q) use ($currentBranch) {
                    $q->where('user_branch.branch_id', $currentBranch->branch_id);
                })
                // Non-login employees → filter by branch_id directly
                ->orWhere(function($q) use ($currentBranch) {
                    $q->whereNotIn('position', ['Cashier', 'Admin'])
                    ->where('branch_id', $currentBranch->branch_id); // 🔒 scoped
                });
            })
            ->when($search, function($query, $search) {
                $query->whereHas('person', function($q) use ($search) {
                    $q->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate($perPage);

        return view('employees.index', compact('employees', 'currentBranch', 'perPage', 'search'));
    }

    public function update(Request $request, $employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $person = $employee->person;

        // Validate input
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'gender' => 'nullable|string',
            'contact_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'daily_rate' => 'required|numeric|min:0',
            'employee_image' => 'nullable|image|max:2048', // 2MB max
        ]);

        // Update person
        $person->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'gender' => $request->gender,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        // Update employee
        $employee->update([
            'daily_rate' => $request->daily_rate,
        ]);

        // Update profile image if uploaded
        if ($request->hasFile('employee_image')) {
            $path = $request->file('employee_image')->store('employees', 'public');
            $employee->update(['employee_image_path' => $path]);
        }

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $person = $employee->person;

        // Delete employee image from storage if exists
        if ($employee->employee_image_path && \Storage::disk('public')->exists($employee->employee_image_path)) {
            \Storage::disk('public')->delete($employee->employee_image_path);
        }

        // If employee is Cashier or Admin, delete their linked User account
        if (in_array($employee->position, ['Cashier', 'Admin']) && $person && $person->user) {
            $person->user->delete();
        }

        // Delete the employee record
        $employee->delete();

        // Optionally delete person record (only if you want)
        if ($person) {
            $person->delete();
        }

        return redirect()->back()->with('success', 'Employee and related account (if any) have been removed.');
    }

}

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
        $positionLower = strtolower($request->position);

        // Validation rules
        $rules = [
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'gender'    => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email'     => 'required|email|unique:person,email',
            'address'   => 'required|string',
            'position'  => 'required|string',
            'daily_rate'=> 'required|numeric|min:0',
            'employee_image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        // Extra rules for Cashier/Admin
        if (in_array($positionLower, ['cashier', 'admin'])) {
            $rules['username'] = 'required|string|max:50|unique:user,username';
            $rules['password'] = 'required|string|min:6';
        }

        $validated = $request->validate($rules);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('employee_image_path')) {
            $imagePath = $request->file('employee_image_path')->store('employees', 'public');
        }

        // Create Person
        $person = Person::create([
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'contact_number' => $validated['contact_number'],
            'email'     => $validated['email'],
            'address'   => $validated['address'],
            'gender'    => $validated['gender'],
        ]);

        // Determine current branch of owner
        $owner = Auth::user();
        $userBranches = $owner->branches;
        $mainBranch = $userBranches->sortBy('branch_id')->first();
        $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
            ?? $mainBranch;

        if (!$currentBranch) {
            return redirect()->back()->withErrors('No active branch found for this owner.');
        }

        // Prepare employee data
        $employeeData = [
            'person_id' => $person->person_id,
            'position'  => $validated['position'],
            'daily_rate'=> $validated['daily_rate'],
            'hire_date' => now(),
            'employee_image_path' => $imagePath,
            'branch_id' => $currentBranch->branch_id, // ✅ Always assign branch_id
        ];

        $employee = Employee::create($employeeData);

        // If Cashier/Admin → also create User + assign branch via pivot
        if (in_array($positionLower, ['cashier', 'admin'])) {
            $user = User::create([
                'username'  => $validated['username'],
                'password'  => bcrypt($validated['password']),
                'role'      => $positionLower,
                'person_id' => $person->person_id,
                'is_active' => true,
                'user_image_path'=> $imagePath, 
            ]);

            // Assign this branch in pivot
            $user->branches()->sync([$currentBranch->branch_id]);
        }

        return redirect()->back()->with('success', 'Employee hired successfully!');
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
            'employee_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB max
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
            // Delete old employee image if exists
            if ($employee->employee_image_path && \Storage::disk('public')->exists($employee->employee_image_path)) {
                \Storage::disk('public')->delete($employee->employee_image_path);
            }

            $path = $request->file('employee_image')->store('employees', 'public');

            // Update employee image path
            $employee->update(['employee_image_path' => $path]);

            // If Cashier/Admin, also update the linked user's image
            if (in_array(strtolower($employee->position), ['cashier', 'admin']) && $person && $person->user) {
                $person->user->update(['user_image_path' => $path]);
            }
        }

        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    public function destroy($employee_id)
    {
        $employee = Employee::findOrFail($employee_id);
        $person = $employee->person;

        try {
            \DB::beginTransaction();

            // Delete employee image from storage if exists
            if ($employee->employee_image_path && \Storage::disk('public')->exists($employee->employee_image_path)) {
                \Storage::disk('public')->delete($employee->employee_image_path);
            }

            // Delete related attendances
            if ($employee->attendance()->exists()) {
                $employee->attendance()->delete();
            }

            // Delete related payrolls
            if ($employee->payroll()->exists()) {
                $employee->payroll()->delete();
            }

            // If employee is Cashier or Admin, delete linked User account
            if (in_array(strtolower($employee->position), ['cashier', 'admin']) && $person && $person->user) {
                $user = $person->user;

                // Delete related audit logs
                $user->userhasManyaudit_log()->delete();

                // Detach user from branches to avoid FK error
                $user->branches()->detach();

                // Delete the user
                $user->delete();
            }

            // Delete the employee record
            $employee->delete();

            // Optionally delete the person record
            if ($person) {
                $person->delete();
            }

            \DB::commit();

            return redirect()->back()->with('success', 'Employee and related records deleted successfully.');
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete employee: ' . $e->getMessage());
        }
    }

}

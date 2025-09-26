<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Employee;
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
            'lastname' => 'required|string|max:100',
            'gender' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:person,email',
            'address' => 'required|string',
            'position' => 'required|string',
            'daily_rate' => 'required|numeric|min:0',
            'employee_image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        // Conditional rules for Cashier/Admin
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
            'lastname' => $validated['lastname'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
        ]);

        // Create Employee
        $employee = Employee::create([
            'person_id' => $person->person_id,
            'position' => $validated['position'],
            'daily_rate' => $validated['daily_rate'],
            'hire_date' => now(),
            'employee_image_path' => $imagePath,
        ]);

        // If Cashier/Admin, create system user and assign branch
        if (in_array($positionLower, ['cashier', 'admin'])) {
            $user = User::create([
                'username' => $validated['username'],
                'password' => bcrypt($validated['password']),
                'role' => $positionLower,
                'person_id' => $person->person_id,
                'is_active' => true,
            ]);

            // Determine current branch of owner
            $owner = Auth::user();
            $userBranches = $owner->branches;
            $mainBranch = $userBranches->sortBy('branch_id')->first();
            $currentBranch = $userBranches->where('branch_id', session('current_branch_id'))->first()
                ?? $mainBranch;

            if ($currentBranch) {
                $user->branches()->sync([$currentBranch->branch_id]); // assign only this branch
            }
        }

        return redirect()->back()->with('success', 'Employee hired successfully!');
    }
}

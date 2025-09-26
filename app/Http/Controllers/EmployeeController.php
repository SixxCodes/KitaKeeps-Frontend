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
        // ✅ Validate
        $validated = $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname' => 'required|string|max:100',
            'gender' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|unique:person,email',
            'address' => 'required|string',
            'position' => 'required|string',
            'daily_rate' => 'required|numeric|min:0',
            'employee_image_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('employee_image_path')) {
            $imagePath = $request->file('employee_image_path')->store('employees', 'public');
        }

        // ✅ Create Person
        $person = Person::create([
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'contact_number' => $validated['contact_number'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'gender' => $validated['gender'],
        ]);

        // ✅ Create Employee
        $employee = Employee::create([
            'person_id' => $person->person_id,
            'position' => $validated['position'],
            'daily_rate' => $validated['daily_rate'],
            'hire_date' => now(),
            'employee_image_path' => $imagePath,
        ]);

        // ✅ If position is Cashier/Admin → also create system user
        if (in_array(strtolower($validated['position']), ['cashier', 'admin'])) {
            // Instead of auto-creating username/password, 
            // you could open a modal OR allow manual input from the form
            $username = $request->username ?? strtolower($validated['firstname']) . '.' . strtolower($validated['lastname']);
            $password = $request->password ?? 'password123';

            $user = User::create([
                'username' => $username,
                'password' => bcrypt($password),
                'role' => strtolower($validated['position']),
                'person_id' => $person->person_id,
                'is_active' => true,
            ]);

            // ✅ Attach to current branch
            $branchId = session('current_branch_id'); 
            if ($branchId) {
                $user->branches()->attach($branchId);
            }
        }

        return redirect()->back()->with('success', 'Employee hired successfully!');
    }
}

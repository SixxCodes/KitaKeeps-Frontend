<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Person;
use App\Models\Branch;
use App\Models\UserBranch;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'hardwareName' => ['required', 'string', 'max:150'],
                'username'      => ['required', 'string', 'max:50', 'unique:user,username'],
                'firstname'     => ['required', 'string', 'max:100'],
                'lastname'      => ['required', 'string', 'max:100'],
                'email'         => ['required', 'string', 'email', 'max:100', 'unique:person,email'],
                'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            // 1. Create Person
            $person = Person::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
            ]);

            // 2. Create Branch (hardware name)
            $branch = Branch::create([
                'branch_name' => $request->hardwareName,
                'location'    => null,
            ]);

            // 3. Create User (Owner role)
            $user = User::create([
                'username'    => $request->username,
                'password' => Hash::make($request->password),
                'role'        => 'Owner',
                'person_id'   => $person->person_id,
                'is_active'   => 1,
            ]);

            // 4. Link User to Branch
            $user_branch = UserBranch::create([
                'user_id'   => $user->user_id,
                'branch_id' => $branch->branch_id,
            ]);

            // 5. Fire Registered event + login
            // event(new Registered($user));
            // Auth::login($user);

            if ($request->expectsJson()) {
                return response()->json([
                    'success'  => true,
                    'redirect' => route('dashboard'),
                ]);
            }

            // fallback to normal redirect (non-AJAX)
            return redirect()->route('dashboard');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'errors'  => $e->errors(),
                ], 422);
            }

            throw $e; // default Laravel error for normal forms
        }
    }
}

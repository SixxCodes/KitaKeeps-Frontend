<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'supp_name' => 'required|string|max:255',
                'supp_contact' => 'nullable|string|max:20',
                'supp_address' => 'nullable|string|max:255',
                'supp_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $imagePath = null;
            if ($request->hasFile('supp_image')) {
                $imagePath = $request->file('supp_image')->store('suppliers', 'public');
            }

            Supplier::create([
                'supp_name' => $validated['supp_name'],
                'supp_contact' => $validated['supp_contact'] ?? null,
                'supp_address' => $validated['supp_address'] ?? null,
                'supp_image_path' => $imagePath,
            ]);

            return redirect()->back()->with('success', 'Supplier added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
    }

    public function index()
    {
        $suppliers = Supplier::paginate(5); // 5 per page

        return view('mySuppliers', ['suppliers' => $suppliers]);

    }
}

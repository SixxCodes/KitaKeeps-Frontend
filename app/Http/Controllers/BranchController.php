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
        // Remove related pivot rows first
        $branch->users()->detach();

        // Now delete the branch
        $branch->delete();

        return redirect()->back()->with('success', 'Branch deleted successfully!');
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

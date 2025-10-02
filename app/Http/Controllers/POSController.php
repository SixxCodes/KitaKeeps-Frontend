<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\BranchProduct;
use App\Models\ProductSupplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class POSController extends Controller
{
    public function index(Request $request)
    {
        $owner = auth()->user();

        // Get current branch from session (or fallback to first branch)
        $userBranches   = $owner->branches;
        $currentBranch  = $userBranches->where('branch_id', session('current_branch_id'))->first()
                            ?? $userBranches->sortBy('branch_id')->first();

        // Selected category (?category=...)
        $selectedCategory = $request->input('category');

        // 🔹 Distinct categories for this branch
        $categories = Product::whereHas('branch_products', function ($q) use ($currentBranch) {
                $q->where('branch_id', $currentBranch->branch_id);
            })
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        // 🔹 POS Products (branch + optional category filter)
        $posProducts = Product::with([
                'product_supplier.supplier',
                'branch_products' => function ($q) use ($currentBranch) {
                    $q->where('branch_id', $currentBranch->branch_id);
                }
            ])
            ->whereHas('branch_products', function ($q) use ($currentBranch) {
                $q->where('branch_id', $currentBranch->branch_id);
            })
            ->when($selectedCategory, function ($q) use ($selectedCategory) {
                $q->where('category', $selectedCategory);
            })
            ->orderBy('product_id', 'asc')
            ->get();

        return view('pos.index', compact('categories', 'posProducts', 'selectedCategory', 'currentBranch'));
    }
    
}
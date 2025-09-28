<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('modules.mySuppliers', function ($view) {
            $user = Auth::user();

            if ($user) {
                // Get query params
                $perPage = request()->query('per_page', 5);
                $search = request()->query('search');

                // Get branches user belongs to
                $branchIds = $user->branches->pluck('branch_id');

                // Build query
                $query = Supplier::whereIn('branch_id', $branchIds);

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('supp_name', 'like', "%{$search}%")
                          ->orWhere('supp_contact', 'like', "%{$search}%")
                          ->orWhere('supp_address', 'like', "%{$search}%");
                    });
                }

                $suppliers = $query->paginate($perPage)->withQueryString();

                $view->with('suppliers', $suppliers);
            }
        });

        View::composer('modules.myHardware', function ($view) {
            $user = Auth::user();

            if ($user) {
                // Entries per page & search query
                $perPage = request()->query('per_page', 5);
                $search = request()->query('search');

                // Get only branches that belong to this owner
                $branchIds = $user->branches->pluck('branch_id');

                $query = Branch::whereIn('branch_id', $branchIds);

                if ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('branch_name', 'like', "%{$search}%")
                          ->orWhere('location', 'like', "%{$search}%");
                    });
                }

                // Paginate results
                $branches = $query->orderBy('branch_id', 'asc')
                                  ->paginate($perPage)
                                  ->withQueryString();

                $view->with([
                    'branches' => $branches,
                    'perPage' => $perPage,
                    'search' => $search,
                ]);
            }
        });

        View::composer('*', function ($view) {
            $branchId = session('current_branch_id');
            $branch = null;

            if ($branchId) {
                $branch = Branch::with(['branchproducts.product.product_supplier.supplier'])
                    ->where('branch_id', $branchId)
                    ->first();
            }

            $view->with('branch', $branch);
        });

        // Share cart globally
        View::composer('*', function ($view) {
            // You can store cart in session, DB, or wherever you prefer
            $cart = Session::get('cart', []);  // default empty array if none
            $view->with('cart', $cart);
        });
    }
}

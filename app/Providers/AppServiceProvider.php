<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

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
    }
}

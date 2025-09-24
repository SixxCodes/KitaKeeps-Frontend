<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // ← import this
use App\Models\Supplier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('modules.mySuppliers', function ($view) {
            $perPage = request()->query('per_page', 5);
            $view->with('suppliers', Supplier::paginate($perPage));
        });
    }
}

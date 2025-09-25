<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SupplierController;

Route::post('/register-frontend', [RegisterUserController::class, 'register']);

Route::post('/login-frontend', [AuthenticatedSessionController::class, 'store']);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login-frontend', function () {
    return view('auth.login');
})->name('login');

Route::get('/register-frontend', function () {
    return view('auth.register');
});

Route::get('/dashboard', function () {
    return view('layouts.app');
})->middleware(['auth'])->name('dashboard'); // i-comment ni if di sa maggamit ug auth
// })->name('dashboard'); // i-comment ni if login is required na

Route::post('/suppliers', [SupplierController::class, 'store'])->name('suppliers.store');
Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
// Update supplier
Route::patch('/suppliers/{supplier}', [SupplierController::class, 'update'])->name('suppliers.update');

// Delete a supplier
Route::delete('/suppliers/{supplier}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

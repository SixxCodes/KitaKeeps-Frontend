<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;

Route::post('/register-frontend', [RegisterUserController::class, 'register']);

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
    return view('dashboard.owner.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); // i-comment ni if di sa maggamit ug auth
// })->name('dashboard'); // i-comment ni if login is required na

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

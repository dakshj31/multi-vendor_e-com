<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    // Show Login route
Route::get('login', [AdminController::class, 'create'])->name('admin.login');

    // Handle login form submission
Route::post('login', [AdminController::class, 'store'])->name('admin.login.request');    

Route::group(['middleware' => ['admin']], function () {
    // Dashboard route
Route::resource('dashboard', AdminController::class)->only(['index']);

    // Admin Logout

Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');    
    });
});


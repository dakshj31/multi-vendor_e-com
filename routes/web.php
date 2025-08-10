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

    // Display Update Password Page
 Route::get('update-password', [AdminController::class, 'edit'])->name('admin.update-password');   

    // Verify Password Route
 Route::post('verify-password', [AdminController::class, 'verifyPassword'])->name('admin.verify-password');

    // Update Password Route
 Route::post('update-password', [AdminController::class, 'updatePasswordRequest'])->name('admin.update-password.request');

    // Display Update Admin Details
 Route::get('update-details', [AdminController::class, 'editDetails'])->name('admin.update-details');  
 
    // Update Admin Details Route
 Route::post('update-details', [AdminController::class, 'updateDetails'])->name('admin.update-details.request');

    // Delete Profile Image Route
 Route::post('delete-profile-image', [AdminController::class, 'deleteProfileImage']);

    // Sub-Admins
 Route::get('subadmins', [AdminController::class, 'subadmins']);
 Route::post('update-subadmin-status', [AdminController::class, 'updateSubadminStatus']);
 Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin']);

    // Admin Logout
 Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');    
    });
});


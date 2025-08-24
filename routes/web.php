<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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
 Route::get('add-edit-subadmin/{id?}', [AdminController::class, 'addEditSubadmin']);
 Route::post('add-edit-subadmin/request', [AdminController::class, 'addEditSubadminRequest']);
 Route::get('delete-subadmin/{id}', [AdminController::class, 'deleteSubadmin']);
 Route::get('/update-role/{id}', [AdminController::class, 'updateRole']);
 Route::post('/update-role/request', [AdminController::class, 'updateRoleRequest']);

    // Categories
 Route::resource('categories', CategoryController::class);
 Route::post('update-category-status', [CategoryController::class, 'updateCategoryStatus']);
 Route::post('delete-category-image', [CategoryController::class, 'deleteCategoryImage']);
 Route::post('delete-sizechart-image', [CategoryController::class, 'deleteSizechartImage']);

     // Products
 Route::resource('products', ProductController::class);
 Route::post('update-product-status', [ProductController::class, 'updateProductStatus']);
 Route::post('/product/upload-image', [ProductController::class, 'uploadImage'])->name('product.upload.image');
 Route::post('/product/upload-video', [ProductController::class, 'uploadVideo'])->name('product.upload.video');
 Route::post('delete-product-main-image/{id?}', [ProductController::class, 'deleteProductMainImage']);
 Route::post('delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);
     
    // Admin Logout
 Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');    
    });
});


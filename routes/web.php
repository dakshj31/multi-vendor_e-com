<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('welcome');
});

Route::get('product-image/{size}/{filename}', function ($size, $filename) {
   $sizes = config('image_sizes.products');
   if (!isset($sizes[$size])) {
      abort(404, 'Invalid size.');
   }
   $width = $sizes[$size]['width'];
   $height = $sizes[$size]['height'];
   $path = public_path('front/images/products/' . $filename);
   if (!file_exists($path)) {
      abort(404, 'Image not found.');
   }
   $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
   $image = $manager->read($path)->resize($width, $height, function ($constraint) {
      $constraint->aspectRatio();
      $constraint->upsize();
   });
   $binary = $image->toJpeg(85); // Comparison with 85% quality
   return Response::make($binary)->header('Content-Type', 'image/jpeg');
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
 Route::post('/product/upload-images', [ProductController::class, 'uploadImages'])->name('product.upload.images');
 Route::post('/product/delete-temp-image', [ProductController::class, 'deleteTempImage'])->name('product.delete.temp.image');
 Route::get('delete-product-image/{id?}', [ProductController::class, 'deleteProductImage']);
 Route::post('/product/upload-video', [ProductController::class, 'uploadVideo'])->name('product.upload.video');
 Route::get('delete-product-main-image/{id?}', [ProductController::class, 'deleteProductMainImage']);
 Route::get('delete-product-video/{id}', [ProductController::class, 'deleteProductVideo']);
 Route::post('/products/update-image-sorting', [ProductController::class, 'updateImageSorting'])->name('admin.products.update-image-sorting');
 Route::post('/products/delete-dropzone-image', [ProductController::class, 'deleteDropzoneImage'])->name('admin.products.delete-image');
 Route::post('/products/delete-temp-image',[ProductController::class, 'deleteTempProductImage'])->name('product.delete.temp.altimage');
 Route::post('/products/delete-temp-video',[ProductController::class, 'deleteTempProductVideo'])->name('product.delete.temp.video');
   // Product Attributes
 Route::post('update-attribute-status', [ProductController::class, 'updateAttributeStatus']);
 Route::delete('delete-product-attribute/{id}', [ProductController::class, 'deleteProductAttribute']);

   // Save Column Orders
//  Route::post('/save-column-order', [AdminController::class, 'saveColumnOrder']);
 Route::post('/save-column-visibility', [AdminController::class, 'saveColumnVisibility']);


     
    // Admin Logout
 Route::get('logout', [AdminController::class, 'destroy'])->name('admin.logout');    
    });
});


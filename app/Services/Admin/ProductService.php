<?php 

namespace App\Services\Admin;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\AdminsRole;
use App\Models\Category;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Auth;


class ProductService
{
    public function products() {
        $products = Product::with('category')->get();

        // Set Admin/Subadmin Permissions for Products
        $productsModuleCount = AdminsRole::where([
            'subadmin_id' => Auth::guard('admin')->user()->id,
            'module' => 'products'
        ])->count();
        $status = "success";
        $message = "";
        $productsModule = [];
            if(Auth::guard('admin')->user()->role == "admin") {
                $productsModule = [
                    'view_access' => 1,
                    'edit_access' => 1,
                    'full_access' => 1
                ];
            } elseif ($productsModuleCount == 0) {
                $status = "error";
                $message = "This feature is restricted for you!";
            } else {
                $productsModule = AdminsRole::where([
                    'subadmin_id' => Auth::guard('admin')->user()->id,
                    'module' => 'products'
                ])->first()->toArray();
            }
            return [
                "products" => $products,
                "productsModule" => $productsModule,
                "status" => $status,
                "message" => $message
            ];
    }

    public function updateProductStatus($data)
    {
        $status = ($data['status'] == "Active") ? 0 : 1;
        Product::where('id', $data['product_id'])->update(['status' => $status]);
        return $status;
    }

    public function deleteProduct($id)
    {
        Product::where('id', $id)->delete();
        $message = 'Product deleted successfully!';
        return ['message' => $message];
    }

    public function addEditProduct($request)
{
    $data = $request->all();

    if (isset($data['id']) && $data['id'] != "") {
        $product = Product::find($data['id']);
        $message = "Product updated successfully!";
    } else {
        $product = new Product;
        $message = "Product added successfully!";
    }

    $product->admin_id = Auth::guard('admin')->user()->id;
    $product->admin_role = Auth::guard('admin')->user()->role;

    $product->category_id = $data['category_id'];
    $product->product_name = $data['product_name'];
    $product->product_code = $data['product_code'];
    $product->product_color = $data['product_color'];
    $product->family_color = $data['family_color'];
    $product->group_code = $data['group_code'];
    $product->product_weight = $data['product_weight'] ?? 0;
    $product->product_price = $data['product_price'];
    $product->product_gst = $data['product_gst'] ?? 0;
    $product->product_discount = $data['product_discount'] ?? 0;
    $product->is_featured = $data['is_featured'] ?? 'No';

    // Calculate discount & final price
    if (!empty($data['product_discount']) && $data['product_discount'] > 0) {
        $product->discount_applied_on = 'product';
        $product->product_discount_amount = ($data['product_price'] * $data['product_discount']) / 100;
    } else {
        $getCategoryDiscount = Category::select('discount')->where('id', $data['category_id'])->first();
        if ($getCategoryDiscount && $getCategoryDiscount->discount > 0) {
            $product->discount_applied_on = 'category';
            $product->product_discount = $getCategoryDiscount->discount;
            $product->product_discount_amount = ($data['product_price'] * $getCategoryDiscount->discount) / 100;
        } else {
            $product->discount_applied_on = '';
            $product->product_discount_amount = 0;
        }
    }

    $product->final_price = $data['product_price'] - $product->product_discount_amount;

    // Optional fields
    $product->description = $data['description'] ?? '';
    $product->wash_care = $data['wash_care'] ?? '';
    $product->search_keywords = $data['search_keywords'] ?? '';
    $product->meta_title = $data['meta_title'] ?? '';
    $product->meta_keywords = $data['meta_keywords'] ?? '';
    $product->meta_description = $data['meta_description'] ?? '';
    $product->status = 1;

    // Main image
    if (!empty($data['main_image_hidden'])) {
        $sourcePath = public_path('temp/' . $data['main_image_hidden']);
        $destinationPath = public_path('front/images/products/' . $data['main_image_hidden']);

        if (file_exists($sourcePath)) {
            @copy($sourcePath, $destinationPath);
            @unlink($sourcePath);
        }

        $product->main_image = $data['main_image_hidden'];
    }

    // Video
    if (!empty($data['product_video_hidden'])) {
        $sourcePath = public_path('temp/' . $data['product_video_hidden']);
        $destinationPath = public_path('front/videos/products/' . $data['product_video_hidden']);

        if (file_exists($sourcePath)) {
            @copy($sourcePath, $destinationPath);
            @unlink($sourcePath);
        }

        $product->product_video = $data['product_video_hidden'];
    }

    $product->main_image = $request->main_image ?? $product->main_image;
    $product->product_video = $request->product_video ?? $product->product_video;

    $product->save();

    // Alternate images
    if (!empty($data['product_images'])) {
        $imageFiles = is_array($data['product_images']) ? $data['product_images'] : explode(',', $data['product_images']);
        $imageFiles = array_filter($imageFiles);

        foreach ($imageFiles as $index => $filename) {
            $sourcePath = public_path('temp/' . $filename);
            $destinationPath = public_path('front/images/products/' . $filename);

            if (file_exists($sourcePath)) {
                @copy($sourcePath, $destinationPath);
                @unlink($sourcePath);
            }

            ProductImage::create([
                'product_id' => $product->id,
                'image' => $filename,
                'sort' => $index,
                'status' => 1
            ]);
        }
    }

    // Product attributes
    $total_stock = 0;

    if (isset($data['sku'])) {
        foreach ($data['sku'] as $key => $value) {
            if (!empty($value) && !empty($data['size'][$key]) && !empty($data['price'][$key])) {
                // SKU check
                $attrCountSKU = ProductsAttribute::where('sku', $value)->count();
                if ($attrCountSKU > 0) {
                    return [
                        'status' => 'error',
                        'message' => "SKU already exists. Please add another SKU!"
                    ];
                }

                // Size check
                $attrCountSize = ProductsAttribute::where('product_id', $product->id)
                    ->where('size', $data['size'][$key])
                    ->count();
                if ($attrCountSize > 0) {
                    return [
                        'status' => 'error',
                        'message' => "Size already exists. Please add another Size!"
                    ];
                }

                if (empty($data['stock'][$key])) {
                    $data['stock'][$key] = 0;
                }

                $attribute = new ProductsAttribute;
                $attribute->product_id = $product->id;
                $attribute->sku = $value;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->sort = $data['sort'][$key];
                $attribute->status = 1;
                $attribute->save();

                $total_stock += $data['stock'][$key];
            }
        }
    }

    // Edit attributes
    if (isset($data['id']) && !empty($data['attrId'])) {
        foreach ($data['attrId'] as $key => $attrId) {
            if (!empty($attrId)) {
                $update_attr = [
                    'price' => $data['update_price'][$key],
                    'stock' => $data['update_stock'][$key],
                    'sort' => $data['update_sort'][$key]
                ];
                ProductsAttribute::where('id', $attrId)->update($update_attr);
                $total_stock += $data['update_stock'][$key];
            }
        }
    }

    // Update stock
    Product::where('id', $product->id)->update(['stock' => $total_stock]);

    return [
        'status' => 'success',
        'message' => $message
    ];
}


    public function handleImageUpload($file)
    {
        $imageName = time().'_'.rand(1111,9999).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('front/images/products'), $imageName);
        return $imageName;
    }

    public function handleVideoUpload($file)
    {
        $videoName = time().'.'. $file->getClientOriginalExtension();
        $file->move(public_path('front/videos/products'), $videoName);
        return $videoName;
    }

    public function deleteProductMainImage($id)
    {
        // Get Product Main Image
        $product = Product::select('main_image')->where('id', $id)->first();

        if (!$product || !$product->main_image) {
            return "No image found.";
        }

        // Get Product Image Path
        $image_path = public_path('front/images/products/' . $product->main_image);

        // Delete Product Main Image if exists
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete Product Main Image from products table
        Product::where('id', $id)->update(['main_image'=> null]);

        $message = "Product main image has been deleted successfully!";
        return $message;
    }

    public function deleteProductImage($id)
    {
        // Get Product Image
        $product = ProductImage::select('image')->where('id', $id)->first();

        if (!$product || !$product->image) {
            return "No image found.";
        }

        // Get Product Image Path
        $image_path = public_path('front/images/products/' . $product->image);

        // Delete Product Image if exists
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // Delete Product Image from product_images table
        ProductImage::where('id', $id)->delete();

        $message = "Product image has been deleted successfully!";
        return $message;
    }

    public function deleteProductVideo($id)
    {
        // Get Product Video
        $productVideo = Product::select('product_video')->where('id', $id)->first();

        // Get Product Video Path
        $product_video_path = 'front/videos/products/';

        // Delete Product Video from folder if exists
        if (file_exists($product_video_path.$productVideo->product_video)) {
            unlink($product_video_path.$productVideo->product_video);
        }

        // Delete Product Video Name from products table
        Product::where('id', $id)->update(['product_video'=> null]);

        $message = "Product Video has been deleted successfully!";
        return $message;
    }

    public function updateAttributeStatus($data)
    {
        $status = ($data['status'] == "Active") ? 0 : 1;
        ProductsAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
        return $status;
    }

    public function deleteProductAttribute($id)
{
    $attribute = ProductsAttribute::find($id);

    if ($attribute) {
        $attribute->delete();
        return redirect()->back()->with('success', 'Product Attribute has been deleted successfully!');
    }

    return redirect()->back()->with('error', 'Product Attribute not found!');
}

}
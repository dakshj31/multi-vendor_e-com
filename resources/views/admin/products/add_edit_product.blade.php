@extends('admin.layout.layout')
@section('content')
<main class="app-main">
<!--begin::App Content Header-->
<div class="app-content-header">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Row-->
<div class="row">
<div class="col-sm-6"><h3 class="mb-0">Catalogue Management</h3></div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-end">
<li class="breadcrumb-item"><a href="#">Home</a></li>
<li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
</ol>
</div>
</div>
<!--end::Row-->
</div>
<!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Row-->
<div class="row g-4">
<!--begin::Col-->

<!--begin::Col-->
<div class="col-md-6">
<!--begin::Quick Example-->
<div class="card card-primary card-outline mb-4">
<!--begin::Header-->
<div class="card-header"><div class="card-title">{{$title}}</div></div>
<!--end::Header-->

 @if (Session::has('error_message'))
          <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <strong>Error:</strong> {{Session::get('error_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

         @if (Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <strong>Success:</strong> {{Session::get('success_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

           @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <strong>Error!</strong> {!! $error !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endforeach

<!--begin::Form-->
@if(!empty($product->id))
    <form name="productForm" id="productForm"
          action="{{ route('products.update', $product->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form name="productForm" id="productForm"
          action="{{ route('products.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
@endif

{{-- <form name="categoryForm" id="categoryForm" action="{{ isset($category)? route('categories.update', $category->id): route('categories.store') }}"
    method="POST" enctype="multipart/form-data"> @csrf
    @if (isset($category)) @method('PUT') @endif --}}
    <div class="card-body">
        <div class="mb-3">
            <label for="category_id">Category Level(Selct Category)*</label>
            <select name="category_id" class="form-control">
                <option value="">Select</option>
                @foreach ($getCategories as $cat)
                    <option value="{{$cat['id']}}" @if (old('category_id', $product->category_id ?? ' ') == $cat['id']) selected  
                    @endif>{{$cat['name']}}</option>
                    @if (!empty($cat['subcategories']))
                        @foreach ($cat['subcategories'] as $subcat)
                            <option value="{{$subcat['id']}}" @if (old('category_id', $category->category_id ?? ' ') == $subcat['id']) selected
                            @endif>&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subcat['name'] }}</option>
                            @if (!empty($subcat['subcategories']))
                                @foreach ($subcat['subcategories'] as $subsubcat)
                                    <option value="{{$subsubcat['id']}}" @if (old('category_id', $product->category_id ?? ' ') == $subsubcat['id']) selected
                                    @endif> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{$subsubcat['name']}}</option>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-3">
          <label for="product_name" class="form-label">Product Name*</label>
          <input type="text" class="form-control" id="product_name" name="product_name" value="{{old('product_name', $product->product_name ?? '')}}" placeholder="Enter Product Name">
        </div>

        <div class="mb-3">
          <label for="product_code" class="form-label">Product Code*</label>
          <input type="text" class="form-control" id="product_code" name="product_code" value="{{old('product_code', $product->product_code ?? '')}}" placeholder="Enter Product Code">
        </div>

        <div class="mb-3">
          <label for="product_color" class="form-label">Product Color</label>
          <input type="text" class="form-control" id="product_color" name="product_color" value="{{old('product_color', $product->product_color ?? '')}}" placeholder="Enter Product Color">
        </div>

        <?php $familyColors = \App\Models\Color::colors(); ?>
        <div class="mb-3">
          <label for="family_color" class="form-label">Family Color</label>
          <select name="family_color" class="form-control">
            <option value="">Please Select</option>
            @foreach ($familyColors as $color)
                <option value="{{ $color->name }}" @if (isset($product['family_color']) && $product['family_color'] == $color->name)
                    selected @endif> {{ $color->name}}
                  </option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label for="group_code" class="form-label">Group Code</label>
          <input type="text" class="form-control" id="group_code" name="group_code" value="{{old('group_code', $product->group_code ?? '')}}" placeholder="Enter Group Code">
        </div>

        <div class="mb-3">
          <label for="product_price" class="form-label">Product Price*</label>
          <input type="text" class="form-control" id="product_price" name="product_price" value="{{old('product_price', $product->product_price ?? '')}}" placeholder="Enter Product Price">
        </div>

        <div class="mb-3">
          <label for="product_discount" class="form-label">Product Discount (%)</label>
          <input type="number" class="form-control" step="0.01" id="product_discount" name="product_discount" value="{{old('product_discount', $product->product_discount ?? '')}}" placeholder="Enter Product Discount">
        </div>

        <div class="mb-3">
          <label for="product_gst" class="form-label">Product GST (%)</label>
          <input type="number" class="form-control" step="0.01" id="product_gst" name="product_gst" value="{{old('product_gst', $product->product_gst ?? '')}}" placeholder="Enter Product GST">
        </div>

        <div class="mb-3">
          <label for="product_weight" class="form-label">Product Weight (Grams)</label>
          <input type="number" class="form-control" step="0.01" id="product_weight" name="product_weight" value="{{old('product_weight', $product->product_weight ?? '')}}" placeholder="Enter Product Weight">
        </div>

          {{-- Product main image upload field --}}
          <div class="mb-3">
            <label for="main_image_dropzone" class="form-label">Product Main Image(Max 500 KB)</label>
            <div class="dropzone" id="mainImageDropzone"></div>

             {{-- hidden input to send uploaded image --}}
            <input type="hidden" name="main_image" id="main_image_hidden">

            @if (!empty($product['main_image']))
                <a target="_blank" href="{{url('front/images/products/'.$product['main_image'])}}">
                <img src="{{asset('front/images/products/'.$product['main_image'])}}" style="width:50px; margin:10px;"></a>
                <a href="javascript:void(0)" style='color:#3f6ed3;' class="confirmDelete" title="Delete Product Image" data-module="product-main-image" data-id="{{$product['id']}}"><i class="fas fa-trash"></i></a>
            @endif
           
          </div>

          <div class="mb-3">
            <label for="product_images_dropzone" class="form-label">
              Alternate Product Images (Multiple Uploads Allowed, Max 500 kb each)
            </label>
            <div class="dropzone" id="productImagesDropzone"></div>
            @if (isset($product->product_images) && $product->product_images->count() > 0)
                @foreach ($product->product_images as $img)
                    <div style="display:inline-block; position:relative; margin:5px;">
                      <a href="{{ url('front/images/products/' . $img->image) }}" target="_blank">
                      <img src="{{asset('front/images/products/' . $img->image)}}" style="width:50px;"></a>
                      <a href="javascript:void(0)" class="confirmDelete" data-module="product-image" data-id="{{$img->id}}"
                        data-image="{{$img->img}}"><i class="fas fa-trash" style="position:absolute;top:0;right:0;color:red;"></i></a>
                    </div>
                @endforeach
            @endif
            {{-- Hidden input to collect alternate images --}}
            <input type="hidden" name="product_images" id="product_images_hidden">
          </div>

          {{-- Product video upload file --}}
          <div class="mb-3">
            <label for="product_video_dropzone" class="from-label">Product Video(Max 2 MB)</label>
            <div class="dropzone" id="productVideoDropzone"></div>

            {{-- hidden input to send uploaded video --}}
            <input type="hidden" name="product_video" id="product_video_hidden">

            @if (!empty($product['product_video']))
                <a target="_blank" href="{{url('front/videos/products/'.$product['product_video'])}}">View Video</a>
                <a href="javascript:void(0)" class="confirmDelete" data-module="product-video" data-id="{{$product['id']}}">Delete Video</a>
            @endif
            
          </div>

        <div class="mb-3">
          <label for="wash_care" class="form-label">Wash Care</label>
          <textarea name="wash_care" class="form-control" placeholder="Enter Wash Care">{{old('wash_care', $product->wash_care ?? '')}}</textarea>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Product Description</label>
          <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Product Description">{{old('description', $product->description ?? '')}}</textarea>
        </div>

        <div class="mb-3">
          <label for="search_keywords" class="form-label">Search Keywords</label>
          <textarea class="form-control" name="search_keywords" id="search_keywords" placeholder="Enter Search Keywords">{{old('search_keywords', $product->search_keywords ?? '')}}</textarea>
        </div>

        <div class="mb-3">
          <label for="meta_title" class="form-label">Meta Title</label>
          <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title', $product->meta_title ?? '')}}">
        </div>

        <div class="mb-3">
          <label for="meta_description" class="form-label">Meta  Description</label>
          <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description', $product->meta_description ?? '')}}">
        </div>

        <div class="mb-3">
          <label for="meta_keywords" class="form-label">Meta Keywords</label>
          <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="{{old('meta_keywords', $product->meta_keywords ?? '')}}">
        </div>

        <div class="mb-3">
          <label for="is_featured" class="form-label">Is Featured?</label>
          <select name="is_featured" class="form-sheet">
            <option value="No" {{ (old('is_featured', $product->is_featured ?? '') == 'No') ? 'selected' : ''}}>No</option>
            <option value="Yes" {{ (old('is_featured', $product->is_featured ?? '') == 'Yes') ? 'selected' : ''}}>Yes</option>
          </select>
        </div>
        {{-- <div class="mb-3">
          <label for="menu_status" class="form-label">Show on Header Menu</label>
          <input type="checkbox" name="menu_status" value="1" {{ !empty($category->menu_status) ? 'checked' : ''}}>
        </div> --}}
    </div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<!--end::Form-->
</div>
<!--end::Quick Example-->



</div>
<!--end::Col-->
</div>
<!--end::Row-->
</div>
<!--end::Container-->
</div>
<!--end::App Content-->
</main>
@endsection
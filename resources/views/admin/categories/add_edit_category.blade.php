@extends('admin.layout.layout')
@section('content')
<main class="app-main">
<!--begin::App Content Header-->
<div class="app-content-header">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Row-->
<div class="row">
<div class="col-sm-6"><h3 class="mb-0">Categories Management</h3></div>
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
<form name="categoryForm" id="categoryForm" action="{{ isset($category)? route('categories.update', $category->id): route('categories.store') }}"
    method="POST" enctype="multipart/form-data"> @csrf
    @if (isset($category)) @method('PUT') @endif
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label" for="category_name">Category Name*</label>
            <input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" value="{{ old('category_name', $category->name??'') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="category_image">Category Image</label>
            <input type="file" name="category_image" id="category_image" class="form-control" accept="image/*">
            @if (!empty($category->image))
                <div class="mt-2">
                    <img src="{{ asset('front/images/categories/'.$category->image) }}" width="50" alt="Category Image">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="size_chart" class="form-label">Size Chart</label>
            <input type="file" name="size_chart" id="size_chart" class="form-control" accept="image/*">
             @if (!empty($category->size_chart))
                <div class="mt-2">
                    <img src="{{ asset('front/images/sizecharts/'.$category->size_chart) }}" width="50" alt="Size Chart">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label for="category_discount" class="form-label">Category Discount</label>
            <input type="text" class="form-control" name="category_discount" id="category_discount" placeholder="Enter Category Discount" value="{{ old('category_discount', $category->discount??'') }}">
        </div>
        <div class="mb-3">
            <label for="url" class="form-label">Category URL*</label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Enter Category URL" value="{{ old('url', $category->url??'') }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Category Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter Description">{{ old('description',$category->description ??'')}}</textarea> 
        </div>
        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title', $category->meta_title??'') }}">
        </div>
        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description" value="{{ old('meta_description', $category->meta_description??'') }}">
        </div>
        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" value="{{ old('meta_keywords', $category->meta_keywords??'') }}">
        </div>
        <div class="mb-3">
            <label for="menu_status">Show on Header Menu</label><br>
            <input type="checkbox" name="menu_status" value="1" {{!empty($category->menu_status) ? 'checked': ''}}>
        </div>
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
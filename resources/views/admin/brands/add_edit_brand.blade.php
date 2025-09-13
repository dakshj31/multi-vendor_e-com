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
{{-- @if(!empty($brand->id))
    <form name="brandForm" id="brandForm"
          action="{{isset($brand)? route('brands.update', $brand->id) }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
@else
    <form name="brandForm" id="brandForm"
          action="{{ route('brands.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
@endif --}}

<form name="brandForm" id="brandForm" action="{{ isset($brand)? route('brands.update', $brand->id): route('brands.store') }}"
    method="POST" enctype="multipart/form-data"> @csrf
    @if (isset($brand)) @method('PUT') @endif
    
    <div class="card-body">
        <div class="mb-3">
            <label for="name" class="form-label">Brand Name*</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Brand Name" value="{{old('name',$brand->name ??'')}}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Brand Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            @if (!empty($brand->image))
                <div class="mt-2">
                    <img src="{{asset('front/images/brands/' .$brand->image)}}" width="50" alt="Brand Image">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="logo" class="form-label">Brand Logo</label>
            <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
             @if (!empty($brand->logo))
                <div class="mt-2">
                    <img src="{{asset('front/images/logos/' .$brand->logo)}}" width="50" alt="Logo">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="brand_discount" class="form-label">Brand Discount</label>
            <input type="text" class="form-control" name="brand_discount" value="{{old('brand_discount', $brand->discount ?? '')}}" id="brand_discount" placeholder="Enter Brand Discount">
        </div>

        <div class="mb-3">
            <label for="url" class="form-label">Brand URL*</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter Brand URL" value="{{old('url',$brand->url ?? '')}}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Brand Description*</label>
            <textarea name="description" class="form-control" id="description" rows="3" placeholder="Enter Description">{{ old('description',$brand->description ??'')}}</textarea> 
        </div>

         <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title', $brand->meta_title??'') }}">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <input type="text" class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description" value="{{ old('meta_description', $brand->meta_description??'') }}">
        </div>

        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="Enter Meta Keywords" value="{{ old('meta_keywords', $brand->meta_keywords??'') }}">
        </div>

        <div class="mb-3 d-flex align-items-center">
            <label for="menu_status" class="me-2 mb-0">Show on Header Menu</label><br>
            <input type="checkbox" name="menu_status" value="1" {{!empty($brand->menu_status) ? 'checked': ''}} >
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
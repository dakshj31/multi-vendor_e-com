@extends('admin.layout.layout')
@section('content')
<main class="app-main">
<!--begin::App Content Header-->
<div class="app-content-header">
<!--begin::Container-->
<div class="container-fluid">
<!--begin::Row-->
<div class="row">
<div class="col-sm-6"><h3 class="mb-0">Admin Management</h3></div>
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
<form name="subadminForm" id="subadminForm" action="{{ url('admin/update-role/request/')}}" method="POST">@csrf
    <input type="hidden" name="subadmin_id" value="{{ $id }}">
    @if (!empty($subadminRoles))
        @foreach ($subadminRoles as $role)
            @if ($role['module']=="categories")
                @php
                    $viewCategories = $role['view_access'] == 1 ? "checked" : "";
                    $editCategories = $role['edit_access'] == 1 ? "checked" : "";
                    $fullCategories = $role['full_access'] == 1 ? "checked" : "";
                @endphp
            @endif
        @endforeach
    @endif

    <div class="card-body">
        <div class="form-group col-md-12">
            <label for="categories">Categories:</label>
            <input type="checkbox" name="categories[view]" value="1" {{ $viewCategories ?? ''}}> View Access
            <input type="checkbox" name="categories[edit]" value="1" {{ $editCategories ?? ''}}> View/Edit Access
            <input type="checkbox" name="categories[full]" value="1" {{ $fullCategories ?? ''}}> Full Access
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
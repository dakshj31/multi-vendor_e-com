@extends('admin.layout.layout')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        @if (Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <strong>Success:</strong> {{Session::get('success_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        @if (Session::has('error_message'))
          <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            <strong>Error:</strong> {{Session::get('error_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
        <!--begin::App Content-->
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
      <!-- Categories -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-primary">
          <div class="inner">
            <h3>{{ $categoriesCount }}</h3>
            <p>Total Categories</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 3h7v7H3V3zm0 11h7v7H3v-7zm11-11h7v7h-7V3zm0 11h7v7h-7v-7z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Products -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-success">
          <div class="inner">
            <h3>{{ $productsCount }}</h3>
            <p>Total Products</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 16V8a1 1 0 00-.553-.894l-8-4a1 1 0 00-.894 0l-8 4A1 1 0 003 8v8a1 1 0 00.553.894l8 4a1 1 0 00.894 0l8-4A1 1 0 0021 16z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Brands -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-warning">
          <div class="inner">
            <h3>{{ $brandsCount }}</h3>
            <p>Total Brands</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2l4 8H8l4-8zm0 20l-4-8h8l-4 8z"></path>
          </svg>
          <a href="#" class="small-box-footer link-dark">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Users -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-danger">
          <div class="inner">
            <h3>{{ $usersCount }}</h3>
            <p>Total Users</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.7 0 5-2.3 5-5s-2.3-5-5-5-5 2.3-5 5 2.3 5 5 5zm0 2c-3.3 0-10 1.7-10 5v3h20v-3c0-3.3-6.7-5-10-5z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
    </div>
    <!--end::Row-->

    <!-- Second Row -->
    <div class="row mt-4">
      <!-- Coupons -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-info">
          <div class="inner">
            <h3>{{ $couponsCount }}</h3>
            <p>Total Coupons</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 7h-2V3H5v4H3v10h2v4h14v-4h2V7zM7 5h10v14H7V5z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Orders -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-secondary">
          <div class="inner">
            <h3>{{ $ordersCount }}</h3>
            <p>Total Orders</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M3 6l3 12h12l3-12H3zm5 2h8l-1.5 6h-5L8 8z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Pages -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-dark">
          <div class="inner">
            <h3>{{ $pagesCount }}</h3>
            <p>Total Pages</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M6 2h9l5 5v15a1 1 0 01-1 1H6a1 1 0 01-1-1V3a1 1 0 011-1z"></path>
          </svg>
          <a href="#" class="small-box-footer link-light">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>

      <!-- Enquiries -->
      <div class="col-lg-3 col-6">
        <div class="small-box text-bg-light">
          <div class="inner">
            <h3>{{ $enquiriesCount }}</h3>
            <p>Total Enquiries</p>
          </div>
          <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
          </svg>
          <a href="#" class="small-box-footer link-dark">More info <i class="bi bi-link-45deg"></i></a>
        </div>
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->

      </main>
@endsection
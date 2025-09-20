@extends('admin.layout.layout')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Banner Management</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Banners</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
       <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Banners</h3>
                            @if ($bannersModule['edit_access']==1 || $bannersModule['full_access']==1)
                            <a style="max-width:150px;float: right; display: inline-block;" href="{{ route('banners.create') }}" class="btn btn-block btn-primary">Add Banner</a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if (Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <strong>Success:</strong> {{Session::get('success_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Link</th>
                                        <th>Title</th>
                                        <th>Alt</th>
                                        <th>Sort</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr>
                                            <td>
                                                <img src="{{ asset('front/images/banners/'.$banner->image)}}" width="100">
                                            </td>
                                            <td>{{$banner->type}}</td>
                                            <td>{{$banner->link}}</td>
                                            <td>{{$banner->title}}</td>
                                            <td>{{$banner->alt}}</td>
                                            <td>{{$banner->sort}}</td>
                                            <td>
                                                @if ($bannersModule['edit_access'] ==1 || $bannersModule['full_access'] ==1)
                                                    <a href="javascript:void(0)" class="updateBannerStatus" data-banner-id="{{$banner->id}}">
                                                        <i class="fas fa-toggle-{{ $banner->status ? 'on' : 'off' }}" style="color: {{$banner->status ? '#3f6ed3' : 'grey' }}" data-status="{{$banner->status ? 'Active' : 'Inactive' }}"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($bannersModule['edit_access'] ==1 || $bannersModule['full_access'] ==1)
                                                    <a href="{{ route('banners.edit', $banner->id) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>&nbsp;
                                                @endif
                                                @if ($bannersModule['full_access'] ==1)
                                                    <form action="{{route('banners.destroy', $banner->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="confirmDelete" data-module="banner" data-id="{{$banner->id}}" style="border:none;background: none;color:#3f6ed3">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
      </main>
@endsection
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
                  <li class="breadcrumb-item active" aria-current="page">Brands</li>
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
                            <h3 class="card-title">Brands</h3>
                            @if ($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)
                            <a style="max-width:150px;float: right; display: inline-block;" href="{{ url('admin/brands/create') }}" class="btn btn-block btn-primary">Add Brand</a>
                            @endif
                        </div>
                        <div class="card-body">
                            @if (Session::has('success_message'))
          <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            <strong>Success:</strong> {{Session::get('success_message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
                            <table id="brands" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th>Creatod On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brands as $brand)
                                        <tr>
                                            <td>{{$brand->id}}</td>
                                            <td>{{$brand->name}}</td>
                                            <td>{{$brand->url}}</td>
                                            <td>{{$brand->created_at->format('F j, Y, g:i a') }}</td>
                                            <td>
                                                 @if ($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)
                                                {{-- actions enable/diasble edit,delte will be added here --}}
                                                @if ($brand->status == 1)
                                                    <a class="updateBrandStatus" data-brand-id="{{$brand->id}}"
                                                         style="color:3f6ed3" href="javascript:void(0)"><i class="fas fa-toggle-on" data-status="Active"></i></a>
                                                @else
                                                    <a class="updateBrandStatus" data-brand-id="{{$brand->id}}"
                                                         style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" data-status="Inactive"></i></a>
                                                @endif
                                                &nbsp;&nbsp;
                                                @if ($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)
                                                <a href="{{ url('admin/brands/'.$brand->id.'/edit') }}">
                                                <i class="fas fa-edit"></i></a>
                                                &nbsp;&nbsp;
                                                @endif
                                                @if ($brandsModule['full_access']==1)
                                                <form action="{{route('brands.destroy',$brand->id) }}" method="POST" 
                                                    style="display:inline-block;">@csrf @method('DELETE')
                                                    <button type="button" class="confirmDelete" name="Brand" style="border:none; background:none; color:#3f6ed3;" href="javascript:void(0)" data-module="brand" data-id="{{ $brand->id }}" title="Delete Brand">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endif
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
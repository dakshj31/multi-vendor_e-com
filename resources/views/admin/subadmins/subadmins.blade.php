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
                  <li class="breadcrumb-item active" aria-current="page">Subadmins</li>
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
                            <h3 class="card-title">Subadmins</h3>
                        </div>
                        <div class="card-body">
                            <table id="subadmins" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subadmins as $subadmin)
                                        <tr>
                                            <td>{{$subadmin->id}}</td>
                                            <td>{{$subadmin->name}}</td>
                                            <td>{{$subadmin->mobile}}</td>
                                            <td>{{$subadmin->email}}</td>
                                            <td>@if ($subadmin->status==1)
                                                <a class="updateSubadminStatus" data-subadmin_id="{{ $subadmin->id }}" style='color:#3f6ed' href="javascript:void(0)">
                                                    <i class="fas fa-toggle-on" data-status="Active"></i>
                                                </a>
                                                @else
                                                <a class="updateSubadminStatus" data-subadmin_id="{{ $subadmin->id }}" style='color:grey' href="javascript:void(0)"><i class="fas fa-toggle-off" data-status="Inactive"></i>
                                                </a>
                                                @endif&nbsp;&nbsp; <a style='color:#3f6ed' title="Delete Subadmin" href="{{url('admin/delete-subadmin/'.$subadmin->id)}}"><i class="fas fa-trash"></i></a>
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
@extends('admin.layout.layout')
@section('content')
<main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">{{$title}}</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

       <div class="app=content">
        <div class="container-fluid">
            @if (Session::has('success_message'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong>Success:</strong> {{Session::get('success_message')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$title}}</h3>
                    <a href="{{route('filters.create')}}" class="btn btn-primary float-end">Add Filter</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Filter Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($filters as $filter)
                                <tr>
                                    <td>{{$filter->id}}</td>
                                    <td>{{$filter->filter_name}}</td>
                                    <td>@if ($filter->categories->count() > 0)
                                        {{$filter->categories->pluck('name')->join(',')}}
                                    @else
                                        
                                    @endif
                                </td>
                                <td>
                                    @if ($filter->status == 1)
                                        <a href="javascript:void(0)" class="updateFilterStatus" data-filter-id="{{$filter->id}}" style="color:#3f6ed3">
                                            <i class="fas fa-toggel-on" data-status="Active"></i></a>
                                    @else
                                        <a href="javascript:void(0)" class="updateFilterStatus" data-filter-id="{{$filter->id}}" style="color:grey">
                                            <i class="fas fa-toggel-off" data-status="Inactive"></i></a>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('filters.edit', $filter->id)}}"><i class="fas fa-edit"></i></a>$nbsp;
                                    <form action="{{route('filters.destroy', $filter->id)}}" method="POST" style="display:inline-block;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="confirmDelete" data-module="filter" data-id="{{$filter->id}}" style="border:none;background:none;color:red;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                    &nbsp;
                                    <a href="{{route('filter-values.index', $filter->id)}}" class="btn btn-sm btn-secondary">Manage Values</a>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
       </div>
      </main>
@endsection
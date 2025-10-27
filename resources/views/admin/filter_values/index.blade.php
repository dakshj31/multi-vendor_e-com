@extends('admin.layout.layout')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Manage Filter Values - {{$filter->filter_name}} </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="{{route('filters.index')}}">Filters</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Filter Values</li>
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
                                <h3 class="card-title">Filter Values</h3>
                                <a style="max-width:200px; float:right;" href="{{route('filter-values.create',$filter->id)}}" class="btn btn-block btn-primary">Add Filter Value</a>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                        <strong>Success:</strong>{{Session::get('success_message')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <table id="filterValue" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Value</th>
                                            <th>Sort</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($filterValues as $value)
                                            <tr>
                                                <td>{{$value=>id}}</td>
                                                <td>{{ucfirst($value->value)}}</td>
                                                <td>{{$value->sort}}</td>
                                                <td>@if ($value->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                    @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif</td>
                                                <td>
                                                    <a href="{{route('filter-values.edit',[$filter->id,$value->id])}}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                                    <form action="{{route('filter-values.destroy',[$filter->id, $value->id])}}" method="POST" style="display:inline-block;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger confirmDelete" name="Filter Value">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
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
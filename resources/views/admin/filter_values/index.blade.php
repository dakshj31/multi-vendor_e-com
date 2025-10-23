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
                                <a style="max-width:200px; float:right;" href=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
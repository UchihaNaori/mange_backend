@extends('partials.master_admin')
@section('title', 'List category')
@section('content')
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">List category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="card-header">
            <a href="{{ route('category.create') }}"><button class="btn btn-success"><i class="fas fa-thin fa-plus"></i>  Add new category</button></a>
            <button type="submit" class="delete-selected btn btn-danger m-1" id="btnDeleteAll" data-toggle="modal" data-target="#deleteAllCategory" style="display: none;">Delete all selected</button>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%" align="center">Id</th>
                                        <th align="center">Title</th>
                                        <th width="10%" align="center">Active</th>
                                        <th width="9%" align="center">Action</th>
                                        <th style="width: 5%"><input type="checkbox" id="checkDeleteAll" class="checkall"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                            <tr id="pid{{ $category->id }}">
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>
                                                    <input id="inputActive{{ $category->id }}" data-id="{{ $category->id }}"
                                                       class="toggle-class" type="checkbox" data-onstyle="success"
                                                       data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                                       data-off="Inactive" {{ $category->active == \App\Constants\Constant::ACTIVE ? 'checked' : '' }}
                                                       data-href="{{ route('category.setActive') }}">
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <button class="success btn btn-success" data-href="{{ route('category.update', $category->id) }}" id="btn-update-category">
                                                            <i class="nav-icon fas fa-edit"></i>
                                                        </button>
                                                        <button class="destroy btn btn-danger" data-toggle="modal" data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                                data-target="#category{{ $category->id }}" style="cursor: pointer;"><i class="fas fa-recycle"></i>
                                                        </button>
                                                    @include('category.modal.delete')
                                                    </div>
                                                </td>
                                                <td><input type="checkbox" value="{{ $category->id }}" name="idP" id="idP{{ $category->id }}" class="checkboxes"></td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="12" class="text-center">No data category</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <ul class="pagination pagination-sm m-0 float-right">
                                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('category.modal.delete_all')
    </div>
@stop
@section('js')
    <script src="{{ asset('js/category_index.js') }}"></script>
    <script>
        var deleteAllUrl = '{{ route('category.delete.all') }}';
    </script>
@stop

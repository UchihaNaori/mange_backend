@extends('partials.master_admin')
@section('title', 'New category')
@section('content')
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Category</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Update</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Update category</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form id="update-category">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter..." value="{{ $category->title }}">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Active</label>
                                                    <div class="row form-group" style="padding-left: 8px">
                                                        <div class="col-3 custom-control custom-radio">
                                                            <input name="active" id="active-yes" value="1" class="custom-control-input" type="radio" @if($category->active == \App\Constants\Constant::ACTIVE)checked @endif/>
                                                            <label for="active-yes" class="custom-control-label">Yes</label>
                                                        </div>
                                                        <div class="col-3 custom-control custom-radio">
                                                            <input name="active" id="active-no" value="0" class="custom-control-input" type="radio" @if($category->active == \App\Constants\Constant::INACTIVE)checked @endif/>
                                                            <label for="active-no" class="custom-control-label">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 form-group">
                                                <label>Description</label>
                                                <textarea id="description" class="form-control" rows="4" placeholder="Enter ..." name="description">{{ $category->description }}</textarea>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('category.index') }}"><button type="button" class="btn btn-default float-right">Cancel</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset("js/common.js") }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation_form/category/update.js') }}"></script>
@stop

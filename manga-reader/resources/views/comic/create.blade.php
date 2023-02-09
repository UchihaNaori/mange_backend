@extends('partials.master_admin')
@section('title', 'New comic')
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
                            <h1>Comic</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">General Form</li>
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
                                    <h3 class="card-title">New comic</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" id="create-comic" action="{{ route('comic.create') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                            <div class="col-10">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter...">
                                                    <span></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>Categories</label>
                                                    <br/>
                                                    <div class="row" style="padding-left: 8px">
                                                        @foreach($categories as $category)
                                                            <div class="col-3 custom-control custom-checkbox" style="padding-bottom: 20px">
                                                                <input class="custom-control-input checkboxes" type="checkbox" id="customCheckbox{{ $category->title }}" name="category[]" value="{{ $category->title }}">
                                                                <label for="customCheckbox{{ $category->title }}" class="custom-control-label">{{ $category->title }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Other name</label>
                                                    <input type="text" class="form-control" id="name" name="other-name" placeholder="Enter...">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Author</label>
                                                    <input type="text" class="form-control" id="name" name="author" placeholder="Enter...">
                                                    <span></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Avatar</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputFile">Cover image</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="exampleInputFile" name="coverImage">
                                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Synopsis</label>
                                                    <textarea id="description" class="form-control" rows="4" placeholder="Enter ..." name="synopsis"></textarea>
                                                    <span></span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Active</label>
                                                    <div class="row form-group" style="padding-left: 8px">
                                                        <div class="col-3 custom-control custom-radio">
                                                            <input name="active" id="active-yes" value="1" class="custom-control-input" type="radio" checked/>
                                                            <label for="active-yes" class="custom-control-label">Yes</label>
                                                        </div>
                                                        <div class="col-3 custom-control custom-radio">
                                                            <input name="active" id="active-no" value="0" class="custom-control-input" type="radio"/>
                                                            <label for="active-no" class="custom-control-label">No</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-10 form-group">

                                            </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Ok</button>
                                        <a href="{{ route('comic.index') }}"><button type="button" class="btn btn-default float-right">Cancel</button></a>
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
    <script src="{{ asset('js/validation_form/comic/create.js') }}"></script>
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    </script>
@stop

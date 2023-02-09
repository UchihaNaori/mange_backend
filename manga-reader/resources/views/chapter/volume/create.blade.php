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
                            <h1>{{ $comicName }}</h1>
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
                                    <h3 class="card-title">New volume</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form method="post" id="create-chapter" action="{{ route('chapter.create.volume', $comicId) }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <label>Comic</label>
                                                <select class="form-control select2bs4" style="width: 100%;" name="comic">
                                                    <option disabled>Choose a comic</option>
                                                    @foreach($comics as $comic)
                                                        <option value="{{ $comic->id }}" @if($comic->id == $comicId) selected @endif>{{ $comic->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Content volume</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="zip">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <!--                      <div class="input-group-append">-->
                                                    <!--                        <span class="input-group-text">Upload</span>-->
                                                    <!--                      </div>-->
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="chapter">Volume</label>
                                                <input type="text" class="form-control" id="chapter" name="name" placeholder="Enter...">
                                                <span></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="name-extend" placeholder="Enter...">
                                                <span></span>
                                            </div>

                                        </div>
                                        <div class="col-10 form-group">

                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Ok</button>
                                        <a href="{{ "/chapter/listVolume?comicId=".$comicId }}"><button type="button" class="btn btn-default float-right">Cancel</button></a>
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
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation_form/chapter/create_volume.js') }}"></script>
@stop

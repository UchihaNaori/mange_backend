@extends('partials.master')
@section('title', 'Register')
@section('content')
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h1"><b>Manga</b>Admin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form onsubmit="" id="quickForm">
                    <div class="input-group mb-3 form-group">
                        <input type="text" class="form-control" placeholder="Full name" name="name" id="name">
                    </div>
                    <div class="input-group mb-3 form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" id="email">
                    </div>
                    <div class="input-group mb-3 form-group" id="phone-number">
                        <input type="text" name="phone" class="form-control" placeholder="Phone Number" id="phone">
                    </div>
                    <div class="input-group mb-3 form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password">
                    </div>
                    <div class="input-group mb-3 form-group">
                        <input type="password" class="form-control" placeholder="Retype password" name="confirmPassword">
                    </div>
                    <div class="input-group mb-3 form-group">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Avatar</label>
                    </div>
                    <div class="row form-group">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login.view') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@stop
@section('js')
    <!-- jquery-validation -->
    <script src="{{ asset('js/alert/registerAlert.js') }}"></script>
    <script src="{{ asset('js/common.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/validation_form/log_res/register_form.js') }}"></script>
{{--    <script>--}}
{{--        $(function () {--}}
{{--            bsCustomFileInput.init();--}}
{{--        });--}}
{{--    </script>--}}
@stop

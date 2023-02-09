@extends('partials.master')
@section('title', 'Login')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h1"><b>Manga</b>Admin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="quickForm">
                    <div class="input-group mb-3 form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="input-group mb-3 form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="row form-group">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <!-- /.social-auth-links -->
                <p class="mb-1">
                    <a href="{{ route('forget-password') }}">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register.view') }}" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop
@section('js')
    <script src="{{ asset("js/common.js") }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('js/alert/loginAlert.js') }}"></script>
    <script src="{{ asset("js/validation_form/log_res/login_form.js") }}"></script>
@stop

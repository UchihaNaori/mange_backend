@extends('partials.master')
@section('title', 'Reset Password')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h1">Forget Password</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Type your email for reset password</p>

                <form role="form" method="post" onsubmit="return emailSendLink()" action="{{ route('forget-password') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email-login">Email</label>
                        <input type="text" id="email-reset-password" class="form-control" name="email" placeholder="Enter your email">
                        <p class="email-block"></p>
                    </div>
                    <div class="padding-top-20 card-header text-center">
                        <button class="btn btn-primary" type="submit">Send Password Reset Link</button>
                    </div>
                    <hr>

                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@stop
@section('js')
    <script src="{{ asset('js/validation_form/log_res/email_reset_password.js') }}"></script>

    @if(session()->has('success'))
        <script>
            alertSuccess();
        </script>
    @endif

    @if(session()->has('error'))
        <script>
            alertError();
        </script>
    @endif
@stop

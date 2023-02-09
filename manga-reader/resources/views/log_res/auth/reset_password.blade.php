@extends('partials.master')
@section('title', 'Reset Password')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h1">Reset password</a>
            </div>
            <div class="card-body">
{{--                <p class="login-box-msg">Type your email for reset password</p>--}}
                <form action="{{ route('reset.password.post') }}" onsubmit="return resetPasswordCheck()" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <label for="email-reset" class="col-md-4 col-form-label text-md-right">Email</label>
                        <div class="col-md-8">
                            <input type="text" id="email-reset" class="form-control" name="email">
                            <p class="email-block"></p>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-reset" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-8">
                            <input type="password" id="password-reset" class="form-control" name="password">
                            <p class="password-block"></p>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password-confirm-reset" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                        <div class="col-md-8">
                            <input type="password" id="password-confirm-reset" class="form-control" name="passwordConfirm">
                            <p class="confirm-password-block"></p>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="padding-top-20 card-header text-center">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
@stop
@section('js')
    <script src="{{ asset("js/validation_form/log_res/reset_password.js") }}"></script>
    @if(session()->has('error'))
        <script>
            let errorMes = '{{ session()->get('error') }}';
            alertError(errorMes);
        </script>
    @endif
    <script>
        $('.brands').remove();
    </script>
@stop

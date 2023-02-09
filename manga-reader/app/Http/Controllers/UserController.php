<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }

    //
    public function loginView()
    {
        return view('log_res.login');
    }

    public function login(Request $request)
    {
        return $this->userService->login($request);
    }

    public function logout()
    {
        $this->userService->logout();
        return redirect(route('login.view'));
    }

    public function registerView()
    {
        return view('log_res.register');
    }

    public function register(Request $request)
    {
        return $this->userService->register($request);
    }

    public function showForgetPassword ()
    {
        return view('log_res.auth.confirm_email');
    }

    public function submitForgetpassword (Request $request)
    {
        return $this->userService->forgetPassword($request);
    }

    public function getResetPasswordForm($token)
    {
        return view('log_res.auth.reset_password', ['token' => $token]);
    }

    public function submitResetpassword(Request $request)
    {
        return $this->userService->resetPassword($request);
    }
}

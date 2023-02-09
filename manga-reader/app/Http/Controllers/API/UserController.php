<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Friend;
use App\Models\ShareComic;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserServices $userService)
    {
        $this->userService = $userService;
    }
    public function register(Request $request)
    {
        $message = $this->userService->register($request);
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'message' => $message,
            'data' => $user
        ]);
    }

    public function login(Request $request)
    {
        $message = $this->userService->login($request);

        return response()->json($message);
    }

    public function searchUser(Request $request)
    {
        $key = $request->key;
        $users = User::where('name', 'like', '%'.$key.'%')->orWhere('email', 'like', '%'.$key.'%')->orWhere('phone', 'like', '%'.$key.'%')->get();

        foreach ($users as $user) {
            $user->image = asset($user->image);
        }

        return response()->json($users);
    }

    public function resetPassword(Request $request)
    {
        $user = User::findOrFail($request->userId);
        $user->password = md5($request->newPass);
        $user->update();
    }

    public function profile($userId)
    {
        $user = User::findOrFail($userId);
        $cntComic = Comic::where('user_id', $userId)->count();
        $cntShared = ShareComic::where('user_id', $userId)->count();
        $cntFriend = Friend::where('user_id1', $userId)->orWhere('user_id2', $userId)->count();
        $user->cntToShared = $cntShared;
        $user->amount_comic = $cntComic;
        $user->image = asset($user->image);
        $user->cnt_friend = $cntFriend;
        return response()->json($user);
    }
}

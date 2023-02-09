<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ShareComic;
use App\Models\User;
use App\Services\ShareComicService;
use Illuminate\Http\Request;

class ShareComicController extends Controller
{
    //
    protected $shareComicService;
    public function __construct(ShareComicService $shareComicService)
    {
        $this->shareComicService = $shareComicService;
    }

    public function create(Request $request)
    {
        return $this->shareComicService->create($request);
    }

    public function listShareUser($comicId)
    {
        $userIds = ShareComic::select('user_id')->where('comic_id', $comicId);
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $user->image = asset($user->image);
        }

        return response()->json($users);
    }

    public function delete(Request $request) {
        $shareComic = ShareComic::where('user_id', $request->userId)->where('comic_id', $request->comicId)->first();
        $shareComic->delete();
    }
}

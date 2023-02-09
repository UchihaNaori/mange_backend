<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Friend;
use App\Models\User;
use App\Services\FriendService;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    //
    protected $friendService;
    public function __construct(FriendService $friendService)
    {
        $this->friendService = $friendService;
    }

    public function getListFriendByUserId($userId)
    {
        $listId1 = Friend::select('user_id1')->where('user_id2', $userId);
        $listId2 = Friend::select('user_id2')->where('user_id1', $userId);
        $friends = User::whereIn('id', $listId1)->orWhereIn('id', $listId2)->get();
        foreach ($friends as $friend) {
            if ($friend->image !== null) {
                $friend->image = asset($friend->image);
            }
        }
        return response()->json($friends);
    }

    public function create(Request $request)
    {
        return $this->friendService->create($request);
    }

    public function delete($id)
    {
        $this->friendService->delete($id);
    }

    public function  deleteFriend(Request $request)
    {
        $friend = Friend::where([
            ['user_id1', $request->userId],
            ['user_id2', $request->friendId]
        ])->orWhere([
            ['user_id1', $request->friendId],
            ['user_id2', $request->userId]
        ])->first();

        $friend->delete();
    }
}

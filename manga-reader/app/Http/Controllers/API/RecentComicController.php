<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\RecentComic;
use App\Services\RecentComicServeice;
use Illuminate\Http\Request;

class RecentComicController extends Controller
{
    protected $recentComicService;
    public function __construct(RecentComicServeice $recentComicServeice)
    {
        $this->recentComicService = $recentComicServeice;
    }

    public function create(Request $request)
    {
        return $this->recentComicService->create($request);
    }

    public function listRecent($userId)
    {
        $recentComics = RecentComic::where('user_id', $userId)->orderBy('comic_id', 'asc')->get();
        $comicIds = RecentComic::select('comic_id')->where('user_id', $userId);
        $comics = Comic::whereIn('id', $comicIds)->orderBy('id', 'asc')->get();
        foreach ($recentComics as $key => $recentComic) {
            $comics[$key]->image = asset($comics[$key]->image);
            $comics[$key]->cover_image = asset($comics[$key]->cover_image);
            $recentComic->comic = $comics[$key];
        }

        return response()->json($recentComics);
    }

    public function updateRecent(Request $request) {
        $recent = RecentComic::where('comic_id', $request->comicId)->where('user_id', $request->userId)->get();
        if ($recent->count() <= 0) {
            return abort(404);
        }
        $recent[0]->chapter_recent = $request->recent;
        $recent[0]->update();
        return response()->json('success');
    }
}

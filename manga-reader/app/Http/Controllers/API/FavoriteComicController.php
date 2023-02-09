<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\FavoriteComic;
use App\Services\FavoriteComicService;
use Illuminate\Http\Request;

class FavoriteComicController extends Controller
{
    //
    protected $favoriteComicService;

    public function __construct(FavoriteComicService $favoriteComicService)
    {
        $this->favoriteComicService = $favoriteComicService;
    }

    public function create(Request $request)
    {
        return $this->favoriteComicService->create($request);
    }

    public function deleteById($id)
    {
        $this->favoriteComicService->deleteById($id);
    }

    public function checkFavoriteComic(Request $request)
    {
        $comicFavorites = FavoriteComic::where('user_id', $request->userId)->where('comic_id', $request->comicId)->get();
        return response()->json($comicFavorites->count() > 0 ? $comicFavorites[0]->id : 0);
    }

    public function listFavoriteComic($userId) {
        $comicFavorites = FavoriteComic::select('comic_id')->where('user_id', $userId);
        $comics = Comic::whereIn('id', $comicFavorites)->get();
        foreach ($comics as $comic) {
            $comic->image = asset($comic->image);
            $comic->cover_image = asset($comic->cover_image);
        }
        return response()->json($comics);
    }
}

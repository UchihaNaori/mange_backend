<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\ShareComic;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    //
    public function getComicById($id) {
        $comic = Comic::findOrFail($id);
        $comic->cover_image = asset($comic->cover_image);
        $comic->image = asset($comic->image);
        return response()->json($comic);
    }

    public function getComics($userId)
    {
        $comicShareId = ShareComic::select('comic_id')->where('user_id', $userId)->where('accept', Constant::IS_ACCEPT);
        $comics = Comic::where([
            ['active', Constant::ACTIVE],
            ['user_id', $userId]
        ])->orWhereIn(
            'id', $comicShareId
        )->get();
        $ids = ShareComic::select('comic_id')->where('user_id', $userId)->where('accept', '!=', Constant::IS_ACCEPT);
        $comicShare = Comic::whereIn('id', $ids)->get();
        foreach ($comics as $comic) {
            $comic->image = asset($comic->image);
            $comic->cover_image = asset($comic->cover_image);
        }

        foreach ($comicShare as $comic) {
            $comic->image = asset($comic->image);
            $comic->cover_image = asset($comic->cover_image);
        }

        return response()->json([
            'comics' => $comics,
            'shared' => $comicShare
        ]);
    }

    public function search(Request $request)
    {
        $key = $request->key;
        $shareIds = ShareComic::select('comic_id')->where('user_id', $request->userId)->get();
        $comics = Comic::where('user_id', $request->userId)->where(function ($query) use ($key) {
            $query->where('name', 'like', '%'.$key.'%')->orWhere('other_name', 'like', '%'.$key.'%')
                ->orWhere('introduction_content', 'like', '%'.$key.'%')->orWhere('author', 'like', '%'.$key.'%');
        })->get();

        $comicShare = Comic::whereIn('id', $shareIds)->where(function ($query) use ($key) {
            $query->where('name', 'like', '%'.$key.'%')->orWhere('other_name', 'like', '%'.$key.'%')
                ->orWhere('introduction_content', 'like', '%'.$key.'%')->orWhere('author', 'like', '%'.$key.'%');
        })->get();
        $arrComic = [];
        foreach ($comics as $key => $comic) {
            $comic->image = asset($comic->image);
            $comic->cover_image = asset($comic->cover_image);
            $arrComic[$key] = $comic;
        }
        $arrComicShare = [];
        foreach ($comicShare as $key => $comic) {
            $comic->image = asset($comic->image);
            $comic->cover_image = asset($comic->cover_image);
            $arrComicShare[$key] = $comic;
        }

        return response()->json(array_merge($arrComic, $arrComicShare));
    }
}

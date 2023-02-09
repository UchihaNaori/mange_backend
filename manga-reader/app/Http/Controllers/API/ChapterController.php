<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\RecentComic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use function PHPUnit\Framework\isEmpty;
use function Sodium\add;

class ChapterController extends Controller
{
    public function contentChapter($id)
    {
        $urlImages = [];
        $chapter = Chapter::findOrFail($id);
        $path = public_path($chapter->path_file);
        $chapPath = array_map('basename', File::directories($path));
        $images = File::allFiles($path);
        $pathN = '/';
        if (count($chapPath) > 0) $pathN = '/'.$chapPath[0].'/';
        foreach ($images as $key => $image) {
            $urlImages[$key] = asset(($chapter->path_file).$pathN.$image->getFilename());
        }

        return $urlImages;
    }

    public function contentChapBypath(Request $request) {
        $urlImages = [];
        $path = public_path($request->path);
        $images = File::allFiles($path);
        foreach ($images as $key => $image) {
            $urlImages[$key] = asset($request->path.'/'.$image->getFilename());
        }

        return $urlImages;
    }

    public function getChaptersByComicId(Request $request)
    {
        $comicId = $request->comicId;
        $chapters = Chapter::where('comic_id', $comicId)->orderBy('chapter')->get();
        $recents = RecentComic::where('comic_id', $comicId)->where('user_id', $request->userId)->get();
        if ($recents->count() > 0) {
            $recent = $recents[0];
            foreach ($chapters as $chapter) {
                if ($chapter->chapter == $recent->chapter_recent) {
                    $chapter->isRecent = true;
                    break;
                }
            }
        }
        $listChapter = [];
        $listVolume = [];
        $cntV = 0;
        $cntC = 0;
        foreach ($chapters as $chapter) {
          if ($chapter->is_volume == Constant::IS_VOLUME) {
              $listVolume[$cntV] = $chapter;
              $cntV++;
          } else {
              $listChapter[$cntC] = $chapter;
              $cntC++;
          }
        }

        foreach ($listVolume as $volume) {
            $path = public_path($volume->path_file);
            $listChap = array_map('basename', File::directories($path));
            foreach ($listChap as $key=>$chap) {
                $listChap[$key] = ($volume->path_file).'/'.$chap;
            }
                $volume->listChap = $listChap;
        }
        return response()->json(
            [
                'chapters' => $listChapter,
                'volumes' => $listVolume
            ]
        );
    }
}

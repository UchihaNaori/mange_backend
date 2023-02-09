<?php

namespace App\Http\Controllers;

use App\Constants\Constant;
use App\Models\Chapter;
use App\Models\Comic;
use App\Services\ChapterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ChapterController extends Controller
{
    protected $chapterService;

    public function __construct(ChapterService $chapterService)
    {
        $this->chapterService = $chapterService;
    }

    public function createView($comicId)
    {
        $comics = Comic::where('active', '!=', Constant::DELETE)->get();
        $comicName = Comic::findOrFail($comicId)->name;
        return view('chapter.create', compact('comics', 'comicId', 'comicName'));
    }

    public function create(Request $request)
    {
        $this->chapterService->create($request);
        return redirect()->route('chapter.list', ['comicId' => $request->input('comic')]);
    }

    public function createVolumeView($comicId)
    {
        $comics = Comic::where('active', '!=', Constant::DELETE)->get();
        $comicName = Comic::findOrFail($comicId)->name;
        return view('chapter.volume.create', compact('comics', 'comicName', 'comicId'));
    }

    public function createVolume(Request $request)
    {
        $this->chapterService->createVolume($request);
        return redirect()->route('chapter.listVolume', ['comicId' => $request->input('comic')]);
    }

    public function index(Request $request)
    {
        $comic = Comic::findOrFail($request->comicId);
        $chapters = Chapter::where('comic_id', $request->comicId)->where('is_volume', '!=', Constant::IS_VOLUME)->get();
        return view('chapter.index', compact('chapters', 'comic'));
    }

    public function listVolume(Request $request)
    {
        $comic = Comic::findOrFail($request->comicId);
        $chapters = Chapter::where('comic_id', $request->comicId)->where('is_volume', Constant::IS_VOLUME)->get();
        foreach ($chapters as $chapter) {
            $chapter->amountChapter = count(File::directories(public_path($chapter->path_file)));
        }
        return view('chapter.volume.index', compact('chapters', 'comic'));
    }

}

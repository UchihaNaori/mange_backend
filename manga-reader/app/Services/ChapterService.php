<?php
    namespace App\Services;
    use App\Constants\Constant;
    use App\Models\Comic;
    use App\Repositories\ChapterRepository;
    use Illuminate\Http\Request;
    use ZipArchive;

    class ChapterService extends BaseServices {
        protected $chapterRepository;
        public function __construct(ChapterRepository $chapterRepository)
        {
            $this->chapterRepository = $chapterRepository;
        }

        public function fillData($request, String $type) {
            return [
                'comic_id' => $request->input('comic'),
                'chapter' => $request->input('name'),
                'name' => $request->input('name-extend'),
                'path_file' => $this->unZip($request, $type)
            ];
        }

        public function create($request) {
            $data = $this->fillData($request, 'chapter');
            $comic = Comic::findOrFail($request->input('comic'));
            $comic->last_chapter = 'Chapter '.$request->input('name');
            $comic->update();

            $this->chapterRepository->create($data);
        }

        public function createVolume($request) {
            $data = $this->fillData($request, 'volume');
            $data['is_volume'] = 1;

            $this->chapterRepository->create($data);
        }

        public function unZip($request, String $type) {
            $comic = Comic::findOrFail($request->input('comic'));
            $zip = new ZipArchive();
            $status  = $zip->open($request->file('zip')->getRealPath());
            $file = $request->file('zip')->getClientOriginalName();
            $name = pathinfo($file, PATHINFO_FILENAME);

            if ($status !== true) {
                throw new \Exception($status);
            }
            else{
                $noi = 'Chapter '.$request->input('name');
                if ($type == 'volume') {
                    $noi = $type;
                }
                $storageDestinationPath = public_path(Constant::BASE_PATH_CHAPTER.($comic->name).'/'.$noi);
                $zip->extractTo($storageDestinationPath);
                $zip->close();
            }
            $nameReturn = '';
            if ($type == 'volume') {
                $nameReturn = '/'.$name;
            }
            return Constant::BASE_PATH_CHAPTER.($comic->name).'/'.$noi.$nameReturn;
        }
    }

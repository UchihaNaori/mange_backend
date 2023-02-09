<?php
    namespace App\Services;
    use App\Models\ShareComic;
    use App\Repositories\ShareComicRepository;

    class ShareComicService extends BaseServices {
        protected $shareComicRepository;
        public function __construct(ShareComicRepository $shareComicRepository)
        {
            $this->shareComicRepository = $shareComicRepository;
        }

        public function fillData($request)
        {
            return [
               'owner' => $request->owner,
               'user_id' => $request->userId,
               'comic_id' => $request->comicId
            ];
        }

        public function create($request)
        {
            $data = $this->fillData($request);
            return $this->shareComicRepository->create($data)->id;
        }

        public function delete($id)
        {
            $shareComic = ShareComic::findOrFail($id);
            $shareComic->delete();
        }

        public function acceptShare($id)
        {
            $shareComic = ShareComic::findOrFail($id);
            $shareComic->accept = 1;
            $shareComic->update();
        }
    }

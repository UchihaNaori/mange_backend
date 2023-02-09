<?php
    namespace App\Services;

    use App\Models\FavoriteComic;
    use App\Repositories\FavoriteComicRepository;

    class FavoriteComicService extends BaseServices {
        protected $favoriteComicRepository;
        public function __construct(FavoriteComicRepository $favoriteComicRepository)
        {
            $this->favoriteComicRepository = $favoriteComicRepository;
        }

        public function fillData($request)
        {
            return [
                'comic_id' => $request->comicId,
                'user_id' => $request->userId
            ];
        }

        public function create($request)
        {
            $data = $this->fillData($request);
            return $this->favoriteComicRepository->create($data)->id;
        }

        public function deleteById($id)
        {
            $favoriteComic = FavoriteComic::findOrFail($id);
            $favoriteComic->delete();
        }
    }

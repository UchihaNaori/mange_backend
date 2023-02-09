<?php
    namespace App\Repositories;
    use App\Models\FavoriteComic;

    class FavoriteComicRepository extends BaseRepository {

        public function model()
        {
            return FavoriteComic::class;
        }
    }

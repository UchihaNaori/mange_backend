<?php
    namespace App\Repositories;
    use App\Models\ShareComic;

    class ShareComicRepository extends BaseRepository {

        public function model()
        {
            return ShareComic::class;
        }
    }

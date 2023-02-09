<?php
    namespace App\Repositories;
    use App\Models\RecentComic;

    class RecentComicRepository extends BaseRepository {

        public function model()
        {
            return RecentComic::class;
        }
    }

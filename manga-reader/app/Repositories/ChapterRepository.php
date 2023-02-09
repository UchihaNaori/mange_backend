<?php
    namespace App\Repositories;
    use App\Models\Chapter;

    class ChapterRepository extends BaseRepository {

        public function model()
        {
           return Chapter::class;
        }
    }

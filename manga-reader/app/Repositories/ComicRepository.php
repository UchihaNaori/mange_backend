<?php
    namespace App\Repositories;

    use App\Models\Comic;

    class ComicRepository extends BaseRepository {

        public function model()
        {
            return Comic::class;
        }

        public function getList()
        {
            return $this->model->all();
        }
    }
?>

<?php
    namespace App\Repositories;

    use App\Models\TaskType;

    class TaskTypeRepository extends BaseRepository {

        public function model()
        {
            return TaskType::class;
        }

        public function getList()
        {
            return $this->model->all();
        }
    }
?>

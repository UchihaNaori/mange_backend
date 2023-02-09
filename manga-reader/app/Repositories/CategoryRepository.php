<?php
    namespace App\Repositories;

    use App\Models\Category;
    use App\Constants\Constant;
class CategoryRepository extends BaseRepository {

        public function model()
        {
            return Category::class;
        }

        public function getAll()
        {
            return $this->model::where('active', '!=', Constant::DELETE)->get();
        }
    }
?>

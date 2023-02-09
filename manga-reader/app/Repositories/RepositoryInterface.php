<?php
     namespace App\Repositories;
     interface RepositoryInterface {
         public function all();

         public function findById($id);

         public function create(array $attributes = []);

         public function updateById($id, array $attributes = []);

         public function deleteById($id);

         public function deleteSelected($lsId);

         public function changeStatus($id);

         public function changeChapterNumber($item);
     }
?>

<?php
    namespace App\Services;
    class BaseServices {
        public function breakString($listIds)
        {
            $strIds = [];
            $ids = explode(',', $listIds);
            if (count($ids) > 0) {
                foreach ($ids as $id) {
                    $strIds[] = $id;
                }
            }
            return $strIds;
        }
    }
?>

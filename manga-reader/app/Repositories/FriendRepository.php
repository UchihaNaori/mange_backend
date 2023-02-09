<?php
    namespace App\Repositories;
    use App\Models\Friend;

    class FriendRepository extends  BaseRepository {

        public function model()
        {
            return Friend::class;
        }
    }

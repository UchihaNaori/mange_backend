<?php
    namespace App\Services;
    use App\Models\Friend;
    use App\Repositories\FriendRepository;

    class FriendService extends BaseServices {
        protected $friendRepository;
        public function __construct(FriendRepository $friendRepository)
        {
            $this->friendRepository = $friendRepository;
        }

        public function fillData($request)
        {
            return [
              'user_id1' => $request->firstUser,
              'user_id2' => $request->secondUser
            ];
        }

        public function create($request)
        {
            $data = $this->fillData($request);
            return $this->friendRepository->create($data)->id;
        }

        public function delete($id)
        {
            $friend = Friend::findOrFail($id);
            $friend->delete();
        }
    }

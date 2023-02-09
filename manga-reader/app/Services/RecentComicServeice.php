<?php
 namespace App\Services;
 use App\Repositories\RecentComicRepository;

 class RecentComicServeice extends BaseServices {
     protected $recentComicRepository;
     public function __construct(RecentComicRepository $recentComicRepository)
     {
         $this->recentComicRepository = $recentComicRepository;
     }

     public function fillData($request) {
         return [
           'comic_id' => $request->comicId,
           'user_id' => $request->userId,
           'chapter_recent' => $request->recent
         ];
     }

     public function create($request)
     {
         $data = $this->fillData($request);
         return $this->recentComicRepository->create($data)->id;
     }
 }

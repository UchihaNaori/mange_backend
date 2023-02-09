<?php
    namespace App\Services;

    use App\Constants\Constant;
use App\Models\Comic;
use App\Models\ShareComic;
use App\Repositories\ComicRepository;

    class ComicService extends BaseServices {
        protected $comicRepository;

        public function __construct(ComicRepository $comicRepository)
        {
            $this->comicRepository = $comicRepository;
        }

        public function fillData($request)
        {
            $user = session()->get('user');
            $userId = $user->id;
            return [
                'name' => $request->input('name'),
                'other_name' => $request->input('other-name'),
                'image' => $this->storeFileToFolder($request, 'image', 'comics/avatar'),
                'cover_image' => $this->storeFileToFolder($request, 'coverImage', 'comics/coverImage'),
                'active' => $request->input('active'),
                'status' => 0,
                'list_category' => implode(', ', $request->input('category')),
                'user_id' => $userId,
                'introduction_content' => $request->input('synopsis'),
                'author' => $request->input('author')
            ];
        }

        public function index()
        {
            $user = session()->get('user');
            $userId = $user->id;
            return Comic::where('user_id', $userId)->where('active', '!=', Constant::DELETE)->get();
        }

        public function setActive($request)
        {
            $comic = Comic::findOrFail($request->id);
            $comic->active = ($comic->active == Constant::INACTIVE) ? Constant::ACTIVE : Constant::INACTIVE;
            $comic->update();

            return true;
        }

        public function create($request)
        {
            $data = $this->fillData($request);

            return $this->comicRepository->create($data);
        }

        public function update($id, $request)
        {
            $data = $this->fillData($request);
            $comic = Comic::findOrFail($id);
            if (!$data['image']) {
                $data['image'] = $comic->image;
            }

            $this->comicRepository->updateById($id, $data);
            return redirect()->route('comic.index');
        }

        public function delete($id)
        {
            $this->comicRepository->deleteById($id);
        }

        public function deleteSelected($request)
        {
            if (isset($request['lsIds'])) {
                $lsIds = $request['lsIds'];
                $strIds = $this->breakString($lsIds);

                $this->comicRepository->deleteSelected($strIds);

                return redirect()->back()->with('success', 'Products are deleted successfully !');
            } else {
                return redirect()->back()->with('error', 'Products are deleted failed !');
            }
        }

        public function storeFileToFolder($request, $imageRequest, $models)
        {
            $pathImage = 'uploads/' . $models;
            if ($request->hasFile($imageRequest)) {
                $image = $request->file($imageRequest);
                $fileName = $this->getNameFile($image);
                $url = $pathImage . '/' . $fileName;
                $this->moveImage($image, $fileName, $pathImage);
                return $url;
            } else {
                return false;
            }
        }

        public function getNameFile($image)
        {
            return $image->getClientOriginalName();
        }

        public function moveImage($image, $imageName, $pathImage)
        {
            $image->move(public_path($pathImage), $imageName);
        }
    }
?>

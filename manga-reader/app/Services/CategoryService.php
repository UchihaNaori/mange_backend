<?php
    namespace App\Services;

    use App\Constants\Constant;
    use App\Models\Category;
    use App\Repositories\CategoryRepository;
    use App\Services\BaseServices;
    use Illuminate\Support\Facades\DB;

    class CategoryService extends BaseServices {
        protected $categoryRepository;

        public function __construct(CategoryRepository $categoryRepository) {
            $this->categoryRepository = $categoryRepository;
        }

        public function fillData($request) {
            $user = session()->get('user');
            $userId = $user->id;
            return [
                'title' => $request->title,
                'description' => $request->description,
                'active' => $request->active,
                'user_id' => $userId
            ];
        }

        public function create($request) {
            $data = $this->fillData($request);

            return $this->categoryRepository->create($data);
        }

        public function update($request, $id) {
            $data = $this->fillData($request);
            $category = Category::findOrFail($id);

            $category->title = $data['title'];
            $category->description = $data['description'];
            $category->active = $data['active'];
            $category->update();

            return $category;
        }

        public function delete($id) {
            $category = Category::findOrFail($id);
            $category->active = Constant::DELETE;
            $category->update();

            return $category;
        }

        public function setActive($request) {
            $category = Category::findOrFail($request->id);
            $category->active = ($category->active == Constant::INACTIVE) ? Constant::ACTIVE : Constant::INACTIVE;
            $category->update();

            return true;
        }

    public function deleteAll($request)
    {
        if (isset($request['lsIds'])) {
            $lsIds = $request['lsIds'];
            $strIds = $this->breakString($lsIds);

            $this->categoryRepository->deleteSelected($strIds);

            return redirect()->back()->with('success', 'Products are deleted successfully !');
        } else {
            return redirect()->back()->with('error', 'Products are deleted failed !');
        }
    }

    }
?>

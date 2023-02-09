<?php

    namespace App\Http\Controllers;

    use App\Constants\Constant;
    use App\Models\Category;
    use App\Models\Comic;
    use App\Services\ComicService;
    use Illuminate\Http\Request;

    class ComicController extends Controller
    {
        protected $comicService;

        public function __construct(ComicService $comicService)
        {
            $this->comicService = $comicService;
        }

        public function index()
        {
            $comics = $this->comicService->index();

            return view('comic.index', compact('comics'));
        }

        public function getViewCreate()
        {
            $user = session()->get('user');
            $userId = $user->id;
            $categories = Category::where('active', '!=', Constant::DELETE)->where('user_id', $userId)->get();
            return view('comic.create', compact('categories'));
        }

        public function create(Request $request)
        {
            $comic = $this->comicService->create($request);

            return redirect()->route('comic.index');
        }

        public function setActive(Request $request)
        {
            $this->comicService->setActive($request);
        }

        public function update($id) {
            $comic = Comic::findOrFail($id);
            $categories = Category::where('active', Constant::ACTIVE)->get();

            return view('comic.update', compact('comic', 'categories'));
        }

        public function store(Request $request, $id) {
            return $this->comicService->update($id, $request);
        }

        public function delete($id)
        {
            $this->comicService->delete($id);
        }

        public function deleteAll(Request $request)
        {
            return $this->comicService->deleteSelected($request);
        }
    }

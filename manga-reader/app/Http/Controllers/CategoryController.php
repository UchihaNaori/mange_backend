<?php

namespace App\Http\Controllers;

use App\Constants\Constant;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $user = session()->get('user');
        $userId = $user->id;
        $categories = Category::where('active', '!=', Constant::DELETE)->where('user_id', $userId)->orderBy('id', 'desc')->get();
        return view('category.index', compact('categories'));
    }

    function getCreateFrom()
    {
        return view('category.create');
    }

    public function create(Request $request)
    {
        return $this->categoryService->create($request);
    }

    public function update($id)
    {
        $category = Category::findOrFail($id);

        return view('category.update', compact('category'));
    }

    public function store(Request $request, $id)
    {
        $category = $this->categoryService->update($request, $id);

        return $category;
    }

    public function setActive(Request $request)
    {
        $this->categoryService->setActive($request);
    }

    public function delete($id)
    {
        return $this->categoryService->delete($id);
    }

    public function deleteAll(Request $request)
    {
        return $this->categoryService->deleteAll($request);
    }
}

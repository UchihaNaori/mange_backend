<?php

namespace App\Http\Controllers\API;

use App\Constants\Constant;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index($userId)
    {
        $categories = Category::where('active', Constant::ACTIVE)->where('user_id', $userId)->get();
        return response()->json($categories);
    }
}

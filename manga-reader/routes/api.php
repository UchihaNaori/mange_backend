<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\ComicController;
use App\Http\Controllers\API\FavoriteComicController;
use App\Http\Controllers\API\FriendController;
use App\Http\Controllers\API\RecentComicController;
use App\Http\Controllers\API\ShareComicController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\TaskTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/listTaskType', [TaskTypeController::class, 'index']);
Route::post('/createTaskType', [TaskTypeController::class, 'create']);
Route::get('/deleteTaskType/{id}', [TaskTypeController::class, 'delete']);
Route::post('/updateTaskType/{id}', [TaskTypeController::class, 'updateTaskType']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::post('/search', [UserController::class, 'searchUser']);
    Route::post('resetPass', [UserController::class, 'resetPassword']);
    Route::get('/profile/{userId}', [UserController::class, 'profile']);
});

Route::prefix('category')->group( function () {
    Route::get('/{userId}', [CategoryController::class, 'index']);
});

Route::prefix('chapter')->group(function () {
    Route::get('/{id}', [ChapterController::class, 'contentChapter']);
    Route::post('/listChapter', [ChapterController::class, 'getChaptersByComicId']);
    Route::post('/contentChapterVolume', [ChapterController::class, 'contentChapBypath']);
});
Route::prefix('comic')->group(function () {
    Route::get('/{id}', [ComicController::class, 'getComicById']);
    Route::get('/getListComic/{userId}', [ComicController::class, 'getComics']);
    Route::post('/search', [ComicController::class, 'search']);
});

Route::prefix('favoriteComic')->group(function () {
    Route::post('/create', [FavoriteComicController::class, 'create']);
    Route::get('/delete/{id}', [FavoriteComicController::class, 'deleteById']);
    Route::get('/checkFavorite', [FavoriteComicController::class, 'checkFavoriteComic']);
    Route::get('/listFavorite/{userId}', [FavoriteComicController::class, 'listFavoriteComic']);
});
Route::prefix('recentComic')->group(function () {
    Route::post('/create', [RecentComicController::class, 'create']);
    Route::get('/list/{userId}', [RecentComicController::class, 'listRecent']);
    Route::post('/update', [RecentComicController::class, 'updateRecent']);
});

Route::prefix('friend')->group(function () {
    Route::get('/{userId}', [FriendController::class, 'getListFriendByUserId']);
    Route::post('create', [FriendController::class, 'create']);
    Route::post('/delete', [FriendController::class, 'deleteFriend']);
});

Route::prefix('share')->group(function() {
    Route::post('/create', [ShareComicController::class, 'create']);
    Route::get('/listUserShared/{comicId}',[ShareComicController::class, 'listShareUser']);
    Route::post('/delete', [ShareComicController::class, 'delete']);
});


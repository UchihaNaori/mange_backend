<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect(route('login.view'));
});
Route::get('/login', [UserController::class, 'loginView'])->name('login.view');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'registerView'])->name('register.view');
Route::post('/register', [UserController::class, 'register']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [UserController::class, 'showForgetPassword'])->name('forget-password');
Route::post('/forgot-password', [UserController::class, 'submitForgetpassword'])->name('forget-password');
Route::get('/reset-password/{token}', [UserController::class, 'getResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [UserController::class, 'submitResetpassword'])->name('reset.password.post');
Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/create',[CategoryController::class, 'getCreateFrom'])->name('create');
    Route::post('/create', [CategoryController::class, 'create'])->name('create');
    Route::get('/update/{id}', [CategoryController::class, 'update']);
    Route::post('/update/{id}', [CategoryController::class, 'store'])->name('update');
    Route::delete('/delete/{id}', [CategoryController::class, 'delete'])->name('delete');
    Route::post('/setActive', [CategoryController::class, 'setActive'])->name('setActive');
    Route::post('/delete/all', [CategoryController::class, 'deleteAll'])->name('delete.all');
});

Route::prefix('comic')->name('comic.')->group(function() {
    Route::get('/', [ComicController::class, 'index'])->name('index');
    Route::get('/create', [ComicController::class, 'getViewCreate']);
    Route::post('/create', [ComicController::class, 'create'])->name('create');
    Route::post('/setActive', [ComicController::class, 'setActive'])->name('setActive');
    Route::delete('/delete/{id}', [ComicController::class, 'delete'])->name('delete');
    Route::post('deleteAll', [ComicController::class, 'deleteAll'])->name('delete.all');
    Route::get('/update/{id}', [ComicController::class, 'update']);
    Route::post('/update/{id}', [ComicController::class, 'store'])->name('update');
});

Route::prefix('chapter')->name('chapter.')->group(function () {
    Route::get('/create/{comicId}', [ChapterController::class, 'createView'])->name('create');
    Route::post('/create/{comicId}', [ChapterController::class, 'create']);
    Route::get('/listChapter', [ChapterController::class, 'index'])->name('list');
    Route::get('/createVolume/{comicId}', [ChapterController::class, 'createVolumeView'])->name('create.volume.view');
    Route::post('/createVolume/{comicId}', [ChapterController::class, 'createVolume'])->name('create.volume');
    Route::get('/listVolume', [ChapterController::class, 'listVolume'])->name('listVolume');
});

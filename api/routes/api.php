<?php
declare(strict_types=1);

use App\Http\Controllers\API\ArticlesController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\FilesController;
use App\Http\Controllers\API\ImagesController;
use App\Http\Controllers\API\TagsController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::resource('articles', ArticlesController::class)->only(['index', 'show']);
Route::resource('tags', TagsController::class)->only(['index', 'show']);
Route::resource('comments', CommentsController::class)->only(['store']);
Route::resource('images', ImagesController::class)->only(['show']);
Route::resource('files', FilesController::class)->only(['show']);

Route::group(['middleware' => ['auth:sanctum']], static function () {
    Route::resource('articles', ArticlesController::class)->except(['index', 'show']);
    Route::resource('tags', TagsController::class)->except(['index', 'show']);
    Route::resource('comments', CommentsController::class)->except(['store']);
    Route::resource('images', ImagesController::class)->except(['show']);
    Route::resource('files', FilesController::class)->except(['show']);

    Route::resource('users', UserController::class);
    Route::get('/profile', [UserController::class, 'getCurrent']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

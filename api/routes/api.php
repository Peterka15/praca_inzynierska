<?php
declare(strict_types=1);

use App\Http\Controllers\API\ArticlesController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentsController;
use App\Http\Controllers\API\FilesController;
use App\Http\Controllers\API\ImagesController;
use App\Http\Controllers\API\InventoryCategoryController;
use App\Http\Controllers\API\InventoryController;
use App\Http\Controllers\API\ManagementController;
use App\Http\Controllers\API\RolesController;
use App\Http\Controllers\API\TagsController;
use App\Http\Controllers\API\UnitsController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/setPassword/{uuid}', [AuthController::class, 'setPassword']);

Route::resource('articles', ArticlesController::class)->only(['index', 'show']);
Route::resource('tags', TagsController::class)->only(['index', 'show']);
Route::resource('comments', CommentsController::class)->only(['store']);
Route::resource('images', ImagesController::class)->only(['show']);
Route::resource('files', FilesController::class)->only(['show']);
Route::resource('units', UnitsController::class)->only(['index', 'show']);
Route::resource('roles', RolesController::class)->only(['index', 'show']);

Route::group(['middleware' => ['auth:sanctum']], static function () {
    Route::resource('articles', ArticlesController::class)->except(['index', 'show']);
    Route::resource('tags', TagsController::class)->except(['index', 'show']);
    Route::resource('comments', CommentsController::class)->except(['store']);
    Route::resource('images', ImagesController::class)->except(['show']);
    Route::resource('files', FilesController::class)->except(['show']);

    Route::resource('inventory', InventoryController::class);
    Route::resource('inventoryCategory', InventoryCategoryController::class);
    Route::resource('management', ManagementController::class);
    Route::resource('users', UserController::class);
    Route::post('/users/resetPassword/{id}', [UserController::class, 'resetPassword']);

    Route::get('/profile', [UserController::class, 'getCurrent']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

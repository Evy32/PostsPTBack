<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Posts\PostsController;
use App\Http\Controllers\Authors\AuthorsController;

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

Route::group(['middleware' => 'cors'], function () {
    Route::apiResource('/authors', AuthorsController::class);
    Route::apiResource('/posts', PostsController::class);
});


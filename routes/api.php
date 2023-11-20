<?php

use App\Http\Controllers\Api\ArticleApiController;
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

Route::get('articles', [ArticleApiController::class, 'index']);

Route::get('articles/{id}',[ArticleApiController::class, 'show']);

Route::delete('articles/delete/{id}', [ArticleApiController::class, 'destroy']);

Route::post('articles/store',[ArticleApiController::class,'store']);

Route::put('articles/{id}/update',[ArticleApiController::class,'update']);





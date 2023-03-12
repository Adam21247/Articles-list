<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LogoutController;

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
    return view('welcome');
});

Route::get('articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('articles/add', [ArticleController::class, 'add'])->name('articles.add');
Route::post('articles/store', [ArticleController::class, 'store'])->name('articles.create');
Route::get('articles/edit/{id}', [ArticleController::class, 'edit'])->name('articles.edit');
Route::post('articles/update', [ArticleController::class, 'update'])->name('articles.update');
Route::get('articles/delete/{id}', [ArticleController::class, 'destroy'])->name('articles.delete');
Route::get('articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('articles/comment/store', [ArticleController::class, 'addComment'])->name('comment.store');
Route::get('articles/comment//delete/{id}', [ArticleController::class, 'destroyComment'])->name('comment.delete');


Route::get('/registration', [RegistrationController::class, 'registration']);
Route::post('/register-user',[RegistrationController::class, 'registerUser'])->name('register-user');

Route::get('/login', [LoginController::class, 'show']);
Route::post('/login', [LoginController::class, 'handle'])->name('login');
Route::post('/logout', [LogoutController::class, 'handle'])->name('logout');


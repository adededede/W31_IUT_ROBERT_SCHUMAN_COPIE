<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;

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

/* ------------------------------------------------------------------------
| Public routing */
Route::get('/', [ArticleController::class,'last'])->name('home');
Route::post('adduser', [UserController::class,'addUser'])->name('adduser');
Route::post('authenticate', [UserController::class,'authenticate'])->name('authenticate');
Route::get('signin', [UserController::class,'signin'])->name('signin');
Route::get('signup', [UserController::class,'signup'])->name('signup');
Route::get('article/{id}', [ArticleController::class,'show'])->name('article');
// ------------------------------------------------------------------------

/* ------------------------------------------------------------------------
| Admin routing */
Route::middleware('auth.myuser')->prefix('admin')->group( function() {

	Route::get('/', [UserController::class,'account'])->name('account');
	Route::post('changepassword', [UserController::class,'changePassword'])->name('changepassword');
	Route::get('deleteuser', [UserController::class,'deleteUser'])->name('deleteuser');
	Route::get('formarticle', [ArticleController::class,'formArticle'])->name('formarticle');
	Route::get('formpassword', [UserController::class,'formPassword'])->name('formpassword');
	Route::post('savearticle', [ArticleController::class,'write'])->name('savearticle');
	Route::get('changestatus/{article_id}', [ArticleController::class,'toggleStatus'])->name('changestatus');
	Route::get('articles', [UserController::class,'articles'])->name('myarticles');
	Route::get('formeditarticle/{article_id}', [ArticleController::class,'formeditarticle'])->name('formeditarticle');
	Route::post('editarticle/{article_id}', [ArticleController::class,'edit'])->name('editarticle');
	Route::get('signout', [UserController::class,'signout'])->name('signout');

});
// ------------------------------------------------------------------------

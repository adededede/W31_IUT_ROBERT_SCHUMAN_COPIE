<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BirdController;

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
Route::get('/', [UserController::class,'signin']);
Route::post('adduser', [UserController::class,'addUser'])->name('adduser');
Route::post('authenticate', [UserController::class,'authenticate'])->name('authenticate');
Route::get('signin', [UserController::class,'signin'])->name('signin');
Route::get('signup', [UserController::class,'signup'])->name('signup');
// ------------------------------------------------------------------------

/* ------------------------------------------------------------------------
| Admin routing */
Route::prefix('admin')->middleware('auth.myuser')->group( function() {

	Route::post('changepassword', [UserController::class,'changePassword'])->name('changepassword');
	Route::get('deleteuser', [UserController::class,'deleteUser'])->name('deleteuser');
	Route::post('addBird',[BirdController::class,'addBird'])->name('addBird');
	Route::get('formpassword', [UserController::class,'formpassword'])->name('formpassword');
	Route::get('account', [UserController::class,'account'])->name('account');
	Route::get('profil', [UserController::class,'profil'])->name('profil');
	Route::get('signout', [UserController::class,'signout'])->name('signout');

});
// ------------------------------------------------------------------------

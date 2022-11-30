<?php

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

Route::group( [], function() {

	session_start();

	/* ------------------------------------------------------------------------
	| Public routing */
	Route::get('/', function () { return view('signin'); });
	Route::post('adduser', function () { return view('adduser'); });
	Route::post('authenticate', function () { return view('authenticate'); });
	Route::get('signin', function () { return view('signin'); });
	Route::get('signup', function () { return view('signup'); });
	// ------------------------------------------------------------------------

	/* ------------------------------------------------------------------------
	| Admin routing */
	Route::prefix('admin')->group( function() {

		if ( !isset($_SESSION['user']) )
			return redirect('signin');

		Route::post('changepassword', function () { return view('changepassword'); });
		Route::get('deleteuser', function () { return view('deleteuser'); });
		Route::get('formpassword', function () { return view('formpassword'); });
		Route::get('account', function () { return view('account'); });
		Route::get('signout', function () {
			session_destroy();
			return redirect('signin');
		});

	});
	// ------------------------------------------------------------------------

});

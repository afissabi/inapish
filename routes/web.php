<?php

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
    return view('login');
});

Route::post('/daftar', 'LoginController@daftar');
Route::post('/mlebu', 'LoginController@mlebu');
Route::get('/sign-out', 'LoginController@logout');

Route::group(['middleware' => 'admin'], function() {

	Route::get('/public-area', 'InapishController@public');
	Route::get('/full-page/{id}', 'InapishController@fullpage');

    Route::get('/home', 'InapishController@home');
    Route::post('/update-profil', 'InapishController@profupdate');
    Route::post('/update-foto', 'InapishController@fotoupdate');
    Route::get('/hapus-foto/{id}', 'InapishController@hapusfoto');

    /*Route Postingan*/
    Route::post('/create-post', 'PostController@createpost');
    Route::post('/update-post/{id}', 'PostController@updatepost');
    Route::get('/destroy-posting/{id}', 'PostController@hapuspost');
    Route::get('/like/{id}', 'PostController@likepost');
    Route::post('/tambah-komen/{id}', 'PostController@createkomen');

    Route::get('/profile/{id}', 'InapishController@profile');
    Route::get('/cari-profil', 'InapishController@cari');
});
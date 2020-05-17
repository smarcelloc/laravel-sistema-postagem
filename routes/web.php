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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/q', 'HomeController@search')->name('home.search');

    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::put('/profile', 'ProfileController@update')->name('profile');
    Route::delete('/profile', 'ProfileController@delete')->name('profile.delete');

    Route::resource('postagem', 'NewsController')->names('news')->parameters(['postagem' => 'news']);
    Route::get('postagem-search', 'NewsController@search')->name('news.search');

    Route::resource('usuario', 'UserController')->names('user')->parameters(['usuario' => 'user']);
    Route::resource('regra', 'RoleController')->names('role')->parameters(['regra' => 'role']);
    Route::resource('permissao', 'PermissionController')->names('permission')->parameters(['permissao' => 'role']);
});

/**
 * Route only environment LOCAL
 */
if (App::environment('local')) {
    Route::get('/debug', 'HomeController@debug')->name('home.debug')->middleware('auth');
}

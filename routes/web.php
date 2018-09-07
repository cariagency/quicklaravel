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
    return view('home');
})->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/profile', 'UserController@edit')->name('users.profile');
    Route::put('/profile', 'UserController@update');
});

Route::group(['middleware' => ['auth', 'admin_user']], function() {
    Route::resource('users', 'UserController')->except(['show']);
});

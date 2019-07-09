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
    return view('home', [
        'carousel' => \App\Carousel::ordered()->get()
    ]);
})->name('home');

Route::get('images/{filename}', 'UploadController@get')->name('uploaded');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::match(['put', 'post'], 'upload', 'UploadController@upload')->name('upload');

    Route::get('profile', 'UserController@edit')->name('users.profile');
    Route::put('profile', 'UserController@update');

    Route::resource('carousels', 'CarouselController')->except(['show']);
    Route::get('carousels/{carousel}/{sort}', 'CarouselController@sort')->where(['sort' => 'up|down'])->name('carousels.sort');
});

Route::group(['middleware' => ['auth', 'admin_user']], function() {
    Route::resource('users', 'UserController')->except(['show']);
});

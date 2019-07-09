<?php

/*
 * PUBLIC
 */

Auth::routes(['register' => false]);

Route::get('/', 'MainController@home')->name('home');

Route::get('images/{filename}', 'MainController@uploaded')->name('uploaded');

/*
 * PRIVATE
 */

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function() {
    // Admin index.
    Route::get('/', function() {
        return redirect()->route('carousels.index');
    })->name('admin');

    // Upload picture.
    Route::match(['put', 'post'], 'upload', 'MainController@upload')->name('upload');

    // Manage user profile.
    Route::get('profile', 'Backend\UserController@edit')->name('users.profile');
    Route::put('profile', 'Backend\UserController@update');

    // Manage carousel.
    Route::resource('carousels', 'Backend\CarouselController')->except(['show']);
    Route::get('carousels/{carousel}/{sort}', 'Backend\CarouselController@sort')->where(['sort' => 'up|down'])->name('carousels.sort');

    // Admin only.
    Route::group(['middleware' => ['admin_user']], function() {
        Route::resource('users', 'Backend\UserController')->except(['show']);
    });
});

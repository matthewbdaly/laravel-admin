<?php

// Needs web middleware
Route::group(['middleware' => ['web']], function () {

    // Authentication Routes...
    Route::get('admin/login', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@showLoginForm')->middleware('guest')->name('admin.login');
    Route::post('admin/login', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@login')->middleware('guest');
    Route::post('admin/logout', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@logout')->name('admin.logout');

    // Admin home page
    Route::get('/admin', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminController@index')->name('admin.home')->middleware('admin');
});

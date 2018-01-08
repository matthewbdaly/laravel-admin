<?php

// Needs web middleware
Route::group(['middleware' => ['web']], function () {

    // Authentication Routes...
    Route::get('admin/login', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@showLoginForm')->middleware('guest')->name('admin.login');
    Route::post('admin/login', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@login')->middleware('guest');
    Route::post('admin/logout', 'Matthewbdaly\LaravelAdmin\Http\Controllers\Auth\LoginController@logout')->name('admin.logout');

    // Admin home page
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminController@index')->name('admin.home');

        // Resource routes
        Route::group(['middleware' => ['admin_model_exists']], function () {
            Route::get('/admin/{resource}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@index')->name('admin.resource');
            Route::get('/admin/{resource}/create', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@create')->name('admin.resource.create');
            Route::post('/admin/{resource}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@store');
            Route::get('/admin/{resource}/{id}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@show')->name('admin.resource.show');
            Route::put('/admin/{resource}/{id}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@update')->name('admin.resource.update');
            Route::patch('/admin/{resource}/{id}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@update');
            Route::delete('/admin/{resource}/{id}', 'Matthewbdaly\LaravelAdmin\Http\Controllers\AdminResourceController@destroy')->name('admin.resource.delete');
        });
    });
});

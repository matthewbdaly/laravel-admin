<?php
// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

// Admin home page
Route::get('/admin', 'AdminControlelr@index')->name('admin/home')->middleware('admin');

<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => [/*'admin'*/]], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.home');
});

<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('game/{slug}', 'HomeController@game')->name('home.game');
Route::get('game/demo/{slug}', 'GameController@playDemo')->name('home.game.demo');

Route::group(['prefix' => 'admin', 'middleware' => [/*'admin'*/]], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.home');
});


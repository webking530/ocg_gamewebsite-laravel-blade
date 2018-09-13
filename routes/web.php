<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('game/{slug}', 'HomeController@game')->name('home.game');
Route::get('game/demo/{slug}', 'GameController@playDemo')->name('home.game.demo');
Route::get('tournaments', 'HomeController@tournaments')->name('home.tournaments');
Route::get('bonuses', 'HomeController@bonuses')->name('home.bonuses');

Route::group(['prefix' => 'admin', 'middleware' => [/*'admin'*/]], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.home');
    Route::post('paymentsbydate', 'AdminController@paymentsByDate')->name('admin.paymentsbydate');
});


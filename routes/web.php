<?php

// Auth Routes
// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
Route::post('login', 'Auth\LoginController@login')->name('home.login.post');

Route::get('logout', 'Auth\LoginController@logout')->name('home.logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
Route::post('register', 'Auth\RegisterController@register')->name('home.register.post');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('home.password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('home.password.request.send');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('home.password.reset.token');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('home.password.reset.post');

// Public pages
Route::get('/', 'HomeController@index')->name('home');
Route::get('game/{slug}', 'HomeController@game')->name('home.game');
Route::get('game/demo/{slug}', 'GameController@playDemo')->name('home.game.demo');

Route::get('lottery', 'LotteryController@index')->name('lottery.index');
Route::get('lottery/countdown', 'LotteryController@getCountdown')->name('lottery.countdown.get');
Route::get('lottery/tab-content', 'LotteryController@getTabContent')->name('lottery.tab_content.get');

Route::get('lottery/{lottery}/watch', 'LotteryController@watch')->name('lottery.watch');

Route::get('tournaments', 'HomeController@tournaments')->name('home.tournaments');
Route::get('bonuses', 'HomeController@bonuses')->name('home.bonuses');
Route::get('profile/{username}', 'HomeController@userProfile')->name('home.user.profile');

Route::get('news/{news}', 'NewsController@news')->name('news.details');

Route::get('terms', 'HomeController@terms')->name('home.terms');
Route::get('policy', 'HomeController@policy')->name('home.policy');

// User pages
Route::group(['prefix' => 'account', 'middleware' => [/*'user'*/]], function () {
    Route::get('dashboard', 'Account\DashboardController@index')->name('user.dashboard.index');

    Route::get('session/{game}/close', 'Account\DashboardController@closeSession')->name('user.session.close');
    Route::get('session/close-all', 'Account\DashboardController@closeAllSessions')->name('user.session.close_all');
});

// Admin pages
Route::group(['prefix' => 'admin', 'middleware' => [/*'admin'*/]], function () {
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.home');
    Route::post('paymentsbydate', 'Admin\AdminController@paymentsByDate')->name('admin.paymentsbydate');
    Route::get('users','Admin\AdminController@userListing')->name('admin.getUsers');
    Route::get('addUser','Admin\AdminController@addUser')->name('admin.adduser');
    Route::post('saveUser','Admin\AdminController@saveUser')->name('admin.saveUser');
});


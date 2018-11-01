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

Route::get('tournaments', 'TournamentController@tournaments')->name('home.tournaments');
Route::get('tournaments-history/{group?}', 'TournamentController@history')->name('tournaments.history');
Route::get('tournament/{tournament}/details', 'TournamentController@details')->name('tournaments.details');

Route::get('bonuses', 'HomeController@bonuses')->name('home.bonuses');
Route::get('profile/{username}', 'HomeController@userProfile')->name('home.user.profile');

Route::get('news/{news}', 'NewsController@news')->name('news.details');

Route::get('terms', 'HomeController@terms')->name('home.terms');
Route::get('policy', 'HomeController@policy')->name('home.policy');

// User pages
Route::group(['prefix' => 'account', 'middleware' => [/* 'user' */]], function () {
    Route::get('dashboard', 'Account\DashboardController@index')->name('user.dashboard.index');

    Route::get('games', 'Account\GameController@games')->name('user.games.index');
    Route::get('game/session/{slug}', 'Account\GameController@manageSession')->name('user.game.manage_session');

    Route::post('game/deposit/{game}', 'Account\GameController@depositToGame')->name('user.games.deposit');
    Route::get('game/live/{game}', 'Account\GameController@playLive')->name('user.games.play_live');
    Route::get('game/check-settings/{game}', 'Account\GameController@checkSettings')->name('user.session.check_settings');
    Route::get('session/{game}/close-ajax', 'Account\GameController@closeSession')->name('user.session.close_ajax');
    Route::get('session/{game}/save-credits', 'Account\GameController@saveCreditsToSession')->name('user.session.save_credits');

    Route::get('lottery/{lottery}/buy-tickets', 'Account\LotteryController@buyTickets')->name('user.lottery.buy_tickets');
    Route::post('lottery/{lottery}/buy-tickets', 'Account\LotteryController@buyTicketsPost')->name('user.lottery.buy_tickets.post');
    Route::get('lottery/{lottery}/my-tickets', 'Account\LotteryController@myTickets')->name('user.lottery.my_tickets');

    Route::get('lottery-ticket/reserve', 'Account\LotteryController@reserveTicket')->name('user.lottery.reserve_ticket');
    Route::get('lottery/{lottery}/check-reservations', 'Account\LotteryController@checkTicketReservation')->name('user.lottery.check_ticket_reservation');

    Route::get('lottery/cancelled', 'Account\LotteryController@cancelled')->name('user.lottery.cancelled');

    Route::get('session/{game}/close', 'Account\DashboardController@closeSession')->name('user.session.close');
    Route::get('session/close-all', 'Account\DashboardController@closeAllSessions')->name('user.session.close_all');

    Route::get('settings', 'Account\SettingsController@index')->name('user.settings.index');
    Route::post('settings', 'Account\SettingsController@store')->name('user.settings.store');
    Route::post('avatar', 'Account\SettingsController@updateAvatar')->name('user.avatar.update');
    Route::post('change-password', 'Account\SettingsController@changePassword')->name('user.settings.change_password');
});

// Admin pages
Route::group(['prefix' => 'admin', 'middleware' => [/* 'admin', 'maintenancemode' */]], function () {
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.home');
    Route::post('user/showdata', 'Admin\UserController@showdata');
    Route::get('user/switch/{user}', 'Admin\UserController@switchUser');
    Route::get('user/suspend/{user}', 'Admin\UserController@suspendUser');
    Route::get('user/resumeuser/{user}', 'Admin\UserController@resumeUser');
    Route::get('user/switchback/stop', 'Admin\UserController@switchBack')->name('switch.stop');
    ;
    Route::resource('user', 'Admin\UserController');
    Route::get('setting/general', 'Admin\SettingController@general')->name('setting.general');


    Route::get('setting/general', 'Admin\SettingController@general')->name('setting.general');
    Route::get('setting/games', 'Admin\SettingController@games')->name('setting.games');
    Route::post('setting/games/showGamedata', 'Admin\SettingController@showGamedata');
    Route::any('setting/games/editSettings/{id}', 'Admin\SettingController@editSettings');
    Route::post('setting/games/statusupdate/{id}', 'Admin\SettingController@statusupdate');

    Route::get('setting/badges', 'Admin\SettingController@general')->name('setting.badges');
    Route::get('setting/money', 'Admin\SettingController@general')->name('setting.money');
    Route::get('setting/countries', 'Admin\SettingController@general')->name('setting.countries');
    Route::get('setting/lottery', 'Admin\SettingController@general')->name('setting.lottery');
    Route::GET('setting/registration/{status}', 'Admin\SettingController@registrationEnableDisable')->name('setting.registration');
    Route::GET('setting/maintenancemode/{mode}', 'Admin\SettingController@maintenanceMode')->name('setting.maintenancemode');
});


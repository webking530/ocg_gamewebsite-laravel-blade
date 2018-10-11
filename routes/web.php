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
Route::group(['prefix' => 'account', 'middleware' => [/*'user'*/]], function () {
    Route::get('dashboard', 'Account\DashboardController@index')->name('user.dashboard.index');

    Route::get('games', 'Account\GameController@games')->name('user.games.index');
    Route::get('game/session/{slug}', 'Account\GameController@manageSession')->name('user.game.manage_session');

    Route::post('game/live/{game}', 'Account\GameController@playLive')->name('user.games.play_live');
    Route::get('game/resume-session/{game}', 'Account\GameController@resumeSession')->name('user.games.resume_session');

    Route::get('lottery/{lottery}/buy-tickets', 'Account\LotteryController@buyTickets')->name('user.lottery.buy_tickets');
    Route::post('lottery/{lottery}/buy-tickets', 'Account\LotteryController@buyTicketsPost')->name('user.lottery.buy_tickets.post');
    Route::get('lottery/{lottery}/my-tickets', 'Account\LotteryController@myTickets')->name('user.lottery.my_tickets');

    Route::get('lottery-ticket/reserve', 'Account\LotteryController@reserveTicket')->name('user.lottery.reserve_ticket');
    Route::get('lottery/{lottery}/check-reservations', 'Account\LotteryController@checkTicketReservation')->name('user.lottery.check_ticket_reservation');

    Route::get('lottery/cancelled', 'Account\LotteryController@cancelled')->name('user.lottery.cancelled');

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


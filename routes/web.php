<?php

Route::get('google5e9365b6c93c4df6.html', function() {
    return 'google-site-verification: google5e9365b6c93c4df6.html';
});

// Auth Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('home.login');
Route::post('login', 'Auth\LoginController@login')->name('home.login.post');

Route::get('logout', 'Auth\LoginController@logout')->name('home.logout');

Route::get('activation/{nickname}', 'Auth\LoginController@activationForm')->name('home.activation');
Route::get('send-pin/{user}/{type}', 'Auth\LoginController@resendPin')->name('home.pin.resend');
Route::post('activation/{user}', 'Auth\LoginController@activationPost')->name('home.activation.post');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('home.register');
Route::post('register', 'Auth\RegisterController@register')->name('home.register.post');

Route::post('auth/google', 'Auth\RegisterController@authFromGoogle')->name('auth.social.google');
Route::post('logout/google', 'Auth\RegisterController@logoutFromGoogle')->name('logout.social.google');

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

Route::post('cookies/set-read-news', 'CookiesController@setNewsCookies')->name('cookies.set_read_news');
Route::get('cookies/count-unread-news', 'CookiesController@countUnreadNews')->name('cookies.count_unread_news');

// User pages
Route::group(['prefix' => 'account', 'middleware' => ['user']], function () {
    Route::get('dashboard', 'Account\DashboardController@index')->name('user.dashboard.index');

    Route::get('games', 'Account\GameController@games')->name('user.games.index');
    Route::get('game/session/{slug}', 'Account\GameController@manageSession')->name('user.game.manage_session');

    Route::post('game/deposit/{game}', 'Account\GameController@depositToGame')->name('user.games.deposit');
    Route::get('game/live/{game}', 'Account\GameController@playLive')->name('user.games.play_live');

    Route::get('game/check-settings/{game}', 'Account\GameController@checkSettings')->name('user.session.check_settings');
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

    // Routes for translators
    Route::post('translations/get-page', 'Account\TranslationController@getPageTranslations')->name('user.translations.get_page');
    Route::post('translations/get-orphans', 'Account\TranslationController@getOrphanTranslations')->name('user.translations.get_orphan');
    Route::post('translations/save', 'Account\TranslationController@saveTranslation')->name('user.translations.save');
});

// This route does not need Laravel's user authentication since it does the session token check internally
Route::group(['prefix' => 'account'], function () {
    Route::get('session/{game}/close-ajax', 'Account\GameController@closeSession')->name('user.session.close_ajax');
    Route::get('game/play/{game}', 'Account\GameController@playRequest')->name('user.games.play_request');
});

// Admin pages
Route::group(['prefix' => 'admin', 'middleware' => [/* 'admin', 'maintenancemode' */]], function () {
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.home');

    Route::post('paymentFilter', 'Admin\AdminController@filterpayments')->name('payment.filter');

    // User Routes
    Route::post('user/showdata', 'Admin\UserController@showdata')->name('user.showdata');
    Route::get('user/switch/{user}', 'Admin\UserController@switchUser');
    Route::get('user/suspend/{user}', 'Admin\UserController@suspendUser');
    Route::get('user/resumeuser/{user}', 'Admin\UserController@resumeUser');
    Route::get('user/switchback/stop', 'Admin\UserController@switchBack')->name('switch.stop');
    Route::resource('user', 'Admin\UserController');

    // General Routes
    Route::get('setting/general', 'Admin\SettingController@general')->name('setting.general');
    Route::post('setting/general/updateGeneral', 'Admin\SettingController@updateGeneral')->name('setting.updateGeneral');
    Route::post('setting/showGeneralSettingsdata', 'Admin\SettingController@showGeneralSettingsdata');
//    Route::post('setting/registration', 'Admin\SettingController@general')->name('setting.registration');
//    Route::post('setting/maintenancemode', 'Admin\SettingController@general')->name('setting.maintenancemode');
    // Games Routes
    Route::get('setting/games', 'Admin\SettingController@games')->name('setting.games');
    Route::post('setting/games/showGamedata', 'Admin\SettingController@showGamedata')->name('game.showdata');
    Route::get('setting/games/editSettings/{id}', 'Admin\SettingController@editGameSettings');
    Route::post('setting/games/updateSettings', 'Admin\SettingController@updateGameSetting')->name('game.updateSetting');
    Route::post('setting/games/statusupdate/{id}', 'Admin\SettingController@gameStatusUpdate');
    Route::get('setting/games/detail/{id}', 'Admin\SettingController@gameDetail');

    Route::get('setting/regenerate-math-files', 'Admin\GameMathController@regenerateMath')->name('admin.settings.regenerate_math');
    Route::get('setting/restart-math-server', 'Admin\GameMathController@restartMathServer')->name('admin.settings.restart_math_server');

    // Badges Route
    Route::get('setting/badges', 'Admin\SettingController@badges')->name('setting.badges');
    Route::post('setting/badges/showBadgesdata', 'Admin\SettingController@showBadgesdata')->name('badges.showdata');
    Route::get('setting/badges/add', 'Admin\SettingController@addBadges')->name('badges.add');
    Route::post('setting/badges/create', 'Admin\SettingController@createdBadges')->name('badges.create');
    Route::get('setting/badges/edit/{id}', 'Admin\SettingController@editBadges')->name('badges.edit');
    Route::post('setting/badges/update/{id}', 'Admin\SettingController@updateBadges')->name('badges.update');

    // Money Route
    Route::get('setting/money', 'Admin\SettingController@general')->name('setting.money');

    // Country Routes
    Route::get('setting/countries', 'Admin\SettingController@countries')->name('setting.countries');
    Route::post('setting/country/statusupdate/{id}', 'Admin\SettingController@countryStatusUpdate');
    Route::get('setting/country/add', 'Admin\SettingController@addCountry')->name('country.add');
    Route::post('setting/country/create', 'Admin\SettingController@createCountry')->name('country.create');
    Route::get('setting/country/edit/{code}', 'Admin\SettingController@editCountry')->name('country.edit');
    Route::post('setting/country/update/{code}', 'Admin\SettingController@updateCountry')->name('country.update');
    Route::post('setting/general/showCountrydata', 'Admin\SettingController@showCountrydata')->name('country.showdata');


    // Lottery Route
    Route::get('setting/lottery', 'Admin\SettingController@lottery')->name('setting.lottery');
    Route::post('setting/lottery/showLotterydata', 'Admin\SettingController@showLotterydata')->name('lottery.showdata');
    Route::post('setting/lottery/updateSettings', 'Admin\SettingController@updateLotterySettings')->name('lottery.updateSettings');
    Route::get('setting/lottery/add', 'Admin\SettingController@addLottery')->name('lottery.add');
    Route::post('setting/lottery/create', 'Admin\SettingController@createLottery')->name('lottery.create');
    Route::get('setting/lottery/edit/{id}', 'Admin\SettingController@editLottery')->name('lottery.edit');
    Route::post('setting/lottery/update/{id}', 'Admin\SettingController@updateLottery')->name('lottery.update');
    Route::post('setting/lottery/delete/{id}', 'Admin\SettingController@destroyLottery');


    // Jackpot Configuration Route
    Route::get('setting/jackpot', 'Admin\SettingController@jackpot')->name('setting.jackpot');

    //News Mangagement
    Route::resource('news', 'Admin\NewsController');
    Route::post('news/showdata', 'Admin\NewsController@showdata');
    Route::post('news/delete/{id}', 'Admin\NewsController@destroy');

    //Bonus Mangagement
    Route::resource('bonus', 'Admin\BonusController');
    Route::post('bonus/showdata', 'Admin\BonusController@showdata');
    Route::post('bonus/delete/{id}', 'Admin\BonusController@destroy');
    Route::post('bonus/statusupdate/{id}', 'Admin\BonusController@statusUpdate');

    //Tournament Management
    Route::resource('tournament', 'Admin\TournamentController');
    Route::post('tournament/showdata', 'Admin\TournamentController@showdata')->name('tournament.showdata');
    Route::get('tournament/cancel/{id}', 'Admin\TournamentController@cancel')->name('tournament.cancel');
    Route::get('tournament/recreate/{id}', 'Admin\TournamentController@recreate');
    Route::get('tournament/edit/settings', 'Admin\TournamentController@editSettings')->name('tournament.editSettings');
    Route::post('tournament/update/settings', 'Admin\TournamentController@updateSettings')->name('tournament.updateSettings');
    Route::get('tournament/custom/create', 'Admin\TournamentController@customTournamentCreate')->name('tournament.customCreate');
    Route::post('tournament/custom/store', 'Admin\TournamentController@customTournamentStore')->name('tournament.customStore');

    //Payments Management
    Route::get('payment', 'Admin\PaymentController@index')->name('payment.index');
    Route::post('payment/showDepositdata', 'Admin\PaymentController@showDepositdata');
    Route::get('deposit/approve/{id}', 'Admin\PaymentController@depositApproved');
    Route::post('deposit/reject', 'Admin\PaymentController@depositRejected');
    Route::post('payment/showWithdrawdata', 'Admin\PaymentController@showWithdrawdata');
    Route::get('withdraw/approve/{id}', 'Admin\PaymentController@withdrawApproved');
    Route::get('withdraw/reject/{id}', 'Admin\PaymentController@withdrawRejected');
});



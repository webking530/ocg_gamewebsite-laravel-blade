<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('price', function ($expression) {
            return "<?php echo formatted_price({$expression})?>";
        });

        Blade::directive('datetime', function ($expression) {
            return "<?php echo with({$expression}) == null? trans('app.common.not_yet') : (\"<abbr data-toggle='tooltip' data-original-title='\" . with({$expression})->toDayDateTimeString().\"'>\" . with({$expression})->diffForHumans() . \"</abbr>\"); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

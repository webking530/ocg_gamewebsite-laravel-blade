let mix = require('laravel-mix');

// Shared styles and scripts
mix.styles([
    'resources/assets/vendor/bootstrap/css/bootstrap.min.css',
    'resources/assets/vendor/fontawesome-5.2.0/all.min.css',
    'resources/assets/vendor/jquery-confirm/jquery-confirm.min.css',
    'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.css',
], 'public/compiled/css/shared.css');

mix.scripts([
    'resources/assets/vendor/jquery-3.3.1/jquery-3.3.1.js',
    'resources/assets/vendor/bootstrap/js/bootstrap.min.js',
    'resources/assets/vendor/jquery-confirm/jquery-confirm.min.js',
    'resources/assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js',
    'resources/assets/js/app.js',
], 'public/compiled/js/shared.js');

mix.copyDirectory('resources/assets/vendor/fontawesome-5.2.0/webfonts', 'public/compiled/webfonts');

// Porto Template
mix.styles([
    'resources/assets/vendor/porto/vendor/animate/animate.min.css',
    'resources/assets/vendor/porto/vendor/simple-line-icons/css/simple-line-icons.min.css',
    'resources/assets/vendor/porto/vendor/owl.carousel/assets/owl.carousel.min.css',
    'resources/assets/vendor/porto/vendor/owl.carousel/assets/owl.theme.default.min.css',
    'resources/assets/vendor/porto/vendor/magnific-popup/magnific-popup.min.css',
    'resources/assets/vendor/porto/css/theme.css',
    'resources/assets/vendor/porto/css/theme-blog.css',
    'resources/assets/vendor/porto/css/theme-elements.css',
    'resources/assets/vendor/porto/vendor/rs-plugin/css/settings.css',
    'resources/assets/vendor/porto/vendor/rs-plugin/css/layers.css',
    'resources/assets/vendor/porto/vendor/rs-plugin/css/navigation.css',
    'resources/assets/vendor/porto/vendor/circle-flip-slideshow/css/component.css',
    'resources/assets/vendor/porto/css/skins/default.css',
    'resources/assets/css/app.css',
], 'public/compiled/porto/porto.css');

mix.scripts([
    'resources/assets/vendor/porto/vendor/modernizr/modernizr.min.js',
    'resources/assets/vendor/porto/vendor/jquery.appear/jquery.appear.min.js',
    'resources/assets/vendor/porto/vendor/jquery.easing/jquery.easing.min.js',
    'resources/assets/vendor/porto/vendor/common/common.min.js',
    'resources/assets/vendor/porto/vendor/jquery.lazyload/jquery.lazyload.min.js',
    'resources/assets/vendor/porto/vendor/isotope/jquery.isotope.min.js',
    'resources/assets/vendor/porto/vendor/owl.carousel/owl.carousel.min.js',
    'resources/assets/vendor/porto/vendor/magnific-popup/jquery.magnific-popup.min.js',
    'resources/assets/vendor/porto/js/theme.js',
    'resources/assets/vendor/porto/vendor/rs-plugin/js/jquery.themepunch.tools.min.js',
    'resources/assets/vendor/porto/vendor/rs-plugin/js/jquery.themepunch.revolution.min.js',
    'resources/assets/vendor/porto/vendor/circle-flip-slideshow/js/jquery.flipshow.min.js',
    'resources/assets/vendor/porto/js/views/view.home.js',
    'resources/assets/vendor/porto/js/theme.init.js',
], 'public/compiled/porto/porto.js');

// Pages
mix.styles([
    'resources/assets/css/pages/home.css',
], 'public/compiled/css/pages/home.css');

mix.scripts([
    'resources/assets/js/pages/home.js',
], 'public/compiled/js/pages/home.js');

mix.styles([
    'resources/assets/css/pages/public_profile.css',
], 'public/compiled/css/pages/public_profile.css');

mix.styles([
    'resources/assets/css/pages/lottery.css',
], 'public/compiled/css/pages/lottery.css');

mix.scripts([
    'resources/assets/js/pages/lottery.js',
], 'public/compiled/js/pages/lottery.js');

mix.styles([
    'resources/assets/css/pages/user_dashboard.css',
], 'public/compiled/css/pages/user_dashboard.css');

mix.scripts([
    'resources/assets/js/pages/user_dashboard.js',
], 'public/compiled/js/pages/user_dashboard.js');

mix.scripts([
    'resources/assets/js/pages/buy_tickets.js',
], 'public/compiled/js/pages/buy_tickets.js');

// Lumino Admin Template
mix.styles([
    'resources/assets/vendor/lumino/css/datepicker3.css',
    'resources/assets/vendor/lumino/css/datepicker.css',
    'resources/assets/vendor/lumino/css/dataTables.bootstrap.min.css',
    'resources/assets/vendor/lumino/css/styles.css',
], 'public/compiled/lumino/lumino.css');

mix.scripts([
    'resources/assets/vendor/lumino/js/chart.min.js',
    'resources/assets/vendor/lumino/js/chart-data.js',
    'resources/assets/vendor/lumino/js/easypiechart.js',
    'resources/assets/vendor/lumino/js/easypiechart-data.js',
    'resources/assets/vendor/lumino/js/bootstrap-datepicker.js',
    'resources/assets/vendor/lumino/js/dataTables.min.js',
    'resources/assets/vendor/lumino/js/dataTables.bootstrap.min.js',
    'resources/assets/vendor/lumino/js/custom.js',
], 'public/compiled/lumino/lumino.js');


if (mix.inProduction()) {
    mix.version();
}
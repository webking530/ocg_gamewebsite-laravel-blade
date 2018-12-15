<!DOCTYPE html>
<html class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

        <title>OCG -  @yield('title')</title>
        <link rel="stylesheet" href="{!! mix('compiled/css/shared.css') !!}">
        <link rel="stylesheet" href="{!! mix('compiled/lumino/lumino.css') !!}">

        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">
        @yield('css')
    </head>
    <body>
        <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 0, 'stickySetTop': '0px', 'stickyChangeLogo': false}">
            <div class="header-body">
                <div class="header-container container">
                    <div class="header-row">
                        <div class="header-column">
                            <div class="header-logo">
                                <a href="{{ route('home') }}">
                                    <img alt="{{ trans('app.meta.short_title') }}" height="40" data-sticky-height="40" data-sticky-top="33" src="{{ asset('img/logo.png') }}">
                                </a>
                            </div>
                        </div>
                        <div class="header-column">
                            <div class="header-row">
                                <div class="header-nav">
                                    <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main">
                                        <i class="fa fa-bars"></i>
                                    </button>
                                    <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 collapse">
                                        <nav>
                                            <ul class="nav nav-pills navbar-center navbar-custom">

                                                <li class="{{ set_active('admin.home') }}">
                                                    <a href="{{ route('admin.home') }}">
                                                        Dashboard
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*user*') }}">
                                                    <a href="{{ route('user.index') }}">
                                                        Users
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*news*') }}">
                                                    <a href="{{ route('news.index') }}">
                                                        News
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*bonus*') }}">
                                                    <a href="{{ route('bonus.index') }}">
                                                        Bonuses  
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*tournament*') }}">
                                                    <a href="{{ route('tournament.index') }}">
                                                        Tournaments
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*payment*') }}">
                                                    <a href="{{ route('payment.index') }}">
                                                        Payments
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*lottery*') }}">
                                                    <a href="{{ route('setting.lottery') }}">
                                                        Lottery
                                                    </a>
                                                </li>
                                                <li class="{{ set_active('*games*') }}">
                                                    <a href="{{ route('setting.games') }}">
                                                        Games
                                                    </a>
                                                </li>
                                                <li class="dropdown">
                                                    <a class="dropdown-toggle" href="#">
                                                        <i class="fas fa-globe"></i> Settings<i class="fa fa-caret-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a href="{{ route('setting.general') }}">
                                                                General
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('setting.badges') }}">
                                                                Badges
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('setting.countries') }}">
                                                                Countries
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('setting.jackpot') }}">
                                                                Jackpot
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li class="">
                                                    <a href="{{ route('home.logout') }}">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>

                                            <!--                                                <ul class="nav nav-pills navbar-right navbar-custom">
                                                                                             
                                                
                                                                                                <li class="">
                                                                                                    <a href="{{ route('home.logout') }}">
                                                                                                        Logout
                                                                                                    </a>
                                                                                                </li>
                                                                                            </ul>-->
                                        </nav>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </header>

        <div class="col-sm-12  col-lg-12  main">
            @if (Session::has('flash_message'))
            <div id="flash-notifier" class="flash-notifier alert alert-{{ Session::get('flash_type') }} alert-dismissible" role="alert" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p><i class="fas {{ Session::get('flash_icon') }}"></i> {{ Session::get('flash_message') }}</p>
            </div>
            @endif

            <div id="success-notifier" class="flash-notifier alert alert-success" role="alert" style="display: none">
                <p><i class="fas fa-check"></i> <span class="notifier-text-content"></span></p>
            </div>

            <div id="info-notifier" class="flash-notifier alert alert-info" role="alert" style="display: none">
                <p><i class="fas fa-info-circle"></i> <span class="notifier-text-content"></span></p>
            </div>

            <div id="warning-notifier" class="flash-notifier alert alert-warning" role="alert" style="display: none">
                <p><i class="fas fa-info-circle"></i> <span class="notifier-text-content"></span></p>
            </div>

            <div id="danger-notifier" class="flash-notifier alert alert-danger" role="alert" style="display: none">
                <p><i class="fas fa-times"></i> <span class="notifier-text-content"></span></p>
            </div>
            @yield('content')
        </div>    <!--/.main-->
        @include('partials.footer')
        <script src="{!! mix('compiled/js/shared.js') !!}"></script>
        <script src="{!! mix('compiled/lumino/lumino.js') !!}"></script>
        <script>
//    window.onload = function () {
//        var chart1 = document.getElementById("line-chart").getContext("2d");
//        window.myLine = new Chart(chart1).Line(lineChartData, {
//            responsive: true,
//            scaleLineColor: "rgba(0,0,0,.2)",
//            scaleGridLineColor: "rgba(0,0,0,.05)",
//            scaleFontColor: "#c5c7cc"
//        });
//    }


        </script>

        @yield('js')

    </body>
</html>
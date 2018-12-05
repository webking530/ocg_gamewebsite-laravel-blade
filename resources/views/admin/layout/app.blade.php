<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />
        <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

        <title>OCG - Dashboard</title>
        <link rel="stylesheet" href="{!! mix('compiled/css/shared.css') !!}">
        <link rel="stylesheet" href="{!! mix('compiled/lumino/lumino.css') !!}">

        <!--Custom Font-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i"
              rel="stylesheet">
        @yield('css')
    </head>
    <body>

        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span></button>
                    <a class="navbar-brand" href="{{ route('home') }}" style="padding-top: 13px;">
                            <!--<span>OCG</span>Admin-->
                        <img alt="{{ trans('app.meta.short_title') }}" height="40" data-sticky-height="40" data-sticky-top="30" src="{{ asset('img/logo.png') }}">

                    </a>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" title="Logout" href="{{ route('home.logout') }}">
                                <em class="fa fa-power-off"></em>
                                <!--<span class="label label-danger">15</span>-->
                            </a>

                        </li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <?php
            $r = \Route::current()->getAction();
            $route = (isset($r['as'])) ? $r['as'] : '';
            ?>

            <ul class="nav menu">
                <li class="{{ set_active('admin.home') }}">
                    <a href="{{ route('admin.home') }}">
                        <em class="fa fa-tachometer-alt">&nbsp;</em> Dashboard
                    </a>
                </li>
                <li class="{{ set_active('user.index') }}">
                    <a href="{{ route('user.index') }}">
                        <em class="fa fa-users-cog">&nbsp;</em> User Management
                    </a>
                </li>
                
                <li class="{{ set_active('news.index') }}">
                    <a href="{{ route('news.index') }}">
                        <em class="fa fa-newspaper">&nbsp;</em> News Management
                    </a>
                </li>
                <li class="{{ set_active('bonus.index') }}">
                    <a href="{{ route('bonus.index') }}">
                        <em class="fa fa-money-bill-alt">&nbsp;</em> Bonus Management
                    </a>
                </li>
                <li class="{{ set_active('tournament.index') }}">
                    <a href="{{ route('tournament.index') }}">
                        <em class="fa fa-trophy">&nbsp;</em> Tournament
                    </a>
                </li>
                <li class="{{ set_active('payment.index') }}">
                    <a href="{{ route('payment.index') }}">
                        <em class="fa fa-credit-card">&nbsp;</em> Payments
                    </a>
                </li>
                <li class="parent {{ (starts_with($route, 'setting')) ? "active" : '' }}">
                    <a class="{{ (starts_with($route, 'setting')) ? "" : 'collapsed' }}" data-toggle="collapse" href="#sub-item-1">
                        <em class="fa fa-user-cog">&nbsp;</em> Settings
                        <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right">
                        <em class="fa fa-plus"></em></span>
                    </a>
                    <ul class="children collapse {{ (starts_with($route, 'setting')) ? "in" : '' }}" id="sub-item-1">
                        <li class="{{ set_active('setting.general','sub-active') }}">
                            <a class="" href="{{ route('setting.general') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> General
                            </a>
                        </li>
                        
                        <li class="{{ set_active('setting.games','sub-active') }}">
                            <a class="" href="{{ route('setting.games') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Games
                            </a>
                        </li>
                        <li class="{{ set_active('setting.badges','sub-active') }}">
                            <a class="" href="{{ route('setting.badges') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Badges
                            </a>
                        </li>
<!--                        <li class="">
                            <a class="" href="">
                                <span class="fa fa-arrow-right">&nbsp;</span> Money
                            </a>
                        </li>-->
                        <li class="{{ set_active('setting.countries','sub-active') }}">
                            <a class="" href="{{ route('setting.countries') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Countries
                            </a>
                        </li>
                        <li class="{{ set_active('setting.lottery','sub-active') }}">
                            <a class="" href="{{ route('setting.lottery') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Lottery
                            </a>
                        </li>
                        <li class="{{ set_active('setting.jackpot','sub-active') }}">
                            <a class="" href="{{ route('setting.jackpot') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Jackpot
                            </a>
                        </li>
                    </ul>
                </li>
                <li><a href="{{ route('home.logout') }}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
            </ul>
        </div><!--/.sidebar-->


        <!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
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
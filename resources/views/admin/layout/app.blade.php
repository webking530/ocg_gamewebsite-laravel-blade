<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Lumino - Dashboard</title>
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
                    <a class="navbar-brand" href="#"><span>Lumino</span>Admin</a>
                    <ul class="nav navbar-top-links navbar-right">
                        <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <em class="fa fa-envelope"></em><span class="label label-danger">15</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li>
                                    <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                        </a>
                                        <div class="message-body">
                                            <small class="pull-right">3 mins ago</small>
                                            <a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
                                            <br/>
                                            <small class="text-muted">1:24 pm - 25/03/2015</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
                                            <img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
                                        </a>
                                        <div class="message-body">
                                            <small class="pull-right">1 hour ago</small>
                                            <a href="#">New message from <strong>Jane Doe</strong>.</a>
                                            <br/>
                                            <small class="text-muted">12:27 pm - 25/03/2015</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <div class="all-button"><a href="#">
                                            <em class="fa fa-inbox"></em> <strong>All Messages</strong>
                                        </a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <em class="fa fa-bell"></em><span class="label label-info">5</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li><a href="#">
                                        <div><em class="fa fa-envelope"></em> 1 New Message
                                            <span class="pull-right text-muted small">3 mins ago</span></div>
                                    </a></li>
                                <li class="divider"></li>
                                <li><a href="#">
                                        <div><em class="fa fa-heart"></em> 12 New Likes
                                            <span class="pull-right text-muted small">4 mins ago</span></div>
                                    </a></li>
                                <li class="divider"></li>
                                <li><a href="#">
                                        <div><em class="fa fa-user"></em> 5 New Followers
                                            <span class="pull-right text-muted small">4 mins ago</span></div>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.container-fluid -->
        </nav>
        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="profile-sidebar">
                <div class="profile-userpic">
                    <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">Username</div>
                    <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="divider"></div>
            <form role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
            </form>
            <?php $r = \Route::current()->getAction() ?>
            <?php $route = (isset($r['as'])) ? $r['as'] : ''; ?>
            <ul class="nav menu">
                <li class="{{ set_active('admin.home') }}">
                    <a href="{{ route('admin.home') }}"><em class="fa fa-bar-chart">&nbsp;</em> Dashboard</a>
                </li>
                <li class="{{ set_active('user.index') }}">
                    <a href="{{ route('user.index') }}"><em class="fa fa-bar-chart">&nbsp;</em> User Management</a>
                </li>
                <li class="{{ set_active('news.index') }}">
                    <a href="{{ route('news.index') }}"><em class="fa fa-bar-chart">&nbsp;</em> News Management</a>
                </li>
                <li class="{{ set_active('bonus.index') }}">
                    <a href="{{ route('bonus.index') }}"><em class="fa fa-bar-chart">&nbsp;</em> Bonus Management</a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="<?php echo (starts_with($route, 'setting')) ? "" : 'collapsed' ?>  <?php echo (starts_with($route, 'setting')) ? "active" : '' ?>">
                    <a href="#"><em class="fa fa-bar-chart">&nbsp;</em> Settings Management<span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse <?php echo (starts_with($route, 'setting')) ? "in" : "" ?>" id="products">
                    <li class="{{ set_active('setting.general') }}"><a href="{{ route('setting.general') }}">General Settings</a></li>
                    <li class="{{ set_active('setting.games') }}"><a href="{{ route('setting.games') }}">Games</a></li>
                    <li class="{{ set_active('setting.badges') }}"><a href="{{ route('setting.badges') }}">Badges</a></li>
                    <li class=""><a href="#">Money</a></li>
                    <li class="{{ set_active('setting.countries') }}"><a href="{{ route('setting.countries') }}">Countries</a></li>
                    <li class="{{ set_active('setting.lottery') }}"><a href="{{ route('setting.lottery') }}">Lottery</a></li>
                    <li class="{{ set_active('setting.jackpot') }}"><a href="{{ route('setting.jackpot') }}">Jackpot Configuration </a></li>
                </ul>
            </ul>
        </div><!--/.sidebar-->

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
<!DOCTYPE html>
<html class="dark">
<head>

    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield('meta')

    <meta name="author" content="OCG - Online Casino Games">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{!! mix('compiled/css/shared.css') !!}">
    <link rel="stylesheet" href="{!! mix('compiled/porto/porto.css') !!}">

    @yield('styles')

</head>
<body>
<div class="body">
    <header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 0, 'stickySetTop': '0px', 'stickyChangeLogo': false}">
        <div class="header-body">
            <div class="header-container container">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-logo">
                            <a href="index.html">
                                <img alt="Porto" width="111" height="54" data-sticky-width="82" data-sticky-height="40" data-sticky-top="33" src="{{ asset('img/logo.png') }}">
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
                                        <ul class="nav nav-pills navbar-center" style="display: inline-block;">
                                            <li class="">
                                                <a href="#">
                                                    Casino Games
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    Lottery
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    Tournament
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    Bonuses
                                                </a>
                                            </li>
                                        </ul>

                                        <ul class="nav nav-pills navbar-right" style="display: inline-block;">
                                            <li class="dropdown">
                                                <a class="dropdown-toggle" href="#">
                                                    <i class="fas fa-globe"></i> Language
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a href="https://www.smswords.net/de">
                                                            Deutsch
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/">
                                                            English
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/es">
                                                            Español
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/fr">
                                                            Français
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/it">
                                                            Italiano
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/nl">
                                                            Nederlands
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/pl">
                                                            Polski
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/tr">
                                                            Türkçe
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="https://www.smswords.net/ru">
                                                            Русский
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>

                                            <li class="">
                                                <a href="#">
                                                    <i class="fas fa-user"></i> Login
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#">
                                                    Sign Up
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="footer-ribbon">
                    <span>Get in Touch</span>
                </div>
                <div class="col-md-4">
                    <div class="contact-details">
                        <h4>Contact Us</h4>
                        <ul class="contact">
                            <li><p><i class="fa fa-map-marker"></i> <strong>Address:</strong> 1234 Street Name, City Name, United States</p></li>
                            <li><p><i class="fa fa-phone"></i> <strong>Phone:</strong> (123) 456-789</p></li>
                            <li><p><i class="fa fa-envelope"></i> <strong>Email:</strong> <a href="mailto:mail@example.com">mail@example.com</a></p></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4>Latest News</h4>
                    <div id="news" class="twitter">
                        <ul>
                            <li><a href="#">Except of news number one. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</a></li>
                            <li><a href="#">Except of news number two. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <a href="index.html" class="logo">
                            <img alt="OCG - Online Casino Games" class="img-responsive" src="{{ asset('img/logo.png') }}">
                        </a>
                    </div>
                    <div class="col-md-7">
                        <p>© Copyright {{ date('Y') }}. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-4">
                        <nav id="sub-menu">
                            <ul>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="{!! mix('compiled/js/shared.js') !!}"></script>
<script src="{!! mix('compiled/porto/porto.js') !!}"></script>

@yield('scripts')

</body>
</html>
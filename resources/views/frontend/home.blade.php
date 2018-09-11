@extends('frontend.layout.app')

@section('meta')
    <title>OCG - Online Casino Games</title>

    <meta name="keywords" content="online casino games, online casino, casino games, online casino real money,
casino gambling, online casino gambling, win real money gambling online, win real money games, win real money online casino, win real money playing games, win real money instantly, win real money playing slots" />
    <meta name="description" content="OCG is the most engaging gaming website to satisfy all your gambling needs">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/home.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="slider-container rev_slider_wrapper" style="height: 700px;">
            <div id="revolutionSlider" class="slider rev_slider" data-plugin-revolution-slider data-plugin-options="{'delay': 9000, 'gridwidth': 800, 'gridheight': 700}">
                <ul>
                    <li data-transition="fade">
                        <img src="{{ asset('img/sliderbg.jpg') }}"
                             alt=""
                             data-bgposition="center center"
                             data-bgfit="cover"
                             data-bgrepeat="no-repeat"
                             class="rev-slidebg">



                        <div class="tp-caption top-label"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="-95"
                             data-start="500"
                             style="z-index: 5"
                             data-transform_in="y:[-300%];opacity:0;s:500;">ARE YOU READY FOR</div>



                        <div class="tp-caption main-label"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="-45"
                             data-start="1500"
                             data-whitespace="nowrap"
                             data-transform_in="y:[100%];s:500;"
                             data-transform_out="opacity:0;s:500;"
                             style="z-index: 5"
                             data-mask_in="x:0px;y:0px;">THE BEST ONLINE CASINO EXPERIENCE?</div>

                        <div class="tp-caption bottom-label"
                             data-x="center" data-hoffset="0"
                             data-y="center" data-voffset="5"
                             data-start="2000"
                             style="z-index: 5"
                             data-transform_in="y:[100%];opacity:0;s:500;">Check out all of our games.</div>

                        <a class="tp-caption btn btn-lg btn-primary btn-slider-action"
                           data-hash
                           data-hash-offset="85"
                           href="#demos"
                           data-x="center" data-hoffset="0"
                           data-y="center" data-voffset="80"
                           data-start="2200"
                           data-whitespace="nowrap"
                           data-transform_in="y:[100%];s:500;"
                           data-transform_out="opacity:0;s:500;"
                           style="z-index: 5"
                           data-mask_in="x:0px;y:0px;">Start Playing Now!</a>

                    </li>
                </ul>
            </div>
        </div>
        <div class="home-intro" id="home-intro">
            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <p>
                            The best <em>Casino Gaming Website</em>
                            <span>Get started immediately, play our game demos without registering.</span>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-lg mb-xl text-right">
                            <a href="#demos" data-hash data-hash-offset="85" class="btn btn-primary mr-md appear-animation" data-appear-animation="fadeInDown" data-appear-animation-delay="300">TEST OUT OUR GAMES!</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="word-rotator-title mb-sm"><strong>OCG</strong> is the most <strong>engaging gaming website</strong> to satisfy all your gambling needs.</h2>
                    <p class="lead">Trusted by over 25,000 satisfied gamers, OCG is a huge success.<br>It is the of one of the world's largest casino gaming websites.</p>
                </div>
            </div>

            <div class="row mt-xl">
                <div class="counters counters-text-dark">
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                            <strong data-to="25000" data-append="+">0</strong>
                            <label>Happy Gamers</label>
                            <p class="text-color-primary mb-xl">They can't be wrong</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
                            <strong data-to="25">0</strong>
                            <label>Engaging Games</label>
                            <p class="text-color-primary mb-xl">Many more to come</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="900">
                            <strong data-to="250000" data-append="+" data-prepend="$">0</strong>
                            <label>Money Paid</label>
                            <p class="text-color-primary mb-xl">Satisfaction guaranteed</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
                            <strong data-to="75000" data-append="+" data-prepend="$">0</strong>
                            <label>Highest Lottery Pot</label>
                            <p class="text-color-primary mb-xl">Participate and win big!</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <section class="call-to-action call-to-action-primary mb-none">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="call-to-action-content align-left pb-md mb-xl ml-none">
                            <h2 class="text-color-light mb-none mt-xl">Want to earn <strong>real money by playing?</strong></h2>
                            <p class="lead mb-xl">Sign up for an account now and start winning big!</p>
                        </div>
                        <div class="call-to-action-btn">
                            <a href="http://themeforest.net/item/porto-responsive-html5-template/4106987" target="_blank" class="btn btn-lg btn-primary btn-primary-scale-2 mr-md">Sign Up Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-no-border section-default m-none pt-xlg" id="demos">
            <div class="container-fluid sample-item-container">
                <div class="row">

                    <div class="col-md-12 center">
                        <h2 class="mt-xlg mb-none">Our <strong>Games</strong></h2>
                        <p class="lead">Click on any game <span class="alternative-font font-size-xl">...and play for free!</span></p>

                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#">ALL GAMES</a>
                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#">SLOT</a>
                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#">ROULETTE</a>
                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#">CARD</a>
                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#">BINGO</a>
                        <a class="open-demo-options btn btn-3d btn-xlg btn-quaternary mt-md mb-xlg" href="#"><i class="fas fa-star"></i> POPULAR</a>

                    </div>

                </div>

                <div class="row">
                    <ul class="sample-item-list sample-item-list-loaded">
                        @foreach ([
                        'Slot Machine - The Fruits',
                        '3D Blackjack',
                        'Slot Machine - Ultimate Soccer',
                        '3D Roulette',
                        'Slot Machine - Mr. Chicken',
                        'Jacks or Better',
                        'Slot Machine - Space Adventure',
                        'Scratch Fruit',
                        '3 Cards Monte',
                        'High or Low',
                        'Wheel of Fortune',
                        'Keno',
                        'Slot Machine - Ramses Treasure',
                        'Slot Machine - Lucky Christmas',
                        'Slot Machine - Arabian Nights',
                        'Bingo',
                        'Baccarat',
                        'Craps',
                        'Caribbean Stud',
                        'Pai Gow Poker',
                        'Joker Poker',
                        'Three Card Poker',
                        'Spin and Win',
                        'Plinko',
                        ] as $key => $game)
                            <li class="col-sm-6 col-md-3 isotope-item">
                                <div class="sample-item sample-item-home pl-md pr-md">
                                    <a href="#" target="_blank">
                                    <span class="sample-item-image-wrapper">
                                        <span class="sample-item-image" data-original="{{ asset("img/games/".($key + 1).".jpg") }}" data-plugin-lazyload data-plugin-options="{'appearEffect': 'animated fadeIn'}"></span>
                                        <i class="fa fa-spinner fa-spin fa-fw"></i>
                                    </span>
                                        <span class="sample-item-description">
                                        <h5>{{ $game }}</h5>
                                    </span>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-12 center mb-xl">
                    <h2 class="mb-sm mt-md"><strong>Pay and withdraw</strong> your money using these...</h2>

                    <div class="payment-logos">
                        <img class="img-responsive" src="{{ asset('img/logos/bitcoin.png') }}" alt="Bitcoin" />
                        <img class="img-responsive" src="{{ asset('img/logos/paypal.png') }}" alt="PayPal" />
                        <img class="img-responsive" src="{{ asset('img/logos/wiretransfer.png') }}" alt="Wire Transfer" />
                        <img class="img-responsive" src="{{ asset('img/logos/visa.png') }}" alt="Visa" />
                        <img class="img-responsive" src="{{ asset('img/logos/mastercard.png') }}" alt="Mastercard" />
                    </div>

                    <h4 class="heading-primary alternative-font mt-xl pt-xl">We Support <strong class="custom-underline">Multiple Currencies!</strong></h4>
                </div>
            </div>
        </div>
    </div>
@endsection

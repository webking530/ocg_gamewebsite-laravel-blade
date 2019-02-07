@inject('statsService', "Models\Statistics\StatisticsService")
@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('app.meta.title') }}</title>

    <meta name="keywords" content="{{ trans('app.meta.keywords') }}" />
    <meta name="description" content="{{ trans('app.meta.description') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/home.css') !!}">
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/game_grid.css') !!}">
@endsection

@section('content')
    <section class="hero primary-hero" id="primary-hero">
        <div class="container">
            <div class="row" id="hero-row">
                <div class="col-lg-12">
                    <div class="hero-container mt-lg">
                        <div class="hero-title text-center">
                            <h1>
                            <span>
                                {!! transdata('frontend/home.banner_are_you_ready') !!}
                            </span>
                            </h1>
                        </div>
                        <div class="hero-tagline text-center">
                            <p class="hero-paragraph">{!! transdata('frontend/home.check_out_our_games') !!}</p>
                        </div>
                        <div class="hero-cta text-center">
                            <a href="#demos" class="btn btn-lg btn-primary btn-borders text-uppercase" data-hash data-hash-offset="100">
                                <p class="hero-paragraph">{!! transdata('frontend/home.start_playing_now') !!}</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div role="main" class="main" style="margin-top: 0">
        <div class="home-intro" id="home-intro">
            <div class="container">

                <div class="row">
                    <div class="col-md-8">
                        <p>{!! transdata('frontend/home.the_best_casino') !!}</p>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-lg mb-xl text-right">
                            <a href="#demos" data-hash data-hash-offset="100" class="btn btn-primary mr-md appear-animation" data-appear-animation="fadeInDown" data-appear-animation-delay="300">{!! transdata('frontend/home.test_our_games') !!}</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-12 center">
                    <h2 class="word-rotator-title mb-sm">{!! transdata('frontend/home.ocg_subtitle_banner_1') !!}</h2>
                    <p class="lead">{!! transdata('frontend/home.ocg_subtitle_banner_2') !!}</p>
                </div>
            </div>

            <div class="row mt-xl">
                <div class="counters counters-text-dark">
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="300">
                            <strong data-to="{{ $statsService->getUsersAmount() }}" data-append="+">0</strong>
                            <label>{!! transdata('frontend/home.counter_title_1') !!}</label>
                            <p class="text-color-primary mb-xl">{!! transdata('frontend/home.counter_subtitle_1') !!}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="600">
                            <strong data-to="{{ $statsService->getGamesAmount() }}">0</strong>
                            <label>{!! transdata('frontend/home.counter_title_2') !!}</label>
                            <p class="text-color-primary mb-xl">{!! transdata('frontend/home.counter_subtitle_2') !!}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="900">
                            <strong data-to="{{ $statsService->getMoneyPaid() }}" data-append="+" data-prepend="$">0</strong>
                            <label>{!! transdata('frontend/home.counter_title_3') !!}</label>
                            <p class="text-color-primary mb-xl">{!! transdata('frontend/home.counter_subtitle_3') !!}</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="counter appear-animation" data-appear-animation="fadeInUp" data-appear-animation-delay="1200">
                            <strong data-to="{{ $statsService->getHighestLotteryPot() }}" data-append="+" data-prepend="$">0</strong>
                            <label>{!! transdata('frontend/home.counter_title_4') !!}</label>
                            <p class="text-color-primary mb-xl">{!! transdata('frontend/home.counter_subtitle_4') !!}</p>
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
                            <h2 class="text-color-light mb-none mt-xl">{!! transdata('frontend/home.sign_up_banner_title') !!}</h2>
                            <p class="lead mb-xl">{!! transdata('frontend/home.sign_up_banner_subtitle') !!}</p>
                        </div>
                        <div class="call-to-action-btn">
                            <a href="{{ route('home.register') }}" target="_blank" class="btn btn-lg btn-gold mr-md">{!! transdata('frontend/home.sign_up_banner_button') !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section section-no-border section-default m-none pt-xlg" id="demos">
            <div class="container-fluid sample-item-container">
                <div class="row">
                    <div class="col-md-12 center">
                        <h2 class="mt-xlg mb-none">{!! transdata('frontend/home.our_games') !!}</h2>
                        <p class="lead">{!! transdata('frontend/home.click_game_play_free') !!}</p>
                    </div>
                </div>

                @include('frontend.partials.game_grid')
            </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="col-md-12 center mb-xl">
                    <h2 class="mb-sm mt-md">{!! transdata('frontend/home.pay_and_withdraw') !!}</h2>

                    <div class="payment-logos">
                        <img class="img-responsive" src="{{ asset('img/logos/bitcoin.png') }}" alt="Bitcoin" />
                        <img class="img-responsive" src="{{ asset('img/logos/paypal.png') }}" alt="PayPal" />
                        <img class="img-responsive" src="{{ asset('img/logos/wiretransfer.png') }}" alt="{{ trans('frontend/home.wire_transfer') }}" />
                        <img class="img-responsive" src="{{ asset('img/logos/visa.png') }}" alt="Visa" />
                        <img class="img-responsive" src="{{ asset('img/logos/mastercard.png') }}" alt="Mastercard" />
                    </div>

                    <h4 class="heading-primary alternative-font mt-xl pt-xl">{!! transdata('frontend/home.we_support_currencies') !!}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! mix('compiled/js/pages/game_grid.js') !!}"></script>
@endsection
@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/lottery.meta.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/lottery.meta.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/lottery.meta.description') }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/lottery.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/lottery.meta.title') }}</strong></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <ul class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" class="active"><a href="#low_stake" aria-controls="home" role="tab" data-toggle="tab"><img width="64" class="img-responsive margin-auto" src="{{ asset('img/lottery/low_stake.png') }}" alt="{{ trans('frontend/lottery.low_stake') }}"></a></li>
                        <li role="presentation" class=""><a href="#mid_stake" aria-controls="home" role="tab" data-toggle="tab"><img width="64" class="img-responsive margin-auto" src="{{ asset('img/lottery/mid_stake.png') }}" alt="{{ trans('frontend/lottery.mid_stake') }}"></a></li>
                        <li role="presentation" class=""><a href="#high_stake" aria-controls="home" role="tab" data-toggle="tab"><img width="64" class="img-responsive margin-auto" src="{{ asset('img/lottery/high_stake.png') }}" alt="{{ trans('frontend/lottery.high_stake') }}"></a></li>
                    </ul>

                    <div class="tab-content">
                        @foreach ($lotteries as $type => $lottery)
                            <div role="tabpanel" class="tab-pane {{ $type == 'low_stake' ? 'active' : '' }} lottery-tab" data-status="{{ $lottery == null ? -1 : $lottery->status }}" data-status-changed="no" data-route="{{ route('lottery.tab_content.get') }}" data-lottery-id="{{ $lottery == null ? 0 : $lottery->id }}" id="{{ $type }}">
                                @include('frontend.partials.lottery_tab_content')
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <h2 class="alternative-font text-center text-blue" style="font-size:50px">{{ trans('frontend/lottery.stakes') }}</h2>

                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content">
                            <img width="120" class="img-responsive margin-auto" src="{{ asset('img/lottery/low_stake.png') }}" alt="{{ trans('frontend/lottery.low_stake') }}">
                            <h4 class="text-uppercase">{{ trans('frontend/lottery.low_stake') }}</h4>
                            <p class="text-light">{{ trans('frontend/lottery.low_stake_description') }}</p>
                            <h4 class="money-earned">{!! trans('frontend/lottery.ticket_price_range', ['from' => '<i class="fas fa-coins"></i> 5', 'to' => '<i class="fas fa-coins"></i> 20']) !!}</h4>
                        </div>
                    </div>

                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content">
                            <img width="120" class="img-responsive margin-auto" src="{{ asset('img/lottery/mid_stake.png') }}" alt="{{ trans('frontend/lottery.mid_stake') }}">
                            <h4 class="text-uppercase">{{ trans('frontend/lottery.mid_stake') }}</h4>
                            <p class="text-light">{{ trans('frontend/lottery.mid_stake_description') }}</p>
                            <h4 class="money-earned">{!! trans('frontend/lottery.ticket_price_range', ['from' => '<i class="fas fa-coins"></i> 80', 'to' => '<i class="fas fa-coins"></i> 120']) !!}</h4>
                        </div>
                    </div>

                    <div class="featured-box featured-box-primary featured-box-effect-1 mt-xl">
                        <div class="box-content">
                            <img width="120" class="img-responsive margin-auto" src="{{ asset('img/lottery/high_stake.png') }}" alt="{{ trans('frontend/lottery.high_stake') }}">
                            <h4 class="text-uppercase">{{ trans('frontend/lottery.high_stake') }}</h4>
                            <p class="text-light">{{ trans('frontend/lottery.high_stake_description') }}</p>
                            <h4 class="money-earned">{!! trans('frontend/lottery.ticket_price_range', ['from' => '<i class="fas fa-coins"></i> 200', 'to' => '<i class="fas fa-coins"></i> 300']) !!}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! mix('compiled/js/pages/lottery.js') !!}"></script>
@endsection
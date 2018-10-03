@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/game.meta.title', ['game' => $game->name]) }}</title>

    <meta name="keywords" content="{{ trans('frontend/game.meta.keywords', ['game' => $game->name]) }}" />
    <meta name="description" content="{{ trans('frontend/game.meta.description', ['game' => $game->name]) }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm">Play <strong>{{ $game->name }}</strong></h2>
                    <p class="lead">Choose below how you want to play</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="col-md-12">
                        <span class="thumb-info thumb-info-side-image thumb-info-side-image-custom thumb-info-no-zoom box-shadow-custom">
                            <span class="thumb-info-caption">
                                <span class="thumb-info-caption-text">
                                    <h4 class="text-uppercase mb-xs">Play Demo</h4>
                                    <div class="col-md-9">
                                        <ul>
                                            <li>Test out the game for free</li>
                                            <li>No real money involved</li>
                                            <li>No sign up required</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <p class="align-right p-lg pb-none">
                                            <a class="btn btn-success btn-lg font-size-sm text-uppercase mb-md btn-play" href="{{ route('home.game.demo', ['slug' => $game->slug]) }}">PLAY DEMO</a>
                                        </p>
                                    </div>
                                </span>
                            </span>
                        </span>

                        <span class="thumb-info thumb-info-side-image thumb-info-side-image-custom thumb-info-no-zoom box-shadow-custom mt-xs">
                            <span class="thumb-info-caption">
                                <span class="thumb-info-caption-text">
                                    <h4 class="text-uppercase mb-xs">Play Live</h4>
                                    <div class="col-md-9">
                                        <ul>
                                            <li>Play and earn real money</li>
                                            <li>Participate in tournaments and earn big prizes</li>
                                            <li>Sign up required</li>
                                        </ul>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <p class="align-right p-lg pb-none">
                                            <a class="btn btn-warning btn-lg font-size-sm text-uppercase mb-md btn-play" href="{{ route('user.game.play_live', ['slug' => $game->slug]) }}">PLAY LIVE</a>
                                        </p>
                                    </div>
                                </span>
                            </span>
                        </span>
                    </div>


                </div>
                <div class="col-md-5">
                    <img class="img-responsive margin-auto" src="{{ asset($game->icon_url) }}" alt="{{ $game->name }}" />
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
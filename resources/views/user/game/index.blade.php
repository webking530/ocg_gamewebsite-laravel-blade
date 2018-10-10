@inject('pricingService', "Models\Pricing\PricingService")
@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/game.casino_games') }} - {{ trans('app.meta.short_title') }}</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/game_grid.css') !!}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">{{ trans('frontend/game.casino_games') }}</h1>
                    <p class="lead">Click on any game to practice or play live and win big!</p>
                </div>
            </div>
        </div>

        <div class="container-fluid sample-item-container">
            @include('frontend.partials.game_grid')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{!! mix('compiled/js/pages/game_grid.js') !!}"></script>
@endsection
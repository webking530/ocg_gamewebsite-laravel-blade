@inject('pricingService', "Models\Pricing\PricingService")
@extends('frontend.layout.app')

@section('meta')
    <title>Play Live - {{ $game->name }} - {{ trans('app.meta.short_title') }}</title>
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">Play Live - {{ $game->name }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="featured-box featured-box-primary mt-xlg">
                                    <div class="box-content">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
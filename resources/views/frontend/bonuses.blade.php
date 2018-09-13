@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/bonuses.meta.title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/bonuses.meta.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/bonuses.meta.description') }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm">Check out our <strong>Bonuses</strong></h2>
                    <p class="lead">Take a look at all the bonuses we have to offer you, take advantage of them so you can
                    maximize your earnings!</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-boxes">
                        <div class="row">
                            @foreach ($bonuses as $bonus)
                                <div class="col-md-3 col-sm-6">
                                    <div class="featured-box featured-box-primary featured-box-effect-1">
                                        <div class="box-content">
                                            <i class="icon-featured {{ $bonus->icon }}"></i>
                                            <h4 class="text-uppercase">{{ $bonus->name }}</h4>
                                            <p class="text-light">{{ $bonus->description }}</p>
                                            <h4 class="money-earned">{!! $bonus->formatted_prize !!}</h4>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
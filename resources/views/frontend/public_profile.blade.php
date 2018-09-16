@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/public_profile.title') }}, {{ $user->nickname }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/public_profile.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/public_profile.description', ['username' => $user->nickname]) }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{!! mix('compiled/css/pages/public_profile.css') !!}">
@endsection

@section('content')
    <div role="main" class="main mt-lg">
        <div class="container">
            <div class="col-md-4 text-center">
                <div class="public-profile">
                    <img class="avatar-img {{ $user->isMale() ? 'avatar-male' : 'avatar-female' }} img-responsive" src="{{ asset($user->formatted_avatar) }}" alt="{{ $user->nickname }}" title="{{ $user->nickname }}"/>

                    <h2 class="{{ $user->gender_color }} mt-lg pb-sm pt-sm">
                        <i class="{{ $user->gender_icon }}"></i> {{ $user->nickname }}
                        <span class="fullname alternative-font"><img src="{{ asset($user->flag_icon) }}" alt="{{ $user->country_code }}" title="{{ $user->country_name }}" width="48"/> {{ $user->full_name }}</span>
                    </h2>

                    <div class="featured-box featured-box-primary featured-box-effect-1">
                        <div class="box-content {{ ! $user->isMale() ? 'featured-box-pink-border' : '' }}">
                            <h3 class="alternative-font">Ranking:</h3>
                            <h2><i class="fas fa-hashtag"></i> 350</h2>
                            <hr>
                            <h3 class="alternative-font">Total Won:</h3>
                            <h2><i class="fas fa-coins money-earned"></i> 25,000</h2>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-md-8">
                <h2 class="text-center text-blue"><i class="fas fa-star"></i> Badges Earned</h2>
                <hr>

                @forelse ($user->badges as $badge)
                    <div class="col-md-4 col-sm-6">
                        <div class="featured-box featured-box-primary featured-box-effect-1">
                            <div class="box-content {{ ! $user->isMale() ? 'featured-box-pink-border' : '' }}">
                                <img class="img-responsive margin-auto" src="{{ asset($badge->image_url) }}" alt="{{ $badge->name }}">
                                <h4 class="text-uppercase">{{ $badge->name }}</h4>
                                <p class="text-light">{{ $badge->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info text-center">This user has not earned any badges yet!</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
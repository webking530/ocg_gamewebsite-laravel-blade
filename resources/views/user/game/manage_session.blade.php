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
                    <h1 class="mb-sm"><img src="{{ asset($game->small_icon) }}" width="48"> Play Live - {{ $game->name }}</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="featured-box featured-box-primary mt-xlg">
                                    <div class="box-content">
                                        @if ($hasOpenSession)
                                            <h2>You already have an open session, choose what do you want to do</h2>
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h2 class="text-center">Credits in Session</h2>
                                                    <h3 class="text-center"><span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($gameSession->pivot->credits, 2) }}</span> <span class="text-blue">&mdash;</span> @price($pricingService->exchangeCredits($gameSession->pivot->credits, $user->currency_code), $user->currency_code)</h3>

                                                    <h4>Session opened @datetime($gameSession->pivot->created_at)</h4>

                                                    <div class="row mt-lg">
                                                        <div class="col-md-12">
                                                            <a href="{{ route('user.games.play_live', ['game' => $game]) }}" class="btn btn-success btn-lg mb-md"><i class="fas fa-play"></i> Keep Playing</a>
                                                            <a href="{{ route('user.session.close', ['game' => $game]) }}" class="btn btn-danger btn-lg mb-md confirm-click" data-confirm-content="{{ trans('frontend/game.this_will_refund') }}"><i class="fas fa-sign-out-alt"></i> Close Session</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img class="img-responsive margin-auto" src="{{ asset($game->icon_url) }}" alt="{{ $game->name }}" />
                                                </div>
                                            </div>
                                        @else
                                            <h2>Choose how much from your balance you want to deposit for this game session</h2>
                                            <hr>

                                            {!! Form::open(['route' => ['user.games.deposit', $game]]) !!}

                                            <div class="row">
                                                <div class="col-md-6">
                                                    @include('user.partials.balance')
                                                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-plus-circle"></i> Add Money</a>
                                                    <hr>

                                                    <h4>Input the amount in coins <i class="fas fa-coins money-earned"></i></h4>
                                                    <div class="row mt-md mb-md">
                                                        <div class="col-md-offset-3 col-md-6 text-center">
                                                            <input type="number" name="credits" class="form-control deposit-coins" required="required" step="0.01" min="1" max="{{ $user->credits }}" placeholder="&middot; &middot; &middot;">
                                                        </div>
                                                    </div>
                                                    <h3 id="inputMoney" style="display: none" data-rate="{{ $pricingService->rate('USD', $user->currency_code) }}">{{ $user->currency->symbol }}<span>0.00</span> {{ $user->currency_code }}</h3>
                                                </div>
                                                <div class="col-md-6">
                                                    <img class="img-responsive margin-auto" src="{{ asset($game->icon_url) }}" alt="{{ $game->name }}" />
                                                </div>
                                            </div>

                                            <hr>

                                            <div class="row mt-lg">
                                                <div class="col-md-12 text-center">
                                                    <div class="alert alert-warning"><i class="fas fa-info-circle"></i> <strong>NOTICE:</strong> By clicking play, the amount you typed in above will be temporarily deducted from your
                                                        balance into the game session. Any earnings or losses through the game will affect the final amount you will be able to retrieve.</div>
                                                    <button type="submit" class="btn btn-xlg btn-primary"><i class="fas fa-play"></i> PLAY LIVE NOW</button>
                                                </div>
                                            </div>

                                            {!! Form::close() !!}
                                        @endif
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
    <script src="{!! mix('compiled/js/pages/manage_session.js') !!}"></script>
@endsection
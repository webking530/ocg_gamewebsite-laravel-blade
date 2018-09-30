@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/tournaments.meta.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/tournaments.meta.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/tournaments.meta.description') }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg mb-xlg">
                <div class="col-md-6 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/tournaments.meta.title') }}</strong></h2>
                </div>
                <div class="col-md-6 center">
                    <a href="{{ route('tournaments.history') }}" class="btn btn-xlg btn-quaternary white-space-normal"><i class="fas fa-calendar-alt"></i> {{ trans('frontend/tournaments.check_past_tournaments') }}</a>
                </div>
            </div>

            @if (count($tournaments))
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-justified" role="tablist">
                            @foreach ($tournaments as $key => $tournament)
                                <li role="presentation" class="@if ($key == 0) active @endif"><a href="#tournament_{{ $tournament->group }}" aria-controls="home" role="tab" data-toggle="tab">{{ $tournament->formattedGroup }}</a></li>
                            @endforeach
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            @foreach ($tournaments as $key => $tournament)
                                <div role="tabpanel" class="tab-pane @if ($key == 0) active @endif" id="tournament_{{ $tournament->group }}">

                                    <h3 class="text-center"><i class="fas fa-clock"></i> Tournament ends on <abbr data-toggle="tooltip" data-original-title="{{ $tournament->date_to->format('l, F j, Y, g:i a') }}">{{ $tournament->date_to->diffForHumans() }}</abbr></h3>

                                    <div class="podium">
                                        <div class="place2">
                                            <div class="prize"><i class="fas fa-coins money-earned"></i> {{ number_format($tournament->prizes[1]) }}</div>
                                            <div class="number">2</div>
                                        </div>
                                        <div class="place1">
                                            <div class="prize"><i class="fas fa-coins money-earned"></i> {{ number_format($tournament->prizes[0]) }}</div>
                                            <div class="number">1</div>
                                        </div>
                                        <div class="place3">
                                            <div class="prize"><i class="fas fa-coins money-earned"></i> {{ number_format($tournament->prizes[2]) }}</div>
                                            <div class="number">3</div>
                                        </div>

                                        <h2 class="heading-primary alternative-font text-center mt-md">PRIZES</h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <h3 class="heading-primary alternative-font"><i class="fas fa-users"></i> USERS PARTICIPATING <span class="badge" style="font-size:20px">{{ $tournament->users()->count() }}</span></h3>
                                                @include('frontend.tournaments.partials.users_table')
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="table-responsive">
                                                <h3 class="heading-primary alternative-font"><i class="fas fa-gamepad"></i> GAMES FOR THIS TOURNAMENT</h3>
                                                <table class="table table-striped table-hover text-light" style="margin:auto">
                                                    <thead>
                                                    <tr>
                                                        <th>Game Name</th>
                                                        <th>Play Now</th>
                                                    </tr>
                                                    @foreach ($tournament->games as $game)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset($game->small_icon) }}" width="48"> {{ $game->name }}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('home.game.demo', ['slug' => $game->slug]) }}" class="btn btn-success btn-sm">Demo</a>
                                                                <a href="#" class="btn btn-warning btn-sm">Live</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="row">

                    <div class="col-md-12">
                        <img class="img-responsive margin-auto" src="{{ asset('img/trophy.png') }}" alt="Trophy" />
                    </div>
                    <div class="col-md-12">
                        <h2 class="alternative-font text-center">We do not have any scheduled tournaments at the moment. Please check back later.</h2>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('scripts')

@endsection
@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/tournaments.meta_history.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/tournaments.meta_history.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/tournaments.meta_history.description') }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg mb-xlg">
                <div class="col-md-6 center">
                    <h2 class="mb-sm"><strong>{{ trans('frontend/tournaments.meta_history.title') }}</strong></h2>
                </div>
                <div class="col-md-6 center">
                    <a href="{{ route('home.tournaments') }}" class="btn btn-xlg btn-quaternary white-space-normal"><i class="fas fa-trophy"></i> {{ trans('frontend/tournaments.back_to_current') }}</a>
                </div>
            </div>


            <div class="row">
                @include('frontend.tournaments.partials.tournament_groups')

                <div class="col-md-8">
                    <div class="featured-box featured-box-primary align-left mt-xlg">
                        <div class="box-content">
                            <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-calendar-alt"></i> {{ trans('frontend/tournaments.meta_history.title') }}</h4>
                            <hr>

                            @if ($group == null)
                                <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ trans('frontend/tournaments.select_tournament_type') }}</div>
                            @else
                                @if ($history->count() == 0)
                                    <div class="alert alert-info"><i class="fas fa-info-circle"></i> {{ trans('frontend/tournaments.no_tournaments_category') }}</div>
                                @else
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Tournament</th>
                                                    <th>Prizes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($history as $tournament)
                                                <tr>
                                                    <td>
                                                        <p><a href="{{ route('tournaments.details', ['tournament' => $tournament]) }}"><i class="fas fa-calendar-check"></i> {{ $tournament->date_from->format('d M Y') }} &mdash; {{ $tournament->date_to->format('d M Y') }}</a></p>
                                                        <p class="text-light"><i class="fas fa-user"></i> Participants: <span class="badge">{{ $tournament->users()->count() }}</span></p>
                                                        <p class="text-light"><i class="fas fa-clock"></i> Duration: <span class="badge">{{ trans_choice('frontend/tournaments.days', $tournament->getDurationInDays(), ['days' => $tournament->getDurationInDays()]) }}</span></p>
                                                    </td>
                                                    <td>
                                                        <p><i class="fas fa-medal color-gold"></i> &mdash; <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($tournament->prizes[0]) }}</span></p>
                                                        <p><i class="fas fa-medal color-silver"></i> &mdash; <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($tournament->prizes[1]) }}</span></p>
                                                        <p><i class="fas fa-medal color-bronze"></i> &mdash; <span class="money-earned"><i class="fas fa-coins"></i> {{ number_format($tournament->prizes[2]) }}</span></p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
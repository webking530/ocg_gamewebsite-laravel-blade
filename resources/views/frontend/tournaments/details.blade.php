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
                            <h4 class="heading-primary text-uppercase mb-md"><i class="fas fa-calendar-alt"></i> Tournament held from <span class="text-light">{{ $tournament->date_from->format('d M Y') }}</span> to <span class="text-light">{{ $tournament->date_to->format('d M Y') }}</span></h4>
                            <hr>

                            <a class="btn btn-default" href="{{ route('tournaments.history', ['group' => $group]) }}"><i class="fas fa-list"></i> Back to List</a>

                            <div class="table-responsive">
                                @include('frontend.tournaments.partials.users_table')
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
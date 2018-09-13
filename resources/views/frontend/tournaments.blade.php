@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('frontend/tournaments.meta.title') }}</title>

    <meta name="keywords" content="{{ trans('frontend/tournaments.meta.keywords') }}" />
    <meta name="description" content="{{ trans('frontend/tournaments.meta.description') }}">
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">

            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h2 class="mb-sm"><strong>Tournaments</strong></h2>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
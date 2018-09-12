@extends('frontend.layout.games')

@section('meta')
    <title>{{ trans('frontend/game.meta.title', ['game' => $game->name]) }}</title>

    <meta name="keywords" content="{{ trans('frontend/game.meta.keywords', ['game' => $game->name]) }}" />
    <meta name="description" content="{{ trans('frontend/game.meta.description', ['game' => $game->name]) }}">
@endsection

@section('content')
    <iframe style="position:fixed; top:0; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;" src="{{ $route }}"></iframe>
@endsection
@extends('email.layout')

@section('content')
    <p>{{ trans('emails.activation.body_1', ['name' => $user->name]) }}</p>

    <p><strong>{{ $user->verification_pin }}</strong></p>

    <p>{{ trans('emails.activation.body_2', ['route' => route('home.activation', ['nickname' => $user->nickname])]) }}</p>
@endsection
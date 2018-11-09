@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('auth.activation.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('auth.activation.keywords') }}" />
    <meta name="description" content="{{ trans('auth.activation.description') }}">
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="featured-boxes mt-none mb-none">
                        <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                            <div class="box-content">
                                <h1 class="mb-lg text-blue text-center">{{ trans('auth.activation.title') }}</h1>

                                <hr>

                                <div class="alert alert-info">
                                    Please check the activation code sent via SMS or Email. It may take a few minutes to be received.

                                    <div class="text-center">
                                        <a class="btn btn-link" href="{{ route('home.pin.resend', ['user' => $user, 'type' => 'sms']) }}">
                                            Resend code via SMS
                                        </a>

                                        <a class="btn btn-link" href="{{ route('home.pin.resend', ['user' => $user, 'type' => 'email']) }}">
                                            Resend code via Email
                                        </a>
                                    </div>
                                </div>

                                <form class="form-horizontal" method="POST" action="{{ route('home.activation.post', ['user' => $user]) }}">
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="verification_pin" class="col-md-4 control-label">Activation Code</label>

                                        <div class="col-md-6">
                                            <input id="verification_pin" type="text" class="form-control" name="verification_pin" required autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Activate
                                            </button>
                                        </div>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

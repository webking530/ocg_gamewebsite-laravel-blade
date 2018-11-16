@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('auth.login.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('auth.login.keywords') }}" />
    <meta name="description" content="{{ trans('auth.login.description') }}">
@endsection

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="featured-boxes mt-none mb-none">
                    <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                        <div class="box-content">
                            <h1 class="mb-lg text-blue text-center">{{ trans('auth.login.title') }}</h1>

                            <hr>

                            @if ($enableSocial)
                                <div class="row">
                                    <div class="text-center mb-md col-md-offset-4 col-md-4">
                                        <div class="g-signin2" data-onsuccess="googleSignIn" data-theme="dark" data-google-auth-route="{{ route('auth.social.google') }}"></div>
                                        {{--<button type="button" class="btn btn-danger"><i class="fab fa-google-plus"></i> Sign in with Google+</button>--}}
                                        {{--<button type="button" class="btn btn-primary"><i class="fab fa-facebook"></i> Sign in with Facebook</button>--}}
                                    </div>
                                </div>
                            @endif

                            <form class="form-horizontal" method="POST" action="{{ route('home.login.post') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Password</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-8 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Login
                                        </button>

                                        <a class="btn btn-link" href="{{ route('home.password.request') }}">
                                            Forgot Your Password?
                                        </a>
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

@section('scripts')
    <script src="{!! mix('compiled/js/social/auth.js') !!}"></script>
@endsection
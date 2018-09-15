@inject('locationService', "App\Models\Location\LocationService")
@inject('pricingService', "App\Models\Pricing\PricingService")
@extends('frontend.layout.app')

@section('meta')
    <title>{{ trans('auth.register.title') }} - {{ trans('app.meta.short_title') }}</title>

    <meta name="keywords" content="{{ trans('auth.register.keywords') }}" />
    <meta name="description" content="{{ trans('auth.register.description') }}">
@endsection

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="featured-boxes mt-none mb-none">
                    <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                        <div class="box-content">
                            <h1 class="mb-lg text-blue text-center">{{ trans('auth.register.title') }}</h1>

                            <hr>

                            <form class="form-horizontal" method="POST" action="{{ route('home.register.post') }}">
                                {{ csrf_field() }}


                                <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                    <label for="nickname" class="col-md-4 control-label">Nickname</label>

                                    <div class="col-md-6">
                                        <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" required autofocus>

                                        @if ($errors->has('nickname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Email</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                    <label for="lastname" class="col-md-4 control-label">Last Name</label>

                                    <div class="col-md-6">
                                        <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                    <label for="gender" class="col-md-4 control-label">Gender</label>

                                    <div class="col-md-6">
                                        {!! Form::select('gender', \Models\Auth\User::getGenderList(), null, ['class' => 'form-control', 'required' => true]) !!}

                                        @if ($errors->has('gender'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                                    <label for="mobile_number" class="col-md-4 control-label">Mobile Number</label>

                                    <div class="col-md-6">
                                        <input id="mobile_number" type="tel" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required autofocus>

                                        @if ($errors->has('mobile_number'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                                    <label for="country_code" class="col-md-4 control-label">Country</label>

                                    <div class="col-md-6">
                                        {!! Form::select('country_code', $locationService->getEnabledCountriesList(), null, ['class' => 'form-control', 'required' => true]) !!}

                                        @if ($errors->has('country_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                                    <label for="currency_code" class="col-md-4 control-label">Preferred Currency</label>

                                    <div class="col-md-6">
                                        {!! Form::select('currency_code', $pricingService->getCurrenciesList(), null, ['class' => 'form-control', 'required' => true]) !!}

                                        @if ($errors->has('currency_code'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('currency_code') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <label><input type="checkbox" name="terms" value="1" required> I accept the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a> of
                                        Online Casino Games.</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Register
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

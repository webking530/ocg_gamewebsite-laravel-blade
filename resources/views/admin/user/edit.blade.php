@inject('locationService', "Models\Location\LocationService")
@inject('pricingService', "Models\Pricing\PricingService")
@extends('admin.layout.app')

@section('meta')
    <title>{{ trans('user.edit.title') }} - {{ trans('user.edit.title') }}</title>
@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="featured-boxes mt-none mb-none">
                        <div class="featured-box featured-box-primary mt-xl" style="text-align: left">
                            <div class="box-content">
                                <h1 class="mb-lg text-blue text-center">{{ trans('user.edit.title') }}</h1>
                                <hr>
                                {{ Form::model($user, array('route' => array('user.update',$user->id), 'method' => 'PUT','class'=>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                    <label for="nickname" class="col-md-4 control-label">Nickname</label>

                                    <div class="col-md-6">
                                        <input id="nickname" type="text" class="form-control" name="nickname"
                                               value="{{ ($user->nickname ? $user->nickname: '') }}" required
                                               autofocus>

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
                                        <input id="email" type="email" class="form-control" name="email"
                                               value="{{ ($user->email ? $user->email: '') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name"
                                               value="{{ ($user->name ? $user->name: '') }}" required autofocus>
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
                                        <input id="lastname" type="text" class="form-control" name="lastname"
                                               value="{{ ($user->lastname ? $user->lastname: '') }}" required
                                               autofocus>
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
                                        {!! Form::select('gender', Models\Auth\User::getGenderList(), ($user->gender ? $user->gender: ''), ['class' => 'form-control', 'required' => true]) !!}
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
                                        <input id="mobile_number" type="tel" class="form-control"
                                               name="mobile_number"
                                               value="{{ ($user->mobile_number ? $user->mobile_number: '') }}"
                                               required autofocus>
                                        @if ($errors->has('mobile_number'))
                                            <span class="help-block">
                                                 <strong>{{ $errors->first('mobile_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('low_balance_threshold') ? ' has-error' : '' }}">
                                    <label for="low_balance_threshold" class="col-md-4 control-label">Low Balance
                                        Threshold</label>
                                    <div class="col-md-6">
                                        <input id="low_balance_threshold" type="tel" class="form-control"
                                               name="low_balance_threshold"
                                               value="{{ ($user->low_balance_threshold ? $user->low_balance_threshold : '') }}"
                                               autofocus>
                                        @if ($errors->has('low_balance_threshold'))
                                            <span class="help-block">
                                                   <strong>{{ $errors->first('low_balance_threshold') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                                    <label for="country_code" class="col-md-4 control-label">Country</label>
                                    <div class="col-md-6">
                                        {!! Form::select('country_code', $locationService->getEnabledCountriesList(), ($user->country_code ? $user->country_code: ''), ['class' => 'form-control', 'required' => true]) !!}
                                        @if ($errors->has('country_code'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('country_code') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                                    <label for="currency_code" class="col-md-4 control-label">Preferred
                                        Currency</label>
                                    <div class="col-md-6">
                                        {!! Form::select('currency_code', $pricingService->getCurrenciesList(), ($user->currency_code ? $user->currency_code: ''), ['class' => 'form-control', 'required' => true]) !!}
                                        @if ($errors->has('currency_code'))
                                            <span class="help-block">
                                                    <strong>{{ $errors->first('currency_code') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@inject('locationService', "Models\Location\LocationService")
@inject('pricingService', "Models\Pricing\PricingService")
@extends('admin.layout.app')

@section('meta')
<title>{{ trans('user.edit.title') }} - {{ trans('user.edit.title') }}</title>

@endsection

@section('content')
<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload{
        width: 100%;
    }
</style>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li>
            <a href="{{ route('user.index') }}">
                User Management
            </a>
        </li>
        <li class="active">Edit User</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <h2>{{ trans('user.edit.title') }}</h2>
    </div>

    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-6">
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
                <div class="col-md-6">
                    
                            
                                <div class="col-xs-12 col-sm-8 form-group">
                                    <label for="" class="col-md-4 control-label">Avatar</label>
                                    <div class="col-md-8">
                                        <img class="avatar-img {{ $user->isMale() ? 'avatar-male' : 'avatar-female' }} img-responsive" src="{{ asset($user->formatted_avatar) }}" alt="{{ $user->nickname }}" title="{{ $user->nickname }}"/>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8 form-group">
                                    <label for="" class="col-md-4 control-label">Bank  Account</label>
                                    @if(!empty($bankAccount)) 
                                    <div class="col-md-8">
                                        <p><strong>Holder Name : </strong>{{ $bankAccount->account_holder }}</p>
                                        <p><strong>Bank : </strong>{{ $bankAccount->bank }}</p>
                                        <p><strong>Number : </strong>{{ $bankAccount->number }}</p>
                                        <p><strong>Iban : </strong>{{ $bankAccount->iban }}</p>
                                        <p><strong>Swift : </strong>{{ $bankAccount->swift }}</p>
                                        <p><strong>Country Code : </strong>{{ $bankAccount->country_code }}</p>
                                    </div>
                                    @else
                                    No Bank account linked
                                    @endif
                                </div>
                                <div class="col-xs-12 col-sm-8 form-group">
                                    <label for="" class="col-md-4 control-label">Referrals</label>
                                    @if(!empty($user->referrals)) 
                                    <div class="col-md-8">
                                        @foreach($user->referrals as $ref)  
                                        <p><strong> Email : </strong>{{ $ref->email }}</p>
                                        @endforeach
                                    </div>
                                    @else
                                    No Referrals
                                    @endif


                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <label for="" class="col-md-4 control-label">User Balance</label>
                                    <div class="col-md-8">
                                        {{ $user->credits }} -   @price($pricingService->exchangeCredits($user->credits, $user->currency_code), $user->currency_code)                                   
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8">
                                    <label for="" class="col-md-4 control-label">Days Since Registration</label>
                                    <div class="col-md-8">
                                        <?php
                                        $CreatedDate = strtotime($user->created_at);
                                        $NewDate = date('M j, Y', $CreatedDate);
                                        $diff = date_diff(date_create($NewDate), date_create(date("M j, Y")));
                                        echo $diff->days;
                                        ?>
                                    </div>
                                </div>
                            </div>
                        
            </div>
        </div>
    </div>
</div>
@endsection

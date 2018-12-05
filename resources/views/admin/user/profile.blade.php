@inject('locationService', "Models\Location\LocationService")
@inject('pricingService', "Models\Pricing\PricingService")
@extends('admin.layout.app')

@section('meta')
<title>{{ trans('user.details.title') }} - {{ trans('user.details.title') }}</title>
@endsection

@section('content')
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
        <li class="active">User Detail</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <h2>{{ trans('user.details.title') }} {{ ' : ' . ($user['details']->nickname ? $user['details']->nickname: '')}}</h2>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group col-md-12">
                    <label for="nickname" class="col-md-4 control-label">Nickname : </label>
                    <div class="col-md-8">
                        <span>{{ ($user['details']->nickname ? $user['details']->nickname: '') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="email" class="col-md-4 control-label">Email : </label>
                    <div class="col-md-8">
                        <span>{{($user['details']->email ? $user['details']->email: '')}}</span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="name" class="col-md-4 control-label">Name : </label>
                    <div class="col-md-8">
                        <span>{{ ($user['details']->name ? $user['details']->name: '') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="lastname" class="col-md-4 control-label">Last Name : </label>
                    <div class="col-md-8">
                        <span>{{ ($user['details']->lastname ? $user['details']->lastname: '') }}</span>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="gender" class="col-md-4 control-label">Gender : </label>
                    <div class="col-md-8">
                        <span>{{($user['gender'] ? $user['gender'] : '')}}</span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="mobile_number" class="col-md-4 control-label">Mobile Number</label>
                    <div class="col-md-8">
                        <span>{{ ($user['details']->mobile_number ? $user['details']->mobile_number: '') }}</span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="low_balance_threshold" class="col-md-4 control-label">Low Balance
                        Threshold</label>
                    <div class="col-md-8">
                        <span>{{ ($user['details']->low_balance_threshold ? $user['details']->low_balance_threshold : '') }}</span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="country_code" class="col-md-4 control-label">Country</label>
                    <div class="col-md-8">
                        <span>{{($user['details']->country_code ? $user['details']->country_code: '')}}</span>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label for="currency_code" class="col-md-4 control-label">Preferred Currency</label>
                    <div class="col-md-8">
                        <span>{{($user['details']->currency_code ? $user['details']->currency_code: '')}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@inject('locationService', "Models\Location\LocationService")
@inject('pricingService', "Models\Pricing\PricingService")
@inject('localeService', "Models\Location\LocaleService")
@extends('frontend.layout.app')

@section('meta')
    <title>Account Settings - {{ trans('app.meta.short_title') }}</title>
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">Account Settings</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">My Avatar</h4>
                                        <hr>

                                        <div class="mb-xlg">
                                            <img class="avatar-img {{ $user->isMale() ? 'avatar-male' : 'avatar-female' }} img-responsive" width="200" src="{{ asset($user->formatted_avatar) }}" alt="{{ $user->nickname }}" title="{{ $user->nickname }}"/>
                                            <p class="text-light text-center">260x260</p>
                                        </div>

                                        {!! Form::open(['route' => 'user.avatar.update', 'class' => 'form-horizontal', 'files' => true]) !!}

                                        <div class="form-group">
                                            <div class="col-md-12">
                                                {!! Form::file('avatar', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12 text-center">
                                                {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Notifications</h4>
                                        <hr>

                                        {!! Form::model($user, ['route' => 'user.settings.store', 'class' => 'form-horizontal']) !!}
                                        <div class="form-group">
                                            <label class="control-label col-md-5"><abbr data-toggle="tooltip" data-original-title="Notifications via SMS, Email and Browser will be delivered to you when any important event occurs.">Enable all notifications</abbr></label>

                                            <div class="col-md-7">
                                                {!! Form::hidden('notifications', 0) !!}
                                                {!! Form::checkbox('notifications', 1, $user->notifications) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-5"><abbr data-toggle="tooltip" data-original-title="When your credit balance gets lower than this amount, a notification will be shown.">Low balance notification in credits</abbr></label>

                                            <div class="col-md-7">
                                                {!! Form::number('low_balance_threshold', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-5"><abbr data-toggle="tooltip" data-original-title="An SMS will be sent this amount of minutes before the lottery you are participating in starts.">Lottery SMS notification in minutes</abbr></label>

                                            <div class="col-md-7">
                                                {!! Form::number('lottery_sms_notification_minutes', null, ['class' => 'form-control']) !!}
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-md-offset-5 col-md-6">
                                                {!! Form::submit('Update Settings', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-7">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="heading-primary text-uppercase mb-md">Account Info</h4>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                @if ($user->verified_identification)
                                                    <p class="label label-info"><i class="fas fa-check"></i> Verified Identity</p>
                                                @else
                                                    <p class="label label-danger"><i class="fas fa-times"></i> Unverified Identity</p>
                                                @endif
                                            </div>
                                        </div>

                                        <hr>

                                        {!! Form::model($user, ['route' => 'user.settings.store', 'class' => 'form-horizontal']) !!}
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Nickname</label>

                                            <div class="col-md-9">
                                                {!! Form::text('nickname', null, ['class' => 'form-control', 'disabled' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Name</label>

                                            <div class="col-md-9">
                                                {!! Form::text('name', null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Last Name</label>

                                            <div class="col-md-9">
                                                {!! Form::text('lastname', null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Gender</label>

                                            <div class="col-md-9">
                                                {!! Form::select('gender', \Models\Auth\User::getGenderList(), null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Birthdate</label>

                                            <div class="col-md-9">
                                                {!! Form::date('birthdate', $user->birthdate->format('Y-m-d'), ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        @if ($user->verified_identification)
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Mobile Number</label>

                                                <div class="col-md-9">
                                                    {!! Form::tel('mobile_number', null, ['class' => 'form-control', 'required' => true]) !!}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email</label>

                                                <div class="col-md-9">
                                                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => true]) !!}
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Mobile Number</label>

                                                <div class="col-md-9">
                                                    @include('user.partials.verify_identity_link')
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3">Email</label>

                                                <div class="col-md-9">
                                                    @include('user.partials.verify_identity_link')
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Country</label>

                                            <div class="col-md-9">
                                                {!! Form::select('country_code', $locationService->getEnabledCountriesList(), null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Preferred Currency</label>

                                            <div class="col-md-9">
                                                {!! Form::select('currency_code', $pricingService->getCurrenciesList(), null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3">Language</label>

                                            <div class="col-md-9">
                                                {!! Form::select('locale', $localeService->nativeLanguages(), null, ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-6">
                                                {!! Form::submit('Update Settings', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Change My Password</h4>
                                        <hr>

                                        {!! Form::open(['route' => 'user.settings.change_password', 'class' => 'form-horizontal']) !!}
                                        <div class="form-group">
                                            <label class="control-label col-md-3">My Current Password</label>

                                            <div class="col-md-9">
                                                {!! Form::password('current_password', ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Password</label>

                                            <div class="col-md-9">
                                                {!! Form::password('password', ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Confirm Password</label>

                                            <div class="col-md-9">
                                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => true]) !!}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-md-6">
                                                {!! Form::submit('Change Password', ['class' => 'btn btn-success']) !!}
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>
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
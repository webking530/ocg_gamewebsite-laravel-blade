@extends('frontend.layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

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
						
						
                        <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                            <label for="nickname" class="col-md-4 control-label">nickname</label>

                            <div class="col-md-6">
                                <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" required autofocus>

                                @if ($errors->has('nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">gender</label>

                            <div class="col-md-6">
                                <input id="gender" type="text" class="form-control" name="gender" value="{{ old('gender') }}" required autofocus>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">lastname</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('mobile_number') ? ' has-error' : '' }}">
                            <label for="mobile_number" class="col-md-4 control-label">mobile_number</label>

                            <div class="col-md-6">
                                <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{ old('mobile_number') }}" required autofocus>

                                @if ($errors->has('mobile_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('avatar_url') ? ' has-error' : '' }}">
                            <label for="avatar_url" class="col-md-4 control-label">avatar_url</label>

                            <div class="col-md-6">
                                <input id="avatar_url" type="text" class="form-control" name="avatar_url" value="{{ old('avatar_url') }}" required autofocus>

                                @if ($errors->has('avatar_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('avatar_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
							<div class="form-group{{ $errors->has('credits') ? ' has-error' : '' }}">
                            <label for="credits" class="col-md-4 control-label">credits</label>

                            <div class="col-md-6">
                                <input id="credits" type="text" class="form-control" name="credits" value="{{ old('credits') }}" required autofocus>

                                @if ($errors->has('credits'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('credits') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('country_code') ? ' has-error' : '' }}">
                            <label for="country_code" class="col-md-4 control-label">country_code</label>

                            <div class="col-md-6">
                                <input id="country_code" type="text" class="form-control" name="country_code" value="{{ old('country_code') }}" required autofocus>

                                @if ($errors->has('country_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
                            <label for="currency_code" class="col-md-4 control-label">currency_code</label>

                            <div class="col-md-6">
                                <input id="currency_code" type="text" class="form-control" name="currency_code" value="{{ old('currency_code') }}" required autofocus>

                                @if ($errors->has('currency_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
							<div class="form-group{{ $errors->has('verification_pin') ? ' has-error' : '' }}">
                            <label for="verification_pin" class="col-md-4 control-label">verification_pin</label>

                            <div class="col-md-6">
                                <input id="verification_pin" type="text" class="form-control" name="verification_pin" value="{{ old('verification_pin') }}" required autofocus>

                                @if ($errors->has('verification_pin'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verification_pin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('low_balance_threshold') ? ' has-error' : '' }}">
                            <label for="low_balance_threshold" class="col-md-4 control-label">low_balance_threshold</label>

                            <div class="col-md-6">
                                <input id="low_balance_threshold" type="text" class="form-control" name="low_balance_threshold" value="{{ old('low_balance_threshold') }}" required autofocus>

                                @if ($errors->has('low_balance_threshold'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('low_balance_threshold') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('notifications') ? ' has-error' : '' }}">
                            <label for="notifications" class="col-md-4 control-label">notifications</label>

                            <div class="col-md-6">
                                <input id="notifications" type="text" class="form-control" name="notifications" value="{{ old('notifications') }}" required autofocus>

                                @if ($errors->has('notifications'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('notifications') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('lottery_sms_notification_minutes') ? ' has-error' : '' }}">
                            <label for="lottery_sms_notification_minutes" class="col-md-4 control-label">lottery_sms_notification_minutes</label>

                            <div class="col-md-6">
                                <input id="lottery_sms_notification_minutes" type="text" class="form-control" name="lottery_sms_notification_minutes" value="{{ old('lottery_sms_notification_minutes') }}" required autofocus>

                                @if ($errors->has('lottery_sms_notification_minutes'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lottery_sms_notification_minutes') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						
						<div class="form-group{{ $errors->has('verified_identification') ? ' has-error' : '' }}">
                            <label for="verified_identification" class="col-md-4 control-label">verified_identification</label>

                            <div class="col-md-6">
                                <input id="verified_identification" type="text" class="form-control" name="verified_identification" value="{{ old('verified_identification') }}" required autofocus>

                                @if ($errors->has('verified_identification'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('verified_identification') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
						<div class="form-group{{ $errors->has('locale') ? ' has-error' : '' }}">
                            <label for="locale" class="col-md-4 control-label">locale</label>

                            <div class="col-md-6">
                                <input id="locale" type="text" class="form-control" name="locale" value="{{ old('locale') }}" required autofocus>

                                @if ($errors->has('locale'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('locale') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
							<div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">role</label>

                            <div class="col-md-6">
                                <input id="role" type="text" class="form-control" name="role" value="{{ old('role') }}" required autofocus>

                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
						
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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
@endsection

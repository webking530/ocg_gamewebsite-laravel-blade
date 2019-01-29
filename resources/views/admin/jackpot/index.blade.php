@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Jackpot</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">Jackpot</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">Edit Jackpot Settings</div>
            <div class="card-body">

                <div class="col-md-12">
                    {{ Form::model('', array('route' => array('lottery.updateSettings'), 'method' => 'post','class'=>'form-horizontal')) }}
                    <div class="form-group">
                        <label for="enable_fake_jackpot" class="col-md-4 control-label">enable_fake_jackpot</label>
                        <div class="col-md-6">

                            <input class="jackpotsetings" type="checkbox"   {{ settings('enable_fake_jackpot') == 'true' ? 'checked' : '' }} data-toggle="toggle" data-style="ios" >

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fake_jackpot_current" class="col-md-4 control-label">fake_jackpot_current</label>
                        <div class="col-md-6">
                            <input id="fake_jackpot_current" type='text' name="fake_jackpot_current" value="{{ settings('fake_jackpot_current') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="fake_jackpot_increment_range_daily" class="col-md-4 control-label">fake_jackpot_increment_range_daily</label>
                        <div class="col-md-6">
                            <input id="fake_jackpot_increment_range_daily" type='text' name='fake_jackpot_increment_range_daily' value="{{ settings('fake_jackpot_increment_range_daily') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="real_jackpot_current" class="col-md-4 control-label">real_jackpot_current</label>
                        <div class="col-md-6">
                            <input id="real_jackpot_current" type='text' name='real_jackpot_current' value="{{ settings('real_jackpot_current') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jackpot_min_value" class="col-md-4 control-label">jackpot_min_value</label>
                        <div class="col-md-6">
                            <input id="jackpot_min_value" type='text' name='jackpot_min_value' value="{{ settings('jackpot_min_value') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jackpot_max_value" class="col-md-4 control-label">jackpot_max_value</label>
                        <div class="col-md-6">
                            <input id="jackpot_max_value" type='text' name='jackpot_max_value' value="{{ settings('jackpot_max_value') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jackpot_bet_coefficient" class="col-md-4 control-label">jackpot_bet_coefficient</label>
                        <div class="col-md-6">
                            <input id="jackpot_bet_coefficient" type='text' name='jackpot_bet_coefficient' value="{{ settings('jackpot_bet_coefficient') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="jackpot_min_bet_usd" class="col-md-4 control-label">jackpot_min_bet_usd</label>
                        <div class="col-md-6">
                            <input id="jackpot_min_bet_usd" type='text' name='jackpot_min_bet_usd' value="{{ settings('jackpot_min_bet_usd') }}" class="form-control">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    {{ Form::close()  }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/generalsettings.js') !!}"></script>
@endsection

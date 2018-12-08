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
                            <div class="btn-group" id="status" data-toggle="buttons">
                                <label class="btn btn-default btn-on {{ settings('enable_fake_jackpot') == 'true' ? 'active' : '' }}">
                                    <input type="radio" id="true" value="true" class="registration"
                                           name="enable_fake_jackpot"
                                           checked="{{ settings('enable_fake_jackpot') == 'true' ? 'checked' : '' }}">TRUE</label>
                                <label class="btn btn-default btn-off {{ settings('enable_fake_jackpot') == 'false' ? 'active' : '' }}">
                                    <input type="radio" id="false" value="false" class="registration"
                                           name="enable_fake_jackpot"
                                           checked="{{ settings('enable_fake_jackpot') == 'false' ? 'checked' : '' }}">FALSE</label>
                            </div>                                    
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

@endsection

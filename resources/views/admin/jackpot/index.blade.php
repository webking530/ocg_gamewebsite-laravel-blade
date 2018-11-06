@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Jackpot Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <form class="form-horizontal" method="post" action="{{ route('lottery.updateSettings')  }}">
                            {{ csrf_field() }}
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
                        </form>
                        <br>

                    </div>

                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection

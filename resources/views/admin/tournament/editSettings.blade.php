@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/settings.css') !!}">
@endsection

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-6">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Edit tournament_tpa_levels </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <div id="jsoneditor"></div> <br>
                        <form method="post" class="submitJsonForm" action="{{ route('tournament.updateSettings') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="tournament_tpa_levels" class="settings" value="">
                            <input  type="button" class="btn btn-primary submitJson" value="Update">
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

            <div class="col-xs-6">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Edit tournament_base_days  </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <form method="post" class="form-horizontal" action="{{ route('tournament.updateSettings') }}">
                            {{ csrf_field() }}
                            <input type="text" name="tournament_base_days" class="form-control" value="{{ settings('tournament_base_days ') }}"><br>
                            <input  type="submit" class="btn btn-primary" value="Update">
                        </form>
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
<script>
    var json = <?php
if (!empty(settings('tournament_tpa_levels'))) {
    print json_encode(settings('tournament_tpa_levels'));
} else {
    print 'null';
}
?>;
</script>
<script src="{!! mix('compiled/js/pages/settings.js') !!}"></script>
@endsection


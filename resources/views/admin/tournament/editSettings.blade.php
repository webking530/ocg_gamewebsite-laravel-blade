@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/settings.css') !!}">
@endsection

@section('content')

<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li>
            <a href="{{ route('tournament.index') }}">
                Tournament Management
            </a>
        </li>
        <li class="active">Edit Tournament Settings</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit tournament_tpa_levels 
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
            </div>
            <div class="panel-body">
                <div id="jsoneditor"></div> <br>
                <form method="post" class="submitJsonForm" action="{{ route('tournament.updateSettings') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="tournament_tpa_levels" class="settings" value="">
                    <input  type="button" class="btn btn-primary submitJson" value="Update">
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit tournament_base_days
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
            </div>
            <div class="panel-body">
                <form method="post" class="form-horizontal" action="{{ route('tournament.updateSettings') }}">
                    {{ csrf_field() }}
                    <input type="text" name="tournament_base_days" class="form-control" value="{{ settings('tournament_base_days ') }}"><br>
                    <input  type="submit" class="btn btn-primary" value="Update">
                </form>
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


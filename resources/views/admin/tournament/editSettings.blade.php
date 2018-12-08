@extends('admin.layout.app')
@section('title','Tournaments')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/settings.css') !!}">
@endsection
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>
            Edit Tournament Settings
        </h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a>
            </li>
            <li>
                <a href="{{ route('tournament.index') }}">
                    Tournaments
                </a>
            </li>
            <li class="active">Edit Tournament Settings</li>
        </ol>
    </div>
</div>
<hr>


<div class="row">
    <div class="col-xs-6">

        <div class="card card-accent-info">
            <div class="card-header">Edit tournament_tpa_levels </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div id="jsoneditor"></div> <br>
                    <form method="post" class="submitJsonForm" action="{{ route('tournament.updateSettings') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="tournament_tpa_levels" class="settings" value="">
                        <input  type="button" class="btn btn-primary submitJson" value="Update">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6">

        <div class="card card-accent-info">
            <div class="card-header">Edit tournament_base_days  </div>
            <div class="card-body">
                <div class="col-md-12">
                    <form method="post" class="form-horizontal" action="{{ route('tournament.updateSettings') }}">
                        {{ csrf_field() }}
                        <input type="text" name="tournament_base_days" class="form-control" value="{{ settings('tournament_base_days ') }}"><br>
                        <input  type="submit" class="btn btn-primary" value="Update">
                    </form>
                </div>
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


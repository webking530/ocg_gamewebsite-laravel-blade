@extends('admin.layout.app')
@section('title','Settings')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/settings.css') !!}">
@endsection

@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Game settings</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li><a href="#">Settings</a></li>
            <li>
                <a href="{{ route('setting.games') }}">
                    Games
                </a>
            </li>
            <li class="active">Edit Settings</li>
        </ol>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-xs-6">
        <div class="card card-accent-info">
            <div class="card-header">Edit</div>
            <div class="card-body">
                <div class="col-md-12">
                    <div id="jsoneditor"></div> <br>
                    {{ Form::open(['route' => 'game.updateSetting','class'=>'form-horizontal submitJsonForm','method' => 'post']) }}
                    <input type="hidden" name="settings" class="settings" value="">
                    <input type="hidden" name="id" class="" value="{{ $game->id }}">
                    <input  type="button" class="btn btn-primary submitJson" value="Update">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var json = <?php
if (!empty($game->settings)) {
    print json_encode($game->settings);
} else {
    print 'null';
}
?>;
</script>
<script src="{!! mix('compiled/js/pages/settings.js') !!}"></script>
@endsection


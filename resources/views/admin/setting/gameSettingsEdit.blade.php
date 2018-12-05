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
            <a href="{{ route('setting.games') }}">
                Game Settings
            </a>
        </li>
        <li class="active"> Edit Game Settings</li>
    </ol>
</div>
<div class="row">
        <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Edit Game settings
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
            </div>
            <div class="panel-body">
                <div id="jsoneditor"></div> <br>
                <form method="post" class="submitJsonForm" action="{{ route('game.updateSetting') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="settings" class="settings" value="">
                    <input type="hidden" name="id" class="" value="{{ $game->id }}">
                    <input  type="button" class="btn btn-primary submitJson" value="Update">
                </form>
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


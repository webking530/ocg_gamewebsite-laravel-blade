@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{!! mix('compiled/css/pages/settings.css') !!}">
@endsection

@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Edit Game Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <div id="jsoneditor"></div> <br>
                        <form method="post" class="submitJsonForm">
                            {{ csrf_field() }}
                            <input type="hidden" name="settings" class="settings" value="">
                            <input  type="button" class="btn btn-primary submitJson" value="Update">
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
    var json = <?phpif (!empty($game->settings)) { print json_encode($game->settings); } else { print 'null'; }?>;
</script>
<script src="{!! mix('compiled/js/pages/settings.js') !!}"></script>
@endsection


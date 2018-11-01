@extends('admin.layout.app')
@section('css')
<style>
   
    .main {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    .main > div {
        margin: 10px;
    }

    #jsoneditor {
        flex: 1;
        width: 100%;
        max-width: 500px;
        height: 400px;
    }
</style>
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
    var container = document.getElementById('jsoneditor');
    var options = {
        mode: 'tree',
//    modes: ['code', 'form', 'text', 'tree', 'view'] // allowed modes
    };
    var json = <?php if (!empty($game->settings)){print json_encode($game->settings);} else {print 'null';} ?>;
    if(json == 'null'){
        json = {};
    }
    var settingsjson = new Array();
    settingsjson = JSON.parse(json);
    var editor = new JSONEditor(container, options, settingsjson);
    editor.expandAll();

    $('.submitJson').click(function (e) {
        var settings = editor.get();
        console.log(settings);
        $('.settings').val(JSON.stringify(settings));
        $('.submitJsonForm').submit();
    });
</script>
@endsection


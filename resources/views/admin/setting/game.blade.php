@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Game Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="gameTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Credits</th>
                                    <th>Highest Win</th>
                                    <th>Latest Win</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
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
    // Game Settins start
    function showMessage() {
        return '<div  class="loader-datatable" style="display: block;"></div>';
    }
    $(document).ready(function () {
        var dTable = $('#gameTbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: 'games/showGamedata',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    d.name = $('input[name=name]').val();

                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'credits', name: 'credits'},
                {data: 'highestwin', name: 'highestwin'},
                {data: 'latestwin', name: 'latestwin'},
                {data: 'image', name: 'image'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<img width="48" src="/' + data.icon_url + '">';
                        return $returnValue;
                    },
                    "aTargets": [4]
                },
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';

                        if (data.enabled == 1) {
                            $returnValue += '<li><form method="post" action="games/statusupdate/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="enabled" value="0" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-danger btn-xs" title="Disable Game"><i class="fa fa-toggle-on"></i></button></form></li>'
                        } else {
                            $returnValue += '<li><form method="post" action="games/statusupdate/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="enabled" value="1" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-success btn-xs" title="Enable Game"><i class="fa fa-toggle-off"></i></button></form></li>'
                        }
                        $returnValue += '<li><a href="games/editSettings/' + data.id + '" class="btn btn-basic btn-xs" title="Edit Game Settings"><i class="fa fa-edit"></i></a></li>';
                        $returnValue += '<li><a href="games/detail/' + data.id + '" class="btn btn-primary btn-xs" title="Game Detail"><i class="fa fa-eye"></i></a></li>';
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [5]
                },
            ]
        });
    });
// Game Settings js end
</script>
@endsection

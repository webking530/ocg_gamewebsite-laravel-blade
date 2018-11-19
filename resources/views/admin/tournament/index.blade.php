@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                        <h3>Tournament Management</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <div class="">

                            <a style="pointer-events: none;" href="{{ route('tournament.create') }}" class="btn  btn-primary" disabled>
                                <span class="glyphicon glyphicon-plus"></span> Create Tournament Structure
                            </a>
                            <a  href="{{ route('tournament.editSettings') }}" class="btn  btn-primary">
                                <span class="glyphicon glyphicon-edit"></span> Edit Tournament Settings
                            </a>
                            <a  href="{{ route('tournament.customCreate') }}" class="btn  btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Create Custom Tournament
                            </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="Tournamenttbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Group</th>
                                    <th>Prizes</th>
                                    <th>Date From</th>
                                    <th>Date To</th>
                                    <th>Status</th>
                                    <th>Level</th>
                                    <th>Tournament Ends</th>
                                    <th>Users Participating</th>
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
    function showMessage() {
        return '<div  class="loader-datatable" style="display: block;"></div>';
    }
    $(document).ready(function () {
        var dTable = $('#Tournamenttbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {

                sProcessing: showMessage()
            },
            ajax: {
                url: '{{ route("tournament.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
//                    d.name = $('input[name=name]').val();

                }
            },
            columns: [
                {data: 'group', name: 'group'},
                {data: 'prizes', name: 'prizes'},
                {data: 'date_from', name: 'date_from'},
                {data: 'date_to', name: 'date_to'},
                {data: 'status', name: 'status'},
                {data: 'level', name: 'level'},
                {data: 'tournamentends', name: 'tournamentends'},
                {data: 'users', name: 'users'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {

                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                        $returnValue += '<li><a href="tournament/' + data.id + '/edit" class="btn btn-basic btn-xs" title="Edit Tournaments"><i class="fa fa-edit"></i></a></li>';
                        if (data.recreate == 1) {
                            $returnValue += '<li><a href="tournament/recreate/' + data.id + '" class="btn btn-basic btn-xs" title="Create Tournaments"><i class="fa fa-plus-circle"></i></a></li>';
                        } else if (data.recreate == 0) {
                            $returnValue += '<li><a href="tournament/cancel/' + data.id + '"  onclick="return confirm_click();" class="btn btn-basic btn-xs" title="Cancel Tournaments"><i style="color:red" class="fa fa-times-circle"></i></a></li>';
                        }
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [8]
                },
            ]
        });
    }
    );
    function confirm_click()
    {
        return confirm("Are you sure ?");
    }
</script>

@endsection

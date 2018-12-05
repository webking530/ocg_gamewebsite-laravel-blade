@extends('admin.layout.app')
@section('content')

<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li class="active">Tournament  Management</li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <h2>Tournament  Management</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Search Panel
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span></div>
            <div class="panel-body">
                <form role="form" name="search-form" id="search-form">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="level">
                                    <option value="">Select level</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <select class="form-control select2" name="status">
                                    <option value="">Select Status</option>
                                    <option value="0">Pending</option>
                                    <option value="1">Finished</option>
                                    <option value="2">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Tournament List
                <span class="pull-right clickable panel-toggle"><em class="fa fa-caret-square-down"></em></span>
                <span class="pull-right">
                    <a style="pointer-events: none;" href="{{ route('tournament.create') }}" class="btn  btn-default" disabled>
                        <span class="glyphicon glyphicon-plus"></span> Create Tournament Structure
                    </a>
                    <a  href="{{ route('tournament.editSettings') }}" class="btn  btn-default">
                        <span class="glyphicon glyphicon-edit"></span> Edit Tournament Settings
                    </a>
                    <a  href="{{ route('tournament.customCreate') }}" class="btn  btn-default">
                        <span class="glyphicon glyphicon-plus"></span> Create Custom Tournament
                    </a>
                </span>
            </div>
            <div class="panel-body">
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
                    d.level = $('select[name=level]').val();
                    d.status = $('select[name=status]').val();

                }
            },
            columns: [
                {data: 'group', name: 'group'},
                {data: 'prizes', name: 'prizes'},
                {data: 'date_from', name: 'date_from'},
                {data: 'date_to', name: 'date_to'},
                {data: 'FormattedStatus', name: 'FormattedStatus'},
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
                            $returnValue += '<li><a href="tournament/cancel/' + data.id + '" class="btn btn-basic btn-xs confirm-click" title="Cancel Tournaments"><i style="color:red" class="fa fa-times-circle"></i></a></li>';
                        }
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [8]
                },
            ]
        });
        $('#search-form input').on('keyup', function (e) {
            dTable.fnDraw(true);
            e.preventDefault();
        });
        $('#search-form select').on('change', function (e) {
            dTable.fnDraw(true);
            e.preventDefault();
        });
    });

</script>
@endsection

@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Lottery Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <form class="form-horizontal" method="post" action="{{ route('lottery.updateSettings')  }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="date_close" class="col-md-4 control-label">lottery_deposit_percent_max</label>
                                <div class="col-md-6">
                                    <input type='text' name="lottery_deposit_percent_max" value="{{ settings('lottery_deposit_percent_max') }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_close" class="col-md-4 control-label">lottery_cancel_hours</label>
                                <div class="col-md-6">
                                    <input type='text' name="lottery_cancel_hours" value="{{ settings('lottery_cancel_hours') }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_close" class="col-md-4 control-label">lottery_deposit_percent_min</label>
                                <div class="col-md-6">
                                    <input type='text' name='lottery_deposit_percent_min' value="{{ settings('lottery_deposit_percent_min') }}" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_close" class="col-md-4 control-label">lottery_prize_not_reached_hours_check</label>
                                <div class="col-md-6">
                                    <input type='text' name="lottery_prize_not_reached_hours_check" value="{{ settings('lottery_prize_not_reached_hours_check') }}" class="form-control">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Update
                            </button>
                        </form>
                        <br>
                        <!--                        <div class="pull-right">
                                                    <a href="{{ route('lottery.add') }}" class="btn btn-xs btn-primary">
                                                        <span class="glyphicon glyphicon-plus"></span> Create
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="lottetryTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Prize</th>
                                    <th>Date Begin</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Ticket Price</th>
                                    <th>Country Code</th>
                                    <!--<th>Action</th>-->
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
        var dTable = $('#lottetryTbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: '{{ route("lottery.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {

                }
            },
            columns: [
                {data: 'prize', name: 'prize'},
                {data: 'date_begin', name: 'date_begin'},
                {data: 'status', name: 'status'},
                {data: 'type', name: 'type'},
                {data: 'ticket_price', name: 'ticket_price'},
                {data: 'country_code', name: 'country_code'},
                        //                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    //                    "mRender": function (a, b, data, d) {
                    //                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                    //                        $returnValue += '<li><a href="lottery/edit/' + data.id + '" class="btn btn-basic btn-xs" title="Edit Lottery"><i class="fa fa-edit"></i></a></li>';
                    //                        $returnValue += '</ul>'
                    //                        return $returnValue;
                    //                    },
                    //                    "aTargets": [6]
                },
            ]
        });
    });
</script>
@endsection

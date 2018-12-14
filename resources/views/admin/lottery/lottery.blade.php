@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Lottery</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Lottery</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab1" data-toggle="tab">Lotteries</a></li>
                    <li><a href="#tab2" data-toggle="tab">Edit Lottery settings</a></li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="tab1">

                        <div class="text-center">
                            <button class="btn btn-warning filterBtn">Filter</button>
                            <a href="{{ route('lottery.add') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Create
                            </a>
                        </div>
                        <hr>
                        <div class="col-sm-8 col-sm-offset-2 well clearfix searchFilterDiv hidden">
                            <form role="form" name="search-form" id="search-form">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <select class="form-control select2" name="type">
                                                <option value="">Select type</option>
                                                @foreach(Lang::get('frontend/lottery.type') as  $stakeKey => $stake)
                                                <option value="{{ $stakeKey }}">{{ $stake }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>  
                                    <div class="col -xs-12 col-sm-6 col-md-6">
                                        <div class="form-group">
                                            <select class="form-control select2" name="status">
                                                <option value="">Select Status</option>
                                                @foreach(Lang::get('frontend/lottery.status') as  $statusKey => $status)
                                                <option value="{{ $statusKey }}">{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <table id="lottetryTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Prize</th>
                                        <th>Date Begin</th>
                                        <th>Status</th>
                                        <th>Type</th>
                                        <th>Ticket Price</th>
                                        <th>Country Code</th>
                                        <th>Action</th>
                                    </tr>   
                                </thead>
                                <tbody>
                                </tbody>
                            </table> </div>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        {{ Form::open(['route' => 'lottery.updateSettings','method' => 'post','class'=>'form-horizontal']) }}
                        <div class="form-group">
                            <label for="date_close" class="col-md-4 control-label">lottery_deposit_percent_max</label>
                            <div class="col-md-6">
                                <input type='text' name="lottery_deposit_percent_max" value="{{ settings('lottery_deposit_percent_max') }}" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date  _close" class="col-md-4 control-label">lottery_cancel_hours</label>
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
                        {{Form::close() }}
                    </div>

                </div>
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
                    d.status = $('select[name=status]').val();
                    d.type = $('select[name=type]').val();
                }
            },
            columns: [
                {data: 'prize', name: 'prize'},
                {data: 'date_begin', name: 'date_begin'},
                {data: 'Formattedstatus', name: 'Formattedstatus'},
                {data: 'Formattedtype', name: 'Formattedtype'},
                {data: 'ticket_price', name: 'ticket_price'},
                {data: 'country_code', name: 'country_code'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                        $returnValue += '<li><a href="lottery/edit/' + data.id + '" class="btn btn-basic btn-xs" title="Edit Lottery"><i class="fa fa-edit"></i></a></li>';
                        $returnValue += '<li><form method="post" action="lottery/delete/' + data.id + '" class="confirm-submit delete"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '" ><button class="btn btn-danger btn-xs" title="Delete Lottery"><i class="fa fa-trash"></i></button></form></li>';
                        $returnValue += '</ul>';
                        return $returnValue;
                    },
                    "aTargets": [6]
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

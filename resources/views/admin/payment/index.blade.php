@extends('admin.layout.app')
@section('content')

<div class="row">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.home') }}">
                <em class="fa fa-home"></em>
            </a>
        </li>
        <li class="active">Payment  Management</li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <h2>Payment Management</h2>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-body tabs">
                <ul class="nav nav-pills">
                    <li class="active">
                        <a href="#deposits" data-toggle="tab">
                            Deposits &nbsp;<span class="label label-danger">{{ $pending['deposit'] }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="#withdrawals" data-toggle="tab">
                            Withdrawals &nbsp; <span class="label label-danger">{{ $pending['withdrawal'] }}</span>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="deposits">
                        <table id="depositsTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nickname</th>
                                    <th>Email</th>
                                    <th>Credits</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="withdrawals">
                        <table id="withdrawTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nickname</th>
                                    <th>Email</th>
                                    <th>Credits</th>
                                    <th>Method</th>
                                    <th>Status</th>
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
    </div>
</div>


@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/admin_dashboard.js') !!}"></script>
<script src="{!! mix('compiled/js/pages/payment.js') !!}"></script>
@endsection

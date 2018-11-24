@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                        <h3>Payment Management</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <!--<span class="nav-tabs-title">Top 10 players by : </span>-->
                                <ul class="nav nav-tabs payment" data-tabs="tabs" data-type="payment">
                                    <li class="nav-item active">
                                        <a class="nav-link" data-id="deposits" href="#deposits" data-toggle="tab">
                                            <i class=""></i> Deposits &nbsp;<span class="label label-danger">{{ $pending['deposit'] }}</span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-id="withdrawals" href="#withdrawals" data-toggle="tab">
                                            <i class=""></i> Withdrawals &nbsp; <span class="label label-danger">{{ $pending['withdrawal'] }}</span>
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <div class="tab-content payment">
                            <div class="tab-pane active show" id="deposits">
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

                            <div class="tab-pane" id="withdrawals">
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{!! mix('compiled/js/pages/admin_dashboard.js') !!}"></script>
<script src="{!! mix('compiled/js/pages/payment.js') !!}"></script>
@endsection

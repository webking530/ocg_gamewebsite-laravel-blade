@extends('admin.layout.app')
@section('css')
<link rel="stylesheet" href="{!! asset('css/pages/dataTables.bootstrap.css') !!}">
@endsection
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                @endif
                <div class="box" style="">
                    <div class="box-header" style="border-bottom:1px solid #d2d6de;">
                        <h3>User Management</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="tbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nick Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>Credits</th>
                                    <th>Country Code</th>
                                    <th>Currency Code</th>
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
        var dTable = $('#tbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: 'user/showdata',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    d.nickname = $('input[name=nickname]').val();
                    d.mobile_number = $('input[name=mobile_number]').val();
                    d.email = $('input[name=email]').val();
                    d.credits = $('input[name=credits]').val();
                    d.country_code = $('input[name=country_code]').val();
                    d.currency_code = $('input[name=currency_code]').val();
                }
            },
            columns: [
                {data: 'nickname', name: 'nickname'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'email', name: 'email'},
                {data: 'credits', name: 'credits'},
                {data: 'country_code', name: 'country_code'},
                {data: 'currency_code', name: 'currency_code'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (data, type, row) {
                        $returnValue = '<a href="<?php echo route('user.index') ?>/' + row.id + '">' + row.nickname + '</a>';
                        return $returnValue;
                    },
                    "aTargets": [0]
                },
                {
                    "mRender": function (a, b, data, d) {
                        console.log(data);
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">' +
                                '<li><form method="GET" action="user/switch/' + data.id + '" accept-charset="UTF-8" class="delete"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-info btn-xs" title="Login as User"><i class="fa fa-retweet"></i></button></form></li>' +
                                '<li><a href="user/' + data.id + '/edit" class="btn btn-basic btn-xs" title="Edit User"><i class="fa fa-edit"></i></a></li>';
                        if (data.suspended_on === '' || data.suspended_on === null) {
                            $returnValue += '<li><form method="delete" action="user/suspend/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-danger btn-xs" title="Suspend User"><i class="fa fa-eraser"></i></button></form></li>'
                        } else {
                            $returnValue += '<li><form method="delete" action="user/resumeuser/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-success btn-xs" title="Resume User"><i class="fa fa-eraser"></i></button></form></li>'
                        }
                        $returnValue += '</ul>'
                        return $returnValue;

                    },
                    "aTargets": [6]
                },
            ]
        });

    });
</script>
@endsection

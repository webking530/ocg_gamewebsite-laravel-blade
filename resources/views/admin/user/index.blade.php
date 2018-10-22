@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{!! asset('css/pages/dataTables.bootstrap.css') !!}">
@endsection
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box" style="border:1px solid #d2d6de;">
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

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            var table = $('#tbl').DataTable({
                ajax: "user/showdata",
                type: 'get',
                deferRender: true,
                columns: [
                    {data: 'nickname'},
                    {data: 'mobile_number'},
                    {data: 'email'},
                    {data: 'credits'},
                    {data: 'country_code'},
                    {data: 'currency_code'}
                ],
                columnDefs: [
                    {
                        targets: [0],
                        render: function (a, b, data, d) {
                            $returnValue = '<a href="<?php echo route('user.index') ?>/' + data.id + '">' + data.nickname + '</a>';
                            return $returnValue;
                        }
                    },
                    {

                        targets: [6],
                        render: function (a, b, data, d) {
                            $returnValue = '<ul class="list-inline" style="margin-bottom:0px;"><li><form method="GET" action="user/switch/' + data.id + '" accept-charset="UTF-8" class="delete"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-info btn-xs" title="Switch User"><i class="fa fa-retweet"></i></button></form></li><li><form method="GET" action="user/' + data.id + '/edit" accept-charset="UTF-8" class="delete"><input name="_method" value="EDIT" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-basic btn-xs" title="Edit User"><i class="fa fa-edit"></i></button></form></li>';
                            if (data.suspended_on === '' || data.suspended_on === null) {
                                $returnValue += '<li><form method="delete" action="user/suspend/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-danger btn-xs" title="Suspend User"><i class="fa fa-eraser"></i></button></form></li>'
                            } else {
                                $returnValue += '<li><form method="delete" action="user/resumeuser/' + data.id + '" accept-charset="UTF-8" class="delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-success btn-xs" title="Resume User"><i class="fa fa-eraser"></i></button></form></li>'
                            }
                            $returnValue += '</ul>'
                            return $returnValue;

                        }
                    }
                ]
            });
        });
    </script>
@endsection

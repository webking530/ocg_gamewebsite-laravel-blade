@inject('locationService', "Models\Location\LocationService")
@extends('admin.layout.app')
@section('title','Users')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>User Management</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Users</li>
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">User List</div>
            <div class="card-body">
                <div class="text-center">
                    <button class="btn btn-warning filterBtn">Filter</button>
                </div>
                <hr>
                <div class="col-sm-8 col-sm-offset-2 well clearfix searchFilterDiv hidden">
                    <form role="form" name="search-form" id="search-form">
                        <div class="">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Search Email" type="text"
                                               name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Search Mobile Number" type="text"
                                               name="mobile_number" id="mobile_number">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <select class="form-control select2" name="country_code">
                                            <option value="">Select Country</option>
                                            @foreach($locationService->getEnabledCountriesList() as $code=>$country)
                                            <option value="{{ $code }}">{{  $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-12">
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
                url: '{{ route("user.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {

                    d.email = $('input[name=email]').val();
                    d.mobile_number = $('input[name=mobile_number]').val();
                    d.country_code = $('select[name=country_code]').val();
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
                        $returnValue = '<img src="' + row.flag + '" width="18" alt="' + row.currency_code + '">'
                                + '&nbsp;&nbsp;<a href="<?php echo route('user.index') ?>/' + row.id + '">' + row.nickname + '</a>';
                        return $returnValue;
                    },
                    "aTargets": [0]
                },
                {
                    "mRender": function (a, b, data, d) {

                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">' +
                                '<li><form method="GET" action="user/switch/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-info btn-xs" title="Login as User"><i class="fa fa-retweet"></i></button></form></li>' +
                                '<li><a href="user/' + data.id + '/edit" class="btn btn-basic btn-xs" title="Edit User"><i class="fa fa-edit"></i></a></li>';
                        if (data.suspended_on === '' || data.suspended_on === null) {
                            $returnValue += '<li><form method="delete" action="user/suspend/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-danger btn-xs" title="Suspend User"><i class="fa fa-eraser"></i></button></form></li>'
                        } else {
                            $returnValue += '<li><form method="delete" action="user/resumeuser/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="_method" value="delete" type="hidden"><meta name="csrf-token" content="<?php echo csrf_token(); ?>"><button class="btn btn-success btn-xs" title="Resume User"><i class="fa fa-eraser"></i></button></form></li>'
                        }
                        $returnValue += '</ul>'
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

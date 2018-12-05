@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Country Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <form role="form" name="search-form" id="search-form">
                            <div class="row">

                                <div class="col-xs-12 col-sm-6 col-md-3">
                                    <div class="form-group">
                                        <select class="form-control select2" name="enabled">
                                            <option value="">Select Status</option>
                                            <option value="1">Enabled</option>
                                            <option value="0">Disabled</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="pull-right">
                            <a href="{{ route('country.add') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Create
                            </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="countryTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Currency code</th>
                                    <th>Pricing Currency</th>
                                    <th>Locale</th>
                                    <th>Capital Timezone</th>
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
        var dTable = $('#countryTbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: '{{ route("country.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    d.enabled = $('select[name=enabled]').val();

                }
            },
            columns: [
                {data: 'code', name: 'code'},
                {data: 'currency_code', name: 'currency_code'},
                {data: 'pricing_currency', name: 'pricing_currency'},
                {data: 'locale', name: 'locale'},
                {data: 'capital_timezone', name: 'capital_timezone'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                        if (data.enabled == 1) {
                            $returnValue += '<li><form method="post" action="country/statusupdate/' + data.code + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="0" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-success btn-xs" title="Disable Country"><i class="fa fa-toggle-on"></i></button></form></li>'
                        } else {
                            $returnValue += '<li><form method="post" action="country/statusupdate/' + data.code + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="1" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-danger btn-xs" title="Enable Country"><i class="fa fa-toggle-off"></i></button></form></li>'
                        }
                        $returnValue += '<li><a href="country/edit/' + data.code + '" class="btn btn-basic btn-xs" title="Edit Game Settings"><i class="fa fa-edit"></i></a></li>';
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [5]
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

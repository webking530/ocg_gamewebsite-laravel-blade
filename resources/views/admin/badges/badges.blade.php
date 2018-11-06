@extends('admin.layout.app')
@section('content')
<div role="main" class="main">
    <div class="container">
        <div class="row">

            <div class="col-xs-12">
                <div class="box" style="">
                    <div class="box-header">
                        <h3>Badges Settings</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="well clearfix">
                        <div class="pull-right">
                            <a href="{{ route('badges.add') }}" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus"></span> Create
                            </a>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding" style="padding-top: 10px;">
                        <table id="badgesTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>relevance</th>
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
        var dTable = $('#badgesTbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: 'badges/showBadgesdata',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {

                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'description', name: 'description'},
                {data: 'relevance', name: 'relevance'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                        $returnValue += '<li><a href="badges/edit/' + data.id + '" class="btn btn-basic btn-xs" title="Edit Badges"><i class="fa fa-edit"></i></a></li>';
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [3]
                },
            ]
        });
    });
</script>
@endsection

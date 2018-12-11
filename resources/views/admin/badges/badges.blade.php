@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Badges</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">Badges</li>
        </ol>
    </div>
</div>
<hr>


<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">Badges List</div>
            <div class="card-body">
                <div class="text-center">
                    <button class="btn btn-warning filterBtn">Filter</button>
                    <a href="{{ route('badges.add') }}" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span> Create
                    </a>
                </div>
                <hr>
                <div class="col-sm-8 col-sm-offset-2 well clearfix searchFilterDiv hidden">
                    <form role="form" name="search-form" id="search-form">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Search Name">
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-md-12">
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
                url: '{{ route("badges.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    d.name = $('input[name=name]').val();
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

@extends('admin.layout.app')
@section('title','Settings')
@section('content')
<div class="row breadcrumbrow">
    <div class="col-lg-4">
        <h4>Game settings</h4>
    </div>
    <div class="col-lg-8">
        <ol class="breadcrumb pull-right">
            <li><a href="{{ route('admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Games</li>
        </ol>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-xs-12">

        <div class="card card-accent-info">
            <div class="card-header">Game List</div>
            <div class="card-body">
                <div class="text-center">
                    <button class="btn btn-warning filterBtn">Filter</button>
                </div>
                <hr>
                <div class="col-sm-8 col-sm-offset-2 well clearfix searchFilterDiv hidden">
                    <form role="form" name="search-form" id="search-form">
                        <div class="row">

                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <select class="form-control select2" name="enabled">
                                        <option value="">Select Status</option>
                                        @foreach(Lang::get('frontend/game.status') as  $statusKey => $status)
                                        <option value="{{ $statusKey }}">{{ $status }}</option>  
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <table id="gameTbl" class="table data-tables table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Credits</th>
                                <th>Highest Win</th>
                                <th>Latest Win</th>
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
    // Game Settins start
    function showMessage() {
        return '<div  class="loader-datatable" style="display: block;"></div>';
    }
    $(document).ready(function () {
        var dTable = $('#gameTbl').dataTable({
            "pageLength": 10,
            processing: true,
            serverSide: true,
            searching: false,
            scrollX: true,
            oLanguage: {
                sProcessing: showMessage()
            },
            ajax: {
                url: '{{ route("game.showdata") }}',
                type: 'post',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: function (d) {
                    d.enabled = $('select[name=enabled]').val();

                }
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'credits', name: 'credits'},
                {data: 'highestwin', name: 'highestwin'},
                {data: 'latestwin', name: 'latestwin'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aoColumnDefs: [
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<img width="48" src="/' + data.image + '">&nbsp;&nbsp;&nbsp;&nbsp;' + data.name;
                        return $returnValue;
                    },
                    "aTargets": [0]
                },
                {
                    "mRender": function (a, b, data, d) {
                        $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';

                        if (data.enabled == 1) {
                            $returnValue += '<li><form method="post" action="games/statusupdate/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="0" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-success btn-xs" title="Disable Game"><i class="fa fa-toggle-on"></i></button></form></li>'
                        } else {
                            $returnValue += '<li><form method="post" action="games/statusupdate/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="1" type="hidden"><?php echo csrf_field(); ?><button class="btn btn-danger btn-xs" title="Enable Game"><i class="fa fa-toggle-off"></i></button></form></li>'
                        }
                        $returnValue += '<li><a href="games/editSettings/' + data.id + '" class="btn btn-basic btn-xs" title="Edit Game Settings"><i class="fa fa-edit"></i></a></li>';
                        $returnValue += '<li><a href="games/detail/' + data.id + '" class="btn btn-primary btn-xs" title="Game Detail"><i class="fa fa-eye"></i></a></li>';
                        $returnValue += '</ul>'
                        return $returnValue;
                    },
                    "aTargets": [4]
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
// Game Settings js end
</script>
@endsection

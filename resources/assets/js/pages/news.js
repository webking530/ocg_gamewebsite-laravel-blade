function showMessage() {
    return '<div  class="loader-datatable" style="display: block;"></div>';
}
$(document).ready(function () {
    var dTable = $('#Newstbl').dataTable({
        "pageLength": 10,
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: true,
        oLanguage: {
            sProcessing: showMessage()
        },
        ajax: {
            url: 'news/showdata',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {
            }
        },
        columns: [
            {data: 'name', name: 'name'},
            {data: 'order', name: 'order'},
            {data: 'fromDate', name: 'fromDate'},
            {data: 'toDate', name: 'toDate'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aoColumnDefs: [
            {
                "mRender": function (a, b, data, d) {
                    $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">' +
                            '<li><a href="news/' + data.id + '/edit" class="btn btn-basic btn-xs" title="Edit News"><i class="fa fa-edit"></i></a></li>' +
                            '<li><form method="post" action="news/delete/' + data.id + '" class="confirm-submit delete"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '" ><button class="btn btn-danger btn-xs" title="Delete News"><i class="fa fa-trash"></i></button></form></li>';
                    $returnValue += '</ul>';
                    return $returnValue;

                },
                "aTargets": [4]
            },
        ]
    });

});
function showMessage() {
    return '<div  class="loader-datatable" style="display: block;"></div>';
}
$(document).ready(function () {
    var dTable = $('#Bonustbl').dataTable({
        "pageLength": 10,
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: true,
        oLanguage: {
            sProcessing: showMessage()
        },
        ajax: {
            url: 'bonus/showdata',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {
                d.type = $('select[name=type]').val();
                d.enabled = $('select[name=enabled]').val();
            }
        },
        columns: [
            {data: 'formattedtype', name: 'formattedtype'},
            {data: 'prize', name: 'prize'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aoColumnDefs: [
            {
                "mRender": function (a, b, data, d) {
                    var prize = data.prize;
                    return prize.replace(/&amp;/g, '&').replace(/&lt;/g, '<').replace(/&gt;/g, '>').replace(/&quot;/g, '"');
                },
                "aTargets": [1]
            },
            {
                "mRender": function (a, b, data, d) {
                    $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                    if (data.enabled == 1) {
                        $returnValue += '<li><form method="post" action="bonus/statusupdate/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="0" type="hidden"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '" ><button class="btn btn-danger btn-xs" title="Disable Bonus"><i class="fa fa-toggle-on"></i></button></form></li>';
                    } else {
                        $returnValue += '<li><form method="post" action="bonus/statusupdate/' + data.id + '" accept-charset="UTF-8" class="confirm-submit delete"><input name="enabled" value="1" type="hidden"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '" ><button class="btn btn-success btn-xs" title="Enable Bonus"><i class="fa fa-toggle-off"></i></button></form></li>';
                    }
                    $returnValue += '<li><a href="bonus/' + data.id + '/edit" class="btn btn-basic btn-xs" title="Edit Bonus"><i class="fa fa-edit"></i></a></li>' +
                            '<li><form method="post" action="bonus/delete/' + data.id + '" class="confirm-submit delete"><input type="hidden" name="_token" value="' + $('meta[name="csrf-token"]').attr('content') + '" ><button class="btn btn-danger btn-xs" title="Delete Bonus"><i class="fa fa-trash"></i></button></form></li>';
                    $returnValue += '</ul>';
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
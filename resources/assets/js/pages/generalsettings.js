function showMessage() {
    return '<div  class="loader-datatable" style="display: block;"></div>';
}
$(document).ready(function () {
    var dTable = $('#settingsTbl').dataTable({
        "pageLength": 10,
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: true,
        oLanguage: {
            sProcessing: showMessage()
        },
        ajax: {
            url: 'showGeneralSettingsdata',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {

            }
        },
        columns: [
            {data: 'key', name: 'key'},
            {data: 'value', name: 'value'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aoColumnDefs: [
            {
                "mRender": function (a, b, data, d) {
                    $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                    $returnValue += '<li><a data-key="' + data.key + '" data-value="' + data.value + '" href="#" class="btn btn-basic btn-xs addEditBtn" data-type="edit" title="Edit Key"><i class="fa fa-edit"></i></a></li>';
                    $returnValue += '</ul>'
                    return $returnValue;
                },
                "aTargets": [2]
            },
        ]
    });
});

$(document).on('click', '.addEditBtn', function () {
    var type = $(this).attr('data-type');
    if (type == 'add') {
        $('.modal-title').html('Create Key');
        $('.modalBtn').html('Add');
        $('#key').removeAttr('disabled');
        $('#key').val('');
        $('#value').val('');
    } else {
        $('.modal-title').html('Edit Key');
        $('.modalBtn').html('Update');
        $('#key').val($(this).attr('data-key'));
        $('#key').attr('disabled', 'disabled');
        $('#value').val($(this).attr('data-value'));
    }
    $('#modalForm').modal('show');
});

$(document).ready(function () {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.jackpotsetings').change(function () {
        var value = $(this).prop('checked');
        $.ajax({
            url: 'general/updateGeneral',
            data: {'_token': CSRF_TOKEN, 'key': 'enable_fake_jackpot', 'value': value},
            type: 'POST',
            success: function (data) {
                if (data == 1) {
                    if (value == 'true') {
                        //swal("Registration Enabled Successfully")
                    } else {
//                        swal("Registration Disabled Successfully")
                    }
                } else {
                    $('input[type="radio"]').not(':checked').prop("checked", true);
                }
            }
        });
    });


    $('.registration').change(function () {
        var value = 'on';
        if ($(this).prop('checked') == false) {
            value = 'off';
        }
        $.ajax({
            url: 'general/updateGeneral',
            data: {'_token': CSRF_TOKEN, 'key': 'registration_enable_disable', 'value': value},
            type: 'POST',
            success: function (data) {
                if (data == 1) {
                    if (value == 'on') {
                        //swal("Registration Enabled Successfully")
                    } else {
//                        swal("Registration Disabled Successfully")
                    }
                } else {
                    $('input[type="radio"]').not(':checked').prop("checked", true);
                }
            }
        });
    });
    $('.maintenance').change(function () {
        var value = 'on';
        if ($(this).prop('checked') == false) {
            value = 'off';
        }
        $.ajax({
            url: 'general/updateGeneral',
            data: {'_token': CSRF_TOKEN, 'key': 'maintenance_mode', 'value': value},
            type: 'POST',
            success: function (data) {
                if (data == 1) {
                    if (value == 'on') {
                        swal("Maintenance Mode Enabled Successfully")
                    } else {
                        swal("Maintenance Mode Disabled Successfully")
                    }
                } else {
                    $('input[type="radio"]').not(':checked').prop("checked", true);
                }
            }
        });
    });
});
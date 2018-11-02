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
            $('#key').val('');
            $('#value').val('');
        } else {
            $('.modal-title').html('Edit Key');
            $('.modalBtn').html('Update');
            $('#key').val($(this).attr('data-key'));
            $('#key').attr('disabled','disabled');
            $('#value').val($(this).attr('data-value'));
        }
        $('#modalForm').modal('show');
    });

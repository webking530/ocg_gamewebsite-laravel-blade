function showMessage() {
    return '<div  class="loader-datatable" style="display: block;"></div>';
}
$(document).ready(function () {
    var dTable = $('#depositsTbl').dataTable({
        "pageLength": 10,
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: true,
        oLanguage: {
            sProcessing: showMessage()
        },
        ajax: {
            url: 'payment/showDepositdata',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {

            }
        },
        columns: [
            {data: 'nickname', name: 'nickname'},
            {data: 'email', name: 'email'},
            {data: 'credits', name: 'credits'},
            {data: 'method', name: 'method'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aoColumnDefs: [
            {
                "mRender": function (a, b, data, d) {
                    $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                    if (data.isPending) {
                        $returnValue += '<li><a href="deposit/approve/' + data.id + '" class="btn btn-success btn-xs confirm-click" title="Approve"><i class="fa fa-check"></i></a></li>';
                        $returnValue += '<li><button data-id="' + data.id + '" class="btn btn-danger btn-xs depositRejectBtn" title="Reject"><i class="fa fa-times"></i></button></li>';
                    }
                    $returnValue += '</ul>'
                    return $returnValue;
                },
                "aTargets": [5]
            },
        ]
    });
    $(document).on('click', '.depositRejectBtn', function (e) {
        var id = $(this).attr('data-id');
        $.confirm({
            title: 'Are You Sure?',
            content: '' +
                    '<form action="deposit/reject" class="depositRejectForm" method="post">' +
                    '<input type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '" name="_token">' +
                    '<div class="form-group">' +
                    '<label>Enter reason for rejection</label>' +
                    '<input type="hidden" name="id" value="' + id + '">' +
                    '<textarea type="text" placeholder="Reason" name="reason" class="name form-control" required ></textarea>' +
                    '</div>' +
                    '</form>',
            buttons: {
                formSubmit: {
                    text: 'Submit',
                    btnClass: 'btn-blue',
                    action: function () {
                        var name = this.$content.find('.name').val();
                        if (!name) {
                            $.alert('provide a reason');
                            return false;
                        }
                        $('.depositRejectForm').submit();
                    }
                },
                cancel: function () {
                    //close
                },
            }
        });
    });


    var dTable = $('#withdrawTbl').dataTable({
        "pageLength": 10,
        processing: true,
        serverSide: true,
        searching: false,
        scrollX: true,
        oLanguage: {
            sProcessing: showMessage()
        },
        ajax: {
            url: 'payment/showWithdrawdata',
            type: 'post',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: function (d) {

            }
        },
        columns: [
            {data: 'nickname', name: 'nickname'},
            {data: 'email', name: 'email'},
            {data: 'credits', name: 'credits'},
            {data: 'method', name: 'method'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        aoColumnDefs: [
            {
                "mRender": function (a, b, data, d) {
                    $returnValue = '<ul class="list-inline" style="margin-bottom:0px;">';
                    if (data.isPending) {
                        $returnValue += '<li><a href="withdraw/approve/' + data.id + '" class="btn btn-success btn-xs confirm-click" title="Approve"><i class="fa fa-check"></i></a></li>';
                        $returnValue += '<li><a href="withdraw/reject/' + data.id + '" class="btn btn-danger btn-xs confirm-click" title="Reject"><i class="fa fa-times"></i></a></li>';
                    }
                    $returnValue += '</ul>'
                    return $returnValue;
                },
                "aTargets": [5]
            },
        ]
    });
});
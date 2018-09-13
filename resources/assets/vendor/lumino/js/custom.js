$('#calendar').datepicker({
		});

!function ($) {
    $(document).on("click","ul.nav li.parent > a ", function(){          
        $(this).find('em').toggleClass("fa-minus");      
    }); 
    $(".sidebar span.icon").find('em:first').addClass("fa-plus");
}

(window.jQuery);
	$(window).on('resize', function () {
  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
})
$(window).on('resize', function () {
  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
})

$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-up').addClass('fa-toggle-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('em').removeClass('fa-toggle-down').addClass('fa-toggle-up');
	}
})
$(document).ready(function(){
	 $('#users-table').DataTable();
	$('.input-daterange').datepicker({
		endDate: '+0d',
        autoclose: true,
		format: 'yyyy-mm-dd'
	}).on('changeDate',depowith);
	$('#birthday').datepicker({
		format: 'yyyy-mm-dd'
	});
});
function depowith(){

	var fromdate = $("#from").val();
	var fromval = $("#to").val();
	var url = $("#url").val();
	var token = $("#token").val();
	if(!fromdate == '' && !fromval==''){
		$.ajax({
			type:'post',
			url:url+'paymentsbydate',
			data:{'from':fromdate,'to':fromval,"_token":token},
			success:function(data){
				console.log(data);
				$(".amtpenappdepo").text(parseInt(data['AmtPnappdepo'][0].AmtPngApplDepost));
				$(".amtpenappwith").text(parseInt(data['AmtPendApplWith'][0].AmtPendApplWith));
				$(".totamtapp").text(parseInt(data['TotAmtAppr'][0].TotAmtAppr));
				$(".totwith").text(parseInt(data['TotAmtWdraw'][0].TotAmtWdraw));	
			}
		})
	}
}

//function 


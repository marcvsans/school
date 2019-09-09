jQuery(function($) {
	
$('.select2').css('width','80%').select2({allowClear:true}).on('change', function(){
					$(this).closest('form').validate().element($(this));
				});

	$('.date-picker').datepicker({
	autoclose: true,
	todayHighlight: true
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
	$(this).prev().focus();
	});

	$('.date-picker').datepicker({autoclose:true}).on('changeDate', function(ev) {
	$(this).closest('form').validate().element($(this));
	});

	$.mask.definitions['~']='[+-]';
	$('#celular').mask('(999) 999-999');
	$('#telefono').mask('999-999');

})
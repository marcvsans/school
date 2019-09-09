 @extends('layouts.director',['title'=>'Director | Caja','headertitle'=>'Caja','viewtitle'=>'Todos','page'=>'Caja'])
 

@section('content')



<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
		Registrar
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	

</div>
<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Pagos
		</div>
		<div>
		<table id="dynamic-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				<th>Alumno</th>
				<th>Pago</th>
			
				<th>Fecha </th>
		  <th></th>
				
				</tr>
			</thead>
		</table>
		</div>
	</div>
</div>

<div id="modal-boleta" class="modal">
	<div class="modal-dialog" >
		<div class="widget-box widget-color-blue3" id="widget-bo">
	
		<iframe src="" id="invoice-iframe"></iframe>
	</div>

	</div></div>


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >
		<div class="widget-box widget-color-blue3" id="widget-box-9">
			<div class="widget-header">
				<h5 class="widget-title">Formulario de Registro</h5>
				<div class="widget-toolbar">
					<a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
				</div>
			</div>

			<div class="widget-body">
								<div id="modal-wizard-container">
												<div class="modal-header">
													<ul class="steps">
														<li data-step="1" class="active">
															<span class="step">1</span>
															<span class="title">Validation states</span>
														</li>

														<li data-step="2">
															<span class="step">2</span>
															<span class="title">Alerts</span>
														</li>

												
													</ul>
												</div>

												<div class=" step-content">
													<div class="step-pane active" data-step="1">
																		<form class="form-horizontal" id="formcreate" role="form" novalidate="novalidate" >
						<div class="widget-main">

							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 
					<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Alumno</label>

							<div class="col-xs-12 col-sm-6">
								<div class="clearfix">
								<select name="alumno" class="seldect2" data-placeholder="Alumno" id="alumno" onchange="deudas($(this).val());" >
									
								</select>
							</div>	<br>
							
						</div>
						
							<span class="block input-icon input-icon-right">
							</span> 
							</div>


	<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Deuda</label>

							<div class="col-xs-12 col-sm-6">
								<div class="clearfix" id="pago">
							
							</div>	
						</div>
						
							<span class="block input-icon input-icon-right">
							</span> 
							</div>
			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Descuentos</label>

							<div class="col-xs-12 col-sm-6">
								
								<select name="descuento[]"   multiple="" class="select2 " data-placeholder="Descuentos"   >
									
							@foreach ($descuentos as $descuento)
								
										   <option value="{{ $descuento->id}}" > {{ $descuento->descripcion}} </option>
									@endforeach  
								</select>
							
						</div>
						
							<span class="block input-icon input-icon-right">
							</span> 
							</div>

					

							
						</div>

					
				</form>
													</div>

													<div class="step-pane" data-step="2">
														<div class="center" id="mystep2">
															
														</div>
													</div>

												
												</div>
											</div>

											<div class="modal-footer wizard-actions">
												<button class="btn btn-sm btn-prev">
													<i class="ace-icon fa fa-arrow-left"></i>
													Prev
												</button>

												<button class="btn btn-success btn-sm btn-next" data-last="Finish">
													Next
													<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
												</button>

												<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
													<i class="ace-icon fa fa-times"></i>
													Cancel
												</button>
											</div>
			</div>
		</div>
	</div>
</div>





@include('partials.destroy')
@stop



@section('script')
<script src="{{ asset('assets/js/jquery-ui.min.js')}}"></script>

 	<script src="{{ asset('assets/js/wizard.min.js')}}"></script>  <script src="{{ asset('assets/js/initinput.js')}}"></script>
 	<script src="{{ asset('assets/js/jquery.fileDownload.js')}}"></script>
  <script type="text/javascript">
	var myTable;   
	var routeUpdate;  
	jQuery(function($) {

		

					@component('components.js.select-search',['name'=>'#alumno','ruta'=>route('Director.Caja.Alumno.Search')])
	
	@endcomponent	
	
				
				$('#modal-wizard-container')
				.ace_wizard({
					step:1
					//step: 2 //optional argument. wizard will jump to step "2" at first
					//buttons: '.wizard-actions:eq(0)'
				})
				.on('actionclicked.fu.wizard' , function(e, info){
					if(info.step == 1 ) {
						if(!$('#formcreate').valid()) 
							
	e.preventDefault();					
	var formData = new FormData($("#formcreate")[0]);
	$.ajax({
	url:"{!! route('Director.Caja.Showtable') !!}",
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	success: function(msg){
		
		

$('#mystep2').html(msg.tabla);




	},

	error : function(msg) {
	

	},


	complete : function(xhr, status) {


	}

	});
					}
				})
				.on('changed.fu.wizard', function() {
					//$('.select2').select2();
				})
				.on('finished.fu.wizard', function(e) {
				var formData = new FormData($("#formcreate")[0]);
	$.ajax({
	url:"{!! route('Director.Caja.Store') !!}",
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	success: function(msg){
		resetForm("#formcreate");
	
		myTable.ajax.reload();

$('#mystep2').html('');
	var wizard = $('#modal-wizard-container').data('fu.wizard')
				wizard.currentStep = 1;
				wizard.setState();

		
messageSucess(msg);


	},

	error : function(msg) {
	

	},


	complete : function(xhr, status) {


	}

	});
				}).on('stepclick.fu.wizard', function(e){
					//e.preventDefault();
					//this will prevent clicking and selecting steps
				});

	$('#menu-caja').addClass('active open');				
	$('#menu-caja-index').addClass('active'); 	

	$('textarea.limited').inputlimiter({
	   limit: 150,
        remText: '%n caractere%s restantes.',
        limitText: 'Campo limitado a %n caractere%s.'
				});
					autosize($('textarea[class*=autosize]'));


	$(document).ready(function() {



	myTable = $('#dynamic-table') 

	.DataTable( {
	
	
	"sScrollX": "100%",
	"sScrollXInner": "100%",


	"sAjaxSource": "{!!route('Director.Caja.Retrieve')!!}"	,
 "aaSorting": [],
 "language": {
			          "url":"{{ asset('assets/js/languageDatable.txt')}}"
			        },

	

	select: {
	style: 'multi'
	}
	} );

	});

	$('#formcreate').validate({
	errorElement: 'div',
	errorClass: 'help-block',
	focusInvalid: false,
	ignore: "",
	rules: {
	
	alumno: {
	required: true

	},
	deuda:{
	required: true	
	}
	},



	highlight: function (e) {
	$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	var controls=$(e).closest('.form-group').find('span[class*="block"]');
	controls.html('<i class="ace-icon fa fa-times-circle bigger-200"></i>');
	},

	success: function (e) {
	$(e).closest('.form-group').removeClass('has-error').addClass('has-success');
	var controls=$(e).closest('.form-group').find('span[class*="block"]');
	controls.html('<i class="ace-icon fa fa-check-circle bigger-200"></i>');
	$(e).remove();
	},

	errorPlacement: function (error, element) {
	if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
	var controls = element.closest('div[class*="col-"]');
	if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
	else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
	}
	else if(element.is('.select2')) {
	error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
	}
	else if(element.is('.select2')) {
	error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
	}
	else error.insertAfter(element.parent());
	},

	submitHandler: function (form) {


	var formData = new FormData($("#formcreate")[0]);
	$.ajax({
	url:"{!! route('Director.Caja.Create') !!}",
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	success: function(msg){
		resetForm("#formcreate");
		$("#modal-registro").modal('hide');
		myTable.ajax.reload();



messageSucess(msg);



	},

	error : function(msg) {
	messageError(msg);

	},


	complete : function(xhr, status) {


	}

	});


	},
	invalidHandler: function (form) {
	}
	});	

	

		$('#form-update').validate({
	errorElement: 'div',
	errorClass: 'help-block',
	focusInvalid: false,
	ignore: "",
	rules: {
	grado: {
	required: true

	},
	letra: {
	required: true

	},
	capacidad:{
	required: true	
	},
	nivel:{
	required:true
	}
	},



	highlight: function (e) {
	$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
	var controls=$(e).closest('.form-group').find('span[class*="block"]');
	controls.html('<i class="ace-icon fa fa-times-circle bigger-200"></i>');
	},

	success: function (e) {
	$(e).closest('.form-group').removeClass('has-error').addClass('has-success');
	var controls=$(e).closest('.form-group').find('span[class*="block"]');
	controls.html('<i class="ace-icon fa fa-check-circle bigger-200"></i>');
	$(e).remove();
	},

	errorPlacement: function (error, element) {
	if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
	var controls = element.closest('div[class*="col-"]');
	if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
	else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
	}
	else if(element.is('.select2')) {
	error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
	}
	else if(element.is('.select2')) {
	error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
	}
	else error.insertAfter(element.parent());
	},

	submitHandler: function (form) {


	var formData = new FormData($("#form-update")[0]);
	$.ajax({
	url:routeUpdate,
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	beforeSend: function(){ 
	 $('#widget-update').widget_box('reload');
	 $.gritter.removeAll();
	},
	success: function(msg){

    myTable.ajax.reload( );
	$("#modal-update").modal('hide');
	$('#widget-update').trigger('reloaded.ace.widget');
messageSucess(msg);


	},

	error : function(msg) {
messageError(msg);
	},


	complete : function(xhr, status) {


	}

	});


	},
	invalidHandler: function (form) {
	}
	});	

	})

	



	function deudas(alumno) {
		//$("#alumno-name").html('');
		//$("#hide").addClass('hide')
	
		if (alumno) {
		
		token=$("#token").val();
		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				"{!! route('Director.Deuda.Alumno.Duedas') !!}"
			@endslot
		
	        @slot('data')
				{ _token:token,alumno:alumno }
			@endslot

			@slot('procesData')

			@endslot
		

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
				$(".datosapoderado").attr("hidden",true);
	        @endslot

			@slot('successAjax')
				$("#pago").html(msg.deudas);
				
$('#deuda').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});
		    @endslot
		  	    
		@endcomponent




	}
}

function invoice(ruta) {	
  $('#invoice-iframe').attr('src',ruta);
}
  </script>

@stop
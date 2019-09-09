@extends('layouts.director',['title'=>'Director | Notas','headertitle'=>'Notas','viewtitle'=>'Asignar','page'=>'Notas'])

@section('content')
	
				
					
						      
 <form class="form-horizontal" id="form-create" role="form" novalidate="novalidate" >

	
		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Curso</label>

							<div class="col-xs-12 col-sm-6">
								<select id="curso" name="curso" class="select2" data-placeholder="Curso" onchange="getNotas($(this).val());">
									<option></option>

											@php

$cursos=$seccion->cursos; 
@endphp
									@foreach ($cursos as $curso)
								
										   <option value="{{$curso->id}}" > {{$curso->cursoinfo->datosCurso->nombre}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>







<div class="space-18"></div>


<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Notas
		</div>
		<div>
		<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="dataTables_scroll"><div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;"><div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 768px; padding-right: 0px;"><table class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" style="margin-left: 0px; width: 768px;">
			
		</table></div></div>
			
				   <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">

		<table id="stable" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;"></table>
		</div>
		<div class="row hide" id="submitnotas">
<div class="col-xs-12">
			
					<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
				
			</div>
		</div>
	
	</div></div>
		</div>
	</div>
</div>

</form>								
			


@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
    	
var myTable;
	var routeUpdate;        
jQuery(function($) {

	$('#menu-notas').addClass('active open');		
			
	$('#menu-notas-asignar').addClass('active').removeClass('hide'); 
			



	$('#form-create').validate({
errorElement: 'div',
	errorClass: 'help-block',
	focusInvalid: false,
	ignore: "",
	rules: {
curso: {
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


	var formData = new FormData($("#form-create")[0]);
	$.ajax({
	url:"{!! route('Director.Notas.Store',['id'=>$seccion->id]) !!}",
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	success: function(msg){
		
	
		

getNotas($("#curso").val());


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




	function getNotas(curso) {
		$('#submitnotas').addClass('hide'); 

$('#horaslist').html('');
			$.ajax({
		url:'{{route('Director.Notas.Edit',['id'=>$seccion->id])}}',
		data:{"curso":curso},
		dataType:'json',
			beforeSend: function(){ 
		 $('#stable').widget_box('reload');



		},
	
		success:function(msg) {

		$('#submitnotas').removeClass('hide'); 				
			
			  $('#stable').html(msg.table);
$('#stable').trigger('reloaded.ace.widget');

		} ,

		error : function(xhr, status) {
		}
		});
	}





  </script>




@stop



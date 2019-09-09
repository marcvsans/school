@extends('layouts.director',['title'=>'Director |Horario','headertitle'=>'Horario','viewtitle'=>'Asignar','page'=>'Horario'])


@section('content')
<style type="text/css">
	
.ace,input[type=checkbox].ace.ace-switch.ace-switch-6:checked+.lbl::before{
background-color: #41a03d;

}

</style>
<style type="text/css">
	.alert,.thumbnail{margin-bottom:1px}
	.close {
    float: right;
    font-size: 21px;
    color: #000;
    text-shadow: 0 1px 0 #fff;
    opacity: 10;
    filter: alpha(opacity=20);
}
</style>
 

		<div class="widget-body">
			<form class="form-horizontal" id="form-update" role="form" novalidate="novalidate" >
			<div class="widget-main">
     



			</div>
  
   		   </form>
		</div>




		<div class="widget-box widget-color-blue3" id="widget-box-9">
			<div class="widget-header">
				<h5 class="widget-title">Asignar Horario para la seccion <strong>{{$seccion->grado ."° " .$seccion->letra}}</strong>  del nivel  <strong>{{$seccion->datosGrado->nivel}}</strong></h5>
				<div class="widget-toolbar">
					<a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
				</div>
			</div>

			<div class="widget-body">
					<form class="form-horizontal" id="form-create" role="form" novalidate="novalidate" >
						<div class="widget-main">
						       <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
 

	

		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Curso</label>

							<div class="col-xs-12 col-sm-6">
								<select id="curso" name="curso" class="select2" data-placeholder="Curso" >
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

									<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Hora</label>

							<div class="col-xs-12 col-sm-6">
								<select id="nivel" name="value" class="select2" data-placeholder="Hora"  >
									<option></option>
@php
$total=count($horas);
$f=$total-2;
$c=0;
for ($i=0; $i <= $f; $i++) { 
$horalibre =  $hlibre->where( ["horainicio"=> date("H:i:s",strtotime($horas[$i])) ,"idconfig"=>$config->id])->count();
  if ( $horalibre==0) {
           	 echo'<option value="'.$horas[$i].$horas[$c+1].'" > '.$horas[$i] .' - '. $horas[$c+1].' </option>';

                }
                else{
                  //  $horaActual->addMinutes($duracion);
                }



	
	
	$c++;

}

								
									 @endphp
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>


									<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Dia</label>

							<div class="col-xs-12 col-sm-6">
								<select id="dia" name="dia" class="select2" data-placeholder="Dia"  >
									<option></option>
																			@php


							foreach ($dias as $dia){
if ($config[strtolower($dia)]=='true') {
  echo '<option value="'.$dia.'" > '.$dia .'</option>';
} 
								
										
								}
									@endphp	
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>


							<input type="" name="idconfig" value="{{$config->id}}" hidden="hidden">
						</div>

						<div class="widget-toolbox padding-8 clearfix">
						

							<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
						</div>
				</form>
			</div>
		</div>




<div class="space-18"></div>


<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Horario
		</div>
		<div>
		<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="dataTables_scroll"><div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;"><div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 768px; padding-right: 0px;"><table class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" style="margin-left: 0px; width: 768px;"><thead>
		
			</thead></table></div></div><div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;"><table id="table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;"><thead>
			<tr>
				<th>Hora</th>
				<th>Lunes</th>
				<th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>
				<th>Domingo</th>
			</tr>
			</thead>
			
		<tbody id="horaslist">
			
		</tbody></table></div></div></div>
		</div>
	</div>
</div>


								
										<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Curso
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Docente
																</th>

															
															</tr>
														</thead>

														<tbody>
															@foreach($seccion->cursos as $curso)
															<tr>
																<td>{{$curso->cursoinfo->datosCurso->nombre}}</td>

																<td>
																
																	<b class="green">	@if($curso->docenteinfo)
																		<div class="name">
																			<a href="#">{{$curso->docenteinfo->persona->nombres}} {{$curso->docenteinfo->persona->apellidos}}</a>
																		</div>

																		
																		
@endif</b>
																</td>

																
															</tr>

											@endforeach
														</tbody>
													</table>



@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
    	
var myTable;
	var routeUpdate;        
jQuery(function($) {

	$('#menu-horario').addClass('active open');		
		$('#menu-horario-main').addClass('active open');			
	$('#menu-horario-asignar-edit').addClass('active').removeClass('hide'); 
			

$(document).ready(function() {

gethorario($("#nivel").val());

				 });


	$('#form-create').validate({
errorElement: 'div',
	errorClass: 'help-block',
	focusInvalid: false,
	ignore: "",
	rules: {
curso: {
	required: true

	},
value: {
	required: true

	},
	dia:{
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
	url:"{!! route('Director.Horario.Store') !!}",
	type:'POST',
	data:formData,

	cache:false,
	dataType:'json',
	processData:false,
	contentType:false,
	success: function(msg){
		//resetForm("#form-create");
	
		

gethorario();

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

	$('.hora').timepicker({
					minuteStep: 1,
					showSeconds: false,
					showMeridian: true,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					//$('.time').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});




			})




	function gethorario() {

$('#horaslist').html('');
			$.ajax({
		url:'{{route('Director.Horario.Show',['id'=>$seccion->id])}}',
		
		dataType:'text',
			beforeSend: function(){ 
		 $('#table').widget_box('reload');



		},
	
		success:function(msg) {

						
			 $('#horaslist').html(msg);
$('#table').trigger('reloaded.ace.widget');

		} ,

		error : function(xhr, status) {
		}
		});
	}




	function destroyhorario(value) {
		 $.gritter.removeAll();
token=$("#token").val();
			$.ajax({
		url:'{{route('Director.Horario.Destroy',['id'=>'$config->id'])}}',
		type:'post',
		data:{"value":value,"_token":token,"_method":"DELETE"},
		dataType:'json',
	
		success:function(msg) {
	gethorario();
				messageSucess(msg);


		} ,

		error : function(msg) {
			messageError(msg);
		}
		});
	}

  </script>




@stop



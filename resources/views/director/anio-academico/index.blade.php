@extends('layouts.director',['title'=>'Director | Año Academico','headertitle'=>'Año Academico','viewtitle'=>'Todos','page'=>'Año Academico'])


@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-create" data-toggle="modal">
		Registrar nuevo año academico
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	 
</div> 


<div id="modal-create"  class="modal">
	<div class="modal-dialog" >
		@component('components.widget-box', ['foo' => 'foo','formId'=>'form-create','id'=>'widget'])
	  @slot('title')
	       Formulario de registro
	  @endslot
	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot

	  @slot('body')
	      		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">




				<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Nivel</label>

							<div class="col-xs-12 col-sm-6">
								<select id="nivel" name="nivel" class="select2" data-placeholder="Nivel"    onchange="plan_horario($(this).val());">
									<option value=""></option>				
									@foreach ($niveles as $nivel)
										   <option value="{{$nivel}}" >{{$nivel}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
				</div>

<div id="planh-show" hidden="">
		<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion</label>
	<div class="col-xs-12 col-sm-9">
		<div class="clearfix">
		<input type="text" name="descripcion"  class="col-xs-12 col-sm-10" >
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>
					
<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Año</label>
	<div class="col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control  col-xs-4 col-sm-4" name="anio" type="text" id="anio"  >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

						<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Plan Academico</label>

							<div class="col-xs-12 col-sm-9" id="planacad2">
						
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
				</div>

							<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Configuracion de horario</label>

							<div class="col-xs-12 col-sm-9" id="horario2">
						
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
				</div>
</div>
				<input type="text" name="estado" hidden="" value="Inactivo">
					
	  @endslot

	  @slot('footer')
		<button class="btn  btn-danger pull-left" type="button" onclick="resetForm('#form-create');" >
								<i class="ace-icon fa fa-times"></i>
								<span class="bigger-110">Cancelar</span>
							</button>

							<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
	  @endslot

	@endcomponent

</div></div>

 


<div class="space-18"></div>

@component('components.table')
	  @slot('title')
	      Años  academicos
	  @endslot
		<th>Descripcion</th>
		<th>Nivel</th>
		
		<th>Año</th>
<th>Plan Academico</th>
<th>Configuracion de Horario</th>
		<th>Acciones</th>
@endcomponent

@include('partials.destroy')		

@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
    
var myTable;      
jQuery(function($) {
	
	  
		$('#menu-anio-academico').addClass('active open');			
	$('#menu-anio-academico-todos').addClass('active'); 	
	     $('#anio').datepicker({
                  format: " yyyy",
              viewMode: "years", 
            minViewMode: "years"
                }); 

$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";
		@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
		anio:{required:true }, 
		descripcion:{required:true},
		nivel:{required:true},
		conf_horario:{required:true},
		planacad:{required:true}
	  @endslot
	

       @slot('valid')
			var formData = new FormData($('#form-create')[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{{route('Director.AnioAcademico.Store')}}"
			@endslot
	      
	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
	            $.gritter.removeAll();
				
	        @endslot

			@slot('successAjax')
				resetForm("#form-create");
				$("#modal-create").modal('hide');
				myTable.ajax.reload();
				messageSucess(msg);
				$("#planh-show").attr("hidden",true);
		    @endslot
		    @slot('completeAjax')
		    $('#widget').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent

	  @endslot

	@endcomponent



	@component('components.js.table',["route"=>route('Director.AnioAcademico.Retrieve')])
	@endcomponent





			})

	function plan_horario(nivel){
  token=$("#token").val();
	$.ajax({
	url: "{!! route('Director.AnioAcademico.Create') !!}",
	
	data: {nivel : nivel ,_token:token},
	dataType:'json',

	success:function(resp) {
		$("#planh-show").removeAttr("hidden");
		$("#planacad2").html(resp.planes);
		$("#horario2").html(resp.confs)

			$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});
	} ,

	error : function(xhr, status) {

	$("#planh-show").attr("hidden",true);
	}
	});


	}
  </script>

@stop



@extends('layouts.director',['title'=>'Director | Horario - Configuracion','headertitle'=>'Horario - Configuracion','viewtitle'=>'Todos','page'=>'Horario - Configuracion'])


@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-create" data-toggle="modal">
		Registrar nueva configuracion  de horario
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
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Nombre:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" class="letras col-xs-12 col-sm-8"  class="col-xs-12 col-sm-6" name="nombre"  />
						</div>
					</div>
					<span class="block input-icon input-icon-right">
				    </span>
				</div>

             <div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Hora Inicio </label>
				<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 ">
					<div class="clearfix">
					  	<div class="input-daterange input-group">
							<input type="text" class="form-control col-xs-12 col-sm-6 hora" name="horainicio" @if (isset($config))value="{{$config->horainicio}}"@endif  />
							<span class="input-group-addon">
							Hora Fin	
							</span>

							<input type="text"  class="form-control col-xs-12 col-sm-6 hora" name="horafin"  @if (isset($config))value="{{$config->horafin}}"@endif />
						</div>
					</div>
				</div>
				<span class="block input-icon input-icon-right">
			    </span>    
			</div>

             <div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Dias de Clase</label>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
					<div class="clearfix">
										
							@foreach	($dias as $dia)								
							<div class="checkbox">
								<label>
									<input name="{{  strtolower($dia)  }}" type="checkbox" class="dia ace" value="true"  @if (isset($config)) @if ($config->$dia=='true') checked="" @endif"@endif > 
									<span class="lbl"> {{$dia}}</span>
								</label>
							</div>
					
							@endforeach  	
                          
					</div>
				</div>
				 
			</div>


			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Duracion Clase </label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
					<div class="clearfix">
						<div class="input-group">
						<input class="form-control col-xs-12 col-sm-6" type="number"  name="duracionclase"  @if (isset($config))value="{{$config->duracionclase}}"  @endif >
						<span class="input-group-addon">
							Minutos
						</span>
					    </div>
					</div>
				</div>
				<span class="block input-icon input-icon-right">
			    </span>    
			</div>

				<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Nivel</label>

							<div class="col-xs-12 col-sm-6">
								<select id="nivel" name="nivel" class="select2" data-placeholder="Nivel"  >
									<option value=""></option>				
									@foreach ($niveles as $nivel)
										   <option value="{{$nivel}}" >{{$nivel}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
				</div>
					
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
	       Configuraciones  de horario
	  @endslot
	  <th>Nombre</th>
		<th>Hora  de Inicio</th>
		<th>Hora de Fin</th>
		
		<th>Nivel</th>

		<th>Acciones</th>
@endcomponent

@include('partials.destroy')		

@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
    
var myTable;      
jQuery(function($) {
	
	$('#menu-horario').addClass('active open');
		$('#menu-horario_config').addClass('active open');			
	$('#menu-horario_config-todos').addClass('active'); 	

$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";
		@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
      nombre:{required:true},
		horainicio:{required:true }, 
		horafin:{required:true }, 
		lunes: {require_from_group: [1,".dia"] }, 
		martes:{require_from_group: [1,".dia"]},
		miercoles:{require_from_group: [1,".dia"]},
		jueves:{require_from_group: [1,".dia"]},
		viernes:{require_from_group: [1,".dia"]},
		sabado:{require_from_group: [1,".dia"]},
		domingo:{require_from_group: [1,".dia"]},
		duracionclase:{required:true},
		nivel:{required:true}
	  @endslot

	

       @slot('valid')
			var formData = new FormData($('#form-create')[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{{route('Director.HorarioConfig.Store')}}"
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
		    @endslot
		    @slot('completeAjax')
		    $('#widget').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent

	  @endslot

	@endcomponent



	@component('components.js.table',["route"=>route('Director.HorarioConfig.Retrieve')])
	@endcomponent



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


  </script>

@stop



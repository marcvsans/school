@extends('layouts.director',['title'=>'Director | Horario - Configuracion','headertitle'=>'Horario - Configuracion','viewtitle'=>'Configuracion de horario |' .$config->nombre .' - '.$config->nivel
,'page'=>'Horario - Configuracion'])


@section('content')



@component('components.widget-box', ['foo' => 'foo','formId'=>'form-update','id'=>'widget'])
	  @slot('title')
	       Formulario de Actualizacion
	  @endslot
	  @slot('toolbar')
	  	<a href="#" data-action="collapse">
							<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
						</a>
	  @endslot

	  @slot('body')
	      	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
		<div class="form-group">
					<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Nombre:</label>

					<div class="col-xs-12 col-sm-9">
						<div class="clearfix">
							<input type="text" class="letras col-xs-12 col-sm-8"  class="col-xs-12 col-sm-6" value="{{$config->nombre}}" name="nombre"  />
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
									<input name="{{strtolower(strtolower($dia))}}" type="checkbox" class="ace dia" value="true"  @if (isset($config)) @if (strtolower($config[strtolower($dia)])=='true') checked="" @endif"@endif > 
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

	  @endslot

	  @slot('footer')
		

							<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
	  @endslot

	@endcomponent




<hr>



 		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget2',
		'title'=>'Horas libre de horario para'.$config->nombre .' - '.$config->nivel])
		 	  @slot('toolbar')
		<a href="#" data-action="collapse">
							<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
						</a>
	  @endslot
	  @slot('body')
				
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">


			<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion</label>
	<div class="col-xs-12 col-sm-9">
		<div class="clearfix">
		<input type="text" name="descripcion"  class="col-xs-12 col-sm-6"  >
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

			<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Hora Inicio</label>

							<div class="col-xs-12 col-sm-6" id="horainicio2">
								
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
				</div>
						<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Duracion Hora Libre </label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
					<div class="clearfix">
						<div class="input-group">
						<input class="form-control col-xs-12 col-sm-6" type="number"  name="duracion"   >
						<span class="input-group-addon">
							Minutos
						</span>
					    </div>
					</div>
				</div>
				<span class="block input-icon input-icon-right">
			    </span>    
			</div>
		<input type="text" name="idconfig" value="{{$config->id}}" hidden="">
	
		<div class="padding-8 clearfix">
			
			<button class="btn btn-success pull-right">
				<span class="bigger-110">Guardar</span>

				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>
		</div>
	
		 <hr>
							
			<table id="dynamic-table" class="table table-striped table-bordered table-hover">
				<thead>
					<tr>
						<th>Descripcion</th>
					<th>Hora  de Inicio</th>
					<th>Duracion</th>

					
					
					<th class="hidden-480">Acciones</th>
					</tr>
				</thead>
			</table>
<div class="space-18"></div>
			
	  @endslot
	
	  @slot('footer')
	  <hr>
	  @endslot
		
	@endcomponent


<div class="space-18"></div>

<table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
	<div class="table-header btn-inverse">
		Vista previa de horario para {{$config->nombre .' - '.$config->nivel}}
	</div>
		<thead>
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
			
		</tbody>
	</table>



	<div id="modal-update" class="modal ">
	<div class="modal-dialog" >

		 		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-update2',
		'id'=>'widget3',
		'title'=>'Actualizar'])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')


							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							  <input type="hidden" name="_method" value="PUT">
	 <div class="form-group">
			<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Hora Inicio </label>
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
				<div class="clearfix">
				  	
						<input type="text" class="form-control col-xs-12 col-sm-5 hora" name="horainicio" id="horainicio" />
				
				</div>
			</div>
			<span class="block input-icon input-icon-right">
		    </span>    
		</div>
							<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Duracion Hora Libre </label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
					<div class="clearfix">
						<div class="input-group">
						<input class="form-control col-xs-12 col-sm-6" type="number"  name="duracion"  id="duracion" >
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
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion</label>
	<div class="col-xs-12 col-sm-9">
		<div class="clearfix">
		<input type="text" name="descripcion" id="descripcion" class="col-xs-12 col-sm-6"  >
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>
			
	  @endslot
	
	  @slot('footer')
			<button class="btn btn-success pull-right">
				<span class="bigger-110">Aceptar</span>

				<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
			</button>
	  @endslot
		
	@endcomponent

	</div>
</div>


@include('partials.destroy')		

@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
    	
var myTable;
	var routeUpdate;        
jQuery(function($) {
		$('#menu-horario').addClass('open');
		$('#menu-horario_config').addClass('open');			
	$('#menu-horario_config-edit').addClass('active').removeClass('hide'); 	

	
		$.validator.messages.required = "Este Campo es Obligatorio";
		$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";


		@component('components.js.validate-form')
	  @slot('form')
	    '#form-update'
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
		duracionclase:{required:true}
	   @endslot

	  @slot('messages')
		nrodocumento: {remote: "Numero de Documento Duplicado"}
	  @endslot

       @slot('valid')
			var formData = new FormData($("#form-update")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{{route('Director.HorarioConfig.Update',["id"=>"$config->id"])}}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
				
	        @endslot

			@slot('successAjax')
				//$('#widget').widget_box('reload');
 $('span[class*="block"] ').html('');
          $('div[class*="form-group"] ').removeClass('has-success');
          $('div[class*="form-group"] ').removeClass('has-error');
    
			 getpreview();
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot
       @slot('completeAjax')
		    $('#widget').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

			


@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
horainicio: {required: true },
 duracion:{required:true },
 descripcion:{required:true }
  @endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{{ route("Director.HorasLibre.Store") }}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget2').widget_box('reload');
				
	        @endslot

			@slot('successAjax')
				
				resetForm("#form-create");
			getpreview();
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot
       @slot('completeAjax')
		    $('#widget2').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-update2'
	  @endslot
      
      @slot('rules')
		 
			horainicio: {required: true },
			 horafin:{required:true }, 
			 descripcion:{required:true } 
	@endslot

	

       @slot('valid')
			var formData = new FormData($("#form-update2")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				routeUpdate
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget3').widget_box('reload');
				
	        @endslot

			@slot('successAjax')
          $('#widget3').trigger('reloaded.ace.widget');
        resetForm('#form-update2');
          $("#modal-update").modal('hide');
		myTable.ajax.reload();
getpreview();


                
             messageSucess(msg);
		    @endslot
       @slot('completeAjax')
		    $('#widget').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

			
						@component('components.js.table',["route"=>route('Director.HorasLibre.Retrieve',['id'=>$config->id])])
	@endcomponent

$(document).ready(function() {

getpreview();



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


	function edithoralibre(ruta){
        $.gritter.removeAll();
		token=$("#token").val();
		$.ajax({
		url: ruta,
		dataType:'json',
		beforeSend: function(){ 
		 $('#widget-update').widget_box('reload');


		},
		success:function(msg) {
getpreview();
			$('#widget-update').trigger('reloaded.ace.widget');
			 resetForm('#form-update2');

			$("#descripcion").val(msg.horalibre.descripcion);
			$("#horainicio").val(msg.horalibre.horainicio);
			$("#duracion").val(msg.horalibre.duracion);

			 routeUpdate=msg.ruta;

			 



		} ,

		error : function(xhr, status) {
		}
		});


	}

	function getpreview() {
$('#horaslist').html('');
			$.ajax({
		url:'{{route('Director.HorarioConfig.Show',['id'=>$config->id])}}',
		dataType:'json',
	
		success:function(msg) {

					
			 $('#horaslist').html(msg.table);
			 	 $('#horainicio2').html(msg.horas);


	$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});
		} ,

		error : function(xhr, status) {
		}
		});
	}

	function destroyhlibre(ruta) {
		   $.gritter.removeAll();
                    
           var formData = new FormData($("#form-destroy")[0]);
           token=$("#token").val();
			$("#btn-destroy").off('click').on('click', function() {
  
				$.ajax({
					url: ruta,
					type: 'post',
					data:{_method:"DELETE",_token:token},
					dataType: 'json',
					cache:false,
					beforeSend: function(){ 
					$('#widget-destroy').widget_box('reload');
					              
					},

					success:function(msg) {

					$('#widget-destroy').trigger('reloaded.ace.widget');
					myTable.ajax.reload();
					$("#modal-destroy").modal('hide');

				messageSucess(msg);
				getpreview()
				
					},
					error : function(msg) {
                        $('#widget-destroy').trigger('reloaded.ace.widget');
					
						$("#modal-destroy").modal('hide');
						messageError(msg);

						
					}
				});
				
			}); // click remove btn

		}

  </script>




@stop



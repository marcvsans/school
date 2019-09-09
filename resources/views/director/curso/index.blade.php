@extends('layouts.director',['title'=>'Director | Curso','headertitle'=>'Curso','viewtitle'=>'Todos','page'=>' Curso'])

@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
		Registrar Nuevo
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	

</div>
<div class="space-12"></div>
 	@component('components.table',['title'=>'Cursos'])
			<th>Nombre</th>
			<th>Nivel</th> 
			<th>Estado</th>
			<th>Acciones</th>
	@endcomponent


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >

		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Registro de Cursos'])
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
							<input type="text" class="letras col-xs-12 col-sm-8"  class="col-xs-12 col-sm-6" id="nombre" name="nombre"  />
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

												
			<input type="text" name="estado" hidden="" value="Activo" >
	  @endslot
	
	  @slot('footer')
		<button class="btn  btn-danger pull-left "  type="button"  onclick="resetForm('#form-create');" >
			<i class="ace-icon fa fa-times"></i>
			<span class="bigger-110">Cancelar</span>
		</button>

		<button class="btn btn-success pull-right">
			<span class="bigger-110">Aceptar</span>

			<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
		</button>
	  @endslot
		
	@endcomponent

	</div>
</div>


<div id="modal-update" class="modal ">
	<div class="modal-dialog" >
			@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-update',
		'id'=>'widget-update',
		'title'=>'Editar Curso'])
		 	 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							  <input type="hidden" name="_method" value="PUT">

								           	<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Nombre:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" class="letras col-xs-12 col-sm-8"  class="col-xs-12 col-sm-6" id="nombre2" name="nombre"  />
																	</div>
																</div>
																<span class="block input-icon input-icon-right">
							</span>
															</div>

												
													
			


							<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Estado</label>

							<div class="col-xs-12 col-sm-6" id="estado2">
								
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


	

$('#menu-curso').addClass('active');				
			
	@component('components.js.table',['route'=>route('Director.Curso.Retrieve')])

	@endcomponent



@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		nombre: {required: true },
		  nivel:{required:true } 
	@endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Curso.Store') !!}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget').trigger('reloaded.ace.widget');
				resetForm("#form-create");
				$("#modal-registro").modal('hide');
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent


@component('components.js.validate-form')
	  @slot('form')
	    '#form-update'
	  @endslot
      
      @slot('rules')
		nombre: {required: true },
		
		  estado:{required:true}
	@endslot

       @slot('valid')
			var formData = new FormData($("#form-update")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				routeUpdate
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget-update').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget-update').trigger('reloaded.ace.widget');
			
				$("#modal-update").modal('hide');
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent




	})

	function editcurso(ruta){
        $.gritter.removeAll();
		token=$("#token").val();
		$.ajax({
		url: ruta,
		dataType:'json',
		beforeSend: function(){ 
		 $('#widget-update').widget_box('reload');
		},
		success:function(msg) {
			$('#widget-update').trigger('reloaded.ace.widget');
			$('span[class*="block"] ').html('');
			$('div[class*="form-group"] ').removeClass('has-success');
		

			
			$("#nombre2").val(msg.nombre);
			$("#estado2").html(msg.estado);
		
				$("#criteriosupdate").html(msg.criterios);

			 routeUpdate=msg.ruta;

	$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});


		} ,

		error : function(xhr, status) {
		}
		});


	}


  </script>

@stop
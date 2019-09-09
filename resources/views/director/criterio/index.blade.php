@extends('layouts.director',['title'=>'Director | Criterios  de  Evaluacion','headertitle'=>'Criterios  de Evaluacion','viewtitle'=>'Todos','page'=>'Criterio de  Evaluacion'])

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

	@component('components.table',['title'=>'Criterios de  Evaluacion'])
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Estado</th>
		<th >Acciones</th>
	@endcomponent  


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >
				@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Registro de Criterios  de Evaluacion'])
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


			    <div class="space-2"></div>
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion:</label>

				<div class="col-xs-12 col-sm-9">
					<div class="clearfix">
						
			<textarea class="form-control limited autosize-transition"   name="descripcion" id="descripcion" ></textarea>
					</div>
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
		'formId'=>'form-create2',
		'id'=>'widget2',
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
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Nombre:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		<input type="text" class="letras col-xs-12 col-sm-8"  class="col-xs-12 col-sm-6" id="nombre2" name="nombre"  />
																	</div>
																</div>
																<span class="block input-icon input-icon-right">
							</span>
															</div>

												
														        <div class="space-2"></div>
                                                    	<div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		
															<textarea class="form-control limited autosize-transition"   name="descripcion" id="descripcion2" ></textarea>
																	</div>
																</div>
																<span class="block input-icon input-icon-right">
							</span>
															</div>
<div class="form-group">
        <label class="control-label col-xs-12 col-sm-3 no-padding-right" >Estado</label>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 ">
            <div class="clearfix" id="s-estado">
                
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
			
	$('#menu-criterioevaluacion').addClass('active'); 	

	$('textarea.limited').inputlimiter({
	   limit: 150,
        remText: '%n caractere%s restantes.',
        limitText: 'Campo limitado a %n caractere%s.'
				});
					autosize($('textarea[class*=autosize]'));
				

			
		@component('components.js.table',['route'=>route('Director.CriterioEvaluacion.Retrieve')])
		@endcomponent



	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		nombre: {required: true }, 
		descripcion: {required: true }
	   @endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.CriterioEvaluacion.Store') !!}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget').trigger('reloaded.ace.widget');
					$("#modal-registro").modal('hide');
				resetForm("#form-create");
					myTable.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

	
	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create2'
	  @endslot
      
      @slot('rules')
		nombre: {required: true }, 
		descripcion: {required: true }
	   @endslot

       @slot('valid')
			var formData = new FormData($("#form-create2")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				routeUpdate
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget2').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget2').trigger('reloaded.ace.widget');
					$("#modal-update").modal('hide');
				
					myTable.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

	})

	function editcriterio(ruta){
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
		
$("#s-estado").html(msg.CriterioEvaluacion.select);
			$("#nombre2").val(msg.CriterioEvaluacion.nombre);
			$("#descripcion2").val(msg.CriterioEvaluacion.descripcion);

			 routeUpdate=msg.CriterioEvaluacion.ruta;
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
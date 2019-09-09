@extends('layouts.director',['title'=>'Director | Trimestre','headertitle'=>'Trimestre','viewtitle'=>'Todos','page'=>' Trimestre'])

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
 	@component('components.table',['title'=>'Trimestres'])
				<th>Nivel</th>
				<th>Numero</th>
				<th>Fecha de inicio</th>
				<th>Fecha de fin</th>
				<th>Año Academico</th>
				<th >Acciones</th>
	@endcomponent


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >
		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget-create',
		'title'=>'Formulario de Registro de  Trimestres'])
		 	 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Año Academico</label>

							<div class="col-xs-12 col-sm-6">
								<select  name="anio_acad" class="select2" data-placeholder="Año Academico"  >
									<option value=""></option>				
									@foreach ($anios as $anio)
										   <option value="{{$anio->id}}" >{{$anio->descripcion }} - {{$anio->nivel}} - {{$anio->anio}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>
					
<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de Inicio</label>
	<div class="col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker col-xs-4 col-sm-4" name="fechainicio" type="text" data-date-format="yyyy-mm-dd" >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de Fin</label>
	<div class=" col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker "  name="fechafin" type="text" data-date-format="yyyy-mm-dd" >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Numero </label>

							<div class="col-xs-12 col-sm-6">
								<select name="numero" class="select2" data-placeholder="Numero"  >
									<option value=""></option>				
									@foreach ($numeros as $numero)
										   <option value="{{$numero}}" >{{$numero}}° </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>
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
		'title'=>'Editar Trimestre'])
		 	 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							  <input type="hidden" name="_method" value="PUT">

							<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de Inicio</label>
	<div class="col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker2 col-xs-4 col-sm-4" id="fechainicio" name="fechainicio" type="text" data-date-format="yyyy-mm-dd" >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de Fin</label>
	<div class=" col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker2 " id="fechafin" name="fechafin" type="text" data-date-format="yyyy-mm-dd" >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
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


 $('#menu-trimestre').addClass('active open');				
	$('#menu-trimestre-index').addClass('active'); 


	@component('components.js.table',['route'=>route('Director.Trimestre.Retrieve')])

	@endcomponent



@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
	fechainicio: {required: true }, 
	fechafin: {required: true }, 
	numero:{required: true }, 
	anio_acad:{required:true }
	 @endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Trimestre.Store') !!}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		       $('#widget-create').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget-create').trigger('reloaded.ace.widget');
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

			fechainicio: {required: true }, 
	fechafin: {required: true }
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

	function edittrimestre(ruta){
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
	
			$("#fechainicio").val(msg.fechainicio);
			$("#fechafin").val(msg.fechafin);
			 routeUpdate=msg.ruta;
			
$('.date-picker2').datepicker({
	autoclose: false,
	todayHighlight: true,
	clear:true,
	})
	//show datepicker when clicking on the icon
	.next().on(ace.click_event, function(){
	$(this).prev().focus();
	});


		} ,

		error : function(xhr, status) {
		}
		});


	}


  </script>

@stop
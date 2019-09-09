@extends('layouts.director',['title'=>'Director | Seccion','headertitle'=>'Seccion','viewtitle'=>'Todos','page'=>' Seccion'])

@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-create" data-toggle="modal">
		Registrar nueva seccion
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
</div>


<div class="space-12"></div>
@component('components.table')
	  @slot('title')
	       Secciones
	  @endslot
		<th>Nivel</th>
		<th>Grado</th>
		<th>Letra</th>
		<th>Capacidad</th>
		<th>Año Academico</th>
		<th>Vacantes libres</th>
		<th >Acciones</th>
@endcomponent

<div id="modal-create" class="modal">
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

								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Año Academico</label>
								<div class="col-xs-12 col-sm-9">
									<select  name="anio_acad" class="select2" data-placeholder="Año Academico"  onchange="grados($(this).val());">
										<option value=""></option>
										@foreach ($anios as $anio)
										   <option value="{{$anio->id}}" >{{$anio->descripcion}} - {{$anio->nivel}} - {{$anio->anio}} </option>
										@endforeach 
									</select>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>
<div id="grados-show" hidden="">
	
			
									<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Grado</label>
								<div class="col-xs-12 col-sm-9" id="grado2">
							
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

									<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Letra</label>
								<div class="col-xs-12 col-sm-6">
									<select  name="letra" class="select2" data-placeholder="Letra">
										<option value=""></option>
										@foreach ($letras as $letra)
										   <option value="{{$letra}}" >{{$letra}} </option>
										@endforeach
									</select>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>
										<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Capacidad </label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="capacidad" name="capacidad" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>
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


	</div>
</div>

<div id="modal-update" class="modal">
	<div class="modal-dialog" >
			@component('components.widget-box', ['foo' => 'foo','formId'=>'form-update','id'=>'widget-update'])
	  @slot('title')
	       Formulario de actualizacion
	  @endslot
	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot

	  @slot('body')
	      		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							  <input type="hidden" name="_method" value="PUT">




							<div class="space-2"></div>

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Letra</label>
								<div class="col-xs-12 col-sm-6" id="letra2">

								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

	

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Capacidad </label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="capacidad2" name="capacidad" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

							<input type="text" name="anio" id="anio" hidden="">

	  @endslot

	  @slot('footer')
			<button class="btn  btn-danger pull-left " data-dismiss="modal" >
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


@include('partials.destroy')
@stop



@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	var myTable;
	var routeUpdate;
	jQuery(function($) {


	$('#menu-seccion').addClass('active open');
	$('#menu-seccion-todos').addClass('active');




	@component('components.js.table')
	  @slot('route')
	      {!!route('Director.Seccion.Retrieve')!!}
	  @endslot

	@endcomponent


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
		grado: {required: true }, 
		letra: {required: true },
		capacidad:{required: true }, 
		anio_acad:{required:true } 
      @endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{!! route('Director.Seccion.Store') !!}"
			@endslot
	      
	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');

				
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


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-update'
	  @endslot

      @slot('rules')
	
			letra: {required: true }, 
	
			nivel:{required:true } 
	  @endslot

	

       @slot('valid')
			var formData = new FormData($('#form-update')[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				routeUpdate
			@endslot
	      
	        @slot('beforeSendAjax')
		        $('#widget-update').widget_box('reload');
	            $.gritter.removeAll();
				
	        @endslot

			@slot('successAjax')
				myTable.ajax.reload( );
				$("#modal-update").modal('hide');
				$('#widget-update').trigger('reloaded.ace.widget');

				messageSucess(msg);
		    @endslot
		    @slot('completeAjax')
		    $('#widget-update').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent

	  @endslot

	@endcomponent



	})

	function editseccion(ruta){
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

			$("#letra2").html(msg.letra);
		
			$("#capacidad2").val(msg.capacidad);
		
			 routeUpdate=msg.ruta;

	$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});


		} 
		});


	}

	function grados(anio){
  token=$("#token").val();
	$.ajax({
	url: "{!! route('Director.Seccion.Create') !!}",
	
	data: {anio_acad : anio ,_token:token},
	dataType:'json',

	success:function(resp) {
		$("#grados-show").removeAttr("hidden");
		$("#grado2").html(resp.grados);
			$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});
	} ,

	error : function(xhr, status) {

	$("#grados-show").attr("hidden",true);
	}
	});


	}
  </script>

@stop
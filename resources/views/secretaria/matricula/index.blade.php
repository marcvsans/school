@extends('layouts.Secretaria',['title'=>'Secretaria | Matricula','headertitle'=>'Matricula','viewtitle'=>'Todos','page'=>'Matricula'])

@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
		Registrar nueva matricula
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	 

</div>
<div class="space-12"></div>

@component('components.table')
	  @slot('title')
	       Matriculas
	  @endslot
		<th>Documento</th>
		<th>Apellidos y Nombres</th>
		<th>Nivel</th>
		<th>Seccion</th>
		
		<th>Fecha</th>
	
@endcomponent

<div id="modal-registro" class="modal">
	<div class="modal-dialog" >

		@component('components.widget-box', ['foo' => 'foo','formId'=>'form-create','id'=>'widget'])
	  @slot('title')
	       Formulario de registro de matriculas
	  @endslot
	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot

	  @slot('body')
	      		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Seccion</label>
								<div class="col-xs-12 col-sm-6" >
									<select id="seccion" name="seccion" class="select2 " data-placeholder="Seccion" >
										<option value=""></option>
									
										@foreach ($secciones->sortBy('datosGrado.numero') as $seccion)
																	    <option value="{{$seccion->id}}">{{$repo_grado->onlyName($seccion->datosGrado->numero) .' - '.$seccion->letra .' - '.$seccion->datosGrado->nivel}} - {{$seccion->datosAnio->anio}}</option>  
																		@endforeach	                                       
									</select>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>


							<div class="space-2"></div>

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Alumno</label>
								<div class="col-xs-12 col-sm-6">
									<select id="alumno" name="alumno" class="select2" data-placeholder="Alumno">
										
									</select>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

							<div class="space-2"></div>

					

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


@include('partials.destroy')
@stop



@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	var myTable;   
	var routeUpdate;  
	jQuery(function($) {


	$('#menu-matricula').addClass('active open');				
	$('#menu-matricula-todos').addClass('active'); 	
@component('components.js.select-search',['name'=>'#alumno','ruta'=>route('Secretaria.Alumno.Search')])

		@endcomponent

	@component('components.js.table',['route'=>route('Secretaria.Matricula.Retrieve')])

	@endcomponent


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
		seccion: {required: true }, 
		alumno: {required: true }
	  @endslot

	

       @slot('valid')
			var formData = new FormData($('#form-create')[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{!! route('Secretaria.Matricula.Store') !!}"
			@endslot
	      
	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
	            $.gritter.removeAll();
				
	        @endslot

			@slot('successAjax')
				resetForm("#form-create");
				$("#modal-registro").modal('hide');
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot
		    @slot('completeAjax')
		    $('#widget').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent

	  @endslot

	@endcomponent





	})




  </script>

@stop
@extends('layouts.director',['title'=>'Director | Docente ','headertitle'=>'Docente','viewtitle'=>'Docente Nuevo','page'=>'Registrar Docente'])

@section('content')
<style type="text/css">
	.profile-info-name {
  width: 160px;
}
</style>
<div class="row">
	<div class="col-xs-12">


	@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Registro de Docentes'])
		 
	  @slot('body')
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

		@include('partials.personainputs')

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

		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Especialidad:</label>
			<div class="col-xs-12 col-sm-9">
				<div class="clearfix">
					<input type="text" name="especialidad" id="especialidad"  class="col-xs-12 col-sm-6"   >
				</div>
			</div>
			<span class="block input-icon input-icon-right">
			</span>
		</div>

		<input type="text" name="estado" value="Activo" hidden="hidden"> 		 

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

<div id="modal-registro" class="modal">
 <div class="modal-dialog" >
 	 		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create2',
		'id'=>'widget2',
		'title'=>'Formulario de Registro de Docentes'])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="email">Numero de Documento </label>
				<div class="col-xs-12 col-sm-8">
					<div class="clearfix">
					<input type="text" name="nrodocumento" id="nrodoc2"  class="col-xs-10 col-sm-5" readonly="" >
					</div>
				</div>
				<span class="block input-icon input-icon-right">
				</span>
			</div>
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="state">Nivel</label>
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
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="email">Especialidad</label>
				<div class="col-xs-12 col-sm-8">
					<div class="clearfix">
						<input type="text" name="especialidad" id="especialidad"  class="col-xs-12 col-sm-6"   >
					</div>
				</div>
				<span class="block input-icon input-icon-right">
				</span>
			</div>

			<input type="text" name="estado" value="Activo" hidden="hidden">
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

@stop


@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
       
	jQuery(function($) {
	$('#menu-persona').addClass('active open');
		$('#menu-docente').addClass('active open');				
		$('#docente-create').addClass('active');               

@component('components.js.validator-check',[
	'MethodName'=>'checkpersona',
	'RutaCheck'=>route('Director.Persona.Check'),
	'data'=>"{_token:token,nrodocumento : value,model:'persona' }",
	'message'=>'<div id="validpersona" class="text-warning">Se han encontrado datos del usuario ingresado <p> Registrelo solo  con los datos que faltan .<a href="#modal-registro" data-toggle="modal" class="btn btn-block  btn-success" >Registrar</a></div>',
	'ActionSuccess'=>' $("#nrodoc2").val(value);'])
@endcomponent

@component('components.js.validator-check',['MethodName'=>'checkdocente','RutaCheck'=>route('Director.Persona.Check'),'data'=>"{_token:token,nrodocumento : value,model:'docente' }"])
@endcomponent


		$('#foto').ace_file_input({
		style: 'well',
		btn_choose: 'Drop files here or click to choose',
		btn_change: null,
		no_icon: 'ace-icon fa fa-cloud-upload-alt',
		droppable: true,
		allowExt:  ["jpeg", "jpg", "png", "gif" , "bmp"],
		allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"],
		thumbnail: 'small'//large | fit


		})


		$.validator.messages.required = "Este Campo es Obligatorio";
		$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";

	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		tipodocumento:{ required:true},
		nombres: {required: true},
		apellidos: {required: true},
		nrodocumento: {required: true,number:true, maxlength:11, minlength:8, checkdocente: true, checkpersona:true }, 
		genero: {required: true }, 
		celular: { require_from_group: [1,".nro"] },
		telefono:{require_from_group: [1,".nro"] },
		fechanacimiento: {required: true },
		correo:{required:true, email:true }, 
		direccion: {required: true },
		nivel:{required:true },
		especialidad:{required:true}
	   @endslot

	  @slot('messages')
		nrodocumento: {remote: "Numero de Documento Duplicado"}
	  @endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Docente.Store') !!}'
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
		nrodocumento: {required: true, number:true, maxlength:11, minlength:8, checkdocente: true },
		especialidad:{required:true } ,
		nivel:{required:true}
		@endslot

		@slot('valid')
			var formData = new FormData($("#form-create2")[0]);

			@component('components.js.ajax-submit')

			    @slot('rutaAjax')
					'{!! route('Director.Docente.Store2') !!}'
				@endslot
			    @slot('data') 
					formData
				@endslot

			    @slot('beforeSendAjax')
					$('#widget2').widget_box('reload');
					
			    @endslot

				@slot('successAjax')
					$('#widget2').trigger('reloaded.ace.widget');
					$("#modal-registro").modal('hide');
					$("#validpersona").html('');
					resetForm("#form-create");
					messageSucess(msg);
			    @endslot

			@endcomponent

		@endslot

	@endcomponent


	})

       
        </script>

@stop
@extends('layouts.secretaria',[
	'title'=>'Secretaria | Alumno',
	'headertitle'=>'Alumno',
	'viewtitle'=>'Alumno Nuevo',
	'page'=>'Registrar Alumno'
	])

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
		'title'=>'Formulario de Registro de Alumnos'])
		 
	  @slot('body')
	      		 
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
			@include('partials.personainputs')

		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Apoderado</label>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
				<div class="clearfix">
					<select class="select2  col-xs-4 col-sm-4"   data-placeholder="Seleccione" name="apoderado" id="apoderado" >
					
					</select>
				</div>
			</div>
			<span class="block input-icon input-icon-right">
		    </span>    
		</div>
				
		<input type="text" name="estadoacademico" value="Estudiando" hidden="">
			
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
		'title'=>'Formulario de Registro de Alumnos'])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-4 no-padding-right" for="email">Numero de Documento :</label>
			<div class="col-xs-12 col-sm-8">
				<div class="clearfix">
				<input type="text" name="nrodocumento" id="nrodoc2"  class="col-xs-10 col-sm-5" readonly="" >
				</div>
			</div>
			<span class="block input-icon input-icon-right">
			</span>
		</div>

		<input type="text" name="estadoacademico" value="Estudiando" hidden="">

		<div class="form-group">
			<label class="control-label col-xs-12 col-sm-4 no-padding-right" >Apoderado</label>
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
				<div class="clearfix">
					<select class="select2 col-xs-8 col-sm-8"   data-placeholder="Seleccione" name="apoderado" id="apoderado2"  >
									
					</select>
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

@stop


@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
       
	jQuery(function($) {
		$('#menu-persona').addClass('active open');
		$('#menu-alumno').addClass('active open');				
		$('#alumno-create').addClass('active');               
		

		@component('components.js.select-search',['name'=>'#apoderado','ruta'=>route('Secretaria.Apoderado.Search')])

		@endcomponent

		@component('components.js.select-search',['name'=>'#apoderado2','ruta'=>route('Secretaria.Apoderado.Search')])

		@endcomponent	

@component('components.js.validator-check',[
	'MethodName'=>'checkpersona',
	'RutaCheck'=>route('Secretaria.Persona.Check'),
	'data'=>"{_token:token,nrodocumento : value,model:'persona' }",
	'message'=>'<div id="validpersona" class="text-warning">Se han encontrado datos del usuario ingresado <p> Registrelo solo  con los datos que faltan .<a href="#modal-registro" data-toggle="modal" class="btn btn-block  btn-success" >Registrar</a></div>',
	'ActionSuccess'=>' $("#nrodoc2").val(value);'])
@endcomponent

@component('components.js.validator-check',['MethodName'=>'checkalumno','RutaCheck'=>route('Secretaria.Persona.Check'),'data'=>"{_token:token,nrodocumento : value,model:'alumno' }"])
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
		token=$("#token").val();


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		tipodocumento:{ required:true},
		nombres: {required: true},
		apellidos: {required: true},
		nrodocumento: {required: true,number:true, maxlength:11, minlength:8, checkalumno: true, checkpersona:true }, 
		genero: {required: true }, 
		celular: { require_from_group: [1,".nro"] },
		telefono:{require_from_group: [1,".nro"] },
		fechanacimiento: {required: true },
		correo:{required:true, email:true }, 
		direccion: {required: true },
		apoderado:{required:true }
	   @endslot

	  @slot('messages')
		nrodocumento: {remote: "Numero de Documento Duplicado"}
	  @endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Secretaria.Alumno.Store') !!}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
				$(".datosapoderado").attr("hidden",true);
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
		nrodocumento: {required: true, number:true, maxlength:11, minlength:8, checkalumno: true },
		apoderado:{required:true } 
		@endslot

		@slot('valid')
			var formData = new FormData($("#form-create2")[0]);

			@component('components.js.ajax-submit')

			    @slot('rutaAjax')
					'{!! route('Secretaria.Alumno.Store2') !!}'
				@endslot
			    @slot('data') 
					formData
				@endslot

			    @slot('beforeSendAjax')
					$('#widget2').widget_box('reload');
					$(".datosapoderado").attr("hidden",true);
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
@extends('layouts.director',['title'=>'Director | Docente ','headertitle'=>'Docente','viewtitle'=>$Persona->nombres ." ". $Persona->apellidos,'page'=>'Docente'])

@section('content')
<style type="text/css">
	.profile-info-name { 
  width: 160px;
}
</style>

@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Docente Editar'])
		 
	  @slot('body')
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

			@include('partials.personainputs')

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-3 no-padding-right" >Estado</label>
				<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 ">
					<div class="clearfix">
						<select class="select2  col-xs-4 col-sm-4"   data-placeholder="Seleccione" name="estado" >
							<option value=''></option>	
							@foreach ($docente->estados as $estado)
								<option value="{{$estado}}" @if($estado==$docente->estado) selected="" @endif>{{$estado}} </option>
							@endforeach  
						</select>
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
							   <option value="{{$nivel}}" @if($nivel==$docente->nivel) selected="" @endif>{{$nivel}} </option>
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
					<input type="text" name="especialidad" id="especialidad"  class="col-xs-12 col-sm-6" value="{{$docente->especialidad}}"  >
					</div>
				</div>
				<span class="block input-icon input-icon-right">
				</span>
			</div>
	 
		
	  @endslot
	
	  @slot('footer')
		<button class="btn btn-success pull-right" type="submit">
			<span class="bigger-110">Actualizar </span>

			<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
		</button>
	  @endslot
		
	@endcomponent

@stop


@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">

	jQuery(function($) {
	$('#menu-persona').addClass('active open');
	$('#menu-docente').addClass('active open');				
	$('#docente-edit').addClass('active').removeClass('hide');   
     $('#nrodocumento').attr('readonly','');		

	$('#foto').ace_file_input({
	style: 'well',
	btn_choose: 'Drop files here or click to choose',
	btn_change: null,
	no_icon: 'ace-icon fa fa-cloud-upload',
	droppable: true,
	allowExt:  ["jpeg", "jpg", "png", "gif" , "bmp"],
	allowMime: ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"],
	thumbnail: 'large'//large | fit

	/**,before_change:function(files, dropped) {
	//Check an example below
	//or examples/file-upload.html
	return true;
	}*/
	/**,before_remove : function() {
	return true;
	}*/
	,
	preview_error : function(filename, error_code) {
	//name of the file that failed
	//error_code values
	//1 = 'FILE_LOAD_FAILED',
	//2 = 'IMAGE_LOAD_FAILED',
	//3 = 'THUMBNAIL_FAILED'
	//alert(error_code);
	}

	}).on('change', function(){
	//console.log($(this).data('ace_input_files'));
	//console.log($(this).data('ace_input_method'));
	});


	$('#foto')
	.ace_file_input('show_file_list', [
	{type: 'image', name: '{{$Persona->Foto}}', path:"{{url(Storage::url('sistem/photos/'.$Persona->foto))}}" }

	]);
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
		nrodocumento: {required: true,number:true, maxlength:11, minlength:8 }, 
		genero: {required: true }, 
		celular: { require_from_group: [1,".nro"] },
		telefono:{require_from_group: [1,".nro"] },
		fechanacimiento: {required: true },
		correo:{required:true, email:true }, 
		direccion: {required: true },
		nivel:{required:true },
		especialidad:{required:true},
		estado:{required:true}
	   @endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);
         
		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{{ route("Director.Docente.Update",["Docente"=>"$Persona->nrodocumento"]) }}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget').widget_box('reload');
				
	        @endslot

			@slot('successAjax')
				$('#widget').trigger('reloaded.ace.widget');
				$('span[class*="block"] ').html('');
		        $('div[class*="form-group"] ').removeClass('has-success');

				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

	})


     
        </script>

@stop
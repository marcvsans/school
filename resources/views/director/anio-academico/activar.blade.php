@extends('layouts.director',['title'=>'Director | Año Academico','headertitle'=>' Año Academico','viewtitle'=>'Habilitar' 
,'page'=>'Año Academico'])


@section('content')

@foreach($niveles as $nivel)
@component('components.widget-box', ['foo' => 'foo','formId'=>'form-'.$nivel,'id'=>'widget-'.$nivel])
	  @slot('title')
	    Activar Año  academico para {{$nivel}}
	  @endslot
	  @slot('toolbar')
	  	<a href="#" data-action="collapse">
							<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
						</a>
	  @endslot

	  @slot('body')
	      	<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right"></label>
	<div class="col-xs-12 col-sm-9">
				

@foreach($anios->where('nivel',$nivel)  as $anio)
		<div>
			<label class="line-height-1 blue">
			<input name="anio" value="{{$anio->id}}" type="radio" class="ace" @if($anio->estado=='Activo') checked="" @endif>
			<span class="lbl"> {{$anio->descripcion}} - {{$anio->anio}}</span>
			</label>
		</div>
	
@endforeach
	
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>
<input type="text" name="nivel" value="{{$nivel}}" hidden="">
	  @endslot

	  @slot('footer')
		

							<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
	  @endslot

	@endcomponent
<div class="space-18"></div>
@endforeach






@include('partials.destroy')		

@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
    	
var myTable;
	var routeUpdate;        
jQuery(function($) {
		
		$('#menu-anio-academico').addClass('active open');			
	$('#menu-anio-academico-activar').addClass('active'); 	


		$.validator.messages.required = "Este Campo es Obligatorio";
		$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";


@foreach($niveles as $nivel)
		@component('components.js.validate-form')
	  @slot('form')
	    '#form-{{$nivel}}'
	  @endslot
      
      @slot('rules')
		
		anio:{required:true}
	   @endslot



       @slot('valid')
			var formData = new FormData($("#form-{{$nivel}}")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{{route('Director.AnioAcademico.Estado.Update')}}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget-{{$nivel}}').widget_box('reload');
				
	        @endslot

			@slot('successAjax')
				//$('#widget').widget_box('reload');
 $('span[class*="block"] ').html('');
          $('div[class*="form-group"] ').removeClass('has-success');
          $('div[class*="form-group"] ').removeClass('has-error');

				messageSucess(msg);
		    @endslot
       @slot('completeAjax')
		    $('#widget-{{$nivel}}').trigger('reloaded.ace.widget');
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent
	


@endforeach



			})






  </script>




@stop



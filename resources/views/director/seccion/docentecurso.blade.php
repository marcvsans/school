@extends('layouts.director',['title'=>'Director | Seccion','headertitle'=>'Seccion','viewtitle'=>'Docente Curso','page'=>' Seccion'])

@section('content')


<div class="space-12"></div>

@component('components.table')
	  @slot('title')
	       Secciones
	  @endslot
		<th>Nivel</th>
		<th>Grado</th>
		<th>Letra</th>
		<th>Año</th>
		<th>Asignar</th>
		<th>Año</th>
		
@endcomponent

<div id="modal-create" class="modal">
	<div class="modal-dialog" >

			@component('components.widget-box', ['foo' => 'foo','formId'=>'form-create','id'=>'widget'])
			
	  @slot('title')
	      Asignar Docentes y Cursos
	  @endslot
	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot

	  @slot('body')
		<div id="inputs">
		</div>
		<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" >
		<input type="text" name="anio" value="{{date('Y')}}" hidden="">		
	  @endslot

	  @slot('footer')
			<button class="btn  btn-danger pull-left" data-dismiss="modal"  type="button">
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
	$('#menu-seccion-docentecurso').addClass('active'); 	



	@component('components.js.table',['route'=>route('Director.SeccionDocenteCurso.Retrieve')])


	@endcomponent


	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
		
      @endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{!! route('Director.SeccionDocenteCurso.Store') !!}"
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





	})


	function createcursodocente(ruta){
        $.gritter.removeAll();
       $("#inputs").html('');
		token=$("#token").val();
		$.ajax({ 
		url:ruta,
		
		dataType:'json',
		beforeSend: function(){ 
		 $('#widget').widget_box('reload');
			
		},
		success:function(msg) {

			$('#widget').trigger('reloaded.ace.widget');
			$('span[class*="block"] ').html('');
			$('div[class*="form-group"] ').removeClass('has-success');
			$('div[class*="form-group"] ').removeClass('has-error');
			$("#inputs").html(msg.curso);
			
			 routeUpdate=msg.ruta;

	$('.select2').css('width','90%').select2().on('change', function(ev) {
	$(this).closest('form').validate().element($(this));
	});


		} 
		});


	}


  </script>

@stop
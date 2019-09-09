@extends('layouts.director',['title'=>'Director | Deuda','headertitle'=>'Deudas','viewtitle'=>'Todos','page'=>'Deudas'])

@section('content')

<div class="row">

		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
			Asignar deuda  a  Alumnos
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>


	
	<div class="space-12"></div>

		<button class="btn btn-info btn-block "  data-target="#modal-registro2" data-toggle="modal">
		Asignar deuda a  Secciones
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>

  
</div>

<div class="space-12"></div>

	@component('components.table',['title'=>'Deudas','id'=>'table-deudas'])
			<th>Documento</th>
				<th>Apellidos  y Nombres</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Mora</th>
				<th>Fecha  de  vencimiento</th>
				<th>Año</th>
				<th>Estado</th>
				<th >Acciones</th>
	@endcomponent  


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >

			@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Registro '])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')

		
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

						
		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Pago</label>

							<div class="col-xs-12 col-sm-6">
								<select name="pago" class="select2" data-placeholder="Pago"  >
									<option></option>
							@foreach ($pagos as $pago)
								
										   <option value="{{$pago->id}}" > {{$pago->descripcion}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>
							

					

		@component('components.table',['title'=>'Alumno','id'=>'table-alumnos'])
				<th class="center">
														<label class="position-relative">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</th>
				<th>Documento</th>
				<th>Apellidos y Nombres</th>
				<th>Estado Academico</th>
	@endcomponent  			


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


<div id="modal-registro2" class="modal">
	<div class="modal-dialog" >
		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create2',
		'id'=>'widget2',
		'title'=>'Formulario de registro'])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
	
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

							
		<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Pago</label>

							<div class="col-xs-12 col-sm-6">
								<select name="pago" class="select2" data-placeholder="Pago"  >
									<option></option>
							@foreach ($pagos as $pago)
								
										   <option value="{{$pago->id}}" > {{$pago->descripcion}} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>
							

					

	
		@component('components.table',['title'=>'Secciones','id'=>'table-secciones'])
			<th class="center">
														<label class="position-relative">
															<input type="checkbox" class="ace" />
															<span class="lbl"></span>
														</label>
													</th>
				<th>Grado</th>
				<th>Letra</th>
				<th>Nivel</th>
				<th>Año</th>
	@endcomponent 			


	  @endslot
	
	  @slot('footer')
	  <button class="btn  btn-danger pull-left "  type="button"  onclick="resetForm('#form-create2');" >
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
	var tableAlumnos; 
	  	
	var routeUpdate;  

	var tableDeudas;
	var tableSecciones; 
	jQuery(function($) {


	$('#menu-pago').addClass('active open');				
	$('#menu-pago-deuda').addClass('active'); 	

	$('textarea.limited').inputlimiter({
	   limit: 150,
        remText: '%n caractere%s restantes.',
        limitText: 'Campo limitado a %n caractere%s.'
				});
					autosize($('textarea[class*=autosize]'));


@component('components.js.table',['route'=>route('Director.Deuda.Retrieve'),'VarName'=>'tableDeudas','idTable'=>'table-deudas'])
@endcomponent

@component('components.js.table',['route'=>route('Director.Deuda.Secciones'),'VarName'=>'tableSecciones','idTable'=>'table-secciones'])
@endcomponent

@component('components.js.table',['route'=>route('Director.Deuda.Alumnos'),'VarName'=>'tableAlumnos','idTable'=>'table-alumnos'])
@endcomponent


	$(document).ready(function() {
				
				
				tableAlumnos.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( tableAlumnos.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				tableAlumnos.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( tableAlumnos.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
					
				tableSecciones.on( 'select', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( tableSecciones.row( index ).node() ).find('input:checkbox').prop('checked', true);
					}
				} );
				tableSecciones.on( 'deselect', function ( e, dt, type, index ) {
					if ( type === 'row' ) {
						$( tableSecciones.row( index ).node() ).find('input:checkbox').prop('checked', false);
					}
				} );
			
			
				/////////////////////////////////
				//table checkboxes
				$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				
				//select/deselect all rows according to table header checkbox
				$('#table-alumnos > thead > tr > th input[type=checkbox], #table-alumnos_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#table-alumnos').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) tableAlumnos.row(row).select();
						else  tableAlumnos.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#table-alumnos').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) tableAlumnos.row(row).deselect();
					else tableAlumnos.row(row).select();
				});
			
		//select/deselect all rows according to table header checkbox
		$('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
				$('#table-secciones > thead > tr > th input[type=checkbox], #table-secciones_wrapper input[type=checkbox]').eq(0).on('click', function(){
					var th_checked = this.checked;//checkbox inside "TH" table header
					
					$('#table-secciones').find('tbody > tr').each(function(){
						var row = this;
						if(th_checked) tableSecciones.row(row).select();
						else  tableSecciones.row(row).deselect();
					});
				});
				
				//select/deselect a row when the checkbox is checked/unchecked
				$('#table-secciones').on('click', 'td input[type=checkbox]' , function(){
					var row = $(this).closest('tr').get(0);
					if(this.checked) tableSecciones.row(row).deselect();
					else tableSecciones.row(row).select();
				});


$(document).on('shown.bs.modal', function (e) {
      $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
});
			


	});

	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		pago: {required: true }
		@endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Deuda.Store') !!}'
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
					tableDeudas.ajax.reload();
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
		pago: {required: true }
		@endslot

       @slot('valid')
			var formData = new FormData($("#form-create2")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Deuda.Store2') !!}'
			@endslot
	        @slot('data')
				formData
			@endslot

	        @slot('beforeSendAjax')
		        $('#widget2').widget_box('reload');
	        @endslot

			@slot('successAjax')
				$('#widget2').trigger('reloaded.ace.widget');
					$("#modal-registro2").modal('hide');
				resetForm("#form-create");
					tableDeudas.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

	



	})

	
function destroy2(ruta) {
		   $.gritter.removeAll();
                    
           var formData = new FormData($("#form-destroy")[0]);
           token=$("#token").val();
			$("#btn-destroy").off('click').on('click', function() {
  
				$.ajax({
					url: ruta,
					type: 'post',
					data:{_method:"DELETE",_token:token},
					dataType: 'json',
					cache:false,
					beforeSend: function(){ 
					$('#widget-destroy').widget_box('reload');
					              
					},

					success:function(msg) {

					$('#widget-destroy').trigger('reloaded.ace.widget');
					tableDeudas.ajax.reload();
					$("#modal-destroy").modal('hide');

				messageSucess(msg);
				
					},
					error : function(msg) {
                        $('#widget-destroy').trigger('reloaded.ace.widget');
					
						$("#modal-destroy").modal('hide');
						messageError(msg);

						
					}
				});
				
			}); // click remove btn

		}

  </script>

@stop
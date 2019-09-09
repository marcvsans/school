@extends('layouts.director',['title'=>'Director | Pagos','headertitle'=>'Pagos','viewtitle'=>'Todos','page'=>'Pagos'])

@section('content')

<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
		Registrar nuevo pago
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	 

</div>
<div class="space-12"></div>
	@component('components.table',['title'=>'Pagos'])
		<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Mora por dia</th>
				<th>Año</th>
				<th>Fecha  de  vencimiento</th>
				<th >Acciones</th>
	@endcomponent  


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >
				@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Registro de Pagos'])
		 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

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

							

					

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Cantidad</label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="costo" name="cantidad" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>
	<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Mora por dia</label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="costo" name="mora_dia" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Año</label>
	<div class="col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control  col-xs-4 col-sm-4" name="anio" id="anio-c" type="text"  >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de vencimiento</label>
	<div class=" col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker "  name="fechavencimiento" type="text" data-date-format="yyyy-mm-dd" >
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

<div id="modal-update" class="modal">
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
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Descripcion:</label>

																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																		
															<textarea class="form-control limited autosize-transition"   name="descripcion" id="descripcionU" ></textarea>
																	</div>
																</div>
																<span class="block input-icon input-icon-right">
							</span>
															</div>

							

							<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Cantidad</label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="costoU" name="cantidad" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>
	<div class="form-group">
								<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name">Mora por dia</label>
								<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12 ">
									<div class="clearfix">
										<input type="number" id="mora_diaU" name="mora_dia" class="col-xs-12 col-sm-5" />
									</div>
								</div>
								<span class="block input-icon input-icon-right">
								</span>
							</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Año</label>
	<div class="col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control  col-xs-4 col-sm-4" name="anio" id="fechapagoU" type="text" data-date-format="yyyy-mm-dd" >
			<span class="input-group-addon">
			<i class="fa fa-calendar bigger-110"></i>
			</span>
		</div>
	</div>
	<span class="block input-icon input-icon-right">
	</span>
</div>

<div class="form-group">
	<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="platform">Fecha de vencimiento</label>
	<div class=" col-sm-6 col-xs-12">
		<div class="input-group">
			<input class="form-control date-picker "  name="fechavencimiento" id="fechavencimientoU" type="text" data-date-format="yyyy-mm-dd" >
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


	$('#menu-pago').addClass('active open');				
	$('#menu-pago-index').addClass('active'); 	

	$('#anio-c').datepicker({
                  format: " yyyy",
              viewMode: "years", 
            minViewMode: "years"
                }); 


		$('#fechapagoU').datepicker({
                  format: " yyyy",
              viewMode: "years", 
            minViewMode: "years"
                }); 
  
	$('textarea.limited').inputlimiter({
	   limit: 150,
        remText: '%n caractere%s restantes.',
        limitText: 'Campo limitado a %n caractere%s.'
				});
					autosize($('textarea[class*=autosize]'));



			
		@component('components.js.table',['route'=>route('Director.Pago.Retrieve')])
		@endcomponent



	@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		descripcion: {required: true },
		 cantidad: {required: true }, 
		 mora_dia:{required: true },
		 fechapago:{required:true },
		 fechavencimiento:{required:true } 
		@endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.Pago.Store') !!}'
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
	descripcion: {required: true }, 
	cantidad: {required: true },
	mora_dia:{required: true },
	 fechapago:{required:true },
	  fechavencimiento:{required:true }
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

	
	function editpago(ruta){
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
	
			$("#descripcionU").val(msg.datos.descripcion);
			$("#costoU").val(msg.datos.cantidad);
			$("#mora_diaU").val(msg.datos.mora_dia);
			//$("#fechapagoU").val(msg.datos.fechapago);
			//$("#fechavencimientoU").val(msg.datos.fechavencimiento);
			 routeUpdate=msg.ruta;
			
		
$('#fechapagoU').datepicker('update', new Date(msg.datos.anio+'-1-1'));

$('#fechavencimientoU').datepicker('update', msg.datos.fechavencimiento);

//$('.datepicker').datepicker( "destroy" );$( '.datepicker' ).removeClass("hasDatepicker").removeAttr('id');


		} ,

		error : function(xhr, status) {
		}
		});


	}


  </script>

@stop
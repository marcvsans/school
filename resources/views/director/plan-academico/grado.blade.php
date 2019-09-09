@extends('layouts.director',['title'=>'Director | Plan Academico','headertitle'=>'Plan Academico','viewtitle'=>'Asignar Grado','page'=>' Plan Academico'])

@section('content')
<div class="alert alert-info">
											<button type="button" class="close" data-dismiss="alert">
												<i class="ace-icon fa fa-times"></i>
											</button>
											<strong>{{$plan->nombre}}</strong>

											{{$plan->nivel}}.
											<br>
										</div>
<div class="row">

	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
	Asignar  Grado
		<i class="ace-icon glyphicon glyphicon-plus align-top  icon-on-right"></i>
		</button>
	</div>
	

</div>
<div class="space-12"></div>
 	@component('components.table',['title'=>'Grados'])
			<th>Grado</th>
			<th>Nivel</th>
			<th>Asignar</th>
			<th>Acciones</th>
	@endcomponent


<div id="modal-registro" class="modal">
	<div class="modal-dialog" >

		@component('components.widget-box', [
		'foo' => 'foo',
		'formId'=>'form-create',
		'id'=>'widget',
		'title'=>'Formulario de Asignacion de grados'])
		 	 	  @slot('toolbar')
	  <a href="#" >
					<i class="ace-icon fa bigger-120 white"  data-dismiss="modal">X</i>
				    </a>
	  @endslot
	  @slot('body')
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">								
	

							<div class="form-group">
							<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="state">Grado</label>

							<div class="col-xs-12 col-sm-6">
								<select name="grado" class="select2" data-placeholder="Seleccione"  >
									<option value=""></option>				
									@foreach ($grados as $grado)
										   <option value="{{$grado->id}}" >{!! $repo_grado->onlyName($grado->numero) !!} </option>
									@endforeach  
								</select>
							</div>
							<span class="block input-icon input-icon-right">
							</span> 
							</div>

												
			<input type="text" name="plan" hidden="" value="{{$plan->id}}" >
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



@include('partials.destroy')
@stop

@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	var myTable;   
	var routeUpdate;
	
	jQuery(function($) {

$('#menu-plan_academico').addClass('active open');
		$('#menu-plan_academico-asignar').addClass('active open').removeClass('hide');				
	$('#menu-plan_academico-asignar-grado').addClass('active').removeClass('hide');	
			
			
	@component('components.js.table',['route'=>route('Director.PlanAcademicoGrado.Retrieve',['plan'=>$plan])])

	@endcomponent



@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot
      
      @slot('rules')
		grado: {required: true }
		 
		 
	@endslot

	

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')
		
		    @slot('rutaAjax')
				'{!! route('Director.PlanAcademicoGrado.Store') !!}'
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
				$("#modal-registro").modal('hide');
				myTable.ajax.reload();
				messageSucess(msg);
		    @endslot

		@endcomponent
	
	  @endslot

	@endcomponent

	})


  </script>

@stop
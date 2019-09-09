@extends('layouts.apoderado',['title'=>'Apoderado | Deudas','headertitle'=>'Deudas','viewtitle'=>'Todos','page'=>'Deudas'])

@section('content')



<div class="space-12"></div>

	@component('components.table',['title'=>'Deudas','id'=>'table-deudas'])
	<th>Alumno</th>
				<th>Descripcion</th>
				<th>Cantidad</th>
				<th>Mora</th>
			
				<th>Fecha  de  vencimiento</th>
				<th>Año</th>
				<th>Estado</th>
				<th >Acciones</th>
	@endcomponent  






@include('partials.destroy')
@stop



@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	 
	jQuery(function($) {


	$('#menu-deuda').addClass('active open');				
	$('#menu-deuda-todos').addClass('active'); 	

@component('components.js.table',['route'=>route('Apoderado.Deuda.Retrieve'),'VarName'=>'tableDeudas','idTable'=>'table-deudas'])
@endcomponent


	})

	


  </script>

@stop
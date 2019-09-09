@extends('layouts.alumno',['title'=>'Alumno | Deudas','headertitle'=>'Deudas','viewtitle'=>'Todos','page'=>'Deudas'])

@section('content')



<div class="space-12"></div>

	@component('components.table',['title'=>'Deudas','id'=>'table-deudas'])
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
	var tableAlumnos; 
	  	
	var routeUpdate;  

	var tableDeudas;
	var tableSecciones; 
	jQuery(function($) {


	$('#menu-deuda').addClass('active open');				
	$('#menu-deuda-todos').addClass('active'); 	




@component('components.js.table',['route'=>route('Alumno.Deuda.Retrieve'),'VarName'=>'tableDeudas','idTable'=>'table-deudas'])
@endcomponent








	})

	


  </script>

@stop
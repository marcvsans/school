@extends('layouts.director',['title'=>'Director | Alumnos','headertitle'=>'Alumno','viewtitle'=>'Todos','page'=>'Alumno'])

@section('content')

	@component('components.table',['title'=>'Alumnos'])
	
		<th>Documento</th>
		<th>Nombres</th>
		<th>Apellidos</th>
		
		<th>Direccion</th>
		<th>Imagen</th>
		<th>Estado Academico</th>
		<th>Acciones</th>
	@endcomponent               

	@include('partials.destroy')

@stop

@section('script')
  <script type="text/javascript">
   	var myTable;       
	jQuery(function($) {
		                  	
		$('#menu-persona').addClass('active open');
		$('#menu-alumno').addClass('active open');				
		$('#alumno-todos').addClass('active');

		@component('components.js.table',['route'=>route('Director.Alumno.Retrieve')])
		@endcomponent

	})


  </script> 

@stop
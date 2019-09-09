@extends('layouts.director',['title'=>'Director | Docente ','headertitle'=>'Docente','viewtitle'=>'Todos','page'=>'Docente'])

@section('content') 

@component('components.table',['title'=>'Docentes'])
	
		<th>Documento</th>
		<th>Apellidos Y Nombres</th>
		<th>Direccion</th>
		<th>Imagen</th>
		<th>Nivel</th>
		<th>Especialidad</th>
		<th>Estado</th>
		<th>Acciones</th>
@endcomponent   


@include('partials.destroy')

@stop



@section('script')
  <script type="text/javascript">
   	var myTable;       
	jQuery(function($) {

		$('#menu-persona').addClass('active open');
		$('#menu-docente').addClass('active open');				
		$('#docente-todos').addClass('active');

		@component('components.js.table',['route'=>route('Director.Docente.Retrieve')])
		@endcomponent

	})

  </script>

@stop
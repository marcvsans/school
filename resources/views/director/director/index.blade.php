@extends('layouts.director',['title'=>'Director | Director','headertitle'=>'Director','viewtitle'=>'Todos','page'=>'Director'])

@section('content')

	@component('components.table',['title'=>'Directores'])
	
		<th>Documento</th>
		<th>Apellidos Y Nombres</th>
		<th>Fecha de  Nacimiento</th>
		<th>Imagen</th>
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
		$('#menu-director').addClass('active open');				
		$('#director-todos').addClass('active');

		@component('components.js.table',['route'=>route('Director.Director.Retrieve')])
		@endcomponent

	})


  </script>

@stop
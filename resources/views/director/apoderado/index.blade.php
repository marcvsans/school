@extends('layouts.director',['title'=>'Director | Apoderado','headertitle'=>'Apoderado','viewtitle'=>'Todos','page'=>'Apoderado'])


@section('content') 

	 	@component('components.table',['title'=>'Apoderados'])
			  
			<th>Documento</th>
			<th>Apellidos y Nombres</th>
			<th>Direccion</th>
			<th >Imagen</th>
			<th>Estado</th>
			<th >Acciones</th>
		@endcomponent

	@include('partials.destroy')

@stop


@section('script')
  <script type="text/javascript">
  	var myTable;
     jQuery(function($) {
	$('#menu-persona').addClass('active open');
	$('#menu-apoderado').addClass('active open');				
	$('#apoderado-todos').addClass('active'); 				

	@component('components.js.table',['route'=>route('Director.Apoderado.Retrieve')])

	@endcomponent


})


  </script>

@stop
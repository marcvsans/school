@extends('layouts.director',['title'=>'Director | Secretaria','headertitle'=>'Secretaria','viewtitle'=>'Todos','page'=>'Secretaria'])

@section('content')

@component('components.table',['title'=>'Secretarias'])
	
		<th>Documento</th>
		<th>Apellidos  Nombres</th>
	
		<th>Fecha  De Nacimiento</th>
		
		<th>Imagen</th>
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
		$('#menu-secretaria').addClass('active open');				
		$('#secretaria-todos').addClass('active');

        @component('components.js.table',['route'=>route('Director.Secretaria.Retrieve')])
		@endcomponent

	})


  </script>


@stop
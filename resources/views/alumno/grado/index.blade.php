@extends('layouts.alumno',['title'=>'Alumno | Grados','headertitle'=>'Alumno','viewtitle'=>'Grados','page'=>'Alumno'])

@section('content')

	@component('components.table',['title'=>'Grados'])
			<th>Grado</th>
			<th>Letra</th>
			<th>Nivel</th>
			<th>Año</th>
			<th >Notas</th>
	@endcomponent

@stop

@section('script')
  <script type="text/javascript">
        
	jQuery(function($) {				
		
		$('#menu-grado').addClass('active open');
		$('#menu-grado-todos').addClass('active');

		@component('components.js.table',['route'=>route('Alumno.Grado.Retrieve')])
		@endcomponent

	})

  </script>

@stop
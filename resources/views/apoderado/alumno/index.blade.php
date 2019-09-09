@extends('layouts.apoderado',['title'=>'Apoderado | Alumnos','headertitle'=>'Alumno','viewtitle'=>'Todos','page'=>'Alumno'])
@section('content')

	@component('components.table',['title'=>'Alumnos'])
			<th>Documento</th>
				<th>Nombres y Apellidos</th>
				<th>Grados</th>
				<th>Horario</th>
	@endcomponent

@stop

@section('script')
  <script type="text/javascript">
   	var myTable;       
	jQuery(function($) {

				
	$('#menu-alumno').addClass('active open');
		$('#menu-alumno-todos').addClass('active');

	@component('components.js.table',['route'=>route('Apoderado.Alumno.Retrieve')])
		@endcomponent


	})


  </script>

@stop
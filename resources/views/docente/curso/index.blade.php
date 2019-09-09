@extends('layouts.docente',['title'=>'Docente | Cursos','headertitle'=>'Cursos','viewtitle'=>'Todos','page'=>'Cursos'])

@section('content')


@component('components.table',['title'=>'Cursos'])
	<th>Curso</th>
	<th>Seccion</th>
	<th>Nivel</th>
	<th>Año</th>
	<th >Notas</th>
@endcomponent


@stop



@section('script')
  <script type="text/javascript">
   	var myTable;       
	jQuery(function($) {

						$('#menu-curso').addClass('active open');
	$('#menu-curso-todos').addClass('active');
	

		@component('components.js.table',['route'=>route('Docente.Curso.Retrieve')])
	 

	@endcomponent



	})


  </script>

@stop
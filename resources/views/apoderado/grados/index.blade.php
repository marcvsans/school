@extends('layouts.apoderado',['title'=>'Apoderado | Alumno Grados','headertitle'=> $id->persona->NombresApellidos,'viewtitle'=>'Grados','page'=>'Alumno'])

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
   	var myTable;       
	jQuery(function($) {

					
		
            $('#menu-alumno').addClass('active open');	
			$('#menu-alumno-grado').addClass('active open').removeClass('hide');	
			$('#menu-alumno-grado-todos').addClass('active').removeClass('hide'); 
	
	@component('components.js.table',['route'=>route('Apoderado.Grado.Retrieve',["id"=>$id])])
		@endcomponent


	})


  </script>

@stop
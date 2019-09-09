@extends('layouts.director',['title'=>'Director | Notas','headertitle'=>'Notas','viewtitle'=>'Todos','page'=>'Notas'])

@section('content')


<div class="space-12"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Secciones
		</div>
		<div>
		<table id="dynamic-table" class="table table-striped table-bordered table-hover" >
			<thead>
				<tr>
				<th>Nivel</th>
				<th>Grado</th>
				<th>Letra</th>
				<th>Asignar</th>
				<th>Año</th>
				
				</tr>
			</thead>
		</table>
		</div>
	</div>
</div>


@stop



@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	var myTable;   
	var routeUpdate;  
	jQuery(function($) {


$('#menu-notas').addClass('active open');		
		$('#menu-notas-index').addClass('active ');			


	@component('components.js.table',['route'=>route('Director.Notas.Retrieve')])

	@endcomponent





	})


  </script>

@stop
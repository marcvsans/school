@extends('layouts.director',['title'=>'Director |Horario','headertitle'=>'Horario','viewtitle'=>'Asignar','page'=>'Horario'])

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
		<table id="dynamic-table" class="table table-striped table-bordered table-hover"  >
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


@include('partials.destroy')
@stop

 

@section('script')
 <script src="{{ asset('assets/js/initinput.js')}}"></script>
  <script type="text/javascript">
	var myTable;   
	var routeUpdate;  
	jQuery(function($) {


$('#menu-horario').addClass('active open');		
		$('#menu-horario-main').addClass('active open');			
	$('#menu-horario-asignar').addClass('active'); 	


	$(document).ready(function() {



	myTable = $('#dynamic-table')

	.DataTable( {
	bAutoWidth:true,

	"aaSorting": [],

	"bProcessing": true,

	// "sScrollY": "500px",
	"sScrollX": "100%",
	"sScrollXInner": "101%",


	"sAjaxSource": "{!!route('Director.Horario.Retrieve')!!}"	,

 "language": {
			          "url":"{{ asset('assets/js/languageDatable.txt')}}"
			        },

	"iDisplayLength": 10,

	select: {
	style: 'multi'
	}
	} );

	});




	})


  </script>

@stop
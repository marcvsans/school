@extends('layouts.apoderado',['title'=>'Apoderado | Alumno Horario','headertitle'=>$alumno->persona->NombresApellidos,'viewtitle'=>'Ver Horario','page'=>'Horario'])

@section('content')


<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Horario
		</div>
		<div>
		<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="dataTables_scroll"><div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;"><div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 768px; padding-right: 0px;"><table class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" style="margin-left: 0px; width: 768px;"><thead>
		
			</thead></table></div></div><div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;"><table id="table" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;"><thead>
			<tr>
				<th>Hora</th>
				<th>Lunes</th>
				<th>Martes</th>
                <th>Miercoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sabado</th>
				<th>Domingo</th>
			</tr>
			</thead>
			
		<tbody id="horaslist">
		{!!$tabla!!}	
		</tbody></table></div></div></div>
		</div>
	</div>
</div>


					
			



@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
      
jQuery(function($) {

	
            $('#menu-alumno').addClass('active open');	
			$('#menu-alumno-horario').addClass('active ').removeClass('hide');	
				
	

			})






  </script>




@stop



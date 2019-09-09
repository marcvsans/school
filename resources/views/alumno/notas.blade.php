@extends('layouts.alumno',['title'=>'Alumno | Notas','headertitle'=>'Alumno','viewtitle'=>'Notas '.$seccion->datosseccion->datosGrado->numero.'°' .$seccion->datosseccion->letra.' '.$seccion->datosseccion->datosGrado->nivel.' '.$seccion->datosseccion->datosAnio->anio,'page'=>'Alumno'])


@section('content')
	

<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		Notas
		</div>
		<div>
		<div id="dynamic-table_wrapper" class="dataTables_wrapper form-inline no-footer"><div class="dataTables_scroll"><div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px; width: 100%;"><div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 768px; padding-right: 0px;"><table class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" style="margin-left: 0px; width: 768px;">
			
		</table></div></div>
			
				  
		<div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">

		<table id="stable" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;">
			{!!$tabla!!}
		</table>
		</div>

	
	</div></div>
		</div>
	</div>
</div>
							
			


@stop



@section('script')
  <script type="text/javascript">
    	      
jQuery(function($) {

			$('#menu-grado').addClass('active open');	
			$('#menu-grado-notas').addClass('active').removeClass('hide'); 
		})


  </script>




@stop



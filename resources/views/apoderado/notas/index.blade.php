@extends('layouts.apoderado',['title'=>'Apoderado | Alumno Notas','headertitle'=>$seccion->datosAlumno->persona->NombresApellidos,'viewtitle'=>'Notas '.$seccion->datosseccion->datosGrado->numero.'°' .$seccion->datosseccion->letra.' '.$seccion->datosseccion->datosGrado->nivel.' '.$seccion->datosseccion->datosAnio->anio,'page'=>'Alumno'])

@section('content')
	
	<div class="row">
	<div class="col-xs-4"><a href="{{route('Apoderado.Grado.Index',['id'=>$seccion->alumno])}}" class="btn btn-grey"> 
												<i class="ace-icon fa fa-arrow-left"></i>
												Volver  a grados
											</a></div>

									</div>
									
						      
 <form class="form-horizontal" id="form-create" role="form" novalidate="novalidate" >

	
<div class="space-12"></div>


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
			
				   <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
		<div class="dataTables_scrollBody" style="position: relative; overflow: auto; width: 100%;">

		<table id="stable" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;">
			{!!$tabla!!}
		</table>
		</div>
		
	
	</div></div>
		</div>
	</div>
</div>

</form>								
			


@stop



@section('script')
 

  <script type="text/javascript">
      
jQuery(function($) {
			
 $('#menu-alumno').addClass('active open');	
			$('#menu-alumno-grado').addClass('active open').removeClass('hide');	
			$('#menu-alumno-grado-notas').addClass('active').removeClass('hide'); 
				
			})

  </script>

@stop



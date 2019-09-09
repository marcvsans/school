@extends('layouts.docente',['title'=>'Docente | Notas','headertitle'=>'Notas','viewtitle'=>'Asignar','page'=>'Notas'])

@section('content')
	

 <form class="form-horizontal" id="form-create" role="form" novalidate="novalidate" >


<div class="space-18"></div>


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

		<table id="stable" class="table table-striped table-bordered table-hover dataTable no-footer" role="grid" aria-describedby="dynamic-table_info" style="width: 101%;"></table>
		</div>
		<div class="row hide" id="submitnotas">
<div class="col-xs-12">
			
					<button class="btn btn-success pull-right">
								<span class="bigger-110">Aceptar</span>
								<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
							</button>
				
			</div>
		</div>
	
	</div></div>
		</div>
	</div>
</div>

</form>								
			


@stop



@section('script')
  <script src="{{ asset('assets/js/initinput.js')}}"></script>

  <script type="text/javascript">
    	
var myTable;
	var routeUpdate;        
jQuery(function($) {

	$('#menu-curso').addClass('active open');
	
			
	$('#menu-curso-notas').addClass('active').removeClass('hide'); 
				

		$(document).ready(function() {

getNotas();

		});



@component('components.js.validate-form')
	  @slot('form')
	    '#form-create'
	  @endslot

      @slot('rules')
	curso: {required: true}
      @endslot

       @slot('valid')
			var formData = new FormData($("#form-create")[0]);

		@component('components.js.ajax-submit')

		    @slot('rutaAjax')
				"{!! route('Docente.Notas.Store',['id'=>$seccion]) !!}"
			@endslot
	      
	      

			@slot('successAjax')
			getNotas();
            messageSucess(msg);
		    @endslot

		   

		@endcomponent

	  @endslot

	@endcomponent






			})




	function getNotas() {
		$('#submitnotas').addClass('hide'); 


			$.ajax({
		url:'{{route('Docente.Notas.Retrieve',['id'=>$seccion])}}',
		
		dataType:'json',
			beforeSend: function(){ 
		 $('#stable').widget_box('reload');



		},
	
		success:function(msg) {

		$('#submitnotas').removeClass('hide'); 				
			
			  $('#stable').html(msg.table);
$('#stable').trigger('reloaded.ace.widget');

		} ,

		error : function(xhr, status) {
		}
		});
	}





  </script>




@stop



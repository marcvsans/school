@extends('layouts.main')
@section('title')
Admin | seccion
@stop
@section('headertitle')
seccion
@stop
@section('viewtitle')
 Todos
@stop
@section('page')
 seccion
@stop
@section('content')
<div class="row">
	<div class="col-xs-12">
		<button class="btn btn-info btn-block "  data-target="#modal-registro" data-toggle="modal">
		Registrar Nuevo
		<i class="ace-icon fa fa-print  align-top bigger-125 icon-on-right"></i>
		</button>
	</div>
    <br>
	<hr>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="clearfix">
		<div class="pull-right tableTools-container"></div>
		</div>
		<div class="table-header btn-inverse">
		seccions
		</div>
		<div>
		<table id="dynamic-table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
				<th>Documento</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				</tr>
			</thead>
		</table>
		</div>
	</div>
</div>

<div id="modal-registro" class="modal ">
 <div class="modal-dialog" >
		<div class="widget-box widget-color-blue3" id="widget-box-9">
												<div class="widget-header">
													<h5 class="widget-title">Bottom Toolbox (Footer)</h5>

													<div class="widget-toolbar">
														<a href="#" data-action="collapse">
															<i class="1 ace-icon fa fa-times bigger-125"></i>
														</a>
													</div>
											
												</div>

												<div class="widget-body">
													<form class="form-horizontal" id="formcreate" role="form" novalidate="novalidate" >
													<div class="widget-main">
													
														<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
											                 <div class="form-group">
																<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Nombre Nivel</label>
																<div class="col-xs-12 col-sm-9">
																	<div class="clearfix">
																	<input type="text" name="descripcion" id="descripcion"  class="col-xs-12 col-sm-6"  >
																	</div>
																</div>
																<span class="block input-icon input-icon-right">
																</span>
															</div>
															 																		
                                                        
													</div>
                                                   
													<div class="widget-toolbox padding-8 clearfix">
														<button class="btn  btn-danger pull-left " data-dismiss="modal" >
															<i class="ace-icon fa fa-times"></i>
															<span class="bigger-110">Cancelar</span>
														</button>

														<button class="btn btn-success pull-right">
															<span class="bigger-110">Aceptar</span>

															<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
														</button>
													</div>
												 </form>
												</div>
											</div>
 </div>
</div>

@stop



@section('script')
  <script type="text/javascript">
          
jQuery(function($) {

$('#nivel').addClass('active');								
	
var myTable;
		
// 		$("#validation-form")[0].reset();
// $("#modal-wizard").modal('hide');

// myTable.ajax.reload();		

	$('.select2').css('width','200px').select2({allowClear:true})
				.on('change', function(){
					$(this).closest('form').validate().element($(this));
				}); 
			


$(document).ready(function() {



				 myTable = $('#dynamic-table')

				 .DataTable( {
					bAutoWidth:true,
					"aoColumns": [
					  { "bSortable": null },
					  { "bSortable": false },
					  { "bSortable": false }
					],
					"aaSorting": [],
									
									"bProcessing": true,
			        
// "sScrollY": "500px",
"sScrollX": "100%",
"sScrollXInner": "101%",

			
"sAjaxSource": "{!!route('retrievenivel')!!}"	,

 "language": {
			          "processing": "Procesando"
			       },

"iDisplayLength": 10,

					select: {
						style: 'multi'
					}
			    } );

				 });

			$('#formcreate').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						descripcion: {
							required: true
							
						}
					},
			
					
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
						$(e).remove();
					},
			
					errorPlacement: function (error, element) {
						if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
							var controls = element.closest('div[class*="col-"]');
							if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
							else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
						}
						else if(element.is('.select2')) {
							error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
						}
						else if(element.is('.chosen-select')) {
							error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
						}
						else error.insertAfter(element.parent());
					},
			
					submitHandler: function (form) {


var formData = new FormData($("#formcreate")[0]);
		$.ajax({
			url:"{!! route('admin.nivel.store') !!}",
			type:'POST',
			data:formData,
		
			cache:false,
			dataType:'json',
			processData:false,
			contentType:false,
		success: function(msg){
               
$("#formcreate")[0].reset();
// $("#modal-wizard").modal('hide');

// myTable.ajax.reload();
                
                     $.gritter.add({
						title: '<center><h3>'+msg.messages+'</h3></center>',
						//text: '<h1></h1>Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-success gritter-center' //+ ' gritter-light'
					});

					return false;

             }
		});


					},
					invalidHandler: function (form) {
					}
				});	

			})


  </script>

@stop
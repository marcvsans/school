@extends('layouts.main')
@section('title')
Admin | docente
@stop
@section('headertitle')
docente
@stop
@section('viewtitle')
 Editar
@stop
@section('page')
 docente
@stop

@section('content')


<div class="row">
	<div class="col-xs-12">
			<div class="widget-box widget-color-blue3" >
				<div class="widget-header">
					<h5 class="widget-title">Editar Informacion</h5>

					<div class="widget-toolbar">
						<a href="#" data-action="collapse">
							<i class="1 ace-icon fa fa-chevron-up bigger-125"></i>
						</a>
					</div>
			
				</div>

				<div class="widget-body" id="widget">
					<form class="form-horizontal" id="create-form" role="form" novalidate="novalidate" >
					<div class="widget-main" >
						 <!-- {{ csrf_field() }} -->
                        <input type="hidden" name="_method" value="PUT">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">

				
						@include('partials.personainputs')


                    
					</div>
	                
					<div class="widget-toolbox padding-8 clearfix">
						<button class="btn  btn-danger pull-left "  type="button" >
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
            
                
                //$('#top-menu').modal('show')
                
       		if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
			
			
				
				}

					$('.chosen-select').chosen().on('change', function(ev) {
					$(this).closest('form').validate().element($(this));
				});

				

				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

                 	$('.date-picker').datepicker({autoclose:true}).on('changeDate', function(ev) {
					$(this).closest('form').validate().element($(this));
				});

				$.mask.definitions['~']='[+-]';
				 $('#celular').mask('(999) 999-999');
				 $('#telefono').mask('999-999');

				 jQuery.validator.addMethod("celular", function (value, element) {
					return this.optional(element) || /^\(\d{3}\) \d{3}\-\d{3}( x\d{1,6})?$/.test(value);
				}, "Enter a valid phone number.");
                



				$('#foto').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'large'//large | fit
			
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				 $('#foto')
				 .ace_file_input('show_file_list', [
					{type: 'image', name: '{{$Persona->Foto}}', path:"{{url('storage/fotografias').'/'.$Persona->Foto}}" }
					
				 ]);
				$.validator.messages.required = "Este Campo es Obligatorio";
				$.validator.messages.require_from_group = "Por favor , complete {0} de estos campos";
			token=$("#token").val();
	$('#create-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: true,
					groups: {
			required: "fromDate toDate"
		},
					ignore: "",
					rules: {
                        tipodocumento:{
                        	required:true
                        },


						nombres: {
							required: true
							
						    //checkuser:"#nombres"
							
						},
						apellidos: {
							required: true
							
						},
						nrodocumento: {
							required: true,
							number:true,						
							maxlength:11,
							minlength:8
							// remote: { url: "{!! route('checkdocente') !!}",
	      //                   type: "post",
						 //    data: {
							// _token:token
						 //          }
						 //      }
						},
						genero: {
							required: true
						},
						celular: {
							//required: true,
							require_from_group: [1,".nro"]
							//celular:true
						},
						telefono:{
                            require_from_group: [1,".nro"]
                           
						},
						fechanacimiento: {
							required: true
						
						},
						correo:{
                            required:true,
                            email:true

						},
					    direccion: {
							required: true
							
						},
						img: {
							required: true
						},
						dniap:{
							required:true
						}

					},

					messages: {
				    nrodocumento: {
					
					remote: "Numero de Documento Duplicado"
				              }

				   

			            },
			
					
			
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
						var controls=$(e).closest('.form-group').find('span[class*="block"]');
						controls.html('<i class="ace-icon fa fa-times-circle bigger-200"></i>');
						
					},
			
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error').addClass('has-success');
						var controls=$(e).closest('.form-group').find('span[class*="block"]');
						controls.html('<i class="ace-icon fa fa-check-circle bigger-200"></i>');
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


var formData = new FormData($("#create-form")[0]);


		$.ajax({
			url:'{{ route("admin.docente.update",["id"=>"$Persona->NroDocumento"]) }}',
			type:'POST',
			data:formData,
			
			cache:false,
			dataType:'json',
			processData:false,
			contentType:false,

           		      beforeSend: function(){ 
                         $('#widget').widget_box('reload');
                        },

		success: function(msg){  
          $('#widget').trigger('reloaded.ace.widget');
          $('span[class*="block"] ').html('');
          $('div[class*="form-group"] ').removeClass('has-success');
          // $("#create-form")[0].reset();
          // $("#create-form").find('input[type=file]').ace_file_input('reset_input_ui');
          // $(".chosen-select").val('').trigger("chosen:updated");
         


     if(msg.success == true ){
                
                     $.gritter.add({
						title: '<center><h3>'+msg.messages+'</h3></center>',
						//text: '<h1></h1>Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-success gritter-center' //+ ' gritter-light'
					});

					return false;

                } else {
             
                    $.gritter.add({
						title: '<center><h3>'+msg.messages+'</h3></center>',
						//text: '<h1></h1>Just add a "gritter-center" class_name to your $.gritter.add or globally to $.gritter.options.class_name',
						class_name: 'gritter-error gritter-center' //+ ' gritter-light'
					});

					return false;

                }




             },

             error : function(xhr, status,error) {
          $.gritter.add({
						title: '<center><h3>Ocurrio Un error </h3></center>',
						text: 'Intentelo mas Tarde',
						class_name: 'gritter-error gritter-center' //+ ' gritter-light'
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
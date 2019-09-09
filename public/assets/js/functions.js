



     function colorboxthis() {
          		jQuery(function($) {
					var $overflow = '';
					var colorbox_params = {
						rel: 'colorbox',
						reposition:true,
						scalePhotos:true,
						scrolling:false,
						previous:'<i class="ace-icon fa fa-arrow-left"></i>',
						next:'<i class="ace-icon fa fa-arrow-right"></i>',
						close:'&times;',
						current:'{current} of {total}',
						maxWidth:'100%',
						maxHeight:'100%',
						onOpen:function(){
							$overflow = document.body.style.overflow;
							document.body.style.overflow = 'hidden';
						},
						onClosed:function(){
						    document.body.style.overflow = $overflow;
						},
						onComplete:function(){
						  $.colorbox.resize();
						}
					};

					$('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);

					$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon

				})
          }


          function resetForm(form) {
          		
          		
          		
				$(form)[0].reset();
				$(form).find('input[type=file]').ace_file_input('reset_input_ui');
				//$(".chosen-select").val('').trigger("chosen:updated");
				$(form).find('select[class*="select2"]').val(null).trigger('change');
				$("#validpersona").html('');
				$(".help-block").html('');
                $('span[class*="block"] ').html('');
				$('div[class*="form-group"] ').removeClass('has-success');
				$('div[class*="form-group"] ').removeClass('has-error');
				
          }


	function destroy(ruta) {
		   $.gritter.removeAll();
                    
           var formData = new FormData($("#form-destroy")[0]);
           token=$("#token").val();
			$("#btn-destroy").off('click').on('click', function() {
  
				$.ajax({
					url: ruta,
					type: 'post',
					data:{_method:"DELETE",_token:token},
					dataType: 'json',
					cache:false,
					beforeSend: function(){ 
					$('#widget-destroy').widget_box('reload');
					              
					},

					success:function(msg) {

					$('#widget-destroy').trigger('reloaded.ace.widget');
					myTable.ajax.reload();
					$("#modal-destroy").modal('hide');

				messageSucess(msg);
				
					},
					error : function(msg) {
                        $('#widget-destroy').trigger('reloaded.ace.widget');
					
						$("#modal-destroy").modal('hide');
						messageError(msg);

						
					}
				});
				
			}); // click remove btn

		}

function messageSucess(msg) {
	        $.gritter.add({
						title: 'Éxito <i class="ace-icon fa fa-check"></i>',
						text: msg.messages,
						class_name: 'gritter-success gritter-center' //+ ' gritter-light'
					});

					return false;

}

function messageError(msg) {
	  $.gritter.add({
						title: 'Error <i class="ace-icon fa fa-times"></i>',
						text: msg.responseJSON.messages,
						class_name: 'gritter-error gritter-center' //+ ' gritter-light'
					});

					return false;
}


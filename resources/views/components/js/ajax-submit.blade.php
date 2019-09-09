

		$.ajax({
		url:{{$rutaAjax}},
		type:"{!! $type or 'POST'!!}",
		data:{{$data or 'formData'}},
		cache:false,
		dataType:"{{$dataType or 'json'}}",
		
	 {{$procesData or 'processData:false,
		contentType:false,' }}
		beforeSend: function(){ 
		{{$beforeSendAjax or null}}
		},

		success: function(msg){  
         {{$successAjax}}
	

		},

		error : function(msg) {
	    {{$errorAjax or 'messageError(msg);'}}
	
		},
		complete : function(msg) {
		{{$completeAjax or null}}

		}

		});
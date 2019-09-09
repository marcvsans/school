

$("{{$name}}").select2({
	
width:'80%',
  allowClear:true,
ajax: {
     url: '{{$ruta}}',
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used

      
      params.page = params.page || 1;

      return {
        results: data.data,
        data:data.data,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: false

  },



  escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
  minimumInputLength: 1,
  templateResult: formatRepo,
  templateSelection: formatRepoSelection
});

function formatRepo (repo) {

  if (repo.loading) {
    return repo.nombres;
  }

 

  var markup = '<div class="widget-box transparent"> <div class="widget-body"> <div class="widget-main no-padding"> <div class="clearfix"> <div class="pull-left"> <span class="orange2 bolder">'+repo.id+'</span>  <br> '+repo.text+' </div> <div class="pull-right">  &nbsp; <img alt="Image 4" width="36" src="{{ url(Storage::url('sistem/photos/'))}}'+'/'+repo.img+'">  </div> </div> </div> </div> </div>'; return markup; } 
  function formatRepoSelection (repo) {
  return repo.nrodocumento || repo.text;
}

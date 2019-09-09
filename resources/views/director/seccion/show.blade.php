@extends('layouts.director',['title'=>'Director | Seccion','headertitle'=>'Seccion','viewtitle'=>$Seccion->datosGrado->numero.'° '.$Seccion->datosGrado->nivel,'page'=>'Año Academico'])

@section('content')

<style type="text/css"> 
	.profile-info-name {
  width: 190px;
}
</style>


						<div class="row">
							<div class="col-xs-12">
					
							
						<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												

												<li class="active">
													<a data-toggle="tab" href="#alumnos">
														<i class="orange ace-icon fas fa-user-graduate bigger-120"></i>
													Alumnos
													</a>
												</li>

												<li>
													<a data-toggle="tab" href="#docentes">
														<i class="blue ace-icon fas fa-chalkboard-teacher bigger-120"></i>
														Docentes
													</a>
												</li>

										
											</ul>

											<div class="tab-content no-border padding-24">
											


												<div id="alumnos" class="tab-pane in active">
													<div class="profile-users clearfix">
														@foreach($Seccion->Alumnos as $alumno)
														

														<div class="itemdiv memberdiv">
															<div class="inline pos-rel">
																<div class="user">
																	<a href="#">
																		<img src="{{url(Storage::url('sistem/photos/'.$alumno->datosalumno->persona->foto))}}"" alt="Alexa Doe's avatar" />
																	</a>
																</div>

																<div class="body">
																	<div class="name">
																		<a href="#">
																			<span class="user-status status-offline"></span>
																			{{$alumno->datosalumno->persona->nombres}}
																			
																		</a>
																	</div>
																</div>

																<div class="popover">
																	<div class="arrow"></div>

																	<div class="popover-content">
																		<div class="bolder">{{$alumno->datosalumno->persona->nombres}}</div>
{{$alumno->datosalumno->persona->apellidos}}
																		
															
																	</div>
																</div>
															</div>
														</div>
@endforeach

													</div>

													<div class="hr hr10 hr-double"></div>

											
												</div><!-- /#friends -->

												<div id="docentes" class="tab-pane">
													
									
<div class="clearfix">
										
										<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Curso
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Docente
																</th>

															
															</tr>
														</thead>

														<tbody>
															@foreach($Seccion->cursos as $curso)

															<tr>
																<td>{{$curso->cursoinfo->datosCurso->nombre}}</td>

																<td>
																
																	<b class="green">	@if($curso->docenteinfo)
																		<div class="name">
																			<a href="#">{{$curso->docenteinfo->persona->nombres}} {{$curso->docenteinfo->persona->apellidos}}</a>
																		</div>

																		
																		
@endif</b>
																</td>

																
															</tr>

											@endforeach
														</tbody>
													</table>
										





								
									

								

																

															

															</div>
												
												
												</div><!-- /#pictures -->
											</div>
										</div>
									</div>


								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
	


@stop


@section('script')

<script type="text/javascript">

		jQuery(function($) {
		$('#menu-seccion').addClass('active open');				
		$('#seccion-show').addClass('active').removeClass('hide'); 
		$(document).ready(function() {
	


		});




		$('#profile-feed-1').ace_scroll({
		height: '250px',
		mouseWheelLock: true,
		alwaysVisible : true
		});





		})
jQuery(function($) {
			
				
			
			
				
			
				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
			
				$('a[ data-original-title]').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				//right & left position
				//show the user info on right or left depending on its position
				$('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
					var $this = $(this);
					var $parent = $this.closest('.tab-pane');
			
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $this.offset();
					var w2 = $this.width();
			
					var place = 'left';
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';
					
					$this.find('.popover').removeClass('right left').addClass(place);
				}).on('click', function(e) {
					e.preventDefault();
				});
			
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'large',
					droppable:true,
					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(999) 999-9999');
			
				$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
				
				
				
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch(e) {}
					$('[class*=select2]').remove();
				});
			});

   
</script>

@stop
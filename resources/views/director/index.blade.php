
 @extends('layouts.director',['title'=>'Director | Home','headertitle'=>'Home','viewtitle'=>'Panel Principal','page'=>'Home'])

@section('content')
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Bienvenido a 
									<strong class="green">
										fogrobl
										<small>(v1.0)</small>
									
									</strong>.
		Sistema de  gestion y administracion de colegios
							</div>

<div class="row">

									<div class="col-xs-12">
										

										<p></p>
									

										<a href="{{route('Director.Alumno.Index')}}" class="btn btn-app btn-info btn-sm no-radius">
											<i class="ace-icon fa fas fa-user-graduate bigger-200"></i>
											Alumnos
											<span class="label label-inverse arrowed-in">{{($data->get('alumnos'))}}</span>
										</a>

										<a class="btn btn-app btn-danger btn-sm" href="{{route('Director.Docente.Index')}}">
											<i class="ace-icon fas fa-chalkboard-teacher bigger-200"></i>
											Docentes
										</a>

										<a class="btn btn-app btn-purple btn-sm" href="{{route('Director.Apoderado.Index')}}">
											<i class="ace-icon fas fa-user-tie bigger-200"></i>
										Padres
										</a>

										<a class="btn btn-app btn-pink btn-sm" href="{{route('Director.Seccion.Index')}}">
											<i class="ace-icon fas fa-boxes bigger-200"></i>
											Secciones
										</a>

							
									</div>
								</div>
								<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-7 infobox-container">
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-child"></i>
											</div>

											<div class="infobox-data">

												<span class="infobox-data-number">{{($data->get('alumnos'))}}</span>
												<div class="infobox-content">Alumnos</div>
											</div>
<div class="badge badge-success">

												<i class="ace-icon fa fa-arrow-up"></i> Activos {{($data->get('alumnos.activo'))}}
											</div>
										</div>

										<div class="infobox infobox-blue">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-briefcase"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">{{($data->get('docentes'))}}</span>
												<div class="infobox-content">Docentes</div>
											</div>

											<div class="stat stat-important">Inactivos {{($data->get('docentes.activo'))}}</div>
										</div>

										<div class="infobox infobox-pink">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-users"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">{{($data->get('apoderados'))}}</span>
												<div class="infobox-content">Padres</div>
											</div>
										
										</div>

										<div class="infobox infobox-red">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-cubes"></i>
											</div>

											<div class="infobox-data">

												<span class="infobox-data-number">{{($data->get('secciones'))}}</span>
												<div class="infobox-content">Secciones</div>
											</div>
										
										</div>

										<div class="infobox infobox-orange2">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-book"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">{{($data->get('cursos'))}}</span>
												<div class="infobox-content">Cursos</div>
											</div>

											
										</div>

							

										<div class="space-6"></div>

										<div class="infobox infobox-green infobox-small infobox-dark">
											<div class="infobox-progress">
												@if($data->get('deuda')!=0)
													<div class="easy-pie-chart percentage" data-percent=" 
													{{ round($data->get('deuda.pagado') *100/ $data->get('deuda'),0,PHP_ROUND_HALF_UP)}} " data-size="40">
													<span class="percent">{{round($data->get('deuda.pagado') *100/ $data->get('deuda'),0,PHP_ROUND_HALF_UP)}} </span>%
												</div>
												@else
													<div class="easy-pie-chart percentage" data-percent=" 
													0" data-size="40">
													<span class="percent">0</span>%
												</div>
												@endif
											</div>

											<div class="infobox-data">

												<div class="infobox-content">Pagos</div>
												<div class="infobox-content">cancelados</div>
											</div>
										</div>

										<div class="infobox infobox-blue infobox-small infobox-dark">
											<div class="infobox-progress">
												@if($data->get('deuda')!=0) 
													<div class="easy-pie-chart percentage" data-percent="{{round($data->get('deuda.pendiente') *100/ $data->get('deuda'),0,PHP_ROUND_HALF_UP)}} " data-size="40">
													<span class="percent">{{round($data->get('deuda.pendiente') *100/ $data->get('deuda'),0,PHP_ROUND_HALF_UP)}} </span>%
												</div>
												@else
														<div class="easy-pie-chart percentage" data-percent="0" data-size="40">
													<span class="percent">0 </span>%
												</div>
												@endif
											</div>

											<div class="infobox-data">
												<div class="infobox-content">Pagos</div>
												<div class="infobox-content">Pendientes</div>
											</div>
										</div>

									
									</div>

									<div class="vspace-12-sm"></div>

									<div class="col-sm-5">
										<div class="widget-box">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">
													<i class="ace-icon fas fa-chart-pie"></i>
													Alumnos
												</h5>

												<div class="widget-toolbar no-border">
													
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<div id="piechart-placeholder"></div>

													

													
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>

								<div class="row">
									<div class="col-sm-6">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-star orange"></i>
													Ultimos pagos
												</h4>

												<div class="widget-toolbar">
													<a href="#" data-action="collapse">
														<i class="ace-icon fa fa-chevron-up"></i>
													</a>
												</div>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<table class="table table-bordered table-striped">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Pago
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Alumno
																</th>

																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Fecha
																</th>
															</tr>
														</thead>

														<tbody>
							

@foreach($data->get('caja') as $pagado)
	<tr>
																<td><span class="label label-info arrowed-right arrowed-in">{{$pagado->deudainfo->pagoinfo->descripcion}}</span></td>
																<td>{{$pagado->deudainfo->alumnoinfo->persona->nombres .' ' .$pagado->deudainfo->alumnoinfo->persona->apellidos}}</td>

																<td>
																	{{ date("Y/m/d h:i:s a ",strtotime($pagado->fecha))}}
																</td>

															
															</tr>
@endforeach
														

													
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

								<div class="col-sm-6">
										<div class="widget-box transparent" id="recent-box">
											<div class="widget-header">
												<h4 class="widget-title lighter smaller">
													<i class="ace-icon fa fa-rss orange"></i>Ultimos usuarios  registrados
												</h4>

										
											</div>

											<div class="widget-body">
												<div class="widget-main padding-4">
												
													

														<div id="member-tab" class="tab-pane">
															<div class="clearfix">
																
																@foreach($data->get('user') as $usr)
																<div class="itemdiv memberdiv">
																	<div class="user">
																		<img alt="Bob Doe's avatar" src="{{url(Storage::url('sistem/photos/'.$usr->persona->foto))}}"" />
																	</div>

																	<div class="body">
																		<div class="name">
																			{{$usr->persona->nombres}}
																		</div>


																		<div>
																			

																			
																		</div>
																	</div>
																</div>
@endforeach
														
															</div>

															<div class="space-4"></div>

															<div class="center">
																<i class="ace-icon fa fa-users fa-2x green middle"></i>

																&nbsp;
																<a href="{{route('Director.User.Index')}}" class="btn btn-sm btn-white btn-info">
																	Ver todos&nbsp;
																	<i class="ace-icon fa fa-arrow-right"></i>
																</a>
															</div>

															<div class="hr hr-double hr8"></div>
														</div><!-- /.#member-tab -->

														
													
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->
								</div><!-- /.row -->

								<div class="hr hr32 hr-dotted"></div>

						

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
@stop

@section('script')
		<script type="text/javascript">
			jQuery(function($) {

				$('#admin-home').addClass('active');	

				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
	
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  @if($data->get('alumnos')!=0)
			  var data = [
				{ label: "Estudiando",  data: {{round($data->get('alumnos.activo') *100/ $data->get('alumnos'),0,PHP_ROUND_HALF_UP)}} , color: "#68BC31"},
				{ label: "Egresado",  data: {{round($data->get('alumnos.egresado') *100/ $data->get('alumnos'),0,PHP_ROUND_HALF_UP)}}, color: "#2091CF"},
				{ label: "Retirado",  data: {{round($data->get('alumnos.retirado') *100/ $data->get('alumnos'),0,PHP_ROUND_HALF_UP)}}, color: "#AF4E96"},
				{ label: "Suspendido",  data: {{round($data->get('alumnos.suspendido') *100/ $data->get('alumnos'),0,PHP_ROUND_HALF_UP)}}, color: "#DA5430"},
			
			  ]
			  @else
			   	  var data = [
				{ label: "Estudiando",  data: 0, color: "#68BC31"},
				{ label: "Egresado",  data: 0, color: "#2091CF"},
				{ label: "Retirado",  data: 0, color: "#AF4E96"},
				{ label: "Suspendido",  data: 0, color: "#DA5430"},
			
			  ]
			  @endif
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
	
			
			
			
			})
		</script>
@stop
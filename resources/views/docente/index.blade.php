@extends('layouts.docente',['title'=>'Docente | Home','headertitle'=>'Home','viewtitle'=>'Panel Principal','page'=>'Home'])


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
									
 
										<a href="{{route('Docente.Curso.Index')}}" class="btn btn-app btn-info btn-sm no-radius">
											<i class="ace-icon fa fa-book bigger-200"></i>
											Cursos
											<span class="label label-inverse arrowed-in">{{$data->get('cursos')->count()}}</span>
										</a>

									

										<a class="btn btn-app btn-purple btn-sm" href="{{route('Docente.Horario.Index')}}">
											<i class="ace-icon fas fa-calendar-day bigger-200"></i>
										Horario
										</a>

									


							
									</div>
								</div>
								<div class="row">
									<div class="space-6"></div>

																	<div class="col-sm-12">
										<div class="widget-box transparent">
											<div class="widget-header widget-header-flat">
												<h4 class="widget-title lighter">
													<i class="ace-icon fa fa-star orange"></i>
													Cursos
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
																	<i class="ace-icon fa fa-caret-right blue"></i>Curso
																</th>

																<th>
																	<i class="ace-icon fa fa-caret-right blue"></i>Seccion
																</th>

																<th class="hidden-480">
																	<i class="ace-icon fa fa-caret-right blue"></i>Año
																</th>
															</tr>
														</thead>

														<tbody>
							

@foreach($data->get('cursos') as $curso)
	<tr>
																<td><span class="label label-info arrowed-right arrowed-in">{{$curso->cursoInfo->datosCurso->nombre}}</span></td>
																<td>{{$curso->seccionInfo->datosGrado->numero .'° ' .$curso->seccionInfo->letra}}</td>

																<td>
																	{{ $curso->seccionInfo->datosAnio->anio}}
																</td>

															
															</tr>
@endforeach
														

													
														</tbody>
													</table>
												</div><!-- /.widget-main -->
											</div><!-- /.widget-body -->
										</div><!-- /.widget-box -->
									</div><!-- /.col -->

									<div class="vspace-12-sm"></div>

							
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

			
			
			
			
	
			
			
			
			})
		</script>
@stop
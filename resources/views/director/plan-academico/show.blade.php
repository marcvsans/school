@extends('layouts.director',['title'=>'Director | Plan Academico','headertitle'=>'Plan Academico','viewtitle'=>'Ver','page'=>'Plan Academico'])

@section('content')

<style type="text/css">
	.profile-info-name {
  width: 190px; 
}
</style> 


						<div class="row">
							<div class="col-xs-12">
					
							
								<div class="">
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												@foreach($plan->grados()->get()->sortBy('datosGrado.numero') as $grado)
												<li @if ($loop->first) class="active" @endif>
													<a data-toggle="tab" href="#{{$repo_grado->onlyName($grado->datosGrado->numero)}}">
														<i class="green ace-icon fas fa-archway bigger-120"></i>
														{{$repo_grado->onlyName($grado->datosGrado->numero)}}
													</a>
												</li>
												@endforeach

											</ul>

											<div class="tab-content no-border padding-24">
@foreach($plan->grados()->get()->sortBy('datosGrado.nombre') as $grado)							
<div id="{{$repo_grado->onlyName($grado->datosGrado->numero)}}" class="tab-pane @if ($loop->first) in active @endif">
	<div class="row">
		<div class="table-header btn-inverse">
		Cursos  de  {{$repo_grado->onlyName($grado->datosGrado->numero)}}
				</div>
	<table class="table table-striped table-bordered table-hover dataTable no-footer">
		<thead>
			<tr>
				<th>Curso</th>
				<th>Criterios  de evaluacion</th>
			</tr>
		</thead>	
		<tbody>
			@foreach($grado->cursos as $curso)
				<tr>
					<td  rowspan="{{count($curso->criterios) +1 }}">{{$curso->datosCurso->nombre}}</td>
				</tr>

				@foreach($curso->criterios as $criterio)
				<tr >
					<td>{{$criterio->datosCriterio->nombre}}</td>
				</tr>	
				@endforeach
				
			@endforeach
		</tbody>
	</table>
	</div>
</div><!-- /#home -->
@endforeach								

								{{-- 				<div id="friends" class="tab-pane">
													<div class="profile-users clearfix">
														<div class="itemdiv memberdiv">
															<div class="inline pos-rel">
																<div class="user">
																	<a href="#">
																		<img src="assets/images/avatars/avatar4.png" alt="Bob Doe's avatar" />
																	</a>
																</div>

																<div class="body">
																	<div class="name">
																		<a href="#">
																			<span class="user-status status-online"></span>
																			Bob Doe
																		</a>
																	</div>
																</div>

																<div class="popover">
																	<div class="arrow"></div>

																	<div class="popover-content">
																		<div class="bolder">Content Editor</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o middle bigger-120 orange"></i>
																			<span class="green"> 20 mins ago </span>
																		</div>

																		<div class="hr dotted hr-8"></div>

																		<div class="tools action-buttons">
																			<a href="#">
																				<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>


														<div class="itemdiv memberdiv">
															<div class="inline pos-rel">
																<div class="user">
																	<a href="#">
																		<img src="assets/images/avatars/avatar3.png" alt="Alexa Doe's avatar" />
																	</a>
																</div>

																<div class="body">
																	<div class="name">
																		<a href="#">
																			<span class="user-status status-offline"></span>
																			Alexa Doe
																		</a>
																	</div>
																</div>

																<div class="popover">
																	<div class="arrow"></div>

																	<div class="popover-content">
																		<div class="bolder">Accounting</div>

																		<div class="time">
																			<i class="ace-icon fa fa-clock-o middle bigger-120 grey"></i>
																			<span class="grey"> 4 hours ago </span>
																		</div>

																		<div class="hr dotted hr-8"></div>

																		<div class="tools action-buttons">
																			<a href="#">
																				<i class="ace-icon fa fa-facebook-square blue bigger-150"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
																			</a>

																			<a href="#">
																				<i class="ace-icon fa fa-google-plus-square red bigger-150"></i>
																			</a>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

													<div class="hr hr10 hr-double"></div>

													<ul class="pager pull-right">
														<li class="previous disabled">
															<a href="#">&larr; Prev</a>
														</li>

														<li class="next">
															<a href="#">Next &rarr;</a>
														</li>
													</ul>
												</div><!-- /#friends -->

												<div id="pictures" class="tab-pane">
													<ul class="ace-thumbnails">
														<li>
															<a href="#" data-rel="colorbox">
																<img alt="150x150" src="assets/images/gallery/thumb-1.jpg" />
																<div class="text">
																	<div class="inner">Sample Caption on Hover</div>
																</div>
															</a>

															<div class="tools tools-bottom">
																<a href="#">
																	<i class="ace-icon fa fa-link"></i>
																</a>

																<a href="#">
																	<i class="ace-icon fa fa-paperclip"></i>
																</a>

																<a href="#">
																	<i class="ace-icon fa fa-pencil"></i>
																</a>

																<a href="#">
																	<i class="ace-icon fa fa-times red"></i>
																</a>
															</div>
														</li>

													

													</ul>
												</div><!-- /#pictures --> --}}
											</div>
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

		$('#menu-plan_academico').addClass('active open');				
		$('#menu-plan_academico-ver').addClass('active').removeClass('hide'); 
	
		$('#profile-feed-1').ace_scroll({
		height: '250px',
		mouseWheelLock: true,
		alwaysVisible : true
		});





		})

   
</script>

@stop
@extends('layouts.Secretaria',['title'=>'Secretaria | Apoderado','headertitle'=>'Apoderado','viewtitle'=>'Ver','page'=>'Apoderado'])

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
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Perfil
													</a>
												</li>

	
											</ul>

											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{url(Storage::url('sistem/photos/'.$Persona->foto))}}" />
															</span>

															<div class="space space-8"></div>

															<div class="width-80 label label-info label-xlg arrowed-in arrowed-in-right">
																<div class="inline position-relative">
																	<a href="#" class="user-title-label dropdown-toggle" data-toggle="dropdown">
																		<i class="ace-icon fa fa-circle light-green"></i>
																		&nbsp;
																		<span class="white">{{$Persona->nombres}}</span>
																	</a>

																
																</div>
															</div>

															<div class="space space-8"></div>
														
															<div class="clearfix">

																<div class="grid1">
																<span class="bigger-175 blue" id="edad">{{$Persona->fechanacimiento->age}} Años</span>

																</div>
															</div>
														</div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
														
													 @include('partials.others.show')

														<div class="space-2"></div>
															<div class="profile-user-info profile-user-info-striped ">
																<div class="profile-info-row">
																	<div class="profile-info-name">Estado</div>

																	<div class="profile-info-value">
																		<span>{{$Apoderado->estado}}</span>
																	</div>
																</div>
															<div class="profile-info-row">
																	<div class="profile-info-name">Ocupacion </div>

																	<div class="profile-info-value">
																		<span>{{$Apoderado->ocupacion}}</span>
																	</div>
																</div>
															</div>
															

															
														</div><!-- /.col -->
													</div><!-- /.row -->

													

												</div><!-- /#home -->

										


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
		$('#menu-persona').addClass('active open');
$('#menu-apoderado').addClass('active open');				
$('#apoderado-show').addClass('active').removeClass('hide'); 


$('#profile-feed-1').ace_scroll({
height: '250px',
mouseWheelLock: true,
alwaysVisible : true
});


})

   
</script>

@stop
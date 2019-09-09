<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Pricing Tables - Ace Admin</title>

		<meta name="description" content="Large &amp; Small" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/fa/css/font-awesome.css')}}" />

        <!-- page specific plugin styles -->
       
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.gritter.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/colorbox.min.css')}}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css')}}" />


        <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css')}}" />
        
        <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css')}}" />

        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-editable.min.css')}}" />

        <!-- text fonts -->
        <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css')}}" />

        <!-- ace styles -->
        <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css')}}" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css')}}" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->



        <script src="{{ asset('assets/js/ace-extra.min.js')}}"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
@include('partials.navbar')

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

		

			<div class="main-content">
				<div class="main-content-inner">

				
					<div class="page-content">





						<div class="row">
							<div class="col-xs-12  ">
								<!-- PAGE CONTENT BEGINS -->
					<div class="page-header">
							<h1>
								
								<small>
									<i class="ace-icon fa "></i>
								
								</small>
							</h1>
						</div><!-- /.page-header -->
							
						
@php
$Director="  glyphicon glyphicon-tasks ";
$Secretaria="  glyphicon glyphicon-tasks ";
$Alumno="fa fa-child";
$Docente="fa fa-briefcase";
$Apoderado="fa fa-users";
$SuperAdmin="fa fa-briefcase"

@endphp

			

								<div class="col-xs-12 center">

								
												<!-- #section:pages/profile.picture -->
												


												 @foreach(Auth::user()->getRoleNames() as $rol)
												@php $rolname=trim(str_replace('-', '', $rol)); @endphp
					
														<span class="profile-picture">

									
									<div class=" pricing-box">
										<div class="widget-box pricing-box-small widget-color-green">
											<div class="widget-header">
												<h5 class="widget-title bigger lighter">{{$rol}}</h5>
											</div>

											<div class="widget-body">
												<div class="widget-main">
													<ul class="list-unstyled spaced2">
														

														<li>
															<i class="{{ $$rolname }} " style="font-size:700%;"></i>
															
														</li>
													</ul>

													
													
												</div>

												<div>
													 @if($rol!='Super-Admin')<a href="{{url(strtolower($rol))}}" class="btn btn-block btn-success">
													 @else
													 <a href="{{url('/director')}}" class="btn btn-block btn-success">
													 @endif	
														
														<span>Ingresar</span>
													</a>
												</div>
											</div>
										</div>
									</div>
							
											
												</span>

					    
								@endforeach
									
									</div>

					<div class="row col-xs-12">
				<ul class="list-unstyled spaced2">
														

														<li>
															<i class="fa fa-user-md " style="font-size:700%;"></i>
															
														</li>
															<li>
															<i class="fa fa-user-secret " style="font-size:700%;"></i>
															
														</li>
														<a href="">s</a>
															<li>
															<i class="fa fa-user-tag " style="font-size:700%;"></i>
															
														</li>
<li>
															<i class="fa fa-user-plus" style="font-size:700%;"></i>
															
														</li>
														<li>
															<i class="fa fa-user-times " style="font-size:700%;"></i>
															
														</li>
														<li>
															<i class="fa fa-user-circle " style="font-size:700%;"></i>
															
														</li>
														<li>
															<i class="fa fa-user-o " style="font-size:700%;"></i>
															
														</li>
														<li>
															<i class="fa fa-th-large " style="font-size:700%;"></i>
															
														</li>
															<li>
															<i class="fa fa-gear " style="font-size:700%;"></i>
															
														</li>
	</li>
															<li>
															<i class="fa fa-flag " style="font-size:700%;"></i>
															
														</li>

													</ul>
											</div>	

				
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

@include('partials.footer')
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
	   <script src="{{ asset('assets/js/jquery-2.1.4.min.js')}}"></script>

        <!-- <![endif]-->

        <!--[if IE]>
<script src="{{ asset('assets/js/jquery-1.11.3.min.js')}}"></script>
<![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>
          <script src="{{ asset('assets/js/excanvas.min.js')}}"></script>
        <![endif]-->
        <script src="{{ asset('assets/js/jquery-ui.custom.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.sparkline.index.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.flot.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.flot.pie.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.flot.resize.min.js')}}"></script>
        
        <script src="{{ asset('assets/js/jquery.validate.min.js')}}" ></script>
        <script src="{{ asset('assets/js/jquery-additional-methods.min.js')}}"> </script>
        <script src="{{ asset('assets/js/messages_es_PE.js')}}"> </script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js')}}"></script>
        <script src="{{ asset('assets/js/dataTables.select.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.gritter.min.js')}}"></script>
        <script src="{{ asset('assets/js/jquery.colorbox.min.js')}}"></script>
    
        <script src="{{ asset('assets/js/jquery.inputlimiter.min.js')}}" ></script>
        <script src="{{ asset('assets/js/autosize.min.js')}}"></script>
        <script src="{{ asset('assets/js/moment.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap-tag.min.js')}}"></script>
       
        
        <script src="{{ asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{ asset('assets/js/daterangepicker.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootstrap-timepicker.min.js')}}"></script>


        <script src="{{ asset('assets/js/jquery.maskedinput.min.js')}}"></script>
        <script src="{{ asset('assets/js/bootbox.js')}}"></script>

        <script src="{{ asset('assets/js/select2.min.js')}}"></script>
        

        <!-- ace scripts -->
        <script src="{{ asset('assets/js/ace-elements.min.js')}}"></script>
        <script src="{{ asset('assets/js/ace.min.js')}}"></script>

		<!-- inline scripts related to this page -->
	</body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>{{$title or ''}}</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css')}}" />
       
       <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.css')}}" />
 

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
          <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css')}}" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="{{ asset('assets/js/ace-extra.min.js')}}"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="{{ asset('assets/js/html5shiv.min.js')}}"></script>
        <script src="{{ asset('assets/js/respond.min.js')}}"></script>
        <![endif]-->

            <style type="text/css">
            

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: middle;
    border-top: 1px solid #ddd;
}
        </style>
    </head>

    <body class="no-skin" id="body">

 @include('partials.secretaria.navbar')

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

   @include('partials.secretaria.menu')

            <div class="main-content">
                <div class="main-content-inner">
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Inicio</a>
                            </li>
                            <li class="active">{!! $page or '' !!}</li>
                        </ul><!-- /.breadcrumb -->

                  
                    </div>

                    <div class="page-content">
                       <div class="ace-settings-container" id="ace-settings-container">
                            <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                                <i class="ace-icon fa fa-cog bigger-130"></i>
                            </div>

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <div class="pull-left">
                                            <select id="skin-colorpicker" class="hide">
                                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                <option data-skin="skin-3" value="#D0D0D0" selected="">#D0D0D0</option>
                                            </select>
                                        </div>
                                        <span>&nbsp; Choose Skin</span>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->


                        <div class="page-header">
                            <h1>
                                {{$headertitle or ''}}
                                <small>
                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                {{$viewtitle or ''}}
                                </small>
                            </h1>
                        </div><!-- /.page-header -->

                          <div class="row">
          <div class="col-xs-12">
            @yield('content')
          </div><!-- /.col -->
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
  
        @yield('script')
       <script src="{{ asset('assets/js/functions.js')}}"></script>

    </body>
</html>



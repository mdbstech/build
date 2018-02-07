<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="assets/images/favicon_1.ico">

        <title>Build</title>

        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
         <link href="{{ asset('public/assets/plugins/select2/select2.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/dropify/dist/css/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/summernote/summernote.css') }}">
        <link href="{{ asset('public/assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="{{ asset('public/assets/plugins/magnific-popup/css/magnific-popup.css') }}"/>
       
        <link href="{{ asset('public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('public/assets/js/modernizr.min.js') }}"></script>
        <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    </head>

    <body class="fixed-left">
    <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="{{ url('/home') }}" class="logo"><i class="icon-magnet icon-c-logo"></i><span>Build</span></a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <div class="pull-left">
                                <div class="text-center">
                                    <a href="{{ url('/home') }}" class="logo"><i class="icon-magnet icon-c-logo"></i><span>{{ $boot_org->org_name }}</span></a>
                                </div>
                            </div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('public/images/User')}}/{{ Auth::user()->avatar }}" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ url('/user/profile') }}"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        
                                      
                                        <li class="divider"></li>
                                        <li                  >
                                            <a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="md md-settings-power"></i> Logout</a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
                                        </li>
                                        {{-- <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li> --}}
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                          <li class="text-muted menu-title">Navigation</li>

                            <li class="has_sub">
                                <a href="{{ url('/dashboard') }}" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>

                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cogs"></i> <span> Configuration </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/organization/create') }}">Organization</a></li>
                                     <li><a href="{{ url('/message_setting/edit') }}">Message Setting</a></li>
                                    <li><a href="{{ url('/master/create') }}">Master</a></li>
                                    <li><a href="{{ url('/society/display') }}">Society</a></li>
                                   
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ion-ios7-person"></i><span>People</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/contact/display') }}">Contacts</a></li>
                                    <li><a href="{{ url('/user/create') }}">User</a></li>
                                   
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-building"></i> <span> Project </span>  <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/category/create') }}">Category</a></li>

                                    <li><a href="{{ url('/project/view/1') }}">Projects</a></li>
                                     
                                    <li><a href="{{ url('/site/create') }}">Site</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Payment </span>  <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/payment/display') }}">Payments</a></li>
                                    <li><a href="{{ url('/refund/display') }}">Refund</a></li>
                                     <li><a href="{{ url('/site_allotment/display') }}">Installment</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Ticket System </span>  <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                   
                                    <li><a href="{{ url('/ticket_category/create') }}">Ticket Category</a></li>
                                    <li><a href="{{ url('/priority/create') }}">Priority</a></li>
                                    <li><a href="{{ url('/ticket/display?status=All') }}">Ticket</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-money"></i> <span> Reports </span>  <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="{{ url('/reports/payment_report') }}">Payment</a></li>
                                    <li><a href="{{ url('/reports/refund_report') }}">Refund</a></li>
                                    <li><a href="{{ url('/reports/member_report') }}">Member</a></li>
                                   
                                    <li><a href="{{ url('/reports/contact_report') }}">Contact</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
      <div class="content-page">
     
        @yield('content') 

                <footer class="footer">
                   2017 © . Designed &amp; Developed by MDBS Tech Private Limited.
                </footer>

            </div>
        </div>
       

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset ('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset ('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset ('public/assets/js/detect.js') }}"></script>
        <script src="{{ asset ('public/assets/js/fastclick.js') }}"></script>
        <script src="{{ asset ('public/assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset ('public/assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset ('public/assets/js/waves.js') }}"></script>
        <script src="{{ asset ('public/assets/js/wow.min.js') }}"></script>
        <script src="{{ asset ('public/assets/js/jquery.nicescroll.js') }}"></script>
        <script src="{{ asset ('public/assets/js/jquery.scrollTo.min.js') }}"></script>


        <script src="{{ asset('public/assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.app.js
        ') }}"></script>

        <script type="text/javascript" src="{{ asset('public/assets/js/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>
         <script src="{{ asset('public/assets/plugins/select2/select2.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('public/assets/plugins/dropify/dist/js/dropify.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('public/assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
       <script src="{{ asset('public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
        <script src="{{ asset('public/assets/plugins/summernote/summernote.min.js') }}"></script>
       
        
    
        <script language="JavaScript">
            jQuery(".select2").select2({
                 width: '100%'
            });
            $(document).ready(function () 
            {
                $('.dropify').dropify();
            });
        
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
            
            jQuery(document).ready(function(){

                $('.summernote').summernote({
                    height: 150,                 // set editor height
                    minHeight: null,             // set minimum height of editor
                    maxHeight: null,             // set maximum height of editor
                    focus: false                 // set focus to editable area after initializing summernote 
                });
            });
            $('.colorpicker-rgba').colorpicker();
            
        </script>
        
       
        @yield('js')

  </body>
</html>

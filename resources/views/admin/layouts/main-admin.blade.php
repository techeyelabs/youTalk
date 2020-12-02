<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="base-url" content="{{ url('/') }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>YouTalk</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{Request::root()}}/assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- toast CSS -->
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <!-- morris CSS -->
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- chartist CSS -->
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    <!-- Calendar CSS -->
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" />
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet" />
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="{{Request::root()}}/assets/admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{Request::root()}}/assets/admin/css/style.css" rel="stylesheet">
    <!-- custome links ashik---->
    <link href="{{Request::root()}}/assets/admin/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{Request::root()}}/assets/admin/css/multi-select.css" rel="stylesheet">
    <link href="{{Request::root()}}/assets/admin/css/bootstrap-select.min.css" rel="stylesheet">

    <link href="{{Request::root()}}/assets/admin/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="{{Request::root()}}/assets/admin/css/colors/default.css" id="theme" rel="stylesheet">
    <link href="{{Request::root()}}/assets/css/bootstrap-datetimepicker.min.css" id="theme" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,200i,300,300i,400,400i,500,500i,600,600i,700" rel="stylesheet">
    <link href="{{Request::root()}}/assets/css/style.css"  rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    @yield('custom-style')
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> 
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="{{ url('/') }}" style="font-size: 15px">
                        <b><strong class="dark-logo text-white text-blue">T</strong><strong class="light-logo text-white text-blue">T</strong></b>
                        <span class="hidden-xs text-white text-blue">
                            <span class="dark-logo">YouTalk</span>
                            <span class="light-logo">YouTalk</span>
                        </span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left">
                    <li><a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs"><i class="ti-close ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                            <b class="hidden-xs">{{ Auth::guard('admin')->user()->name }}</b><span class="caret"></span> </a>
                        <ul class="dropdown-menu dropdown-user animated flipInY">
                            <li>
                                <div class="dw-user-box">
                                    <div class="u-text">
                                        <h4>{{ Auth::guard('admin')->user()->name }}</h4>
                                        <p class="text-muted">{{ Auth::guard('admin')->user()->email }}</p></div>
                                </div>
                            </li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('admin-logout') }}"><i class="fa fa-power-off"></i> Logout </a></li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    
                    <!-- /.dropdown -->
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> 
                </div>
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                      
                    </div>
                </div>
                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ route('admin-dashboard') }}" class="waves-effect"><i class="ti-settings fa-fw"></i><span class="hide-menu">Dashboard</span></a>
                    </li>

                    <li>
                        <a href="{{ route('services') }}" class="waves-effect"><i class="ti-settings fa-fw"></i><span class="hide-menu">Service List</span></a>
                    </li>
                    
                    <li>
                        <a href="{{ route('user-list') }}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">User List</span></a>
                    </li>
                    
                    <li>
                        <a href="{{ route('reservation-list') }}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">Reservation List</span></a>
                    </li>

                    <li>
                        <a href="{{ route('service-category-list') }}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">Service category</span></a>
                    </li>

                    <li>
                        <a href="{{ route('service-history-list') }}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">Talk Room History</span></a>
                    </li>

                    <li>
                        <a href="{{ route('pending-deposit')}}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">Deposit History</span>
                            <span id="pending_badge" class="badge"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('point-withdraw') }}" class="waves-effect"><i class="fa-fw ti-star"></i><span class="hide-menu">Withdraw Request</span>
                            <span id="withdraw_badge" class="badge"></span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            @if (session('message'))
                <div class="m-l-15 m-r-15">
                    @include('../partials.myalert')
                </div>
            @endif
            @yield('title')
            @yield('content')
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2020 &copy; YouTalk </footer>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{Request::root()}}/assets/js/moment.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{Request::root()}}/assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="{{Request::root()}}/assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="{{Request::root()}}/assets/admin/js/waves.js"></script>
    <!--Counter js -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    
    <!-- chartist chart -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    
    <!-- Custom Theme JavaScript -->
    <script src="{{Request::root()}}/assets/admin/js/custom.min.js"></script>
    <!-----for templateing ashik---->
    <script src="{{Request::root()}}/assets/admin/js/jquery.dataTables.min.js"></script>
    <script src="{{Request::root()}}/assets/admin/js/jquery.multi-select.js"></script>
    <script src="{{Request::root()}}/assets/admin/js/bootstrap-select.min.js"></script>

    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/summernote/dist/summernote.min.js"></script>

    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
    <!--Style Switcher -->
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="{{Request::root()}}/assets/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="{{Request::root()}}/assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{Request::root()}}/assets/js/app.js') }}"></script>

    <script>
        $(document).ready(function(){
            
            function updateWithdrawBadge(){
                
                var ajaxurl = "{{route('withdraw-notification')}}";
                console.log("hello pn");
                $.ajax({
                    url: ajaxurl,
                    type: "GET",
                    data: {
                            '_token': "{{ csrf_token() }}"
                    },
                    success: function(data){
                            console.log("pnpn: "+data);
                            //$data = $(data);
                        if(data > 0){
                            console.log("tktk2: "+data);
                            $('#withdraw_badge').html("new");
                            $('#withdraw_badge').show();
                        }
                            
                    },
                    complete: function (data) {
                            // Schedule the next
                            
                    }
                }); 
            }

            console.log("main admin");
            updateWithdrawBadge();
            
        });

    </script>

    @yield('script')
</body>


<!-- Mirrored from wrappixel.com/ampleadmin/ampleadmin-html/ampleadmin-minimal/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Aug 2017 13:45:35 GMT -->
</html>
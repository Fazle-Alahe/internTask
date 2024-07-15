
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Internship</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('dashboard')}}/assets/images/favicon.ico">

        <!-- App css -->
        <link href="{{asset('dashboard')}}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard')}}/assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard')}}/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('dashboard')}}/assets/css/style.css" rel="stylesheet" type="text/css" />

        <script src="{{asset('dashboard')}}/assets/js/modernizr.min.js"></script>

        <style>
            .inputt{
                float: left;
                width: 85%;
            }

            .btnn{
                float: left;
                width: 15%;
                padding: 7px;
                border: 1px solid gray;
                border-radius: 2px;
                background-color: gray;
                color: white;
                cursor: pointer;
            }
        </style>
    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">

                <div class="slimscroll-menu" id="remove-scroll">


                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <!--<li class="menu-title">Navigation</li>-->
                            <li>
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{route('category')}}">Category</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Sub Category </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{route('subcategory')}}">Sub Category</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Product </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{route('product')}}">Add Product</a></li>
                                    <li><a href="{{route('all.products')}}">All Products</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Transaction </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{route('transaction.list')}}">Transaction</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-layers"></i> <span> Role Manage </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="{{route('role.manage')}}">Role Manage</a></li>
                                </ul>
                            </li>

                        </ul>

                    </div>
                    <!-- Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->

            <div class="content-page">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">
                            
                            <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    {{-- <img src="assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle"> --}}
                                    <span class="ml-1">{{Auth::user()->name}} <i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">

                                    <!-- item-->
                                    <a href="{{route('logout')}}" class="dropdown-item notify-item">
                                        <i class="fi-power"></i> <span>Logout</span>
                                    </a>

                                </div>
                            </li>

                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left disable-btn">
                                    <i class="dripicons-menu"></i>
                                </button>
                            </li>
                            <li>
                                <div class="page-title-box">
                                    <h4 class="page-title">Dashboard </h4>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item active">Welcome!</li>
                                    </ol>
                                </div>
                            </li>

                        </ul>

                    </nav>

                </div>
                <!-- Top Bar End -->



                <!-- Start Page content -->
                <div class="content">
                    <div class="container-fluid">

                        @yield('content')

                    </div> <!-- container -->

                </div> <!-- content -->


            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- jQuery  -->
        <script src="{{asset('dashboard')}}/assets/js/jquery.min.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/popper.min.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/bootstrap.min.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/metisMenu.min.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/waves.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/jquery.slimscroll.js"></script>

        @yield('footer_script')
        <!-- KNOB JS -->
        <!--[if IE]>
        <script type="text/javascript" src="../plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
        <script src="../plugins/jquery-knob/jquery.knob.js"></script>

        <!-- Dashboard Init -->
        <script src="{{asset('dashboard')}}/assets/pages/jquery.dashboard.init.js"></script>

        <!-- App js -->
        <script src="{{asset('dashboard')}}/assets/js/jquery.core.js"></script>
        <script src="{{asset('dashboard')}}/assets/js/jquery.app.js"></script>

    </body>
</html>
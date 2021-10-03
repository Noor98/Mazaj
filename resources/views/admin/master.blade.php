<!DOCTYPE html>

<html lang="en" dir="rtl">
    <head>
        <meta charset="utf-8" />
        <title> لوحة التحكم | مزاج</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

        <link href="/metronic-rtl/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic-rtl/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic-rtl/assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="/metronic-rtl/assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="/metronic-rtl/assets/global/css/components-md-rtl.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="/metronic-rtl/assets/global/css/plugins-md-rtl.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="/metronic-rtl/assets/layouts/layout/css/layout-rtl.min.css" rel="stylesheet" type="text/css" />
        {{-- <link href="/metronic-rtl/assets/layouts/layout/css/themes/darkblue-rtl.min.css" rel="stylesheet" type="text/css" id="style_color" /> --}}
        <link href="/metronic-rtl/assets/layouts/layout/css/custom-rtl.min.css" rel="stylesheet" type="text/css" />
        <link href="/nprogress-master/nprogress.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />


        <style>
            .error{
                border-color: red !important;
            }
            .align {
                text-align:right !important;
            }
            .mazaj{
                background-image: url("{{ asset('assets/img/coffee-house-bg.jpg') }}")  !important;
            }
            .mazaj,
            .page-header.navbar .top-menu .navbar-nav>li.dropdown .dropdown-toggle:hover,
            .page-sidebar .page-sidebar-menu>li.open>a,
            .page-sidebar .page-sidebar-menu>li:hover>a,
            .page-sidebar .page-sidebar-menu>li>ul>li:hover {
                background-color: #d4c393de;
            }

            .page-header.navbar,.page-header.navbar .top-menu .navbar-nav>li.dropdown.open .dropdown-toggle{
                background-color: #000000e8;

            }
            .page-sidebar .page-sidebar-menu>li>a,.page-sidebar .page-sidebar-menu .sub-menu>li>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a,
            .page-sidebar .page-sidebar-menu>li>a>i[class*=icon-], .page-sidebar .page-sidebar-menu>li>a>i[class^=icon-], .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a>i[class*=icon-], .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a>i[class^=icon-] ,
            .page-sidebar .page-sidebar-menu>li>a>i, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li>a>i,
            .page-sidebar .page-sidebar-menu .sub-menu>li>a>i,
            .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu .sub-menu>li>a>i,
            .page-sidebar .page-sidebar-menu li>a>.arrow:before,
            .page-footer .page-footer-inner,
            .page-header.navbar .top-menu .navbar-nav>li.dropdown-language>.dropdown-toggle>.langname
            {
                color: #000000 !important;
            }

            .page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-toggle>i,
            .page-header.navbar .top-menu .navbar-nav>li.dropdown-user>.dropdown-toggle>.username{
                color: #ffffff !important;

            }



        </style>
        @yield("css")
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-md">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="/admin">
                        <img src="/metronic-rtl/assets/layouts/layout/img/logo.png" alt="logo" height="30px" class="logo-default" /> </a>
                    <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <li class="dropdown dropdown-user">
                            <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <img alt="" class="img-circle" src="/metronic-rtl/assets/layouts/layout/img/avatar3_small.jpg" />
                                <span class="username username-hide-on-mobile">
                               {{ auth()->user()->name  }}</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-default">

                                <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                      <i class="icon-key"></i>   {{ __('تسجيل خروج') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- END TOP NAVIGATION MENU -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <div class="clearfix"> </div>
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class=" page-sidebar-wrapper">
                <div class=" page-sidebar navbar-collapse collapse">
                    <ul class="mazaj page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li class="sidebar-search-wrapper">
                            <!--<form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>
                             -->
                        </li>

                        <li class="nav-item start ">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title">الرئيسية</span>
                            </a>

                        </li>

                        @if (auth()->user()->user_type=='admin')

                          <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">الأصناف الرئيسية</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.categories.index') }}" class="mazaj nav-link ">
                                        <i class="fa fa-list"></i>
                                        <span class="title">ادارة الأصناف الرئيسية</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">اضافة صنف رئيسي جديد</span>
                                    </a>
                                </li>

                            </ul>
                         </li>

                         <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">الأصناف الفرعية</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.items.index') }}" class="nav-link ">
                                        <i class="fa fa-list"></i>
                                        <span class="title">ادارة الأصناف الفرعية</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.items.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">اضافة صنف فرعي جديد</span>
                                    </a>
                                </li>

                            </ul>
                         </li>

                         <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-list"></i>
                                <span class="title">الوحدات</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.units.index') }}" class="nav-link ">
                                        <i class="fa fa-list"></i>
                                        <span class="title">ادارة الوحدات</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.units.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">اضافة وحدة جديدة</span>
                                    </a>
                                </li>

                            </ul>
                         </li>

                         <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-users"></i>
                                <span class="title">المستخدمين</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title">ادارة المستخدمين</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.users.admin') }}" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title">ادارة المدراء</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.users.branch') }}" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title">ادارة الفروع</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.users.supplier') }}" class="nav-link ">
                                        <i class="fa fa-user"></i>
                                        <span class="title">ادارة الموردون</span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">اضافة مستخدم جديد</span>
                                    </a>
                                </li>

                            </ul>
                         </li>
                        @endif
                        <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-table"></i>
                                <span class="title">الطلبيات</span>
                                <span class="arrow"></span>
                            </a>
                            <ul class="sub-menu">
                                @if (auth()->user()->user_type=='admin'||auth()->user()->user_type=='supplier')
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.orders.index') }}" class="nav-link ">
                                        <i class="fa fa-table"></i>
                                        <span class="title"> الطلبيات العادية</span>
                                    </a>
                                </li>
                                @endif
                            @if (auth()->user()->user_type=='admin'|| auth()->user()->user_type=='branch')

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.my_orders') }}" class="nav-link ">
                                        <i class="fa fa-table"></i>
                                        <span class="title">  طلبياتي </span>
                                    </a>
                                </li>

                                <li class="nav-item start ">
                                    <a href="{{ route('admin.orders.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title">اضافة طلبية جديدة</span>
                                    </a>
                                </li>
                            @endif
                                @if (auth()->user()->user_type=='admin'||auth()->user()->user_type=='supplier')
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.special_order.index') }}" class="nav-link ">
                                        <i class="fa fa-table"></i>
                                        <span class="title">  الطلبيات الخاصة </span>
                                    </a>
                                </li>
                                @endif
                                @if (auth()->user()->user_type=='admin'|| auth()->user()->user_type=='branch')
                                <li class="nav-item start ">
                                    <a href="{{ route('admin.special_order.create') }}" class="nav-link ">
                                        <i class="icon-plus"></i>
                                        <span class="title"></span>اضافة طلبية خاصة</span>
                                    </a>
                                </li>
                                @endif

                            </ul>
                        </li>
                        @if (auth()->user()->user_type=='admin')
                        <li class="nav-item start ">
                            <a href="{{ url('admin/orders/statistics') }}" class="nav-link nav-toggle">
                                <i class="fa fa-bar-chart-o"></i>
                                <span class="title">الاحصائيات</span>
                            </a>
                        </li>
                        @endif

                    </ul>
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="mazaj page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <h3 class="page-title"> @yield("title")
                        <small>@yield("subtitle")</small>
                    </h3>
                    @include("_msg")
                    @if(Session::has('success'))
                   <div class="alert alert-success">
                    {{Session::get('success')}}
                    </div>
                    @endif
                    @yield("content")
                </div>
                <!-- END CONTENT BODY -->
            </div>
        </div>
        <!-- END CONTAINER -->
        <!-- BEGIN FOOTER -->
        <div class="mazaj page-footer">

            <div class="page-footer-inner">{{date("Y")}} &copy;جميع الحقوق محفوظة لشركة بدري و هنية


            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
         <div id="Confirm" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">تأكيد</h4>
              </div>
              <div class="modal-body">
                <p>هل انت متأكد من الاستمرار في العملية؟</p>
              </div>
              <div class="modal-footer">
                <a class="btn btn-danger">نعم, متأكد</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">الغاء الأمر</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div>
         <div id="PopUp" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
              </div>
            </div>
          </div>
        </div>
        <script src="/metronic-rtl/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="/metronic-rtl/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="/metronic-rtl/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="/metronic-rtl/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="/nprogress-master/nprogress.js" type="text/javascript"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

        @yield("js")
        <script>
            $(function(){
             /* $(".Confirm").click(function(e){
                  $("#Confirm").modal("show");
                  $("#Confirm .btn-danger").attr("href",$(this).attr("action"));
                  return false;
                  e.preventDefault();
              });*/
              $(".PopUp").click(function(e){
                  $("#PopUp").modal("show");
                  $("#PopUp .modal-title").html($(this).attr("title"));
                  $("#PopUp .modal-body").load($(this).attr("href"));
                  return false;
              });

                $( document ).ajaxStart(function() {
                    NProgress.start();
                });

                $( document ).ajaxStop(function() {
                    NProgress.done();
                });


                $( document ).ajaxError(function() {
                    NProgress.done();
                });
            })
        </script>


    </body>

</html>

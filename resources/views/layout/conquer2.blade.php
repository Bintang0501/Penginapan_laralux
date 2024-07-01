<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8" />
    <title>Nginep | @yield("icha")</title>

    @include("layout.component.css.style-css")

    @yield("css")
</head>

<body class="page-header-fixed">
    <div class="header navbar navbar-fixed-top">
        <div class="header-inner">
            <div class="page-logo">
                <a href="index.html">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="logo" />
                </a>
            </div>
            {{-- <form class="search-form search-form-header" role="form" action="index.html">
                <div class="input-icon right">
                    <i class="icon-magnifier"></i>
                    <input type="text" class="form-control input-sm" name="query" placeholder="Search...">
                </div>
            </form> --}}
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <img src="{{ asset('assets/img/menu-toggler.png') }}" alt="" />
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <ul class="nav navbar-nav pull-right">
                <li class="devider">
                    &nbsp;
                </li>
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <li class="dropdown user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                        <img alt="" src="{{ asset('assets/img/avatar3_small.jpg') }}" />
                        <span class="username username-hide-on-mobile">
                            {{ Auth::user()->name }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('/logout') }}">
                                Logout
                            </a>

                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>

    <div class="page-container">

        @if (Auth::user()->role == "PEMBELI")
            @include("layout.component.sidebar.sidebar-pembeli")
        @elseif (Auth::user()->role == "STAFF")
            @include("layout.component.sidebar.sidebar-staff")
        @else
            @include("layout.component.sidebar.sidebar")
        @endif

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-hidden="true"></button>
                                <h4 class="modal-title">Modal title</h4>
                            </div>
                            <div class="modal-body">
                                Widget settings form goes here
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success">Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
                <!-- BEGIN STYLE CUSTOMIZER -->
                <div class="theme-panel hidden-xs hidden-sm">
                    <div class="toggler">
                        <i class="fa fa-gear"></i>
                    </div>
                    <div class="theme-options">
                        <div class="theme-option theme-colors clearfix">
                            <span>
                                Theme Color </span>
                            <ul>
                                <li class="color-black current color-default tooltips" data-style="default"
                                    data-original-title="Default">
                                </li>
                                <li class="color-grey tooltips" data-style="grey" data-original-title="Grey">
                                </li>
                                <li class="color-blue tooltips" data-style="blue" data-original-title="Blue">
                                </li>
                                <li class="color-red tooltips" data-style="red" data-original-title="Red">
                                </li>
                                <li class="color-light tooltips" data-style="light" data-original-title="Light">
                                </li>
                            </ul>
                        </div>
                        <div class="theme-option">
                            <span>
                                Layout </span>
                            <select class="layout-option form-control input-small">
                                <option value="fluid" selected="selected">Fluid</option>
                                <option value="boxed">Boxed</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span>
                                Header </span>
                            <select class="header-option form-control input-small">
                                <option value="fixed" selected="selected">Fixed</option>
                                <option value="default">Default</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span>
                                Sidebar </span>
                            <select class="sidebar-option form-control input-small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected="selected">Default</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span>
                                Sidebar Position </span>
                            <select class="sidebar-pos-option form-control input-small">
                                <option value="left" selected="selected">Left</option>
                                <option value="right">Right</option>
                            </select>
                        </div>
                        <div class="theme-option">
                            <span>
                                Footer </span>
                            <select class="footer-option form-control input-small">
                                <option value="fixed">Fixed</option>
                                <option value="default" selected="selected">Default</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- END BEGIN STYLE CUSTOMIZER -->
                <!-- BEGIN PAGE HEADER-->
                <h3 class="page-title">
                    @yield('budi')
                </h3>
                <div class="page-bar">
                    @yield("breadcrumb")
                </div>
                <!-- END PAGE HEADER-->
                <div>
                    @yield('eleanor')
                </div>
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            &copy; Copyright 2024 &copy;. All Rights Reserved
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>

    @include("layout.component.javascript.style-javascript")

    @yield('javascript')

</body>
</html>

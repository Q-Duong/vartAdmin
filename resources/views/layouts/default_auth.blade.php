<!DOCTYPE html>

<head>
    <title>@yield('title')VART</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="vart, hội hình ảnh">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel='shortcut icon' href="{{ asset('assets/images/logo/vart-logo.png') }}" />
    <script type="application/x-javascript">
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ versionResource('backend/css/bootstrap.min.css') }} " as="style">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ versionResource('backend/css/style.css') }}" rel='stylesheet' type='text/css' as="style" />
    <link href="{{ versionResource('backend/css/style-responsive.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('backend/css/jquery.dataTables.min.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('backend/css/responsive-jqueryui.min.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('backend/css/themes-base-jquery-ui.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('assets/css/overview.built.css') }}" rel='stylesheet' type='text/css'
        as="style" />
    <!-- font CSS -->
    {{-- <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'> --}}
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ versionResource('backend/css/font.css') }}" type="text/css" as="style" />
    <link href="{{ versionResource('backend/css/font-awesome.css') }}" rel="stylesheet" as="style" />
    {{-- <link rel="stylesheet" href="{{ versionResource('backend/css/morris.css') }}" type="text/css" />  --}}
    <!-- calendar -->
    <link rel="stylesheet" href="{{ versionResource('backend/css/monthly.css') }}" as="style" />
    <!-- //calendar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" as="style" />
    <!-- //font-awesome icons -->
    <link rel="stylesheet" href="{{ versionResource('backend/fontawesome-free-5.15.4-web/css/all.css') }}"
        as="style" />
    <!-- //select2 -->
    <link href="{{ versionResource('backend/css/select2.min.css') }}" rel="stylesheet" as="style" />
    @stack('css')
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ route('dashboard') }}" class="logo">
                    VART
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                    <!-- settings start -->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-tasks"></i>
                            <span class="badge bg-success">8</span>
                        </a>
                        <ul class="dropdown-menu extended tasks-bar">
                            <li>
                                <p class="">You have 8 pending tasks</p>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="task-info clearfix">
                                        <div class="desc pull-left">
                                            <h5>Target Sell</h5>
                                            <p>25% , Deadline 12 June’13</p>
                                        </div>
                                        <span class="notification-pie-chart pull-right" data-percent="45">
                                            <span class="percent"></span>
                                        </span>
                                    </div>
                                </a>
                            </li>

                            <li class="external">
                                <a href="#">See All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- settings end -->
                    <!-- inbox dropdown start-->
                    <li id="header_inbox_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-envelope"></i>
                            <span class="badge bg-important">4</span>
                        </a>
                        <ul class="dropdown-menu extended inbox">
                            <li>
                                <p class="red">You have 4 Mails</p>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="photo"><img alt="avatar"></span>
                                    <span class="subject">
                                        <span class="from">Jonathan Smith</span>
                                        <span class="time">Just now</span>
                                    </span>
                                    <span class="message">
                                        Hello, this is an example msg.
                                    </span>
                                </a>
                            </li>

                            <li>
                                <a href="#">See all messages</a>
                            </li>
                        </ul>
                    </li>
                    <!-- inbox dropdown end -->
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge bg-warning">3</span>
                        </a>
                        <ul class="dropdown-menu extended notification">
                            <li>
                                <p>Notifications</p>
                            </li>
                            <li>
                                <div class="alert alert-info clearfix">
                                    <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                                    <div class="noti-info">
                                        <a href="#"> Server #1 overloaded.</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li>
                        <div class="bmucDg"></div>
                    </li>
                    @if (Auth::check())
                        <li class="dropdown">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;">
                                <img alt="" src="{{ asset('assets/images/logo/vart-logo.png') }}">
                                <span class="username">
                                    {{ Auth::user()->profile->profile_lastname }}
                                </span>
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu extended logout">
                                <li>
                                    <div class="extended-info">
                                        <div class="extended-img">
                                            <img src="{{ asset('assets/images/logo/vart-logo.png') }}">
                                        </div>
                                        <div class="extended-cty">VART</div>
                                        <div class="extended-name">Hi, {{ Auth::user()->profile->profile_lastname }}
                                        </div>
                                    </div>
                                </li>
                                <li><a href="{{ route('user.profile') }}"><i class=" fa fa-suitcase"></i>Profile</a>
                                </li>
                                <li><a href="{{ route('user.settings') }}"><i class="fa fa-cog"></i> Settings</a>
                                </li>
                                <li><a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> Log Out
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            @php
                                $route = Route::current();
                            @endphp
                            <a class="{{ $route->uri == 'dashboard' ? 'active' : '' }}"
                                href="{{ Route('dashboard') }}">
                                <i class="far fa-chart-bar"></i>
                                <span>Statistical</span>
                            </a>
                        </li>
                        @can('isAdmin')
                            <li>
                                <a class="{{ $route->uri == 'home-page/edit' ? 'active' : '' }}"
                                    href="{{ Route('editHomePage') }}">
                                    <i class="fa fa-info-circle"></i>
                                    <span>Home Page</span>
                                </a>
                            </li>
                            <li>
                                <a class="{{ $route->uri == 'contact/edit' ? 'active' : '' }}"
                                    href="{{ Route('edit-contact') }}">
                                    <i class="fa fa-info-circle"></i>
                                    <span>Contact</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('vart.index') || request()->routeIs('vart.create') || request()->routeIs('vart.edit') ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>VART</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ request()->routeIs('vart.create') ? 'active' : '' }}"
                                            href="{{ Route('vart.create') }}">
                                            <i class="far fa-plus-square"></i> Create VART
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('vart.index') ? 'active' : '' }}"
                                            href="{{ Route('vart.index') }}">
                                            <i class="far fa-list-alt"></i> List VART
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ $route->uri == 'hart/create' || $route->uri == 'hart' ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>HART</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ $route->uri == 'hart/create' ? 'active' : '' }}"
                                            href="{{ Route('hart.create') }}">
                                            <i class="far fa-plus-square"></i> Create HART
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ $route->uri == 'hart' ? 'active' : '' }}"
                                            href="{{ Route('hart.index') }}">
                                            <i class="far fa-list-alt"></i> List HART
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference_category.index') || request()->routeIs('conference_category.create') || request()->routeIs('conference_category.edit') ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Conference Category</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ request()->routeIs('conference_category.create') ? 'active' : '' }}"
                                            href="{{ Route('conference_category.create') }}">
                                            <i class="far fa-plus-square"></i> Create Conference Category
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('conference_category.index') ? 'active' : '' }}"
                                            href="{{ Route('conference_category.index') }}">
                                            <i class="far fa-list-alt"></i> List Conference Category
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference.index') || request()->routeIs('conference.create') || request()->routeIs('conference.edit') ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Conference</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ request()->routeIs('conference.create') ? 'active' : '' }}"
                                            href="{{ Route('conference.create') }}">
                                            <i class="far fa-plus-square"></i> Create Conference
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('conference.index') ? 'active' : '' }}"
                                            href="{{ Route('conference.index') }}">
                                            <i class="far fa-list-alt"></i> List Conference
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endcan
                        @canany(['isAdmin', 'isSubAdmin', 'isStaffReport'])
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference_report.index') || request()->routeIs('conference_report.edit') ? 'active' : '' }}"
                                    href="{{ route('conference_report.index') }}">
                                    <i class="fas fa-th"></i>
                                    <span>@lang('conference.en.report_title')</span>
                                </a>
                            </li>
                        @endcan
                        @canany(['isAdmin', 'isSubAdmin', 'isStaffReport', 'isStaffInter'])
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference_en_report.index') || request()->routeIs('conference_en_report.edit') ? 'active' : '' }}"
                                    href="{{ Route('conference_en_report.index') }}">
                                    <i class="fas fa-th"></i>
                                    <span>@lang('conference.en.en_report_title')</span>
                                </a>
                            </li>
                        @endcan
                        @canany(['isAdmin', 'isSubAdmin', 'isStaffRegister'])
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference_register.index') || request()->routeIs('conference_register.edit') ? 'active' : '' }}"
                                    href="{{ Route('conference_register.index') }}">
                                    <i class="fas fa-th"></i>
                                    <span>@lang('conference.en.register_title')</span>
                                </a>
                            </li>
                        @endcan
                        @canany(['isAdmin', 'isSubAdmin', 'isStaffRegister', 'isStaffInter'])
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('conference_en_register.index') || request()->routeIs('conference_en_register.edit') ? 'active' : '' }}"
                                    href="{{ Route('conference_en_register.index') }}">
                                    <i class="fas fa-th"></i>
                                    <span>@lang('conference.en.en_register_title')</span>
                                </a>
                            </li>
                        @endcan
                        @can('isAdmin')
                            <li class="sub-menu">
                                <a class="{{ $route->uri == 'courses/add' || $route->uri == 'courses/list' ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Lesson</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ $route->uri == 'courses/add' ? 'active' : '' }}" href="">
                                            <i class="far fa-plus-square"></i> Add
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ $route->uri == 'courses/list' ? 'active' : '' }}" href="">
                                            <i class="far fa-list-alt"></i> List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ $route->uri == 'courses/add' || $route->uri == 'courses/list' ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Forum</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ $route->uri == 'courses/add' ? 'active' : '' }}" href="">
                                            <i class="far fa-plus-square"></i> Add
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ $route->uri == 'courses/list' ? 'active' : '' }}" href="">
                                            <i class="far fa-list-alt"></i> List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ $route->uri == 'courses/add' || $route->uri == 'courses/list' ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Albums</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ $route->uri == 'courses/add' ? 'active' : '' }}" href="">
                                            <i class="far fa-plus-square"></i> Add
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ $route->uri == 'courses/list' ? 'active' : '' }}" href="">
                                            <i class="far fa-list-alt"></i> List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('blog_category.index') || request()->routeIs('blog_category.create') || request()->routeIs('blog_category.edit') ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fas fa-th"></i>
                                    <span>Categogies Blog</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ request()->routeIs('blog_category.create') ? 'active' : '' }}"
                                            href="{{ Route('blog_category.create') }}">
                                            <i class="far fa-plus-square"></i> Create Blog Categories
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('blog_category.index') ? 'active' : '' }}"
                                            href="{{ route('blog_category.index') }}">
                                            <i class="far fa-list-alt"></i> List Blog Categories</a>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sub-menu">
                                <a class="{{ request()->routeIs('blog.index') || request()->routeIs('blog.create') || request()->routeIs('blog.edit') ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fab fa-blogger-b"></i>
                                    <span>Blog</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ request()->routeIs('blog.create') ? 'active' : '' }}"
                                            href="{{ Route('blog.create') }}">
                                            <i class="far fa-plus-square"></i> Create Blog
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->routeIs('blog.index') ? 'active' : '' }}"
                                            href="{{ route('blog.index') }}">
                                            <i class="far fa-list-alt"></i> List Blog
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="sub-menu">
                                <a class="{{ $route->uri == 'slider/create' || $route->uri == 'slider' ? 'active' : '' }}"
                                    href="javascript:;">
                                    <i class="fa fa-picture-o"></i>
                                    <span>Slider</span>
                                </a>
                                <ul class="sub">
                                    <li>
                                        <a class="{{ $route->uri == 'slider/create' ? 'active' : '' }}"
                                            href="{{ route('add-slider') }}">
                                            <i class="far fa-plus-square"></i> Thêm slider
                                        </a>
                                    </li>
                                    <li>
                                        <a class="{{ $route->uri == 'post' ? 'active' : '' }}"
                                            href="{{ route('list-slider') }}">
                                            <i class="far fa-list-alt"></i> Quản lý slider
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                        @endcan
                    </ul>
                    <!-- sidebar menu end-->
                </div>
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            <!-- footer -->
            {{-- <div class="footer">
                <div class="wthree-copyright">
                    <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a>
                    </p>
                </div>
            </div> --}}
            <!-- / footer -->
        </section>
        <!--main content end-->
        <!-- Noti Popup -->
        <div class="notifications-popup-success">
            <div class="notifications-content">
                <div class="notifications-icon">
                </div>
                <div class="notifications-message">
                    <span class="message-title">Notification !</span>
                    <span class="message-text"></span>
                </div>
            </div>
            <i class="fas fa-times notifications-close"></i>
        </div>
        <div class="notifications-popup-error">
            <div class="notifications-content">
                <div class="notifications-icon">
                </div>
                <div class="notifications-message">
                    <span class="message-title">Notification !</span>
                    <span class="message-text"></span>
                </div>
            </div>
            <i class="fas fa-times notifications-close"></i>
        </div>

        @if (session('success'))
            <div class="notifications-popup-success active">
                <div class="notifications-content">
                    <div class="notifications-icon">
                        <i class="fas fa-solid fa-check notifications-success"></i>
                    </div>
                    <div class="notifications-message">
                        <span class="message-title">Notification !</span>
                        <span class="message-text">{!! session('success') !!}</span>
                    </div>
                </div>
                <i class="fas fa-times notifications-close"></i>
            </div>
        @elseif(session('error'))
            <div class="notifications-popup-error active">
                <div class="notifications-content">
                    <div class="notifications-icon">
                        <i class="fas fa-times notifications-error"></i>
                    </div>
                    <div class="notifications-message">
                        <span class="message-title">Notification !</span>
                        <span class="message-text">{!! session('error') !!}</span>
                    </div>
                </div>
                <i class="fas fa-times notifications-close"></i>
            </div>
        @endif
        <!--End Noti Popup -->
    </section>

    <div class="loader-over">
        <span class="loader"></span>
    </div>
    <script src="{{ versionResource('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ versionResource('backend/js/bootstrap.js') }}"></script>
    <!-- Ux Ui -->
    <script src="{{ versionResource('backend/js/ux-ui/jquery.dcjqaccordion.2.7.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/jquery.slimscroll.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/jquery.nicescroll.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/left-side.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/jquery-ui.min.js') }}"></script>
    {{-- <script src="{{ versionResource('backend/js/responsive.jqueryui.min.js') }}"></script> --}}
    <script src="{{ versionResource('backend/js/tool/select2.min.js') }}"></script>
    <script src="{{ versionResource('backend/js/tool/main.js') }}"></script>
    <script src="{{ versionResource('assets/js/support/essential.js') }}" defer></script>

    @stack('js')

    <script type="text/javascript">
        //Handle sales
        var url_upload_image_ck = "{{ route('file.upload_image_ck', ['_token' => csrf_token()]) }}";
        // Revenue Statistics Url
    </script>

    {{-- [if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif] --}}
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
    <!-- calendar -->
    <script type="text/javascript" src="{{ asset('backend/js/monthly.js') }}"></script>
</body>

</html>

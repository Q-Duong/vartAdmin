<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="{{ route('dashboard.index') }}" class="logo">
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
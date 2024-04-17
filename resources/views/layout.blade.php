<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="description"
        content="{{ App::getLocale() == 'vn' ? 'Hội Kỹ Thuật Điện Quang & Y Học Hạt Nhân VIỆT NAM' : 'Viet Nam Assosiation Of Radiological Technologists' }}">
    <meta name="keywords"
        content="Vart, Y tế, Hội Kỹ Thuật Điện Quang & Y Học Hạt Nhân VIỆT NAM ,Hội Kỹ Thuật Điện Quang,Y Học Hạt Nhân VIỆT NAM, Viet Nam Assosiation Of Radiological Technologists">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        @yield('title'){{ App::getLocale() == 'vn' ? 'Hội Kỹ Thuật Điện Quang & Y Học Hạt Nhân VIỆT NAM' : 'Viet Nam Assosiation Of Radiological Technologists' }}
    </title>
    <!-- #FAVICONS -->
    <link rel='shortcut icon' href="{{ asset('assets/images/logo/vart-logo.png') }}" type="image/x-icon">
    <link rel='icon' href="{{ asset('assets/images/logo/vart-logo.png') }}" type="image/x-icon">
    <link rel='canonical' href="https://vart.vn">
    <!-- Google Font -->
    <link rel="preload stylesheet"
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ versionResource('frontend/css/bootstrap.min.css') }}" type="text/css"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/jquery-ui.min.css') }}" as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/font-awesome.min.css') }}" type="text/css"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/elegant-icons.min.css') }}" type="text/css"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/slicknav.min.css') }}" type="text/css" as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/style.css') }}" type="text/css" as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/landing.built.css') }}" type="text/css"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/fontawesome-free-5.15.4-web/css/all.min.css') }}"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('frontend/css/prettify.css') }}" as="style">

    @stack('css')
</head>

<body>
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div id="mobile-menu-wrap"></div>
        <div class="mobile-menu">
            <nav class="mobile-menu-nav">
                <ul>
                    <li class="nav-item">
                        <a href="javascript:;" class="globalnav-link-text">@lang('masterpages.header.vart')</a>
                        <ul class="submenu-list">
                            <li class="submenu-list-item">
                                <a href="{{ Route('vartMain') }}" class="submenu-link">@lang('masterpages.header.exploreVart')
                                </a>
                            </li>
                            @foreach ($getAllVart as $key => $vart)
                                <li class="submenu-list-item">
                                    <a href="{{ Route('vart', $vart->vart_slug) }}"
                                        class="submenu-link">{{ App::getLocale() == 'en' ? $vart->vart_title_en : $vart->vart_title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="javascript:;" class="globalnav-link-text">@lang('masterpages.header.hart')
                        </a>
                        <ul class="submenu-list">
                            <li class="submenu-list-item">
                                <a href="{{ Route('hartMain') }}" class="submenu-link">@lang('masterpages.header.exploreHart')
                                </a>
                            </li>
                            @foreach ($getAllHart as $key => $hart)
                                <li class="submenu-list-item">
                                    <a href="{{ Route('hart', $hart->hart_slug) }}"
                                        class="submenu-link">{{ $hart->hart_title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('lesson') }}" class="globalnav-link-text">@lang('masterpages.header.lesson')</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('forum') }}" class="globalnav-link-text">@lang('masterpages.header.forum')</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="globalnav-link-text">@lang('masterpages.header.conference')</a>
                        <ul class="submenu-list">
                            <li class="submenu-list-item">
                                <a href="{{ Route('conferenceCategoryMain') }}" class="submenu-link">@lang('masterpages.header.exploreConference')
                                </a>
                            </li>
                            @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                <li class="submenu-list-item">
                                    <a href="{{ Route('conference', $conferenceCategory->conference_category_slug) }}"
                                        class="submenu-link">
                                        {{ App::getLocale() == 'en' ? $conferenceCategory->conference_category_name_en : $conferenceCategory->conference_category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('albums') }}" class="globalnav-link-text">@lang('masterpages.header.albums')</a>
                    </li>
                    <li class="nav-item">
                        <a href="javascript:;" class="globalnav-link-text">@lang('masterpages.header.blog')
                        </a>
                        <ul class="submenu-list">
                            <li class="submenu-list-item">
                                <a href="{{ Route('blogCategories') }}" class="submenu-link">@lang('masterpages.header.exploreBlog')</a>
                            </li>
                            @foreach ($getAllBlogCategory as $key => $blogCategory)
                                <li class="submenu-list-item">
                                    <a href="{{ Route('blogCategoriesSlug', $blogCategory->blog_category_slug) }}"
                                        class="submenu-link">{{ $blogCategory->blog_category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ Route('contact') }}" class="globalnav-link-text">@lang('masterpages.header.contact')
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="globalnav-list">
                <div class="header__logo">
                    <a href="{{ Route('home') }}">
                        <img src="{{ asset('assets/images/logo/vart-logo.png') }}" class="img-logo" alt="Vart">
                    </a>
                </div>
                <nav class="header__menu">
                    <ul>
                        <li class="nav-item">
                            <a href="{{ Route('vartMain') }}" class="globalnav-link-text">@lang('masterpages.header.vart')
                                <span class="localnav-chevron" aria-hidden="true">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </a>
                            <div class="globalnav-submenu-link">
                                <div class="globalnav-submenu-group">
                                    <ul class="submenu-list">
                                        <h4 class="submenu-header">@lang('masterpages.header.exploreVart')</h4>
                                        @foreach ($getAllVart as $key => $vart)
                                            <li class="submenu-list-item">
                                                <a href="{{ Route('vart', $vart->vart_slug) }}" class="submenu-link">
                                                    {{ App::getLocale() == 'en' ? $vart->vart_title_en : $vart->vart_title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="{{ Route('hartMain') }}" class="globalnav-link-text">@lang('masterpages.header.hart')
                                <span class="localnav-chevron" aria-hidden="true">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </a>
                            <div class="globalnav-submenu-link">
                                <div class="globalnav-submenu-group">
                                    <ul class="submenu-list">
                                        <h4 class="submenu-header">@lang('masterpages.header.exploreHart')</h4>
                                        @foreach ($getAllHart as $key => $hart)
                                            <li class="submenu-list-item">
                                                <a href="{{ Route('hart', $hart->hart_slug) }}"
                                                    class="submenu-link">{{ $hart->hart_title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('lesson') }}" class="globalnav-link-text">@lang('masterpages.header.lesson')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('forum') }}" class="globalnav-link-text">@lang('masterpages.header.forum')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('conferenceCategoryMain') }}"
                                class="globalnav-link-text">@lang('masterpages.header.conference')
                                <span class="localnav-chevron" aria-hidden="true">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </a>
                            <div class="globalnav-submenu-link">
                                <div class="globalnav-submenu-group">
                                    <ul class="submenu-list">
                                        <h4 class="submenu-header">@lang('masterpages.header.exploreConference')</h4>
                                        @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                            <li class="submenu-list-item">
                                                <a href="{{ Route('conference', $conferenceCategory->conference_category_slug) }}"
                                                    class="submenu-link">{{ App::getLocale() == 'en' ? $conferenceCategory->conference_category_name_en : $conferenceCategory->conference_category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('albums') }}" class="globalnav-link-text">@lang('masterpages.header.albums')</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('blogCategories') }}" class="globalnav-link-text">@lang('masterpages.header.blog')
                                <span class="localnav-chevron" aria-hidden="true">
                                    <i class="fas fa-chevron-down"></i>
                                </span>
                            </a>
                            <div class="globalnav-submenu-link">
                                <div class="globalnav-submenu-group">
                                    <ul class="submenu-list">
                                        <h4 class="submenu-header">@lang('masterpages.header.exploreBlog')</h4>
                                        @foreach ($getAllBlogCategory as $key => $blogCategory)
                                            <li class="submenu-list-item">
                                                <a href="{{ Route('blogCategoriesSlug', $blogCategory->blog_category_slug) }}"
                                                    class="submenu-link">{{ $blogCategory->blog_category_name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ Route('contact') }}" class="globalnav-link-text">@lang('masterpages.header.contact')</a>
                        </li>
                    </ul>
                </nav>
                <div class="header__nav__option">
                    <button class="button-languages header-icon" dropdown="false">
                        <div class="header__languages">
                            <span class="header__languages-icon">
                                <img src="{{ App::getLocale() == 'en' ? asset('assets/images/flags/united-states.png') : asset('assets/images/flags/vietnam.png') }}"
                                    alt="{{ App::getLocale() == 'en' ? 'en_GB' : 'vn' }}"
                                    class="header__language-flag">
                            </span>
                        </div>
                    </button>
                    <div class="language-dropdown-menu languages-desktop">
                        <div class="header__languages-list">
                            <div class="language {{ App::getLocale() == 'vn' ? 'selection' : '' }}">
                                <a href="{{ Route('locale', 'vn') }}" class="language__link"></a>
                                <span class="language__flag">
                                    <img src="{{ asset('assets/images/flags/vietnam.png') }}" alt="VietNamese">
                                </span>
                                <span class="language__title">@lang('masterpages.header.vietnamese')</span>
                            </div>
                            <div class="language {{ App::getLocale() == 'en' ? 'selection' : '' }}">
                                <a href="{{ Route('locale', 'en') }}" class="language__link"></a>
                                <span class="language__flag">
                                    <img src="{{ asset('assets/images/flags/united-states.png') }}"
                                        alt="English (United Kingdom)">
                                </span>
                                <span class="language__title">@lang('masterpages.header.english')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open" menu="close">
                <div class="menu-icon">
                    <span class="bread-top"></span>
                    <span class="bread-bottom"></span>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <a href="{{ Route('home') }}"><img src="{{ asset('assets/images/logo/vart-logo.png') }}"
                        class="img-logo" alt="Vart"></a>
                <div class="social-list">
                    <a class="social-button" href="https://www.facebook.com/profile.php?id=100063636246876"
                        target="_blank" data-analytics-title="Share via Facebook"
                        aria-label="Share this article via Facebook (opens in new window)">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="social-button" href="https://www.youtube.com/c/vietnamvartnm" target="_blank"
                        data-analytics-title="Share via Youtube"
                        aria-label="Share this article via Youtube (opens in new window)">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <p>@lang('masterpages.header.vart')</p>
                        <ul>
                            @foreach ($getAllVart as $key => $vart)
                                <li>
                                    <a href="{{ Route('vart', $vart->vart_slug) }}}">
                                        {{ App::getLocale() == 'en' ? $vart->vart_title_en : $vart->vart_title }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <p>@lang('masterpages.header.hart')</p>
                        <ul>
                            @foreach ($getAllHart as $key => $hart)
                                <li>
                                    <a href="{{ Route('hart', $hart->hart_slug) }}">{{ $hart->hart_title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <p>@lang('masterpages.header.conference')</p>
                        <ul>
                            @foreach ($getAllConferenceCategory as $key => $conferenceCategory)
                                <li>
                                    <a
                                        href="{{ Route('conference', $conferenceCategory->conference_category_slug) }}">
                                        {{ App::getLocale() == 'en' ? $conferenceCategory->conference_category_name_en : $conferenceCategory->conference_category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__widget">
                        <p>@lang('masterpages.header.blog')</p>
                        <ul>
                            @foreach ($getAllBlogCategory as $key => $blogCategory)
                                <li><a
                                        href="{{ Route('blogCategoriesSlug', $blogCategory->blog_category_slug) }}">{{ $blogCategory->blog_category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-legal-compliance">
                <div class="footer-legal">
                    <div class="footer-legal-copyright">@lang('masterpages.footer.coppy')</div>
                </div>
                <div class="legal-compliance">
                    <h3 class="legal-compliance-title">@lang('masterpages.footer.contactInfo')</h3>
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="legal-title">VART</h3>
                            <p>@lang('masterpages.footer.phone'):<a href="tel:+0913559636"> 0913.559.636 ( @lang('masterpages.footer.mrd') )</a>
                            </p>
                            <p>@lang('masterpages.footer.email'):<a href="mailto:hoikythuatdq.yhhn.vn@gmail.com">
                                    hoikythuatdq.yhhn.vn@gmail.com</a>
                            </p>
                            <p>@lang('masterpages.footer.address'):
                                <a target="_blank" href="https://maps.app.goo.gl/7ggkU6YeGcWe1TFCA">
                                    @lang('masterpages.footer.addHN')
                                    <span class="link-maps"> ( @lang('masterpages.footer.seemaps') )</span>
                                </a>
                            </p>
                        </div>

                        <div class="col-lg-6">
                            <h3 class="legal-title">HART</h3>
                            <p>@lang('masterpages.footer.phone'):<a href="tel:+0913636541 "> 0913.636.541 ( @lang('masterpages.footer.mrv') )</a>
                            </p>
                            <p>@lang('masterpages.footer.email'):<a href="mailto:hoikythuatdq.yhhn.vn@gmail.com">
                                    hoikythuatdq.yhhn.vn@gmail.com</a>
                            </p>
                            <p>@lang('masterpages.footer.address'):
                                <a target="_blank" href="https://maps.app.goo.gl/o9JrSEV8hYYViqth7">
                                    @lang('masterpages.footer.addHCM')
                                    <span class="link-maps"> ( @lang('masterpages.footer.seemaps') )</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Page Loading -->
    <div id="loading">
        <div class="loader">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    <!-- Page Loading End-->

    <!-- scrollUp -->
    <a id="button"></a>
    <!-- scrollUp End -->

    <!-- Noti Popup -->
    <div class="notifications-popup-success">
        <div class="notifications-content">
            <div class="notifications-icon">
            </div>
            <div class="notifications-message">
                <span class="message-title">@lang('alert.masterPages.notification') !</span>
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
                <span class="message-title">@lang('alert.masterPages.notification') !</span>
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
                    <span class="message-title">@lang('alert.masterPages.notification') !</span>
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
                    <span class="message-title">@lang('alert.masterPages.notification') !</span>
                    <span class="message-text">{!! session('error') !!}</span>
                </div>
            </div>
            <i class="fas fa-times notifications-close"></i>
        </div>
    @endif
    <!-- Noti Popup -->
    <script src="{{ versionResource('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ versionResource('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ versionResource('frontend/js/jquery-ui.min.js') }}" defer></script>
    <script src="{{ versionResource('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ versionResource('frontend/js/main.js') }}"></script>
    <script src="{{ versionResource('frontend/js/jquery.nicescroll.min.js') }}" defer></script>
    <script src="{{ versionResource('frontend/js/prettify.min.js') }}" defer></script>
    @stack('js')
</body>

</html>

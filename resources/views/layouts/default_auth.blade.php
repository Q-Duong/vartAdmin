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
    <link rel="stylesheet" href="{{ versionResource('backend/css/bootstrap.min.css') }} " as="style">
    <!-- Custom CSS -->
    <link href="{{ versionResource('backend/css/style.css') }}" rel='stylesheet' type='text/css' as="style" />
    <link href="{{ versionResource('backend/css/style-responsive.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('backend/css/responsive-jqueryui.min.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('backend/css/themes-base-jquery-ui.css') }}" rel="stylesheet" as="style" />
    <link href="{{ versionResource('assets/styles/overview.built.css') }}" rel='stylesheet' type='text/css'
        as="style" />
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/essential.built.css') }}" type="text/css"
        as="style">
    <link rel="stylesheet" href="{{ versionResource('assets/styles/landing/web/unified.css') }}" type="text/css"
        as="style">
    {{-- <link rel="stylesheet" href="{{ versionResource('backend/css/morris.css') }}" type="text/css" />  --}}
    <!-- calendar -->
    <link rel="stylesheet" href="{{ versionResource('backend/css/monthly.css') }}" as="style" />
    <!-- //calendar -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css" as="style" />
    <!-- //select2 -->
    <link href="{{ versionResource('backend/css/select2.min.css') }}" rel="stylesheet" as="style" />
    @stack('css')
</head>

<body>
    <section id="container">
        @include('layouts.section.header')
        @include('layouts.section.side_bar')
        <section id="main-content">
            <section class="wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
            @include('layouts.section.footer')
        </section>
        @include('layouts.section.notification')
    </section>

    <script src="{{ versionResource('backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ versionResource('backend/js/bootstrap.js') }}"></script>
    <!-- Ux Ui -->

    <script src="{{ versionResource('backend/js/ux-ui/jquery.dcjqaccordion.2.7.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/jquery.slimscroll.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/jquery.nicescroll.min.js') }}" defer></script>
    <script src="{{ versionResource('backend/js/ux-ui/left-side.min.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/4b68e3663c.js" crossorigin="anonymous" defer></script>
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

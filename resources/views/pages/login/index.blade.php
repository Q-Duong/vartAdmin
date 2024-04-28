<!DOCTYPE html>

<head>
    <title>Login VART</title>
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
    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
    <link href="{{ asset('backend/css/login.css') }}" rel='stylesheet' type='text/css' />
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link href="{{ asset('backend/css/font-awesome.css') }}" rel="stylesheet">
    <script src="{{ asset('backend/js/jquery2.0.3.min.js') }}"></script>
</head>

<body>
    <div class="w3layouts-main">
        <h2>@lang('auth.login')</h2>
        @if (session('error'))
            <div class="alert alert-danger">{!! session('error') !!}</div>
        @endif

        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="input-control" name="account_username" placeholder="@lang('auth.fill_email')"
                    required="" value="{{ old('account_username') }}">
            </div>
            <div class="form-group">
                <input type="password" class="input-control" name="account_password" placeholder="@lang('auth.fill_password')"
                    required="" id="password_login">
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <i class="fa-styling fa fa-eye-slash " id="toggleEye"></i>
                </div>
            </div>
            {{-- <span><input type="checkbox" />Nhớ lần đăng nhập tới</span>
            <h6><a href="#">Quên mật khẩu</a></h6> --}}
            <button type="submit" class="primary-btn-submit">@lang('auth.login')</button>
        </form>
    </div>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/js/jquery.scrollTo.js') }}"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert-success').fadeOut('fast');
        }, 3000);
    });

    const toggleEye = document.querySelector("#toggleEye");
    const password_login = document.querySelector("#password_login");

    toggleEye.addEventListener("click", function() {
        const type = password_login.getAttribute("type") === "password" ? "text" : "password";
        password_login.setAttribute("type", type);
        this.classList.toggle("fa-eye");
        this.classList.toggle("fa-eye-slash");
    });
</script>

</html>

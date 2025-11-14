


<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href="{{ $imgLogo }}" type="image/x-icon">
    <link rel='icon' href="{{ $imgLogo }}" type="image/x-icon">
    <title>Thư mời</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            width: 100%;
        }

        p {
            font-weight: 600;
        }

        .main {
            position: relative;
        }

        .background {
            margin: -50px
        }

        .background img {
            width: 100%;
            height: 100%;
        }

        .content {
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
        }

        .block-title {
            width: 100%;
        }

        .title-logo {
            height: 85px;
            width: 85px;
            float: left;
            margin-right: 10px;
            margin-top: -25px;
            margin-left: -15px
        }

        .title-name {
            text-align: left;
            text-transform: uppercase;
            color: #ffffff;
            font-size: 15px;
            margin-top: 5px;
        }

        .attendance-time {
            clear: both;
            width: 90%;
            text-align: right;
            font-style: italic;
            margin: 10px 0;
        }

        .title {
            text-align: center;
            color: #1545a6;
        }

        .dear {
            font-style: italic;
            color: #1545a6;
            font-size: 16px;
        }

        .name {
            text-align: center;
            color: #1545a6;
            font-size: 19px;
            margin-bottom: 10px;
        }

        .unit {
            text-align: center;
            color: #1545a6;
            text-transform: uppercase;
            font-size: 19px;
            margin-bottom: 20px;
        }

        .content-text {
            margin-bottom: 15px;
            text-align: justify;
        }

        .conference-title {
            text-transform: uppercase;
            font-size: 18px;
            text-align: center;
            color: #f01c1c;
            margin-bottom: 20px;
        }

        .topic {
            text-align: center;
            font-style: italic;
            color: #1545a6;
            font-size: 15px;
        }

        .conference-topic {
            /* text-transform: uppercase; */
            font-size: 18px;
            text-align: center;
            color: #f01c1c;
        }

        .line {
            border: 1px solid #d1d1d1;
            margin: 20px 0;
        }

        .content-text-sub {
            text-align: justify;
            font-weight: normal;
            margin-bottom: 10px
        }

        .content-strong {
            color: #1545a6;
            font-weight: 700;
        }


        .sub-content {
            margin-left: 40px;
        }

        .img-signature {
            height: 100px;
            width: 180px;
            margin-left: 60px
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="background">
            <img src="{{ $imgBackground }}">
        </div>
        <div class="content">
            <div class="block-title">
                <img src="{{ $imgLogo }}" class="title-logo">
                <h4 class="title-name">CHI HỘI KỸ THUẬT ĐIỆN QUANG VÀ Y HỌC HẠT NHÂN KHU VỰC PHÍA BẮC</h4>
            </div>
            <div>
                <h2 class="title">THƯ MỜI</h2>
            </div>
            <div class="dear">
                <b>Kính mời:</b>
            </div>
            <div class="name"><b> {{ $title }}. {{ $fullName }}</b></div>
            <div class="unit"><b> {{ $unit }}</b></div>
            <div class="content-text">
                Chúng tôi rất vui được mời Quý đại biểu tham dự:
            </div>
            <div class="conference-title">
                <b>Hội nghị Khoa học Quốc tế kỹ thuật Điện quang, Y học hạt nhân và Xạ trị lần thứ VIII - khu vực phía Bắc (mở rộng)</b>
            </div>
            <div class="topic"><b>Chủ đề:</b></div>
            <div class="conference-topic"><b>"Kết Nối - Chuyển Đổi - Phát Triển Bền Vững"</div>
            <div class="line"></div>
            <div class="section-location">
                <div class="content-text-sub">
                    <span class="content-strong">Thời gian:</span> Ngày 05,06/12/2024 (Thứ Sáu và Thứ Bảy)
                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Địa điểm tổ chức:</span> Celina Peninsula, Đường Võ Nguyên Giáp, phường Đồng Hới, tỉnh Quảng Trị (Quảng Bình cũ).
                </div>
                <div class="content-text-sub">Quý đại biểu sẽ được miễn phí: Phí tham gia, Tiệc chào mừng, Gala dinner, Giấy
                    chứng nhận tham gia hội
                    nghị, Chỗ ở trong 2 đêm (20/06 và 21/06).</div>
                <div class="content-text-sub">
                    Để biết thêm thông tin và đăng ký, vui lòng truy cập website tại <a
                        href="https://vart.vn/conference/hoi-nghi-trong-nuoc/hoi-nghi-khoa-hoc-quoc-te-ky-thuat-dien-quang-y-hoc-hat-nhan-va-xa-tri-lan-thu-viii-khu-vuc-phia-bac">https://vart.vn</a>.
                    Sự
                    có mặt của Quý vị là niềm cổ vũ, động viên to lớn, góp phần quan trọng để tổ chức hội nghị thành
                    công.
                </div>
            </div>
            <div class="line"></div>
            <div class="section-contact">
                <div class="content-text">
                    <div class="content-text-sub">
                        <b>Quý đại biểu cần thêm thông tin vui lòng liên hệ:</b>
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Nguyễn Cao Cường</span> - 0942.921.444 - Hỗ trợ thông tin CME.
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Nguyễn Quang Trung</span> - 0986.024.192 - Hỗ trợ thông tin HN.
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div style="margin-left: 50%; margin-top: 0px;">
                <div style="text-align: center;"><b>TM. Ban Thường Vụ chi Hội </b></div>
                <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                <img src="{{ $imgSign }}" class="img-signature">
                <div style="text-align: center;"><b>Ths.Phạm Nhật Yên</b></div>
            </div>
        </div>
    </div>
</body>

</html>

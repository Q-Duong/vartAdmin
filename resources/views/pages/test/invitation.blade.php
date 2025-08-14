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
            font-size: 16px;
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
            font-size: 20px;
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
                <h4 class="title-name">CHI HỘI KỸ THUẬT ĐIỆN QUANG VÀ Y HỌC HẠT NHÂN VIỆT NAM</h4>
            </div>
            <div>
                <h2 class="title">THƯ MỜI </h2>
            </div>
            <div class="dear">
                <b>Kính mời:</b>
            </div>
            <div class="name"><b> {{ $degree }}. {{ $fullName }}</b></div>
            <div class="unit"><b> {{ $unit }}</b></div>

            <div class="content-text">
                Chúng tôi rất vui được mời Quý đại biểu tham dự:
            </div>
            <div class="conference-title">
                <b>Hội Thảo Khoa học ISRRT RT-RTT
                    Kỹ Thuật Hình Ảnh Y Học và Kỹ Thuật Xạ Trị
                </b>
            </div>
            <div class="topic"><b>Chủ đề:</b></div>
            <div class="conference-topic"><b>"Chuẩn hóa theo thế giới về Kỹ thuật Hình ảnh Y học và Xạ trị và hiểu sâu
                    trí tuệ nhân tạo chuyên nghành"</br></div>
            <div class="line"></div>
            <div class="section-location">
                <div class="content-text-sub">
                    <span class="content-strong">Thời gian:</span> Thứ Bảy, ngày 25/10/2025
                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Địa điểm tổ chức:</span> Hội Trường Bệnh viện Đại học Y Dược Shingmark,
                    Đồng Nai.<br>
                    1054 Quốc lộ 51, Phường Long Hưng, Tỉnh Đồng Nai.
                </div>

                <div class="content-text-sub">
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
                        <span class="content-strong">CN. Huỳnh Quốc Dương</span> - 0943.705.326 - Đăng ký tham dự.
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Võ Nguyễn Thúy An</span> - 0988.608.146 - Chuyển khoản.
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Lục Thanh Vũ</span> - 0913.636.541 - Thư mời, giấy chứng nhận.
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div style="margin-left: 50%; margin-top: 0px;">
                <div style="text-align: center;"><b>TM. Ban Thường Vụ Liên chi Hội </b></div>
                <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                <img src="{{ $imgSign }}" class="img-signature">
                <div style="text-align: center;"><b>Ths.Thái Văn Lộc</b></div>
            </div>
        </div>
    </div>
</body>

</html>

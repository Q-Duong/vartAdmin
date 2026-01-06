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

        .content-strong-white {
            font-weight: 700;
            color: #ffffff;
        }


        .sub-content {
            margin-left: 40px;
        }

        .signature-block{
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .img-signature {
            height: 100px;
            width: 180px;
            margin-left: 60px
        }

        .img-signature-left{
            height: 75px;
            width: 155px;
            margin-left: 60px
        }

        .signature-left {
            float: left;
            width: 40%;
        }
        .signature-right {
            float: right;
            width: 40%;
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
                <h4 class="title-name">Chi Hội kỹ thuật xạ trị Thành phố Hồ Chí Minh</h4>
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
                <b>Hội Nghị Khoa Học Thường Niên Chi Hội Kỹ Thuật Xạ Trị Tp. Hồ Chí Minh Lần 3
                </b>
            </div>
            <div class="topic"><b>Chủ đề:</b></div>
            <div class="conference-topic"><b>"Phương pháp tiếp cận đa ngành trong xạ trị và quản lý chuyển động xạ trị
                    vùng ngực và bụng"</br></div>
            <div class="line"></div>
            <div class="section-location">
                <div class="content-text-sub">
                    <span class="content-strong">Thời gian:</span> Ngày thứ Sáu 13/03/2026 từ 13:00-17:00 (Hội thảo tiền
                    hội nghị)</br>
                    <span class="content-strong-white">Thời gian:</span> Ngày thứ Bảy 14/03/2026 từ 8:00-17:00 (Hội nghị
                    chính thức)

                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Địa điểm:</span> Hội trường Bệnh viện FV
                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Địa chỉ:</span> Số 06 Nguyễn Lương Bằng, Phường Tân Mỹ, TP. Hồ Chí
                    Minh.
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
                        <span class="content-strong">CN. Lục Thanh Vũ, TTK hội HART</span> - ĐT: 0913.636.541.
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Nguyễn Trần Tấn Du, Phó CT Chi hội</span> - ĐT: 0797.819.433.
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">CN. Nguyễn Thế Ngọc, TTK Chi hội HRTTA</span> - ĐT: 0397.530.456.
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div class="signature-block">
                <div class="signature-left">
                    <div style="text-align: center;"><b>Hội Kỹ thuật Hình ảnh Y học TP. HCM</b></div>
                    <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                    <img src="{{ $imgSign['hart'] }}" class="img-signature-left">
                    <div style="text-align: center;"><b>Ths.Thái Văn Lộc</b></div>
                </div>
                <div class="signature-right">
                    <div style="text-align: center;"><b>TM. BAN THƯỜNG VỤ CHI HỘI<b></div>
                    <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                    <img src="{{ $imgSign['hrtta'] }}" class="img-signature">
                    <div style="text-align: center;"><b>Ths. Phàng Đức Tín</b></div>
                </div>
            </div>
            {{-- <div style="margin-left: 50%; margin-top: 0px;">
                <div style="text-align: center;"><b>TM. Ban Thường Vụ Hội </b></div>
                <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                <img src="{{ $imgSign }}" class="img-signature">
                <div style="text-align: center;"><b>Ths.Thái Văn Lộc</b></div>
            </div> --}}
        </div>
    </div>
</body>

</html>

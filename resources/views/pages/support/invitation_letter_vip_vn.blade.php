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

        .block-title {
            width: 100%;
        }

        .title-logo {
            height: 60px;
            width: 60px;
            float: left;
            margin-right: 10px;
        }

        .title-name {
            text-align: left;
            text-transform: uppercase;
            font-size: 14px;
        }

        .attendance-time {
            clear: both;
            width: 90%;
            text-align: right;
            font-style: italic;
            margin: 30px 0;
        }

        .title {
            text-align: center;
            color: #601e89;
        }

        .content {
            width: 86%;
            margin: 40px auto;
        }

        .dear {
            margin-bottom: 20px;
        }

        .content-main {
            margin-bottom: 30px;
            text-align: justify;
        }

        .sub-content {
            margin-left: 30px;
        }

        .signature {
            margin-top: 130px;
        }

        .img-signature {
            position: absolute;
            bottom: -60px;
            left: -70px;
            right: 0;
            width: 120%;
        }
    </style>
</head>

<body>
    <div class="block-title">
        <img src="{{ $imgLogo }}" class="title-logo">
        <h4 class="title-name">HỘI KỸ THUẬT ĐIỆN QUANG VÀ Y HỌC HẠT NHÂN VIỆT NAM</h4>
    </div>
    <div class="attendance-time">
        <strong>Huế, ngày {{ \Carbon\Carbon::now()->day }} tháng {{ \Carbon\Carbon::now()->month }} năm
            {{ \Carbon\Carbon::now()->year }}</strong>
    </div>
    <div>
        <h3 class="title">THƯ MỜI THAM GIA HỘI NGHỊ THƯỜNG NIÊN VART 2024</h3>
    </div>
    <div class="content">
        <div class="dear">
            Kính gửi<strong> {{ $title }} {{ $fullName }}</strong>,
        </div>
        <div class="main">
            <div class="content-main">
                Hội nghị quốc tế kỹ thuật điện quang và y học hạt nhân Việt Nam lần thứ 12 vào ngày
                <strong>21-22/06/2024</strong> tại <strong>Đại học Y Dược Huế</strong>, Thành Phố Huế, Việt Nam.
            </div>
            <div class="content-main">
                Bạn sẽ được miễn phí: Phí tham gia, Tiệc chào mừng, Gala dinner, Giấy chứng nhận tham gia hội
                nghị, Chỗ ở trong 2 đêm (21 và 22/6) checkin 21/06 và checkout ngày 23/06.
            </div>
            <div class="content-main">
                Quý quan khách cần thêm thông tin gì vui lòng liên hệ:
                <div class="sub-content">
                    <strong>Khu vực miền Bắc:</strong> Mr. Nguyễn Cao Cường - Zalo: 0942921444
                </div>
                <div class="sub-content">
                    <strong>Khu vực miền Trung:</strong> Mr. Lưu Trí Dũng - Zalo: 0904234310
                </div>
                <div class="sub-content">
                    <strong>Khu vực miền Nam:</strong> Mr. Lục Thanh Vũ - Zalo: 0913636541
                </div>
            </div>
        </div>
        <div class="signature">
            <strong>Trân trọng,</strong>
        </div>
    </div>
    <img src="{{ $imgSign }}" class="img-signature">
</body>

</html>

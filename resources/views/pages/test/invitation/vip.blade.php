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
                <h4 class="title-name">Viet Nam Assosiation Of Radiological Technologists</h4>
            </div>
            <div>
                <h2 class="title">INVITATION LETTER</h2>
            </div>
            <div class="dear">
                <b>Dear:</b>
            </div>
            <div class="name"><b> {{ $title }} {{ $fullName }}</b></div>
            <div class="unit"><b> {{ $unit }}</b></div>

            <div class="content-text">
                It is our great pleasure to invite you to participate in the upcoming:
            </div>
            <div class="conference-title">
                <b>Hội nghị Khoa học Kỹ Thuật Hình Ảnh Y Học Toàn
                    Quốc lần thứ 14</b>
            </div>
            <div class="topic"><b>Chủ đề:</b></div>
            <div class="conference-topic"><b>"Kỷ nguyên Trí tuệ nhân tạo đã bắt đầu và tác động đến<br> Kỹ thuật hình
                    ảnh y
                    học"</div>
            <div class="line"></div>
            <div class="section-location">
                <div class="content-text-sub">
                    <span class="content-strong">Date:</span> 20 June, 2026
                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Venue:</span> Royal Lotus Convention Center - 120A Nguyen
                    Van
                    Thoai, My An, Da Nang, Vietnam.
                </div>
                <div class="content-text-sub">
                    <span class="content-strong">Welcome Dinner:</span> Royal Lotus Convention Center - 18:00, 19 June, 2026.
                </div>
                <div class="content-text-sub">
                    Your presence will be a great source of encouragement and will play a vital role in the success of this conference.
                </div>
            </div>
            <div class="line"></div>
            <div class="section-contact">
                <div class="content-text">
                    <div class="content-text-sub">
                        <b>Should delegates require any further inquiries, please kindly contact:</b>
                    </div>
                    <div class="content-text-sub">
                        <span class="content-strong">Mr. Luu Tri Dung (Dung) - Head of the International Relations subcommittee</span>
                        <div><span class="content-strong">Email:</span> tridungbvc@gmail.com<span class="content-strong"> - WhatsApp/Zalo:</span> +84904234310</div>
                    </div>
                    
                    <div class="content-text-sub">
                        <span class="content-strong">Mr. Phan Hoai Phuong (Paul) - International Director</span>
                        <div><span class="content-strong">Email:</span> phuongmatlab@gmail.com<span class="content-strong"> - Zalo/Line:</span> +84915767101</div>
                    </div>
                </div>
            </div>
            <div class="line"></div>
            <div style="margin-left: 50%; margin-top: 0px;">
                <div style="text-align: center;"><b>Sincerely,</b></div>
                <img src="{{ $imgSign }}" class="img-signature">
                <div style="text-align: center;"><b>Thai Van Loc</b></div>
                <div style="text-align: center;"><b>VART chairman</b></div>
            </div>
        </div>
    </div>
</body>

</html>
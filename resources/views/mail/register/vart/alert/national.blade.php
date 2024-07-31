<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invitation Letter</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
</head>

<body
    style="font-family: SF Pro Display, SF Pro Icons, Helvetica Neue, Helvetica, Arial, sans-serif; width: 100%; height: 100%; background: #f5f5f7;margin: 0;">
    <div style="margin: 0 auto; width: 600px; padding: 40px 0">
        <a href="https://vart.vn/"
            style="display: flex; margin: 0 auto; width: 96px; text-decoration: none; color: #601e89;">
            <img src="https://images.vart.vn/gmail/vart-logo.png" style="height: 50px; width: 50px;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                VART
            </h4>
        </a>
    </div>
    <div
        style="background: #ffffff;border-radius: 20px;padding: 20px;  width: 700px; margin: 0 auto; position: relative;">
        <div style="display: flex; align-items: center;">
            <img src="https://images.vart.vn/gmail/vart-logo.png" style="height: 50px; width: 50px; float: left;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                CHI HỘI KỸ THUẬT ĐIỆN QUANG VÀ Y HỌC HẠT NHÂN VIỆT NAM
            </h4>
        </div>
        <div style="text-align: right; font-style: italic; margin: 40px 50px; font-size: 15px;">
            <strong>Huế, ngày {{ \Carbon\Carbon::now()->day }} tháng {{ \Carbon\Carbon::now()->month }} năm
                {{ \Carbon\Carbon::now()->year }}</strong>
        </div>
        <div>
            <h3 style="text-align: center; color: #601e89;">
                XÁC NHẬN NỘP BÀI BÁO CÁO
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Kính gửi<strong> {{ $gender == 0 ? 'Ông' : 'Bà' }} <span
                        style=" text-transform: uppercase">{{ $name }}</span></strong>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Cảm ơn <strong>{{ $gender == 0 ? 'Ông' : 'Bà' }} <span
                                style="text-transform: uppercase">{{ $name }}</span></strong></span> đã đăng ký tham gia và nộp bài thành công.
                    <br><strong>"Hội nghị Kỹ Thuật Hình Ảnh Y Học Toàn Quốc lần thứ 12"</strong> 
                    <br>Phiên báo cáo toàn thể ngày 22 tháng 06 năm 2024 lúc 8:30-17:00. Thông báo bình duyệt bài thành công sẽ được gửi đến email đăng ký từ 20-30/05/2024.
                </div>
                
                <div style="margin-bottom: 25px; text-align: justify;">
                    Trân trọng,
                </div>
            </div>
        </div>
    </div>
    <div style="margin: 0 auto; width: 600px; padding: 40px 0">
        <div style="display: flex; margin: 0 auto; width: 244px; font-size: 13px">
            <a href="https://vart.vn/vart" style="color: #601e89;">VART</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/hart" style="color: #601e89;">HART</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/conference" style="color: #601e89;">Conference</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/forum" style="color: #601e89;">Forum</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/blog" style="color: #601e89;">Blog</a>
        </div>
        <div style="text-align: center; margin-top: 25px ; font-size: 13px">Bản quyền © Vart.
            {{ \Carbon\Carbon::now()->year }} Bảo lưu mọi quyền.</div>
        <div style="text-align: center; margin-top: 5px ; font-size: 13px">Bệnh viện Bạch Mai Hà Nội, 78 Đường Giải
            Phóng,
            Phường Phương Mai, Quận Đống Đa, Hà Nội.</div>
    </div>
</body>

</html>

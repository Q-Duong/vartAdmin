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
            <img src="https://images.vart.vn/gmail/hart-logo.png" style="height: 50px; width: 50px;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                HART
            </h4>
        </a>
    </div>
    <div
        style="background: #ffffff;border-radius: 20px;padding: 20px;  width: 700px; margin: 0 auto; position: relative;">
        <div style="display: flex; align-items: center;">
            <img src="https://images.vart.vn/gmail/hart-logo.png" style="height: 50px; width: 50px; float: left;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                LIÊN CHI HỘI KỸ THUẬT HÌNH ẢNH Y HỌC THÀNH PHỐ HỒ CHÍ MINH
            </h4>
        </div>
        <div style="text-align: right; font-style: italic; margin: 40px 50px; font-size: 15px;">
            <b>TP. Hồ Chí Minh, ngày {{ \Carbon\Carbon::now()->day }} tháng {{ \Carbon\Carbon::now()->month }} năm
                {{ \Carbon\Carbon::now()->year }}</b>
        </div>
        <div>
            <h3 style="text-align: center; color: #601e89;">
                    THƯ MỜI THAM GIA BÁO CÁO
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Kính gửi<b> {{ $title == 0 ? 'Ông' : 'Bà' }} <span
                        style=" text-transform: uppercase">{{ $name }}</span></b>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Cảm ơn <b>{{ $title == 0 ? 'Ông' : 'Bà' }} <span
                                style="text-transform: uppercase">{{ $name }}</span></b></span> đã đăng ký
                    tham gia.
                    <div style="text-align: center;">
                        <br><b>"Xu thế Kỹ thuật hình ảnh y học từ nghiên cứu đến thực
                            hành"</b>
                    </div>
                    <br>Ban tổ chức xin thông báo: Bài báo cáo của Quý đại biểu đã được bình duyệt và mời Quý đại biểu tham dự báo cáo.
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Quý đại biểu có thể bấm vào đường <a href="https://vart.vn/invitation"
                        target="_blank"><b>Link</b></a> và điền <b>Mã code: {{$code}}</b>
                    để lấy thư mời.
                </div>
                <div style="margin-left: 50%;">
                    <div style="text-align: center;"><b>TM.BAN THƯỜNG VỤ LIÊN CHI HỘI</b></div>
                    <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                    <img src="https://images.vart.vn/gmail/sign-hart.png"
                        style="height: 70px; width: 120px; margin-left: 90px">
                    <div style="text-align: center;"><b>Ths.Thái Văn Lộc</b></div>
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
        <div style="text-align: center; margin-top: 25px ; font-size: 13px">Bản quyền © Hart.
            {{ \Carbon\Carbon::now()->year }} Bảo lưu mọi quyền.</div>
        <div style="text-align: center; margin-top: 5px ; font-size: 13px">Bệnh viện Đại học Y Dược Tp.HCM-CS2, 201
            Nguyễn Chí Thanh, Phường 12, Quận 5, TP.HCM.</div>
    </div>
</body>

</html>

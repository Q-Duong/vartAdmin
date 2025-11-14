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
            style="display: flex; margin: 0 auto; width: 112px; text-decoration: none; color: #601e89;">
            <img src="https://images.vart.vn/gmail/nvart-logo.png" style="height: 50px; width: 56px;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                NVART
            </h4>
        </a>
    </div>
    <div
        style="background: #ffffff;border-radius: 20px;padding: 20px;  width: 700px; margin: 0 auto; position: relative;">
        <div style="display: flex; align-items: center;">
            <img src="https://images.vart.vn/gmail/nvart-logo.png" style="height: 50px; width: 56px;">
            <h4 style="text-align: left; text-transform: uppercase; font-size: 14px; margin-left: 10px;">
                CHI HỘI KỸ THUẬT ĐIỆN QUANG VÀ Y HỌC HẠT NHÂN KHU VỰC PHÍA BẮC
            </h4>
        </div>

        <div>
            <h3 style="text-align: center; color: #601e89;">
                THƯ MỜI THAM GIA HỘI NGHỊ
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Kính gửi<strong> {{ $title == 0 ? 'Ông' : 'Bà' }} <span
                        style=" text-transform: uppercase">{{ $name }}</span></strong>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify; line-height: 1.38em;">
                    <span style="margin-left: 30px;">Thay mặt Ban tổ chức, Chúng tôi trân trọng kính mời
                        <strong>{{ $title == 0 ? 'Ông' : 'Bà' }} <span
                                style="text-transform: uppercase">{{ $name }}</span></strong> đến tham dự</span>
                    <div style="text-align: center;">
                        <br><b>"{{ $conference_title }}"</b>
                    </div>
                    <div style="margin-top: 25px;"><b>Hình thức tham dự:</b></div>
                    <div style="margin-top: 15px; text-align: center; color: #27c24c;"><b>TRỰC TUYẾN</b></div>
                    <div style="margin-top: 25px;"><b>Thời gian:</b> Ngày 05,06/12/2025 (Thứ Sáu và Thứ Bảy)</div>
                </div>
                {{-- <div style="margin-bottom: 25px; text-align: justify;">
                    Quý đại biểu có thể bấm vào đường <a href="https://vart.vn/invitation"
                        target="_blank"><strong>Link</strong></a> và điền <strong>Mã code: {{ $code }}</strong>
                    để lấy thư mời.
                </div> --}}
                <div style="margin-bottom: 25px; text-align: justify;">
                    Link trực tuyến sẽ gửi qua email đăng ký trước ngày diễn ra hội nghị 1 - 3 ngày. Vui lòng kiểm tra
                    Mail.
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Chúng tôi rất trân trọng sự quan tâm, tham gia và đóng góp quý báu của đại biểu cho hội nghị.
                </div>
                <div style="margin-left: 50%;">
                    <div style="text-align: center;"><strong>TM. BAN THƯỜNG VỤ CHI HỘI</strong></div>
                    <div style="text-align: center;"><strong>CHỦ TỊCH</strong></div>
                    <img src="https://images.vart.vn/gmail/sign-nvart.png"
                        style="height: 70px; width: 150px; margin-left: 70px">
                    <div style="text-align: center;"><strong>Ths. Phạm Nhật Yên</strong></div>
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

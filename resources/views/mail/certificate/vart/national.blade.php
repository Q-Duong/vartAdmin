<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate</title>
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
        <div>
            <h3 style="text-align: center; color: #601e89;">
                GIẤY CHỨNG NHẬN CME HỘI NGHỊ 2025 - ĐÀ NẴNG
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Kính gửi<b> {{ $title == 0 ? 'Ông' : 'Bà' }} <span
                        style=" text-transform: uppercase">{{ $name }}</span></b>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Chi hội Kỹ Thuật Điện Quang và Y Học Hạt Nhân Việt Nam trân trọng
                        cảm ơn {{ $title == 0 ? 'Ông' : 'Bà' }} {{ $name }} đã quan tâm và đăng ký tham dự.
                        <div style="text-align: center;">
                            <br><b>"{{ $conference_title }}"</b>
                        </div>
                        <div style="margin-top: 25px;">• Vui lòng mở file đính kèm: Giấy chứng nhận Hội nghị 2025 tại Đà Nẵng.</div>
                        <div style="margin-top: 10px;">• Chấp hành chủ trương của Đảng và Chính phủ về chuyển đổi số: 
                            <div style="margin-top: 10px; margin-left: 30px;">- Đề nghị Quý đại biểu lưu và in file đính kèm để Sở Y tế kiểm tra.</div>
                            <div style="margin-top: 10px; margin-left: 30px;">- Ban tổ chức không khuyến khích việc sử dụng bảng cứng, nhưng nếu một số địa phương vẫn cần, vui lòng phản hồi email để Ban tổ chức gửi bảng cứng về địa chỉ đại biểu đã đăng ký.</div>
                        </div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Chúng tôi rất trân trọng sự quan tâm, tham gia và đóng góp quý báu của đại biểu cho hội nghị.
                </div>
                <div style="margin-left: 50%;">
                    <div style="text-align: center;"><b>TM.BAN THƯỜNG VỤ LIÊN CHI HỘI</b></div>
                    <div style="text-align: center;"><b>CHỦ TỊCH</b></div>
                    <img src="https://images.vart.vn/gmail/sign-vart.png"
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

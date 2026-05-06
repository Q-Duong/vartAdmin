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

        <div>
            <h3 style="text-align: center; color: #601e89;">
                THƯ MỜI THAM GIA BÁO CÁO
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Kính gửi<b> {{ $title == 0 ? 'Ông' : 'Bà' }} <span>{{ $name }}</span></b>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Chi hội Kỹ Thuật Điện Quang và Y Học Hạt Nhân Việt Nam trân trọng
                        cảm ơn {{ $title == 0 ? 'Ông' : 'Bà' }} {{ $name }} đã quan tâm và đăng ký bài báo cáo
                        tham dự.
                        <div style="text-align: center;">
                            <br><b>"{{ $conference_title }}"</b>
                        </div>
                        <div style="margin-top: 25px;">Chúng tôi xin thông báo:</div>
                        <div style="margin-top: 15px; text-align: center; color: #27c24c;"><b>BÀI BÁO CÁO ĐÃ ĐƯỢC PHÊ
                                DUYỆT</b></div>
                </div>
                @if ($suggestedAddition)
                    <div style="margin-bottom: 15px;">
                        <div style="margin-bottom: 15px;"><b>Ban chuyên môn xin gửi tới quý báo cáo viên nội dung góp
                                ý/nhận xét như sau:
                        </div>
                        <div
                            style="margin-bottom: 15px; background: #f5f5f7; border-radius: 18px; border: 1px solid rgba(0, 0, 0, 0.16); padding: 20px;">
                            {{ $suggestedAddition }}</div>
                    </div>
                @endif
                
                <div style="margin-bottom: 15px;">Báo cáo viên vui lòng gửi bài báo cáo hoàn chỉnh trước ngày
                    01/06/{{ \Carbon\Carbon::now()->year }} qua <a href="https://forms.gle/Zj6Tm76qzjFzYa4u5"
                        target="_blank">
                        <b>Link</b></a></div>
                <div>
                    <div style="margin-bottom: 15px;"><b>Lưu ý:</b></div>
                    <div style="margin-left: 30px;">
                        <div style="margin-bottom: 15px;"><b>1. Chuẩn bị bài thuyết trình và Poster:</b>
                            <div style="margin-left: 15px;">
                                <p>&nbsp;•&nbsp; Quý báo cáo viên vui lòng sử dụng mẫu (template) chính thức của Ban tổ
                                    chức. Tải tại: <a
                                        href="https://drive.google.com/drive/folders/1Heq4iZf0XRAzoZbYuUq8s1UBHNHA9qV4?usp=sharing"
                                        target="_blank"><b>Link</b></a></p>
                                <p>&nbsp;•&nbsp; <b>Quy định đặt tên file:</b> Lĩnh vực - Tên bài báo cáo - Tên báo cáo
                                    viên

                                </p>
                                <div style="margin-top: -10px; margin-left: 20px;"><i>(Ví dụ: MRI - Kỹ thuật chụp -
                                        Nguyễn Văn A)</i></div>
                            </div>
                        </div>

                        <div style="margin-bottom: 5px;"><b>2. Cập nhật thông tin và quyền lợi:</b>
                            <div style="margin-left: 15px;">
                                <p>&nbsp;•&nbsp; Để nhận các thông báo mới nhất và đảm bảo quyền lợi dành riêng cho báo
                                    cáo viên, kính mời quý vị tham gia nhóm Zalo tại: <a
                                        href="https://zalo.me/g/iey2x9trpqwosw59qc4c" target="_blank"><b>Link</b></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 15px;; margin-bottom: 25px;">
                    <b>Thông tin liên hệ:</b>
                    <div style="margin-left: 15px;">
                        <p>&nbsp;•&nbsp; Thư ký: <b>CN. Phan Văn Thường</b> – SĐT: <b>0349 510 177</b>
                        </p>
                    </div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Ban tổ chức trân trọng cảm ơn sự quan tâm và đóng góp quý báu của quý báo cáo viên cho thành công
                    của hội nghị.
                </div>
                <div style="margin-left: 50%;">
                    <div style="text-align: center;"><b>TM. BAN THƯỜNG VỤ LIÊN CHI HỘI</b></div>
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
        <div style="text-align: center; margin-top: 25px ; font-size: 13px">Bản quyền © Vart.
            {{ \Carbon\Carbon::now()->year }} Bảo lưu mọi quyền.</div>
        <div style="text-align: center; margin-top: 5px ; font-size: 13px">Bệnh viện Bạch Mai Hà Nội, 78 Đường Giải
            Phóng,
            Phường Phương Mai, Quận Đống Đa, Hà Nội.</div>
    </div>
</body>

</html>

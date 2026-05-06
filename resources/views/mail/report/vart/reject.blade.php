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
                THÔNG BÁO
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
                        <div style="margin-top: 25px;">Sau quá trình đánh giá nghiêm túc và khách quan của Hội đồng phản
                            biện, Ban chuyên môn rất tiếc phải thông báo rằng bài báo cáo của quý đồng nghiệp:</div>
                        <div style="margin-top: 15px; text-align: center; text-transform: uppercase;color: #e53637;">
                            <b>chưa phù hợp để trình bày tại hội nghị lần này</b></div>
                </div>
                <div style="margin-bottom: 15px;">
                    <div style="margin-bottom: 15px;"><b>Lý do từ chối:</b>
                    </div>
                    <div
                        style="margin-bottom: 15px; background: #f5f5f7; border-radius: 18px; border: 1px solid rgba(0, 0, 0, 0.16); padding: 20px;">
                        {{ $reasonRejection }}</div>
                </div>

                <div style="margin-bottom: 15px; text-align: justify;">
                    Đây là một quyết định khó khăn đối với Hội đồng vì bài viết của quý vị có những góc nhìn đáng ghi
                    nhận. Tuy nhiên, do giới hạn về thời lượng chương trình cũng như các tiêu chí chuyên môn đặc thù của
                    năm nay, Hội đồng chưa thể lựa chọn báo cáo này.
                </div>

                <div style="margin-bottom: 15px; text-align: justify;">
                    Ban tổ chức rất trân trọng nỗ lực và tâm huyết của quý đồng nghiệp dành cho hội nghị. Rất mong quý
                    vị tiếp tục nghiên cứu, hoàn thiện và gửi bài tham dự trong các kỳ hội nghị tiếp theo.
                </div>

                <div style="margin-bottom: 25px;">
                    Trân trọng cảm ơn và kính chúc quý đồng nghiệp sức khỏe và thành công.
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

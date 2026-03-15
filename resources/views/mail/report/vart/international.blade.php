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
                Vietnam Association of Radiological Technologists
            </h4>
        </div>
        <div>
            <h3 style="text-align: center; color: #601e89; text-transform: uppercase;">
                Presentation Invitation Letter
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Dear<strong> {{ $title }} {{ $name }}</strong>,
            </div>
            <div>
                <div style="margin: 10px 0 10px 0; text-align: justify;">
                    <span style="margin-left: 30px;">On behalf of the Vietnam Association of Radiological Technologists (VART), we would like to sincerely thank you for your interest in our upcoming event.</span>
                </div>
                <div style="margin-bottom: 5px; text-align: justify;">
                    <span style="margin-left: 30px;">We are pleased to inform you that your registration for <b>{{ $conference_title }}</b> has been successfully received. We look forward to welcoming you to the event.</span>
                </div>
                <div style="margin: 20px 0 5px 0"><strong>Event Details:</strong></div>
                <div style="margin-bottom: 25px; text-align: justify; background: #f5f5f7; border-radius: 20px;padding: 20px 25px;">
                    <div style="margin: 5px 0 0 0">•&nbsp;<strong>Conference:</strong> {{ $conference_title }}</div>
                    <div style="margin: 5px 0 0 0">•&nbsp;<strong>Date:</strong> 20 June, 2026</div>
                    <div style="margin: 5px 0 0 0">•&nbsp;<strong>Venue:</strong> Royal Lotus Convention Center - 120A Nguyen Van Thoai, My An, Da Nang,
                        Vietnam.</div>
                </div>
                
                <div style="margin-bottom: 25px; text-align: justify;">
                    Should you have any further inquiries or require assistance, please do not hesitate to contact:
                    <div style="margin: 10px 0 0 30px;"><strong>Mr. Luu Tri Dung (Dung)</strong></div>
                    <div style="margin: 5px 0 0 30px;"><i>Head of the International Relations subcommittee</i></div>
                    <div style="margin: 5px 0 0 30px;"><strong>•&nbsp;Email:</strong> tridungbvc@gmail.com</div>
                    <div style="margin: 5px 0 0 30px;"><strong>•&nbsp;WhatsApp/Zalo:</strong> +84 904 234 310</div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    We appreciate your participation and look forward to seeing you at the event.
                </div>
                <div style="margin-left: 60%;">
                    <div style="text-align: center;"><strong>Sincerely, </strong></div>
                    <img src="https://images.vart.vn/gmail/sign-vart.png"
                        style="height: 70px; width: 150px; margin-left: 30px">
                    <div style="text-align: center;"><strong>Thai Van Loc</strong></div>
                    <div style="text-align: center;"><strong>VART chairman</strong></div>
                </div>
            </div>
        </div>
    </div>
    <div style="margin: 0 auto; width: 600px; padding: 40px 0">
        <div style="display: flex; margin: 0 auto; width: 244px; font-size: 13px">
            <a href="https://vart.vn/en/vart" style="color: #601e89;">VART</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/en/hart" style="color: #601e89;">HART</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/en/conference" style="color: #601e89;">Conference</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/en/forum" style="color: #601e89;">Forum</a>&nbsp;•&nbsp;
            <a href="https://vart.vn/en/blog" style="color: #601e89;">Blog</a>
        </div>
        <div style="text-align: center; margin-top: 25px ; font-size: 13px">Copyright ©
            {{ \Carbon\Carbon::now()->year }} Vart. All rights reserved.</div>
        <div style="text-align: center; margin-top: 5px ; font-size: 13px">Bach Mai Hospital Hanoi, 78 Giai Phong Street, Phuong Mai Ward, Dong Da District, Hanoi.</div>
    </div>
</body>

</html>

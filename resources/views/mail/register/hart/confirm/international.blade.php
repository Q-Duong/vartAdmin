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
                Ho Chi Minh City Association of Radiological Technologists
            </h4>
        </div>
        <div style="text-align: right; font-style: italic; margin: 40px 50px; font-size: 15px;">
            <strong>Ho Chi Minh, {{ \Carbon\Carbon::now()->isoFormat('MMMM D, Y') }}</strong>
        </div>
        <div>
            <h3 style="text-align: center; color: #601e89; text-transform: uppercase;">
                Invitation to the HART Conference
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Dear<strong> {{ $title }} {{ $name }}</strong>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Thank you very much for your interest and successful registration
                        in this activity of the HART,</span>
                    <br>Please see detailed information below:
                </div>
                <div
                    style="margin-bottom: 25px; text-align: justify; background: #f5f5f7; border-radius: 20px;padding: 20px 25px;">
                    <strong>“Trends in Medical Image Technology - Research to Practice”</strong>
                    <div>Date: September 20th-21st, 2024</div>
                    <div>Venue: Pham Ngoc Thach University of Medicine, Ho Chi Minh City, Vietnam.</div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Please click this <a href="https://vart.vn/en/invitation" target="_blank"><strong>Link</strong></a>
                    and fill in your Code: <span style="color:#0000EE; font-weight:600;">{{ $code }}</span> to receive invitation.
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    If the lady or gentleman requires any further information, feel free to contact:
                    <div style="margin: 10px 0 0 30px;">Mr. Phan Hoai Phuong (Paul) - International Director</div>
                    <div style="margin-left: 30px;">Email: phuongmatlab@gmail.com Zalo/Line: +84915767101</div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    We look forward to your presence at this conference, see you soon.
                </div>
                <div style="margin-left: 60%;">
                    <div style="text-align: center;"><strong>Sincerely, </strong></div>
                    <img src="https://images.vart.vn/gmail/sign.png"
                        style="height: 70px; width: 150px; margin-left: 40px">
                    <div style="text-align: center;"><strong>Thai Van Loc</strong></div>
                    <div style="text-align: center;"><strong>HART Chairman</strong></div>
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
            {{ \Carbon\Carbon::now()->year }} Hart. All rights reserved.</div>
        <div style="text-align: center; margin-top: 5px ; font-size: 13px">HCMC University of Medicine and Pharmacy Hospital - Campus 2, 201 Nguyen Chi Thanh, Ward 12, District 5, Ho Chi Minh City.</div>
    </div>
</body>

</html>

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
                Vietnam Association of Radiological Technologist
            </h4>
        </div>
        <div style="text-align: right; font-style: italic; margin: 40px 50px; font-size: 15px;">
            <strong>Hue, {{ \Carbon\Carbon::now()->isoFormat('MMMM D, Y') }}</strong>
        </div>
        <div>
            <h3 style="text-align: center; color: #601e89; text-transform: uppercase;">
                Confirmation letter of participation in VART12 Conference
            </h3>
        </div>
        <div style="width: 86%; margin: 50px auto;">
            <div style="margin: 0 0 20px 30px;">
                Dear<strong> {{ $en_register_title }} {{ $en_register_firstname }} {{ $en_register_lastname }}</strong>,
            </div>
            <div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    <span style="margin-left: 30px;">Thank you very much for your interest and successful registration in this activity of the 12th VART in Hue City,</span>
                    <br>Please see detailed information below:
                </div>
                <div style="margin-bottom: 25px; text-align: justify; background: #f5f5f7; border-radius: 20px;padding: 20px 25px;">
                    <strong>“The 12th National Conference of Vietnam Association of Radiological Technologist”</strong>
                    <div>Date: June 26 (Sat) 8:30-17:00</div>
                    <div>Opening: Ballroom A</div>
                    <div>International report: Ballroom B</div>
                    <div>Venue: Hue University of Medicine and Pharmacy, 06 Ngo Quyen, Hue City.</div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    Please click this <a href="https://vart.vn/en/invitation-letter" target="_blank"><strong>Link</strong></a> and fill in your full name to receive an automatic invitation.
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    If the lady or gentleman requires any further information, feel free to contact:
                    <div style="margin: 10px 0 0 30px;">Mr. Luu Tri Dung (Dung) - Head of the International Relations subcommittee</div>
                    <div style="margin-left: 30px;">Email: tridungbvc@gmail.com  WhatsApp/Zalo: +84904234310</div>
                    <div style="margin: 10px 0 0 30px;">Mr. Phan Hoai Phuong (Paul) - International Director</div>
                    <div style="margin-left: 30px;">Email: phuongmatlab@gmail.com  Zalo/Line: +84915767101</div>
                </div>
                <div style="margin-bottom: 25px; text-align: justify;">
                    We look forward to your presence at this conference, see you soon in Hue.
                </div>
                <div style="margin-left: 60%;">
                    <div style="text-align: center;"><strong>Sincerely, </strong></div>
                    <img src="https://images.vart.vn/gmail/signature.png"
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

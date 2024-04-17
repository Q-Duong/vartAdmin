<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='shortcut icon' href="{{ $imgLogo }}" type="image/x-icon">
    <link rel='icon' href="{{ $imgLogo }}" type="image/x-icon">
    <title>Invitation Letter</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: SF Pro Display, SF Pro Icons, Helvetica Neue, Helvetica, Arial, sans-serif;
            ;
            width: 100%;
        }

        p {
            font-weight: 600;
        }

        .block-title {
            width: 100%;
        }

        .title-logo {
            height: 60px;
            width: 60px;
            float: left;
            margin-right: 10px;
        }

        .title-name {
            text-align: left;
            text-transform: uppercase;
            font-size: 14px;
        }

        .attendance-time {
            clear: both;
            width: 90%;
            text-align: right;
            font-style: italic;
            margin: 30px 0;
        }

        .title {
            text-align: center;
            color: #601e89;
        }

        .content {
            width: 86%;
            margin: 40px auto;
        }

        .dear {
            margin-bottom: 20px;
        }

        .content-1 {
            margin-bottom: 25px;
            text-align: justify;
        }

        .content-2 {
            margin-bottom: 25px;
            text-align: justify;
        }

        .content-3 {
            margin-bottom: 25px;
            text-align: justify;
        }

        .content-4 {
            margin-bottom: 25px;
            text-align: justify;
        }

        .content-notice {
            font-size: 15px;
            font-weight: 200;
            text-align: justify;
        }

        .signature {
            margin-top: 30px;
        }

        .img-signature {
            position: absolute;
            bottom: -60px;
            left: -70px;
            right: 0;
            width: 120%;
        }
    </style>
</head>

<body>
    <div class="block-title">
        <img src="{{ $imgLogo }}" class="title-logo">
        <h4 class="title-name">Vietnam Association of Radiological Technologist</h4>
    </div>
    <div class="attendance-time">
        Hue, <strong>{{ $time }}</strong>
    </div>
    <div>
        <h3 class="title">INVITATION TO JOIN THE 2024 VART ANNUAL CONFERENCE</h3>
    </div>
    <div class="content">
        <div class="dear">
            Dear<strong> {{ $title }} {{ $fullName }}</strong>,
        </div>
        <div class="content-main">
            <div class="content-1">
                The Vietnam Association of Radiological Technologist will host the
                12th annual meeting on <strong>June 21-22, 2024</strong> at <strong>Hue University of Medicine
                    and Pharmacy</strong>, Hue City, Vietnam.
            </div>
            <div class="content-2">
                On behalf of the Organizing Committee of VART, it is my great pleasure
                and honor to invite <strong>{{ $title }} {{ $fullName }}</strong> to attend the academic
                activities of VART 2024 as well as have the chance to delve into the
                rich history of Hue and explore the vibrant culture of Vietnam. In the meantime, we will provide hotel
                accommodation for 1 representative at Mondial Hotel Hue for 2 nights (Check-in 21 and check-out 23).
                Conference free (Main conference day, 2 tea breaks &1 lunch box, welcome dinner, Gala dinner).
            </div>
            <div class="content-3">
                Please feel free to contact Mr. Luu Tri Dung, Head of the International
                Relations subcommittee via tridungbvc@gmail.com or WhatsApp/Zalo:
                +84904234310 for all support.
            </div>
            <div class="content-4">
                We are looking forward to receiving your participation and valuable
                contributions to the conference.
            </div>
            <div class="content-notice">
                Please note that the VART will not waive the registration fee nor support travel or accommodation.
            </div>
        </div>
        <div class="signature">
            <p>Sincerely yours,</p>
        </div>
    </div>
    <img src="{{ $imgSign }}" class="img-signature">
</body>

</html>

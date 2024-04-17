<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thư Mời</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: DejaVu Sans;
            ;
            width: 100%;
        }

        p {
            font-weight: 600;
        }

        .main {
            position: relative;
            margin: -45px
        }

        .main img {
            width: 100%;
            height: 100%;
        }

        .section-content {
            position: fixed;
            width: 54.5%;
            height: 100%;
            top: 0;
        }

        .section-name {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
        }

        .title {
            position: relative;
            margin-top: 113px;
            text-align: center;
        }

        .name {
            position: relative;
            margin-top: 19px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="section-content">
            <div class="section-name">
                <div class="title"><strong>{{ $degree }}</strong></div>
                <div class="name"><strong>{{ $fullName }}</strong></div>
            </div>
        </div>
        <img src="{{ $imgBackground }}">
    </div>
</body>

</html>

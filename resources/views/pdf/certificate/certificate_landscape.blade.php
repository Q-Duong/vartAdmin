<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            font-weight: 400;
        }

        .main {
            position: relative;
            /* margin: -45px */
        }

        .main img {
            width: 100%;
            height: 100%;
        }

        .section-content {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
        }

        .name {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 298px;
            left: 0;
            right: 0;
            font-size: 25px;
            font-weight: bold;
        }
        .birthday {
            position: absolute;
            top: 391px;
            left: 178px;
            font-size: 17px;
        }

        .unit {
            position: absolute;
            top: 429px;
            left: 223px;
            font-size: 17px;
        }

        

    </style>
</head>

<body>
    <div class="main">
        <div class="section-content">
            <div class="name">{{ $title }} {{ $name }}</div>
            {{-- <div class="birthday">{{ $birthday }}</div>
            <div class="unit">{{ $unit }}</div> --}}
        </div>
        <img src="{{ $imgBackground }}">
    </div>
</body>

</html>

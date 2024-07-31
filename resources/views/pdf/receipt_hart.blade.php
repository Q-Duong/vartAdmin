<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BIÊN LAI THU PHÍ HỘI NGHỊ/ HỘI THẢO</title>

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
            width: 100%;
            height: 100%;
            top: 0;
        }

        .name {
            position: absolute;
            top: 223px;
            left: 300px;
            font-size: 14px;
        }

        .phone {
            position: absolute;
            top: 223px;
            left: 750px;
            font-size: 14px;
        }

        .unit {
            position: absolute;
            top: 249px;
            left: 300px;
            font-size: 14px;
        }

        .address {
            position: absolute;
            top: 276px;
            left: 300px;
            font-size: 14px;
        }

        .price {
            position: absolute;
            top: 490px;
            left: 770px;
            font-size: 14px;
        }

        .total {
            position: absolute;
            top: 490px;
            left: 932px;
            font-size: 14px;
        }

        .day {
            position: absolute;
            top: 546px;
            left: 887px;
            font-size: 13px;
        }

        .month {
            position: absolute;
            top: 546px;
            left: 950px;
            font-size: 13px;
        }

        .year {
            position: absolute;
            top: 546px;
            left: 1000px;
            font-size: 13px;
        }

    </style>
</head>

<body>
    <div class="main">
        <div class="section-content">
            <div class="name"><strong>{{ $name }}</strong></div>
            <div class="phone"><strong>{{ $phone }}</strong></div>
            <div class="unit"><strong>{{ $unit }}</strong></div>
            <div class="address"><strong>{{ $address }}</strong></div>
            <div class="price"><strong>{{ $price }}</strong></div>
            <div class="total"><strong>{{ $price }}</strong></div>
            <div class="day"><strong>{{ \Carbon\Carbon::now()->day }}</strong></div>
            <div class="month"><strong>{{ \Carbon\Carbon::now()->month }}</strong></div>
            <div class="year"><strong>{{ \Carbon\Carbon::now()->year }}</strong></div>
        </div>
        <img src="{{ $imgBackground }}">
    </div>
</body>

</html>

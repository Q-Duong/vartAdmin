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
            font-weight: 400;
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
            top: 234px;
            left: 230px;
            font-size: 15px;
        }

        .phone {
            position: absolute;
            top: 234px;
            left: 810px;
            font-size: 15px;
        }

        .unit {
            position: absolute;
            top: 261px;
            left: 230px;
            font-size: 15px;
        }

        .address {
            position: absolute;
            top: 288px;
            left: 230px;
            font-size: 15px;
        }

        .fee-title{
            position: absolute;
            top: 456px;
            left: 200px;
            font-size: 14px;
        }

        .price {
            position: absolute;
            top: 456px;
            left: 780px;
            font-size: 14px;
        }

        .sub {
            position: absolute;
            top: 456px;
            left: 942px;
            font-size: 14px;
        }

        .total {
            position: absolute;
            top: 493px;
            left: 942px;
            font-size: 14px;
        }

        .day {
            position: absolute;
            top: 539px;
            left: 820px;
            font-size: 15px;
        }

        .month {
            position: absolute;
            top: 539px;
            left: 900px;
            font-size: 15px;
        }

        .year {
            position: absolute;
            top: 539px;
            left: 965px;
            font-size: 15px;
        }

    </style>
</head>

<body>
    <div class="main">
        <div class="section-content">
            <div class="name">{{ $name }}</div>
            <div class="phone">{{ $phone }}</div>
            <div class="unit">{{ $unit }}</div>
            <div class="address">{{ $address }}</div>
            <div class="fee-title">{{ $conferenceFeeTitle }}</div>
            <div class="price">{{ $price }}</div>
            <div class="sub">{{ $price }}</div>
            <div class="total"><strong>{{ $price }}</strong></div>
            <div class="day">{{ \Carbon\Carbon::now()->day }}</div>
            <div class="month">{{ \Carbon\Carbon::now()->month }}</div>
            <div class="year">{{ \Carbon\Carbon::now()->year }}</div>
        </div>
        <img src="{{ $imgBackground }}">
    </div>
</body>

</html>

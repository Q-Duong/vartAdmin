<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        
        body {
            font-family: 'Tinos', serif;
            width: 100%;
            font-weight: 400;
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

        .no {
            position: absolute;
            top: 71px;
            left: 118px;
            font-size: 13px;
            /* font-style: italic; */
        }

        /* .name {
            position: absolute;
            width: 100%;
            text-align: center;
            top: 352px;
            left: 0;
            right: 0;
            font-size: 17px;
        } */

        .name {
            position: absolute;
            top: 351px;
            left: 260px;
            font-size: 18px;
        }

        .birthday {
            position: absolute;
            top: 390px;
            left: 178px;
            font-size: 18px;
        }

        .unit {
            position: absolute;
            top: 428px;
            left: 223px;
            font-size: 18px;
        }

        

    </style>
</head>

<body>
    <div class="main">
        <div class="section-content">
            <div class="no">{{ $no }}</div>
            <div class="name">{{ $name }}</div>
            <div class="birthday">{{ $birthday }}</div>
            <div class="unit">{{ $unit }}</div>
        </div>
        <img src="{{ $imgBackground }}">
    </div>
</body>

</html>

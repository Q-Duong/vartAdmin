<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biên lai HART</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            font-family: 'DejaVu Sans', sans-serif !important;
        }

        .container {
            width: 100%;
            background-color: #ffffff;
        }

        .header img {
            width: 60px;
            height: 60px;
            float: left;
            margin-right: 20px;
        }

        .header h3 {
            margin-bottom: 15px;
            margin-top: 12px;
            font-size: 13pt;
            text-align: left;
        }

        .header h2 {
            clear: both;
            font-weight: bold;
            font-size: 16pt;
            color: #333;
            text-align: center;
        }

        .section strong {
            font-size: 12pt;
            font-style: italic;
        }

        .section p {
            margin: 0;
            font-size: 13pt;
        }

        .indented {
            padding-left: 30px;
        }

        .indented p {
            font-size: 11pt;
        }

        .info-block p {
            margin-bottom: 0px;
        }

        .info-line {
            margin-right: 200px;
        }

        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border: 2px solid black;
        }

        .payment-table th,
        .payment-table td {
            border: 1px solid black;
            padding: 3px;
            font-size: 11pt;
        }

        .payment-table th {
            background-color: #f2f2f2;
            text-align: center;
            font-weight: bold;
        }

        .payment-table td {
            text-align: center;
        }


        .payment-table tfoot td {
            font-weight: bold;
        }

        .payment-table tfoot td:nth-child(2) {
            text-align: center;
        }

        .signature-block {
            float: right;
            text-align: center;
            margin-top: 15px;
            padding-right: 50px;
        }

        .signature-block p {
            margin: 2px 0;
            font-size: 11pt;
        }

        .signature-block .date {
            font-style: italic;
        }

        .signature-block .title {
            font-weight: bold;
        }

        .signature {
            display: block;
            position: relative;
            width: 100%;
        }

        .signature-image {
            width: 250px;
            position: absolute;
            top: -10px;
            right: 50px;
        }

        .signature-block .name {
            font-weight: bold;
            margin-top: 90px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <img src="{{ $imgLogo }}" alt="Logo HART">
            <h3>HỘI KỸ THUẬT HÌNH ẢNH Y HỌC THÀNH PHỐ HỒ CHÍ MINH</h3>
            <h2>BIÊN LAI THU PHÍ HỘI THẢO/HỘI NGHỊ</h2>
        </div>

        <div class="section">
            <p><strong>I. Thông tin Ban tổ chức:</strong></p>
            <div class="indented">
                <p>Hội Kỹ thuật Hình ảnh Y học Thành phố Hồ Chí Minh</p>
                <p>Địa chỉ: 201 Nguyễn Chí Thanh, phường Chợ Lớn, Tp. Hồ Chí Minh</p>
            </div>
        </div>

        <div class="section">
            <p><strong>II. Thông tin hội nghị/ hội thảo:</strong></p>
            <div class="indented">
                <p>“{{ $conferenceTitle }}”</p>
            </div>
        </div>

        <div class="section info-block">
            <p><strong>III. Thông tin người tham dự và đóng phí:</strong></p>
            <div class="indented">
                <p><span class="info-line">Họ tên: {{ $name }}</span> Số điện thoại: {{ $phone }}</p>
                <p>Cơ quan: {{ $unit }}</p>
                <p>Địa chỉ: {{ $address }}</p>
            </div>
        </div>

        <div class="section">
            <p><strong>IV. Thông tin thanh toán:</strong></p>
            <div class="indented">
                <p>Phương thức thanh toán: Chuyển khoản qua ngân hàng</p>
                <p>Trạng thái thanh toán: Đã thanh toán</p>
            </div>
        </div>

        <table class="payment-table">
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>Nội dung</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $conferenceFeeTitle }}</td>
                    <td>1</td>
                    <td>{{ $price }}</td>
                    <td>{{ $price }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td colspan="3"><strong>TỔNG</strong></td>
                    <td><strong>{{ $price }}</strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="signature-block">
            <p class="date"><strong>TP. Hồ Chí Minh, ngày</strong> {{ \Carbon\Carbon::now()->day }} <strong>tháng</strong>
                {{ \Carbon\Carbon::now()->month }} <strong>năm</strong>
                {{ \Carbon\Carbon::now()->year }}</p>
            <p class="title">TM. Ban thường vụ Hội</p>
            <p class="title">Chủ tịch</p>
            <div class="signature">
                <img src="{{ $imgSignature }}" alt="Chữ ký và Dấu" class="signature-image">
            </div>
            <p class="name">ThS. Thái Văn Lộc</p>
        </div>

    </div>

</body>

</html>

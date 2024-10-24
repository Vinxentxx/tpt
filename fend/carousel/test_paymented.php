<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ชำระเงิน</title>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #dc3545;
            text-align: center;
            margin-top: 20px;
            font-size: 3em;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .qrcode {
            max-width: 200px;
            margin: 20px auto;
        }
        .qrcode img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 20px;
            margin-top: 30px;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ยืนยันการสั่งซื้อ</h1>
    <div class="qrcode">
        <img src="https://img2.pic.in.th/pic/payment8ee9d467f44c1d3f.md.png" alt="QR Code" class="img-fluid">
    </div>
    <form action="view_order_detail.php" method="POST" class="form-upload">
        <button type="submit" class="btn btn-primary">ยืนยันการสั่งซื้อ</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

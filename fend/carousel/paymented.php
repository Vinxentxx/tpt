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
        .container {
            text-align: center;
        }
        h1 {
            color: #dc3545;
            margin-top: 0;
            font-size: 3em;
        }
        .qrcode {
            max-width: 200px;
            margin: 20px auto;
        }
        .form-upload {
            margin-top: 30px;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>ชำระเงิน</h1>
    <div class="qrcode">
        <img src="https://img2.pic.in.th/pic/payment8ee9d467f44c1d3f.md.png" alt="QR Code" class="img-fluid">
    </div>
    <form action="paymented.php" method="POST" enctype="multipart/form-data" class="form-upload">
        <div class="mb-3">
            <input type="file" class="form-control" name="payment_image" required>
        </div>
        <button type="submit" class="btn btn-primary">ชำระเงิน</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

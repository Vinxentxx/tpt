<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบว่ามีการอัพโหลดไฟล์หรือไม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['payment_image'])) {
    // ตรวจสอบการอัพโหลดไฟล์
    $fileTmpPath = $_FILES['payment_image']['tmp_name'];
    $fileName = $_FILES['payment_image']['name'];
    $fileSize = $_FILES['payment_image']['size'];
    $fileType = $_FILES['payment_image']['type'];
    $uploadDir = 'uploads/'; // กำหนดโฟลเดอร์สำหรับการอัพโหลดไฟล์

    // ย้ายไฟล์ไปยังโฟลเดอร์ปลายทาง
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $destPath = $uploadDir . $fileName;
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        // อัพโหลดสำเร็จ
    } else {
        echo "การอัพโหลดไฟล์ล้มเหลว";
        exit();
    }
} else {
    header("Location: qr_payment.php");
    exit();
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ชำระเงินเรียบร้อยแล้ว</title>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #28a745;
            text-align: center;
            margin-top: 20px;
            font-size: 3em;
        }
        .container {
            text-align: center;
            margin-top: 50px;
        }
        .icon-success {
            color: #28a745;
            font-size: 100px;
            margin: 20px auto;
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
    <h1>ชำระเงินเรียบร้อยแล้ว</h1>
    <div class="icon-success">
        <i class="fa fa-check-circle"></i>
    </div>
    <form action="view_order.php" method="GET">
        <button type="submit" class="btn btn-primary">ดูรายละเอียดคำสั่งซื้อ</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

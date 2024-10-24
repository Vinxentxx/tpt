<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$total = 0; // ตัวแปรรวมราคา

// คำนวณยอดรวม
foreach ($_SESSION['sid'] as $pid) {
    $sum = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
    $total += $sum;
}

// ตรวจสอบและดึงราคาส่วนลดจาก session
$discount_price = isset($_SESSION['discount_price']) ? $_SESSION['discount_price'] : 0;

// คำนวณราคาหลังหักส่วนลด
$total_after_discount = $total - $discount_price;

// เพิ่มข้อมูลคำสั่งซื้อในตาราง order
$cr_id = $_SESSION['user_id']; // รหัสลูกค้าจาก session
$odate = date("Y-m-d H:i:s"); // วันที่และเวลาปัจจุบัน

// เตรียมคำสั่ง SQL สำหรับบันทึกข้อมูลคำสั่งซื้อ
$sql_order = "INSERT INTO `order` (ototal, odate, cr_id) VALUES ('$total_after_discount', '$odate', '$cr_id')";
$result_order = mysqli_query($conn, $sql_order);

// ตรวจสอบว่าบันทึกข้อมูลคำสั่งซื้อสำเร็จหรือไม่
if ($result_order) {
    $oid = mysqli_insert_id($conn); // ดึงหมายเลขคำสั่งซื้อที่เพิ่งบันทึก

    // บันทึกรายละเอียดสินค้าลงในตาราง orders_detail
    foreach ($_SESSION['sid'] as $pid) {
        $item = $_SESSION['sitem'][$pid]; // จำนวนสินค้าที่สั่ง
        $price = $_SESSION['sprice'][$pid]; // ราคาต่อชิ้น

        // เตรียมคำสั่ง SQL สำหรับบันทึกข้อมูลรายละเอียดสินค้า
        $sql_detail = "INSERT INTO orders_detail (oid, pid, item, price) VALUES ('$oid', '$pid', '$item', '$price')";
        mysqli_query($conn, $sql_detail);
    }

    // ล้าง session ของตะกร้าสินค้าหลังจากบันทึกข้อมูลเสร็จ
    unset($_SESSION['sid'], $_SESSION['sitem'], $_SESSION['sprice'], $_SESSION['discount_price']);

    // เปลี่ยนเส้นทางไปยังหน้าแสดงรายละเอียดคำสั่งซื้อ
    header("Location: view_order_detail.php?a=$oid");
    exit();
} else {
    echo "<p class='text-danger'>เกิดข้อผิดพลาดในการบันทึกข้อมูลคำสั่งซื้อ กรุณาลองใหม่อีกครั้ง</p>";
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ยืนยันการสั่งซื้อ</title>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #dc3545;
            text-align: center;
            margin-bottom: 20px;
            font-size: 3em;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
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
        .empty-cart-message {
            text-align: center;
            color: #dc3545;
            font-weight: bold;
        }
        .btn-submit-payment {
            text-align: right;
        }
    </style>
</head>
<body>
    <!-- ส่วนของหน้า HTML ไม่ได้เปลี่ยนแปลง -->
</body>
</html>

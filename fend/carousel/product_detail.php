<?php
    include("connectdb.php");

    // รับค่า id จาก URL
    $p_id = isset($_GET['id']) ? $_GET['id'] : null;

    // ตรวจสอบว่ามีการส่ง id หรือไม่
    if ($p_id !== null) {
        // ดึงข้อมูลจากฐานข้อมูล
        $sql = "SELECT * FROM product WHERE p_id = '$p_id'";
        $result = mysqli_query($conn, $sql);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
        } else {
            $product = null; // กำหนดให้เป็น null ถ้าไม่มีข้อมูล
        }
    }

    mysqli_close($conn);
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสินค้า</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 800px; /* จำกัดความกว้างของคอนเทนเนอร์ */
            padding: 20px;
            background-color: #ffffff; /* สีพื้นหลังของคอนเทนเนอร์ */
            border-radius: 10px; /* มุมโค้ง */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
        }
        .thumbnail {
            border: 1px solid #ff69b4; /* Pink border */
            border-radius: 15px; /* Rounded corners */
            overflow: hidden;
            transition: transform 0.2s; /* Transition effect */
        }
        .thumbnail:hover {
            transform: scale(1.02); /* ขยายเมื่อ hover */
        }
        .caption {
            background-color: #ffffff; /* Background for caption */
            color: #ff69b4; /* Pink text */
            padding: 15px;
            text-align: center;
        }
        .text-danger {
            color: red; /* สีแดงสำหรับข้อความที่ไม่พบสินค้า */
            text-align: center;
            font-size: 18px; /* ขนาดตัวอักษรที่ใหญ่ขึ้น */
        }
        h2 {
            text-align: center; /* จัดกลางหัวข้อ */
            color: #dc3545; /* สีแดงสำหรับหัวข้อ */
            margin-bottom: 30px; /* ช่องว่างใต้หัวข้อ */
        }
        .btn-primary {
            background-color: #dc3545; /* สีแดงสำหรับปุ่ม */
            border-color: #dc3545;
        }
        .btn-primary:hover {
            background-color: #c82333; /* สีแดงเข้มเมื่อ hover */
        }
        img {
            max-width: 100%; /* ให้ภาพขยายเต็มที่ */
            height: auto; /* ปรับความสูงตามสัดส่วน */
        }
    </style>
</head>

<body>
<div class="container">
    <h2>รายละเอียดสินค้า</h2>
    <?php if ($product) { ?>
        <div class="thumbnail">
            <img src="images/<?=$product['p_id'];?>.<?=$product['p_ext'];?>" class="img-fluid" alt="<?=$product['p_name'];?>" style="height: 400px; object-fit: cover;">
            <div class="caption">
                <h5><?=$product['p_name'];?></h5>
                <p>ราคา: <?=number_format($product['p_price']);?> บาท</p> <!-- ใช้ number_format เพื่อจัดรูปแบบราคา -->
                <p>รายละเอียด: <?=$product['p_detail'];?></p>
                <p><a href="basket.php?id=<?=$product['p_id'];?>" class="btn btn-primary" role="button">เพิ่มลงตะกร้า</a></p>
            </div>
        </div>
    <?php } else { ?>
        <p class="text-danger">ไม่พบสินค้านี้</p>
    <?php } ?>
</div>
</body>
</html>

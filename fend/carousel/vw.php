<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ข้อมูลสินค้า</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
        }
        h1 {
            text-align: center;
            margin: 30px 0;
            color: #dc3545;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .thumbnail {
            border: 1px solid #dc3545;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            background-color: #ffffff;
            padding: 15px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .thumbnail img {
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .caption {
            text-align: center;
            flex-grow: 1;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.3s;
            padding: 10px 20px;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #c82333;
            transform: translateY(-2px);
        }
        .mb-4 {
            margin-bottom: 30px;
        }
        .text-danger {
            color: #dc3545;
        }
        .cart-icon {
            position: fixed; /* แก้ไขเป็น fixed */
            top: 20px; /* ตำแหน่งจากด้านบน */
            right: 20px; /* ตำแหน่งจากด้านขวา */
            font-size: 36px; 
            color: #dc3545;
            cursor: pointer; 
            z-index: 1000; /* ทำให้ไอคอนอยู่เหนือเนื้อหาอื่น ๆ */
        }
        .cart-count {
            position: absolute;
            top: 0; 
            right: -10px; 
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 4px; 
            font-size: 14px; 
        }
        .back-to-top {
            position: fixed; /* แก้ไขเป็น fixed */
            bottom: 40px; /* ตำแหน่งจากด้านล่าง */
            right: 40px; /* ตำแหน่งจากด้านขวา */
            font-size: 36px;
            background-color: #f8f9fa;
            color: #dc3545;
            padding: 10px;
            border-radius: 50%;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
            display: none;
            cursor: pointer;
        }
        .back-to-top:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ข้อมูลประเภทสินค้า</h1>
    <div class="row">
<?php
session_start(); // เริ่ม session หากยังไม่ได้เริ่ม

$servername = "localhost";
$username = "root";
$password = "vinx220203";
$dbname = "shoponline";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("เชื่อมต่อฐานข้อมูลไม่ได้");
mysqli_query($conn, "SET NAMES 'utf8'");
$pt = isset($_GET['pt_id']) ? $_GET['pt_id'] : null;

if ($pt !== null) {
    $sql = "SELECT * FROM product WHERE pt_id = '$pt'";
    $rs = mysqli_query($conn, $sql);

    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $img = "images/" . $row["p_id"] . "." . $row["p_ext"];
            echo "<div class='col-md-4 mb-4'>
                    <div class='thumbnail'>
                        <img src='$img' class='img-fluid' alt='" . htmlspecialchars($row["p_name"]) . "'>
                        <div class='caption'>
                            <h5>" . htmlspecialchars($row["p_name"]) . "</h5>
                            <p>" . htmlspecialchars($row["p_detail"]) . "</p>
                            <p>Price: " . number_format($row["p_price"]) . " บาท</p>
                            <p><button class='btn btn-primary' onclick='addToCart(" . $row["p_id"] . ");'>เพิ่มลงตะกร้า</button></p>
                        </div>
                    </div>
                  </div>";
        }
    } else {
        echo "<p class='text-danger text-center'>ไม่มีข้อมูลในประเภทนี้</p>";
    }
} else {
    echo "<p class='text-danger text-center'>ไม่ได้ระบุประเภท</p>";
}
mysqli_close($conn);
?>
    </div>
</div>

<!-- ไอคอนตะกร้า -->
<div class="cart-icon" onclick="window.location.href='basket.php';">
    <a href="index.php" class="fa fa-home" title="กลับสู่หน้าแรก" style="color: #dc3545;"></a>
    <a class="fa fa-shopping-cart" title="ตะกร้าสินค้า" style="color: #dc3545;"></a>
    <div class="cart-count"><?= isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></div>
</div>

<!-- ปุ่มกลับไปด้านบน -->
<div class="back-to-top" id="back-to-top">
    <i class="fa fa-arrow-up"></i>
</div>

<script>
    // ฟังก์ชันเพื่อเพิ่มจำนวนสินค้าที่ถูกเพิ่มลงในตะกร้า
    function addToCart(productId) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "add_to_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // ปรับปรุงการแสดงผลของจำนวนสินค้าในตะกร้า
                document.querySelector('.cart-count').innerText = xhr.responseText;
            }
        };
        xhr.send("product_id=" + productId);
    }

    // ปุ่มกลับไปด้านบน
    const backToTopButton = document.getElementById("back-to-top");
    
    window.onscroll = function() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            backToTopButton.style.display = "block"; // แสดงปุ่มเมื่อเลื่อนลง
        } else {
            backToTopButton.style.display = "none"; // ซ่อนปุ่มเมื่อเลื่อนขึ้น
        }
    };

    backToTopButton.onclick = function() {
        window.scrollTo({ top: 0, behavior: "smooth" }); // เลื่อนกลับไปด้านบนแบบ smooth
    };
</script>

</body>
</html>

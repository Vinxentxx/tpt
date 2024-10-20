<?php
include("connectdb.php");
session_start(); // เริ่ม session หากยังไม่ได้เริ่ม
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>รายการสินค้า</title>
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
        h2 {
            color: #dc3545; 
            text-align: center;
            margin: 20px 0 30px;
            font-size: 3em; 
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
        }
        .btn-primary, .btn-filter, .btn-search {
            border-radius: 20px;
            font-weight: bold;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-primary:hover {
            background-color: #c82333;
        }
        .btn-filter {
            background-color: #ffcc00; /* สีเหลืองสำหรับปุ่มกรองราคา */
            border-color: #ffcc00;
            color: white;
        }
        .btn-filter:hover {
            background-color: #e6b800;
        }
        .btn-search {
            background-color: #d1e7fd; /* สีฟ้าพาสเทลสำหรับปุ่มค้นหา */
            border-color: #d1e7fd;
            color: black;
        }
        .btn-search:hover {
            background-color: #a8d3ea;
        }
        .thumbnail {
            border: 1px solid #dc3545;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .caption {
            background-color: #f8f9fa;
            color: black; /* เปลี่ยนสีตัวหนังสือเป็นสีดำ */
            padding: 15px;
            text-align: center;
        }
        .form-control {
            border-color: #dc3545;
            border-radius: 20px;
            height: calc(2.5em + .75rem + 2px);
        }
        .cart-icon {
            position: absolute;
            top: 20px;
            right: 40px; 
            font-size: 36px; 
            color: #dc3545;
            cursor: pointer; /* เพิ่ม cursor pointer */
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
        .filter-form {
            display: none; /* ซ่อนฟอร์มกรองราคาเริ่มต้น */
            margin-top: 20px;
            text-align: center;
        }
        /* ปุ่มกลับไปด้านบน */
        .back-to-top {
            position: fixed;
            bottom: 40px;
            right: 40px;
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
<h2>รายการสินค้าทั้งหมด</h2>

<?php
$sql2 = "SELECT * FROM product_type";
$rs2 = mysqli_query($conn, $sql2);
?>

<div class="text-center">
    <a href="index1.php" class="btn btn-info btn-search">สินค้าทั้งหมด</a> | 
    <?php while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) { ?>
        <a href="index1.php?pt=<?= $data2['pt_id']; ?>" class="btn btn-info btn-search"><?= htmlspecialchars($data2['pt_name']); ?></a> | 
    <?php } ?>
</div>

<br>

<!-- ปุ่มค้นหาและตัวกรองราคา -->
<div class="text-center">
    <form class="form-inline" action="../shoponline/index.php" method="post">
        <div class="form-group">
            <label class="control-label" for="textinput">ค้นหา</label>  
            <input name="kw" type="text" placeholder="กรอกคำค้น" class="form-control input-md" required>
        </div>
        <div class="form-group">
            <button id="singlebutton" name="singlebutton" class="btn btn-primary">
                <i class="fa fa-search"></i> <!-- เพิ่มไอคอนค้นหาที่นี่ -->
            </button>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-filter" onclick="toggleFilter()">ตัวกรองราคา <i class="fa fa-filter"></i></button>
        </div>
    </form>
</div>

<!-- ฟอร์มกรองราคา -->
<div class="filter-form" id="filter-form">
    <form class="form-inline text-center" action="index1.php" method="post">
        <div class="form-group">
            <label class="control-label" for="price1">ช่วงราคา:</label>  
            <input name="price1" type="number" placeholder="ต่ำกว่า" class="form-control input-md" required>
            <input name="price2" type="number" placeholder="สูงกว่า" class="form-control input-md" required>
        </div>
        <div class="form-group">
            <button id="filter-button" name="filter-button" class="btn btn-primary">ยืนยัน</button>
        </div>
    </form>
</div>

<br>

<div class="container">
    <div class="row">
    <?php
    @$kw = $_POST['kw'];
    @$pt = $_GET['pt'];
    @$price1 = $_POST['price1'];
    @$price2 = $_POST['price2'];

    // เช็คช่วงราคาถ้าได้รับค่าจากฟอร์ม
    $price_filter = isset($price1) && isset($price2) ? "AND (p_price BETWEEN $price1 AND $price2)" : "";    
    $s = isset($_GET['pt']) ? "AND (pt_id = '$pt')" : "";    

    // สร้าง SQL Query
    $sql = "SELECT * FROM product WHERE (p_name LIKE '%" . mysqli_real_escape_string($conn, $kw) . "%' OR p_detail LIKE '%" . mysqli_real_escape_string($conn, $kw) . "%') $s $price_filter";
    $rs = mysqli_query($conn, $sql);
    $i = 0;

    if (!isset($_SESSION['cart_count'])) {
        $_SESSION['cart_count'] = 0; 
    }

    while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
        $i++;
        if (($i % 3) == 1) {
            echo "<div class='row' align='center' style='width:100%;'>";
        }
    ?>
        <div class="col-md-4">
            <div class="thumbnail">
                <img src="images/<?= htmlspecialchars($data['p_id']); ?>.<?= htmlspecialchars($data['p_ext']); ?>" class="img-fluid" alt="<?= htmlspecialchars($data['p_name']); ?>" style="height: 300px; object-fit: cover;">
                <div class="caption">
                    <h5><?= htmlspecialchars($data['p_name']); ?></h5>
                    <p><?= number_format($data['p_price']); ?> บาท</p>
                    <p>
                        <button onclick="addToCart(<?= htmlspecialchars($data['p_id']); ?>);" class="btn btn-primary">เพิ่มลงตะกร้า</button>
                    </p>
                </div>
            </div>
        </div>
    <?php 
        if (($i % 3) == 0) {
            echo "</div>";    
        }
    } // end while

    mysqli_close($conn);
    ?>
    </div> <!-- end of row -->
</div> <!-- end of container -->

<!-- ไอคอนตะกร้า -->
<div class="cart-icon" onclick="window.location.href='basket.php';"> <!-- นำทางไปที่ basket.php -->
    <a href="index.php" class="fa fa-home" style="font-size: 36px; color: #dc3545; margin-right: 10px;" title="กลับสู่หน้าแรก"></a>
    <a class="fa fa-shopping-cart" style="font-size: 36px; color: #dc3545;"></a>
    <div class="cart-count"><?= $_SESSION['cart_count']; ?></div>
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
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    // ปรับปรุงการแสดงผลของจำนวนสินค้าในตะกร้า
                    document.querySelector('.cart-count').innerText = xhr.responseText;
                } else {
                    console.error('Error: ' + xhr.status); // ถ้ามีข้อผิดพลาด ให้แสดงสถานะ
                }
            }
        };
        xhr.send("product_id=" + productId);
    }

    // ฟังก์ชันสำหรับซ่อนและแสดงฟอร์มกรองราคา
    function toggleFilter() {
        const filterForm = document.getElementById("filter-form");
        filterForm.style.display = filterForm.style.display === "none" || filterForm.style.display === "" ? "block" : "none";
    }

    // ปุ่มกลับไปด้านบน
    const backToTopButton = document.getElementById("back-to-top");
    
    window.onscroll = function() {
        backToTopButton.style.display = (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) ? "block" : "none";
    };

    backToTopButton.onclick = function() {
        window.scrollTo({ top: 0, behavior: "smooth" }); // เลื่อนกลับไปด้านบนแบบ smooth
    };
</script>

</body>
</html>

<?php
session_start(); // เริ่ม session
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบคำค้นหา
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = mysqli_real_escape_string($conn, $_GET['search']);
}

// ดึงข้อมูลสินค้าจากฐานข้อมูลตามคำค้นหา
$productResults = [];
if ($searchQuery) {
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchQuery%' OR description LIKE '%$searchQuery%'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productResults[] = $row;
        }
    }
}

// ตรวจสอบจำนวนสินค้าที่อยู่ในตระกร้าจาก session
$cartItemCount = 0;
if (isset($_SESSION['cart'])) {
    $cartItemCount = count($_SESSION['cart']); // นับจำนวนสินค้าที่อยู่ใน session ตระกร้า
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tripletoys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Kalam:wght@300;400;700&display=swap" rel="stylesheet">

    <style>
        .carousel-inner img {
    height: 800px; /* กำหนดความสูงที่ต้องการ */
    object-fit: cover; /* ปรับรูปภาพให้เต็มพื้นที่โดยไม่เสียอัตราส่วน */
    width: 100%; /* ให้กว้างเต็มพื้นที่ */
}

        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
        }
        .bg-dark { background-color: #dc3545 !important; }
        .navbar-brand, .nav-link, .footer-text { color: #fff !important; }
        .btn-custom { 
            background-color: #f8d7da; 
            border-color: #f5c6cb; 
            color: black; 
        }
        .btn-custom:hover { 
            background-color: #f5c6cb; 
            border-color: #f1b0b7; 
        }
        .rounded-image {
            border: 5px solid #dc3545; 
            border-radius: 20px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3); 
            transition: transform 0.3s; 
        }
        .rounded-image:hover {
            transform: scale(1.05); 
        }
        footer { 
            background-color: #dc3545; 
            color: #fff; 
        }
        .footer-text a { color: #f8d7da !important; }
        .featurette-divider {
            border-top: 1px solid #dc3545;
        }
        h1, h2, h5 {
            color: darkred;
        }
        .navbar-brand {
            font-family: 'Modak', cursive;
            font-size: 2.5rem;
            letter-spacing: 2px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        .card {
            border: none;
            border-radius: 10px;
        }
        .cart-icon {
            position: relative;
            color: white;
            font-size: 2rem;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 12px;
        }
        /* New styles for modal positioning */
        .modal-dialog {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100% - 1rem); /* Adjust for some margin */
        }
    </style>
</head>
<body>

<header>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tripletoy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index1.php">Product</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">none</a></li>
            </ul>
            <form class="d-flex" action="" method="get" style="align-items: center;">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= htmlspecialchars($searchQuery) ?>">
                <button class="btn btn-outline-light me-2" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="profile.php" class="btn btn-custom me-2">
                        <i class="bi bi-person-circle"></i>
                        <?= htmlspecialchars($_SESSION['username']) ?>
                    </a>
                    <a href="#" class="btn btn-custom" onclick="confirmLogout(event)">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-custom">Login</a>
                <?php endif; ?>
                <a href="basket.php" class="cart-icon ms-2">
                    <i class="bi bi-cart3"></i>
                        <?php if ($cartItemCount > 0): ?>
                        <span class="cart-badge"><?= $cartItemCount ?></span>
                        <?php endif; ?>
                </a>
            </form>
        </div>
    </div>
</nav>
</header>


<main>
<!-- Modal for Logout Confirmation -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">ยืนยันการออกจากระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-danger me-2" data-bs-dismiss="modal">ยกเลิก</button>
        <a href="logout.php" class="btn btn-danger">ยืนยัน</a>
      </div>
    </div>
  </div>
</div>


<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <a href="vw.php?pt_id=2">
                <img src="https://prod-global-static.oss-us-east-1.aliyuncs.com/globalAdmin/1719177703877____download-4____.jpg?x-oss-process=image/format,webp" class="d-block w-100">
            </a>
            <div class="carousel-caption text-start">
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://prod-global-static.oss-us-east-1.aliyuncs.com/globalAdmin/1719177707770____download-5____.jpg?x-oss-process=image/format,webp" class="d-block w-100">
            <div class="carousel-caption">   
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://fado.vn/blog/wp-content/uploads/2023/05/4-diem-an-tuong-cua-mo-hinh-Skullpanda.jpg" class="d-block w-100">
            <div class="carousel-caption text-end"> 
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container marketing my-5">
    <h1 class="text-center" style="color: darkred;">เเนะนำ</h1>
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="https://prod-eurasian-res.popmart.com/default/1_X8ltv4qiy2_1200x1200.jpg" class="card-img-top rounded-image">
                <div class="card-body">
                    <h5 class="card-title">SKULLPANDA</h5>
                    <p class="card-text">Skullpanda อาร์ตทอยจากศิลปิน Xiongmao ตัวอิตอันดับต้นๆ ของอาร์ตทอยด้วยความน่ารักในแบบเด็กผู้หญิง</p>
                    <a href="vw.php?pt_id=2" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="https://prod-thailand-res.popmart.com/default/20240731_171817_505119____1_____1200x1200.jpg" class="card-img-top rounded-image">
                <div class="card-body">
                    <h5 class="card-title">MOLLY</h5>
                    <p class="card-text">น้องมอลลี่คือเด็กผู้หญิงสุดน่ารักจากคุณ Kenny Wong ศิลปินชาวฮ่องกง</p>
                    <a href="vw.php?pt_id=5" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card">
                <img src="https://prod-thailand-res.popmart.com/default/20240924_095748_398503____1_____1200x1200.jpg" class="card-img-top rounded-image">
                <div class="card-body">
                    <h5 class="card-title">CRYBABY</h5>
                    <p class="card-text">Crybaby เป็นอาร์ตทอยที่สื่อถึงความรู้สึกของเด็กผู้หญิงที่รองไห</p>
                    <a href="vw.php?pt_id=1" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">Single Box</h2>
            <p class="lead">สินค้าที่ออกแบบให้ผู้ซื้อไม่รู้ว่าจะได้ฟิกเกอร์ตัวใดจนกว่าจะเปิดกล่อง มีคาแรคเตอร์หลากหลายจากซีรีส์</p>
            <p>
                <a href="vw1.php?c_id=2" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
            </p>
        </div>
        <div class="col-md-5">
            <img src="https://prod-thailand-res.popmart.com/default/20240625_101713_899251____8_____1200x1200.jpg" class="featurette-image img-fluid mx-auto rounded-image" width="500">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Box Set</h2>
            <p class="lead">Box set รับประกันว่าผู้ซื้อจะได้ฟิกเกอร์ครบทุกตัวในซีรีส์</p>
            <p>
                <a href="vw1.php?c_id=1" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
            </p>
        </div>
        <div class="col-md-5 order-md-1">
            <img src="https://prod-thailand-res.popmart.com/default/20240715_095521_842985_________1200x1200.jpg" class="rounded-image" width="500">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">MEGA</h2>
            <p class="lead">ฟิกเกอร์ขนาดใหญ่ที่ออกแบบมาเป็นพิเศษในคอเลกชัน</p>
            <p>
                <a href="vw1.php?c_id=3" class="btn btn-secondary" style="background-color: #dc3545; border-color: #f1b0b7;">View details &raquo;</a>
            </p>
        </div>
        <div class="col-md-5">
            <img src="https://prod-thailand-res.popmart.com/default/20240702_165447_886235____4_____1200x1200.jpg" class="rounded-image" width="500">
        </div>
    </div>
    <hr class="featurette-divider">
</div>
</main>

<footer class="text-center text-lg-start mt-5">
    <div class="container p-4">
        <p class="footer-text">© 2024 Tripletoys. All rights reserved. <br>
        <a href="https://www.facebook.com/profile.php?id=100019297476796" target="_blank">Contact us</a>
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
<script>
    function confirmLogout(event) {
        event.preventDefault(); // ป้องกันการทำงานของลิงก์
        const modal = new bootstrap.Modal(document.getElementById('logoutModal'));
        modal.show(); // แสดง modal
    }
</script>
</body>
</html>

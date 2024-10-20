<?php
session_start(); // เริ่ม session
include("connectdb3.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้ายังไม่ล็อกอิน ให้เปลี่ยนไปหน้า login
    exit;
}

// รับ c_id จากตาราง user โดยใช้ username ที่ล็อกอิน
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT c_id FROM user WHERE u_user = ?");
if (!$stmt) {
    die("เตรียม statement ไม่สำเร็จ: " . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $c_id = $row['c_id']; // เก็บ c_id ไว้ใช้ใน query ถัดไป

    // ดึงข้อมูลจากตาราง customer ตาม c_id
    $stmt = $conn->prepare("SELECT cr_name, cr_last, cr_tel, cr_add, cr_mail FROM customer WHERE c_id = ?");
    if (!$stmt) {
        die("เตรียม statement ไม่สำเร็จ: " . $conn->error);
    }
    $stmt->bind_param("i", $c_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc(); // ดึงข้อมูลลูกค้า
    } else {
        echo "ไม่พบข้อมูลลูกค้า";
        exit;
    }
} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit;
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>โปรไฟล์ผู้ใช้ - Tripletoys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

    <style>
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
        footer { 
            background-color: #dc3545; 
            color: #fff; 
        }
        .footer-text a { color: #f8d7da !important; }
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
        .profile-icon {
            font-size: 50px;
            color: #dc3545;
            margin-bottom: 20px;
        }
        .cart-icon {
            position: absolute;
            top: 20px;
            right: 40px; 
            font-size: 36px; 
            color: #dc3545;
            cursor: pointer;
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
        .form-popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid #dc3545;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .form-popup .close-btn {
            float: right;
            color: #dc3545;
            cursor: pointer;
        }
    </style>
</head>
<body>

<header>
    <div class="cart-icon" onclick="window.location.href='basket.php';">
        <a href="index.php" class="fa fa-home" style="font-size: 36px; color: #dc3545; margin-right: 10px;" title="กลับสู่หน้าแรก"></a>
        <a class="fa fa-shopping-cart" style="font-size: 36px; color: #dc3545;"></a>
        <div class="cart-count"><?= $_SESSION['cart_count'] ?? 0; ?></div>
    </div>
</header>

<main class="container my-5 text-center">
    <h1 class="text-center" style="color: darkred;">โปรไฟล์ของคุณ</h1>
    <div class="card my-4 mx-auto" style="width: 18rem;">
        <div class="card-body">
            <div class="profile-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <h5 class="card-title"><?= htmlspecialchars($userData['cr_name'] . ' ' . $userData['cr_last']) ?></h5>
            <p><strong>เบอร์โทร:</strong> <?= htmlspecialchars($userData['cr_tel']) ?></p>
            <p><strong>อีเมล:</strong> <?= htmlspecialchars($userData['cr_mail']) ?></p>
            <p><strong>ที่อยู่:</strong> <?= htmlspecialchars($userData['cr_add']) ?></p>
            <a href="#" class="btn btn-custom" onclick="openForm()">
                <i class="bi bi-plus-circle"></i> เพิ่มที่อยู่ใหม่
            </a>
        </div>
    </div>
</main>

<!-- ฟอร์มเพิ่มข้อมูล -->
<div class="form-popup" id="myForm">
    <span class="close-btn" onclick="closeForm()">&times;</span>
    <form action="" method="post">
        <h2>เพิ่มข้อมูลใหม่</h2>
        <div class="mb-3">
            <label for="first_name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">นามสกุล</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">เบอร์โทร</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">ที่อยู่</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">ยืนยัน</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<script>
    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>

</body>
</html>

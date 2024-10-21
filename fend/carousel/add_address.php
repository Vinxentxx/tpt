<?php
session_start(); // เริ่ม session
include("connectdb3.php"); // เชื่อมต่อฐานข้อมูล

$message = ""; // ตัวแปรสำหรับเก็บข้อความ flash

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้ายังไม่ล็อกอิน ให้เปลี่ยนไปหน้า login
    exit;
}

// ตรวจสอบว่ามีการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลที่อยู่จากฟอร์ม
    $address_text = $_POST['address_text'];
    $is_default = isset($_POST['is_default']) ? 1 : 0; // กำหนดค่าเป็น 1 ถ้าตั้งเป็นที่อยู่หลัก

    // รับ cr_id จากตาราง user โดยใช้ username ที่ล็อกอิน
    $username = $_SESSION['username'];
    $stmt = $conn->prepare("SELECT cr_id FROM user WHERE u_user = ?");
    if (!$stmt) {
        die("เตรียม statement ไม่สำเร็จ: " . $conn->error);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cr_id = $row['cr_id']; // เก็บ cr_id ไว้ใช้ใน query ถัดไป

        // เพิ่มที่อยู่ลงในตาราง addresses
        $stmt = $conn->prepare("INSERT INTO addresses (cr_id, address_text, is_default) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("เตรียม statement ไม่สำเร็จ: " . $conn->error);
        }
        $stmt->bind_param("isi", $cr_id, $address_text, $is_default);
        if ($stmt->execute()) {
            $message = "บันทึกที่อยู่เรียบร้อยแล้ว"; // ตั้งค่าข้อความ flash
            header("Location: profile.php?message=" . urlencode($message)); // เปลี่ยนไปหน้า profile.php พร้อมส่งข้อความ
            exit;
        } else {
            echo "ไม่สามารถบันทึกที่อยู่ได้: " . $stmt->error;
        }
    } else {
        echo "ไม่พบข้อมูลผู้ใช้";
        exit;
    }
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>เพิ่มที่อยู่</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Mali', sans-serif;
        }
        .address-container {
            max-width: 500px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #c0392b;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .btn-primary:hover {
            background-color: #e74c3c;
        }
        .btn-link {
            color: #c0392b;
        }
        .btn-link:hover {
            text-decoration: underline;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #c0392b;
            color: #c0392b;
        }
        .cart-icon {
            position: absolute;
            top: 20px;
            right: 20px; /* เลื่อนไอคอนไปทางขวา */
            display: flex;
            align-items: center;
        }
        .cart-icon a {
            font-size: 36px;
            color: #dc3545; /* สีแดง */
            margin-right: 10px;
        }
        .cart-count {
            background-color: #c0392b;
            color: #fff;
            border-radius: 50%;
            padding: 5px 10px;
            font-size: 16px;
            margin-left: -20px;
            margin-top: -10px;
        }
        .account-icon {
            font-size: 36px;
            color: #dc3545; /* สีแดง */
            margin-right: 10px;
        }
        .flash-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            display: none; /* เริ่มต้นไม่แสดง */
        }
    </style>
</head>
<body>
    <!-- ไอคอนบัญชี, Home และตะกร้าสินค้า -->
    <div class="cart-icon">
        <a href="profile.php" class="fa fa-user account-icon" title="โปรไฟล์"></a>
        <a href="index.php" class="fa fa-home" title="กลับสู่หน้าแรก"></a>
        <a href="basket.php" class="fa fa-shopping-cart" title="ตะกร้าสินค้า"></a>
        <div class="cart-count"><?= isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></div>
    </div>

    <div class="address-container">
        <h2>เพิ่มที่อยู่ใหม่</h2>
        <form method="POST">
            <div class="form-group">
                <label for="address_text">ที่อยู่:</label>
                <input type="text" class="form-control form-control-lg" id="address_text" name="address_text" required>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="is_default" name="is_default">
                <label class="form-check-label" for="is_default">ตั้งเป็นที่อยู่หลัก</label>
            </div>
            <button type="submit" class="btn btn-primary btn-block">บันทึก</button>
        </form>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> Tripletoys. สงวนลิขสิทธิ์.</p>
    </footer>

    <!-- แสดงข้อความ flash -->
    <?php if (isset($_GET['message'])): ?>
        <div class="flash-message" id="flash-message"><?= htmlspecialchars($_GET['message']); ?></div>
    <?php endif; ?>

    <script>
        // แสดงข้อความ flash ถ้ามี
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'block'; // แสดงข้อความ
            setTimeout(() => {
                flashMessage.style.display = 'none'; // ซ่อนข้อความหลัง 3 วินาที
            }, 3000);
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- เพิ่ม Font Awesome -->
</body>
</html>

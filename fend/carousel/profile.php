<?php
session_start(); // เริ่ม session
include("connectdb3.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // ถ้ายังไม่ล็อกอิน ให้เปลี่ยนไปหน้า login
    exit;
}

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

    // ดึงข้อมูลจากตาราง customer ตาม cr_id
    $stmt = $conn->prepare("SELECT cr_name, cr_last, cr_tel, cr_add, cr_mail FROM customer WHERE cr_id = ?");
    if (!$stmt) {
        die("เตรียม statement ไม่สำเร็จ: " . $conn->error);
    }
    $stmt->bind_param("i", $cr_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc(); // ดึงข้อมูลลูกค้า
    } else {
        echo "ไม่พบข้อมูลลูกค้า";
        exit;
    }

    // ดึงข้อมูลที่อยู่ทั้งหมด
    $stmt = $conn->prepare("SELECT address_id, address_text, is_default FROM addresses WHERE cr_id = ?");
    $stmt->bind_param("i", $cr_id);
    $stmt->execute();
    $addresses_result = $stmt->get_result();

} else {
    echo "ไม่พบข้อมูลผู้ใช้";
    exit;
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>โปรไฟล์</title>
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
        .profile-container {
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
        h3 {
            text-align: center;
            margin: 20px 0;
            color: #c0392b; /* สีของหัวข้อ */
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
    </style>
</head>
<body>
    <!-- ไอคอน Home และตะกร้าสินค้า -->
    <div class="cart-icon">
        <a href="index.php" class="fa fa-home" title="กลับสู่หน้าแรก"></a>
        <a href="basket.php" class="fa fa-shopping-cart" title="ตะกร้าสินค้า"></a>
        <div class="cart-count"><?= isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0; ?></div>
    </div>

    <div class="profile-container">
        <h2>โปรไฟล์ของคุณ</h2>
        <p><strong>ชื่อ:</strong> <?= htmlspecialchars($userData['cr_name']); ?></p>
        <p><strong>นามสกุล:</strong> <?= htmlspecialchars($userData['cr_last']); ?></p>
        <p><strong>หมายเลขโทรศัพท์:</strong> <?= htmlspecialchars($userData['cr_tel']); ?></p>
        <p><strong>ที่อยู่:</strong> <?= htmlspecialchars($userData['cr_add']); ?></p>
        <p><strong>อีเมล:</strong> <?= htmlspecialchars($userData['cr_mail']); ?></p>

        <h3>ที่อยู่ในการใช้จัดส่งปัจจุบัน</h3> <!-- เปลี่ยนชื่อที่นี่ -->
        <ul>
            <?php while ($address = $addresses_result->fetch_assoc()): ?>
                <li>
                    <?= htmlspecialchars($address['address_text']); ?>
                    <?php if ($address['is_default']): ?>
                        <strong>(ที่อยู่หลัก)</strong>
                    <?php else: ?>
                        <a href="set_default_address.php?address_id=<?= $address['address_id']; ?>">ตั้งเป็นที่อยู่หลัก</a>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>

        <a href="logout.php" class="btn btn-link btn-block">ออกจากระบบ</a>
        <a href="add_address.php" class="btn btn-outline-success btn-block">+ เพิ่มที่อยู่</a>
    </div>

    <footer>
        <p>&copy; <?= date('Y'); ?> Tripletoys. สงวนลิขสิทธิ์.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- เพิ่ม Font Awesome -->
</body>
</html>

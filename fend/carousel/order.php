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
            background-color: #f8f9fa; /* สีพื้นหลัง */
            font-family: 'Mali', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #dc3545; /* เปลี่ยนเป็นสีแดง */
            text-align: center;
            margin-bottom: 20px;
            font-size: 3em; /* ขนาดตัวอักษรใหญ่ */
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #dc3545; /* ปุ่มสีแดง */
            border-color: #dc3545;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #c82333; /* สีแดงเข้มเมื่อ hover */
            border-color: #bd2130;
        }
        .empty-cart-message {
            text-align: center;
            color: #dc3545;
            font-weight: bold;
        }
        .btn-submit-payment {
            text-align: right; /* จัดตำแหน่งปุ่มให้ชิดขวา */
        }
    </style> 
</head>
<body>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h1>ยืนยันการสั่งซื้อ</h1>
            <?php if (!empty($_SESSION['sid'])): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา/ชิ้น</th>
                            <th>จำนวน</th>
                            <th>รวม</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($_SESSION['sid'] as $pid) {
                        $sum = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
                    ?>
                        <tr>
                            <td><?php echo $_SESSION['sname'][$pid]; ?></td>
                            <td><?php echo number_format($_SESSION['sprice'][$pid], 0); ?> บาท</td>
                            <td><?php echo $_SESSION['sitem'][$pid]; ?></td>
                            <td><?php echo number_format($sum, 0); ?> บาท</td>
                        </tr>
                    <?php } ?>
                    <tr class="total-row">
                        <td colspan="3" class="text-right"><strong>รวมทั้งสิ้น</strong></td>
                        <td><strong><?php echo number_format($total, 0); ?> บาท</strong></td>
                    </tr>
                    <?php if ($discount_price > 0): ?>
                    <tr class="total-row total-row-discount">
                        <td colspan="3" class="text-right"><strong>ส่วนลด</strong></td>
                        <td><strong>- <?php echo number_format($discount_price, 0); ?> บาท</strong></td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="3" class="text-right"><strong>ยอดรวมหลังหักส่วนลด</strong></td>
                        <td><strong><?php echo number_format($total - $discount_price, 0); ?> บาท</strong></td>
                    </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="empty-cart-message">ไม่มีสินค้าที่เลือกในตะกร้า</p>
            <?php endif; ?>
            
            <div class="card-body btn-submit-payment text-right"> <!-- เพิ่มคลาส text-right ที่นี่ -->
                <form method="POST" action="qr_payment.php">
                    <button type="submit" class="btn btn-primary">ยืนยันการสั่งซื้อ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

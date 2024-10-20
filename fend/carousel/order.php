<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล
include("phpqrcode.php"); // รวมไลบรารี QR Code

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$orderId = null;
$paymentMethod = null;
$total = 0; // ตัวแปรรวมราคา

// คำนวณยอดรวม
foreach ($_SESSION['sid'] as $pid) {
    $sum = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
    $total += $sum;
}

// ตรวจสอบและดึงราคาส่วนลดจาก session
$discount_price = isset($_SESSION['discount_price']) ? $_SESSION['discount_price'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentMethod = $_POST['payment_method'];

    // คำนวณราคาหลังหักส่วนลด
    $total_after_discount = $total - $discount_price;

    // บันทึกข้อมูลใบสั่งซื้อในฐานข้อมูล
    $sql = "INSERT INTO orders (odate, ototal, payment_status, cr_name) VALUES (NOW(), '$total_after_discount', 'pending', 'ไม่ระบุชื่อ')";
    mysqli_query($conn, $sql) or die("insert error: " . mysqli_error($conn));
    $orderId = mysqli_insert_id($conn); // ดึง ID ที่สร้างขึ้นล่าสุด

    // ถ้าเลือกชำระผ่านคิวอาร์โค้ด
    if ($paymentMethod === 'qr') {
        $qrData = "https://example.com/pay?order_id=" . $orderId; // สร้างลิงก์สำหรับคิวอาร์โค้ด
        QRcode::png($qrData, 'qrcode.png'); // สร้างคิวอาร์โค้ด
    } elseif ($paymentMethod === 'cod') {
        // เปลี่ยนเส้นทางไปยัง view_order.php
        header("Location: view_order.php?order_id=$orderId");
        exit();
    }
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
        .payment-info {
            text-align: center;
        }
        table {
            width: 100%;
            margin-bottom: 20px;
        }
        .total-row {
            font-weight: bold;
        }
        .total-row-discount {
            font-weight: bold;
            color: #dc3545; /* สีแดงสำหรับคำว่า "ส่วนลด" */
        }
        .empty-cart-message {
            text-align: center;
            color: #dc3545;
            font-weight: bold;
        }
        .btn-submit-payment {
            text-align: left;
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
            
            <div class="card-body btn-submit-payment">
                <form method="POST" action="">
                    <div class="mb-3">
                        <select class="form-select" name="payment_method" id="payment_method" required>
                            <option value="" disabled selected>เลือกวิธีการชำระเงิน</option>
                            <option value="cod">เก็บปลายทาง</option>
                            <option value="qr">ชำระผ่านคิวอาร์โค้ด</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">ยืนยันการสั่งซื้อ</button>
                </form>
            </div>

            <?php if (isset($paymentMethod)): ?>
                <div class="mt-5 payment-info">
                    <?php if ($paymentMethod === 'qr'): ?>
                        <h2>คิวอาร์โค้ดสำหรับการชำระเงิน</h2>
                        <p>สแกนคิวอาร์โค้ดเพื่อทำการชำระเงิน:</p>
                        <img src="qrcode.png" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px;">
                        <form method="POST" action="view_order.php">
                            <input type="hidden" name="order_id" value="<?php echo $orderId; ?>">
                            <button type="submit" class="btn btn-success">ชำระเสร็จสิ้น</button>
                        </form>
                    <?php elseif ($paymentMethod === 'cod'): ?>
                        <h2>เก็บปลายทาง</h2>
                        <p>สินค้าจะถูกส่งถึงคุณและชำระเงินเมื่อได้รับสินค้า</p>
                    <?php endif; ?>
                    <?php if ($orderId): ?>
                        <p>หมายเลขออเดอร์: <strong><?php echo $orderId; ?></strong></p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>รายการใบสั่งซื้อ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* ฟ้าอ่อน */
        }
        h1 {
            color: #ff69b4; /* ชมพู */
            text-align: center;
            margin: 20px 0;
        }
        table {
            margin: auto; /* จัดกึ่งกลาง */
            width: 80%; /* กำหนดความกว้างของตาราง */
        }
        th, td {
            text-align: center; /* จัดข้อความให้อยู่กลาง */
        }
        .btn-lightpurple {
            background-color: #e0b0ff; /* สีม่วงอ่อน */
            color: white; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
        }
        .btn-lightpurple:hover {
            background-color: #d8a0ff; /* สีม่วงอ่อนเข้มขึ้นเมื่อ hover */
        }
        .btn-danger {
            background-color: #ff4d4d; /* สีแดงสำหรับปุ่มลบ */
            color: white; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
        }
        .btn-danger:hover {
            background-color: #ff1a1a; /* สีแดงเข้มขึ้นเมื่อ hover */
        }
        .btn-warning {
            background-color: #ffc107; /* สีเหลืองสำหรับปุ่มแก้ไข */
            color: black; /* เปลี่ยนสีตัวอักษรเป็นสีดำ */
        }
        .btn-warning:hover {
            background-color: #e0a800; /* สีเหลืองเข้มขึ้นเมื่อ hover */
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>รายการใบสั่งซื้อ</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                    <th>ดูรายละเอียด</th>
                    <th>เลขที่ใบสั่งซื้อ</th>
                    <th>วันที่</th>
                    <th>ราคารวม</th>
                    <th>ลูกค้า</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connectdb.php");
				 include("connectdb3.php");

                // ดึงข้อมูลใบสั่งซื้อจากฐานข้อมูล
                $sql = "SELECT * FROM `orders` ORDER BY oid DESC";
                $rs = mysqli_query($conn, $sql);

                // ตรวจสอบว่ามีข้อมูลหรือไม่
                if (mysqli_num_rows($rs) > 0) {
                    while ($data = mysqli_fetch_array($rs, MYSQLI_ASSOC)) {
                ?>
                <tr>
                    <td>
                        <a href="edit_order.php?id=<?= $data['oid']; ?>" class="btn btn-warning btn-sm">แก้ไข</a>
                    </td>
                    <td>
                        <a href="delete_order.php?id=<?= $data['oid']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบใบสั่งซื้อนี้?');">ลบ</a>
                    </td>
                    <td>
                        <a href="view_order_detail.php?a=<?= $data['oid']; ?>" class="btn btn-lightpurple btn-sm">ดูรายละเอียด</a>
                    </td>
                    <td><?= $data['oid']; ?></td>
                    <td><?= date("d-m-Y", strtotime($data['odate'])); ?></td> <!-- แสดงวันที่ในรูปแบบที่อ่านง่าย -->
                    <td><?= number_format($data['ototal'], 0); ?> บาท</td> <!-- แสดงราคาพร้อมหน่วยเงิน -->
                    <td><?= htmlspecialchars($data['cr_name']); ?></td> <!-- แสดงชื่อผู้ซื้อ (สมมุติ) -->
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='7'>ไม่มีใบสั่งซื้อ</td></tr>"; // ข้อความเมื่อไม่มีข้อมูล
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // โค้ดสำหรับแสดงผลการชำระเงิน
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
        $orderId = $_POST['order_id'];

        // อัปเดตสถานะการชำระเงินในฐานข้อมูล
        $sql = "UPDATE `orders` SET payment_status = 'paid' WHERE oid = '$orderId'";
        if (mysqli_query($conn, $sql)) {
            $message = "ชำระเงินสำเร็จ! หมายเลขออเดอร์ของคุณคือ: $orderId";
        } else {
            $message = "เกิดข้อผิดพลาดในการอัปเดตสถานะการชำระเงิน: " . mysqli_error($conn);
        }
    } elseif (isset($_GET['order_id'])) {
        $message = "ไม่พบหมายเลขออเดอร์";
    }
    ?>

    <div class="container mt-5">
        <div class="alert alert-info text-center">
            <h1>ผลการชำระเงิน</h1>
            <p><?php echo isset($message) ? $message : ''; ?></p>
            <a href="index.php" class="btn btn-primary">กลับไปที่หน้าหลัก</a>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

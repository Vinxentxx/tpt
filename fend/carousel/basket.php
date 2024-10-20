<?php
error_reporting(E_NOTICE);
session_start(); // เริ่ม session
include("connectdb.php"); // เชื่อมต่อฐานข้อมูล
include("connectdbcode.php"); // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่า id มีค่าใน URL หรือไม่
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE p_id='$id'";
    $rs = mysqli_query($conn, $sql);
    $data = mysqli_fetch_array($rs);
    
    // ถ้ามีข้อมูลสินค้าในฐานข้อมูล
    if ($data) {
        if (isset($_SESSION['sitem'][$id])) {
            $_SESSION['sitem'][$id]++; // เพิ่มจำนวนสินค้าหากมีอยู่แล้ว
        } else {
            $_SESSION['sid'][$id] = $data['p_id'];
            $_SESSION['sname'][$id] = $data['p_name'];
            $_SESSION['sprice'][$id] = $data['p_price'];
            $_SESSION['sdetail'][$id] = $data['p_detail'];
            $_SESSION['sext'][$id] = $data['p_ext'];
            $_SESSION['sitem'][$id] = 1; // เริ่มต้นที่ 1 ชิ้น
        }
    }
}

// ฟังก์ชันลบสินค้าจากตะกร้า
if (isset($_GET['remove'])) {
    $removeId = $_GET['remove'];
    unset($_SESSION['sid'][$removeId]);
    unset($_SESSION['sname'][$removeId]);
    unset($_SESSION['sprice'][$removeId]);
    unset($_SESSION['sdetail'][$removeId]);
    unset($_SESSION['sext'][$removeId]);
    unset($_SESSION['sitem'][$removeId]);
}

// ตัวแปรสำหรับส่วนลด
$discount_code = '';
$discount_price = 0;

// ตรวจสอบการใช้โค้ดส่วนลด
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_discount'])) {
    $discount_code = $_POST['discount_code']; // รับค่าจากฟิลด์โค้ดส่วนลด

    // เช็คโค้ดส่วนลด
    if (!empty($discount_code)) {
        $sql_discount = "SELECT code_price FROM code WHERE code_name = '$discount_code'"; // เปลี่ยนเป็นตาราง 'code'
        $result_discount = mysqli_query($conn, $sql_discount);

        if ($result_discount) {
            if (mysqli_num_rows($result_discount) > 0) {
                $row_discount = mysqli_fetch_assoc($result_discount);
                $discount_price = $row_discount['code_price'];
                $_SESSION['discount_price'] = $discount_price; // เก็บส่วนลดใน session
                echo "<p class='text-success'>ใช้โค้ดส่วนลดสำเร็จ: ลดไป " . number_format($discount_price, 2) . " บาท</p>";
            } else {
                echo "<p class='text-danger'>โค้ดส่วนลดไม่ถูกต้อง</p>";
            }
        } else {
            echo "<p class='text-danger'>เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . mysqli_error($conn) . "</p>";
        }
    }
}

?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ตะกร้าสินค้า</title>
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
        h2 {
            color: #dc3545; /* สีแดง */
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            font-size: 3em; /* ขนาดตัวอักษรใหญ่ */
        }
        .table th {
            background-color: #dc3545; /* สีแดง */
            color: white;
        }
        .table td {
            background-color: #ffffff; /* สีพื้นหลังขาว */
        }
        .btn-primary {
            background-color: #ffc107; /* ปุ่มสีเหลือง */
            border-color: #ffc107;
            border-radius: 20px;
        }
        .btn-primary:hover {
            background-color: #ffca2c; /* สีเหลืองอ่อนลงเมื่อ hover */
        }
        .btn-danger {
            background-color: #dc3545; /* ปุ่มสีแดง */
            border-color: #dc3545;
            border-radius: 20px;
        }
        .btn-danger:hover {
            background-color: #c82333; /* สีแดงเข้มขึ้นเมื่อ hover */
        }
        .total-row {
            background-color: #ffe6e6; /* ชมพูอ่อน */
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>ตะกร้าสินค้า</h2>
    <div class="text-center mb-4">
        <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a>  
        <a href="clear.php" class="btn btn-danger">ลบสินค้าทั้งหมด</a>
    </div>
    
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th width="5%">ที่</th>
                <th width="19%">รูปสินค้า</th>
                <th width="24%">ชื่อสินค้า</th>
                <th width="14%">ราคา/ชิ้น</th>
                <th width="15%">จำนวน (ชิ้น)</th>
                <th width="14%">รวม</th>
                <th width="9%">ลบ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($_SESSION['sid'])) {
            $total = 0; // กำหนดตัวแปรรวม
            $i = 0; // เริ่มนับที่ 0
            foreach($_SESSION['sid'] as $pid) {
                $i++;
                $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
                $total += $sum[$pid];
        ?>
            <tr>
                <td><?=$i;?></td>
                <!-- แสดงรูปสินค้า -->
                <td>
                    <img src="images/<?=$pid;?>.<?=$_SESSION['sext'][$pid];?>" width="120" alt="รูปสินค้า">
                </td>
                <td><?=$_SESSION['sname'][$pid];?></td>
                <td><?=number_format($_SESSION['sprice'][$pid],0);?> บาท</td>
                <td><?=$_SESSION['sitem'][$pid];?></td>
                <td><?=number_format($sum[$pid],0);?> บาท</td>
                <td><a href="?remove=<?=$pid;?>" class="btn btn-danger">ลบ</a></td>
            </tr>
        <?php } // end foreach ?>
            <tr class="total-row">
                <td colspan="5" class="text-right"><strong>รวมทั้งสิ้น</strong> &nbsp;</td>
                <td><strong><?=number_format($total,0);?></strong> บาท</td>
                <td>
                    <?php if(empty($_SESSION['sid'])) { ?>
                        <a href="#" class="btn btn-primary" onClick="alert('กรุณาเลือกสินค้า');">สั่งซื้อสินค้า</a>
                    <?php } else { ?>
                        <a href="record.php" class="btn btn-primary">สั่งซื้อสินค้า</a>
                    <?php } ?>
                </td>
            </tr>
            <tr class="total-row">
                <td colspan="5" class="text-right"><strong>หลังหักส่วนลด</strong> &nbsp;</td>
                <td><strong><?=number_format($total - (isset($_SESSION['discount_price']) ? $_SESSION['discount_price'] : 0), 0);?></strong> บาท</td>
                <td></td>
            </tr>
        <?php 
        } else {
        ?>
            <tr>
                <td colspan="7" height="50" class="text-center text-danger">ไม่มีสินค้าในตะกร้า</td>
            </tr>
        <?php } // end if ?>
        </tbody>
    </table>

    <form action="" method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="discount_code" class="form-control" placeholder="กรอกโค้ดส่วนลด" required>
            <div class="input-group-append">
                <button type="submit" name="apply_discount" class="btn btn-primary">ยืนยันโค้ด</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="bootstrap.js"></script>
</body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>รายละเอียดใบสั่งซื้อ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* สีพื้นหลังขาว */
        }
        h1 {
            color: #c0392b; /* สีแดงเข้ม */
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Arial', sans-serif; /* ฟอนต์ */
        }
        .table {
            border: 2px solid #c0392b; /* กรอบสีแดง */
        }
        .table th, .table td {
            border: 2px solid #c0392b; /* กรอบสีแดง */
            padding: 15px; /* เพิ่ม padding ให้กับเซลล์ */
        }
        .table th {
            background-color: #c0392b; /* สีพื้นหลังของหัวข้อเป็นสีแดง */
            color: white; /* สีตัวอักษรในหัวข้อ */
        }
        .table td {
            background-color: #f9f9f9; /* พื้นหลังของข้อมูลในตารางเป็นสีเทาอ่อน */
        }
        .table tr:hover {
            background-color: #ffe5e5; /* สีพื้นหลังเมื่อ hover เป็นสีแดงอ่อน */
        }
        .total-row {
            background-color: #f2dede; /* พื้นหลังสีแดงอ่อนสำหรับแถวรวม */
            font-weight: bold; /* ทำให้ตัวอักษรหนา */
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>รายละเอียดใบสั่งซื้อ เลขที่ <?php echo htmlspecialchars($_GET['a']); ?></h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ที่</th>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา/ชิ้น</th>
                    <th>รวม (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connectdb.php");

                // ใช้ mysqli_real_escape_string เพื่อป้องกัน SQL Injection
                $oid = mysqli_real_escape_string($conn, $_GET['a']);
                $sql = "SELECT * FROM orders_detail
                        INNER JOIN product ON orders_detail.pid = product.p_id
                        WHERE orders_detail.oid = '$oid'";
                $rs = mysqli_query($conn, $sql);
                $total = 0; // กำหนดตัวแปรรวม

                $i = 0;
                while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                    $i++;
                    $sum = $data['p_price'] * $data['item'];
                    $total += $sum;
                ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>
                            <img src="images/<?php echo htmlspecialchars($data['p_id']) . '.' . htmlspecialchars($data['p_ext']); ?>" width="120"> <br>
                            รหัสสินค้า: <?php echo htmlspecialchars($data['p_id']); ?> <br>
                            ชื่อสินค้า: <?php echo htmlspecialchars($data['p_name']); ?>
                        </td>
                        <td><?php echo $data['item']; ?></td>
                        <td><?php echo number_format($data['p_price'], 0); ?></td>
                        <td><?php echo number_format($sum, 0); ?></td>
                    </tr>
                <?php } ?>
                <tr class="total-row">
                    <td colspan="3" class="text-right"><strong>รวมทั้งสิ้น</strong></td>
                    <td><?php echo number_format($total, 0); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>รายการใบสั่งซื้อ</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลังอ่อน */
        }
        h1 {
            color: #c0392b; /* สีแดงเข้ม */
            text-align: center;
            margin: 20px 0;
            font-family: 'Arial', sans-serif; /* ฟอนต์ */
        }
        table {
            margin: auto; /* จัดกึ่งกลาง */
            width: 80%; /* กำหนดความกว้างของตาราง */
            background-color: #ffffff; /* สีพื้นหลังของตาราง */
            border-radius: 10px; /* มุมมน */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* เงา */
        }
        th, td {
            text-align: center; /* จัดข้อความให้อยู่กลาง */
            padding: 15px; /* เพิ่มระยะห่าง */
        }
        th {
            background-color: #c0392b; /* สีแดงเข้มสำหรับหัวตาราง */
            color: white; /* สีตัวอักษรเป็นสีขาว */
        }
        .btn-danger {
            background-color: #e74c3c; /* สีแดงสด */
            color: white; /* เปลี่ยนสีตัวอักษรเป็นสีขาว */
        }
        .btn-danger:hover {
            background-color: #c0392b; /* สีแดงเข้มขึ้นเมื่อ hover */
        }
        .btn-lightred {
            background-color: #f9c2c5; /* สีแดงอ่อน */
            color: #721c24; /* สีข้อความ */
        }
        .btn-lightred:hover {
            background-color: #f5a5a9; /* สีแดงอ่อนเข้มขึ้นเมื่อ hover */
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
                    <th>ลบ</th>
                    <th>ดูรายละเอียด</th>
                    <th>เลขที่ใบสั่งซื้อ</th>
                    <th>วันที่</th>
                    <th>ราคารวม</th>
                    <th>ลูกค้า</th>
                    <th>ที่อยู่</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connectdb.php");
                $sql = "SELECT * FROM orders ORDER BY oid DESC";
                $rs = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
                ?>
                <tr>
                    <td>
                        <a href="delete_order.php?id=<?=$data['oid'];?>" class="btn btn-danger btn-sm" onclick="return confirm('คุณแน่ใจหรือว่าต้องการลบใบสั่งซื้อนี้?');">ลบ</a>
                    </td>
                    <td>
                        <a href="view_order_detail.php?a=<?=$data['oid'];?>" class="btn btn-lightred btn-sm">ดูรายละเอียด</a>
                    </td>
                    <td><?=$data['oid'];?></td>
                    <td><?=$data['odate'];?></td>
                    <td><?=number_format($data['ototal'],0);?></td>
                    <td><?=$data['cr_name'];?></td> <!-- แสดงชื่อของลูกค้า -->
                    <td><?=$data['cr_add'];?></td> <!-- แสดงที่อยู่ของลูกค้า -->
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

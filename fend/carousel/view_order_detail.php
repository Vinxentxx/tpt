<?php
session_start();
include("connectdb.php"); // รวมไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// ดึงข้อมูลการสั่งซื้อจากฐานข้อมูล
$user_id = $_SESSION['user_id'];
$query = "SELECT od.*, p.p_name, p.p_price 
          FROM order_detail od 
          JOIN products p ON od.p_id = p.p_id
          WHERE od.user_id = ? 
          ORDER BY od.order_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>รายละเอียดการสั่งซื้อ</title>
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap" rel="stylesheet">
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Mali', sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            color: #dc3545;
            text-align: center;
            margin-top: 20px;
            font-size: 3em;
        }
        .container {
            margin: 50px auto;
            max-width: 800px;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            border-radius: 20px;
            margin-top: 30px;
        }
        .btn-primary:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>รายละเอียดการสั่งซื้อ</h1>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ชื่อสินค้า</th>
                    <th>ราคา</th>
                    <th>จำนวน</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['p_name']; ?></td>
                    <td><?php echo number_format($row['p_price'], 0); ?> บาท</td>
                    <td><?php echo $row['quantity']; ?></td> <!-- Assuming quantity column exists -->
                    <td><?php echo number_format($row['p_price'] * $row['quantity'], 0); ?> บาท</td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="empty-cart-message">ยังไม่มีการสั่งซื้อใดๆ</p>
    <?php endif; ?>
    
    <form action="order.php" method="GET" class="text-right">
        <button type="submit" class="btn btn-primary">กลับไปที่หน้าสั่งซื้อ</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

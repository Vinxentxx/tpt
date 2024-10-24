<?php
session_start();
include("connectdb.php"); // Ensure you have the database connection

// Fetch orders from the database
$sql = "SELECT * FROM `orders`"; // Change the table name if necessary
$result = mysqli_query($conn, $sql);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Orders - TripleToys</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <h1>Orders List</h1>
</header>

<main class="container my-4">
    <h2>Your Orders</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($order = mysqli_fetch_array($result)) { ?>
                <tr>
                    <td><?= $order['order_id']; ?></td>
                    <td><?= $order['customer_name']; ?></td>
                    <td><?= $order['product_name']; ?></td>
                    <td><?= $order['quantity']; ?></td>
                    <td><?= number_format($order['total_price'], 2); ?> บาท</td>
                    <td><?= $order['order_date']; ?></td>
                    <td>
                        <!-- ปุ่มสำหรับลิงก์ไปที่หน้า profile.php -->
                        <a href="profile.php?customer_id=<?= $order['customer_id']; ?>" class="btn btn-info btn-sm">รายละเอียดผู้ส่ง</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</main>

<footer class="footer py-5">
    <div class="container">
        <p class="mb-1">TripleToys &copy; 2024</p>
    </div>
</footer>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

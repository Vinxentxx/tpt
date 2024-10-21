<?php

$host = 'localhost';
$dbname = 'messaging_system';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ข้อความจากลูกค้า</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #e6f7ff; /* พื้นหลังสีฟ้าอ่อน */
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #ff69b4; /* สีชมพู */
        }
        .table thead th {
            background-color: #ff69b4; /* สีชมพู */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #ffe6f0; /* สีชมพูอ่อนเมื่อ hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ข้อความจากลูกค้า</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>อีเมล</th>
                <th>ข้อความ</th>
                <th>วันที่ส่ง</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= htmlspecialchars($msg['name']) ?></td>
                    <td><?= htmlspecialchars($msg['email']) ?></td>
                    <td><?= htmlspecialchars($msg['message']) ?></td>
                    <td><?= $msg['created_at'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

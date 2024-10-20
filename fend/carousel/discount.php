<?php
// รวมการเชื่อมต่อฐานข้อมูล
include("connectdbcode.php");
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>เพิ่มโค้ดส่วนลด</title>
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
            text-align: center;
            margin: 20px 0;
            font-size: 2.5em; /* ขนาดตัวอักษร */
        }
        .form-control {
            border-color: #dc3545; /* สีขอบของช่องกรอก */
            border-radius: 20px; /* มุมมน */
            height: calc(2.5em + .75rem + 2px); /* ความสูงของช่องกรอก */
        }
        .btn-primary {
            background-color: #dc3545; /* สีปุ่ม */
            border-color: #dc3545; /* สีขอบปุ่ม */
            border-radius: 20px; /* มุมมน */
            color: white; /* สีตัวอักษรในปุ่ม */
            padding: 10px 20px; /* ขนาดปุ่ม */
            transition: background-color 0.3s; /* การเปลี่ยนสีเมื่อ hover */
        }
        .btn-primary:hover {
            background-color: #c82333; /* สีปุ่มเมื่อ hover */
        }
        .container {
            max-width: 600px; /* ขนาดความกว้างของฟอร์ม */
            margin: 0 auto; /* จัดกลาง */
            padding: 20px; /* ระยะห่าง */
            background-color: white; /* สีพื้นหลังของฟอร์ม */
            border-radius: 10px; /* มุมมน */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* เงาของฟอร์ม */
        }
    </style>
</head>

<body>

<div class="container">
    <h2>เพิ่มโค้ดส่วนลด</h2>
    <form action="discount.php" method="POST">
        <div class="form-group">
            <label for="code_name">ชื่อโค้ดส่วนลด:</label>
            <input type="text" id="code_name" name="code_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="code_price">ราคาส่วนลด:</label>
            <input type="number" step="0.01" id="code_price" name="code_price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">เพิ่มโค้ดส่วนลด</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $code_name = $_POST['code_name'];
        $code_price = $_POST['code_price'];

        // เพิ่มข้อมูลโค้ดส่วนลดเข้าในตาราง code
        $sql = "INSERT INTO code (code_name, code_price) VALUES ('$code_name', '$code_price')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='text-success'>เพิ่มโค้ดส่วนลดสำเร็จ!</p>";
        } else {
            echo "<p class='text-danger'>เกิดข้อผิดพลาด: " . $sql . "<br>" . $conn->error . "</p>";
        }
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
    ?>
</div>

</body>
</html>

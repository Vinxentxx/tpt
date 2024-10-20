<?php
include("connectdb3.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับข้อมูลจากฟอร์ม
    $name = $_POST['name'];
    $last = $_POST['last'];
    $tel = $_POST['tel'];
    $add = $_POST['add'];
    $mail = $_POST['mail'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // เพิ่มข้อมูลลูกค้าลงในตาราง customer
    $stmt = $conn->prepare("INSERT INTO customer (cr_name, cr_last, cr_tel, cr_add, cr_mail) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $last, $tel, $add, $mail);

    if ($stmt->execute()) {
        $cr_id = $stmt->insert_id; // รับ ID ของลูกค้า

        // เพิ่มข้อมูลผู้ใช้ลงในตาราง user
        $stmt = $conn->prepare("INSERT INTO user (cr_id, u_user, u_password) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $cr_id, $username, $password);

        if ($stmt->execute()) {
            // เปลี่ยนเส้นทางไปยังหน้า login.php
            header("Location: login.php");
            exit();
        } else {
            echo "ไม่สามารถสร้างบัญชีผู้ใช้ได้: " . $stmt->error;
        }
    } else {
        echo "ไม่สามารถลงทะเบียนได้: " . $stmt->error;
    }
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ลงทะเบียน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet"> <!-- เพิ่มฟอนต์ Mali -->
    <style>
        body {
            background-color: #f8f9fa; /* พื้นหลังสีอ่อน */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* ให้เต็มความสูงของหน้าจอ */
            margin: 0;
            font-family: 'Mali', sans-serif; /* ใช้ฟอนต์ Mali */
        }
        .form-register {
            max-width: 500px; /* ขนาดของฟอร์ม */
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
        }
        h2 {
            color: #c0392b; /* สีแดงเข้ม */
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #c0392b; /* ปุ่มสีแดง */
            border-color: #c0392b;
        }
        .btn-primary:hover {
            background-color: #e74c3c; /* สีแดงอ่อนเมื่อ hover */
        }
        .form-group label {
            font-weight: 500;
        }
        .form-control {
            padding: 10px;
            border-radius: 10px;
            width: 100%; /* ให้ช่องกรอกข้อมูลเต็มความกว้าง */
            max-width: 400px; /* ตั้งค่าความกว้างสูงสุด */
        }
        .btn-block {
            border-radius: 10px;
        }
        .text-center a {
            color: #c0392b;
            text-decoration: none;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: #f8f9fa;
            border-top: 1px solid #c0392b;
            color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="form-register">
        <img src="https://img2.pic.in.th/pic/new-logo-trippletoy.png" alt="Logo" class="logo" style="display: block; margin: 0 auto 20px; width: 160px;">
        <h2>ลงทะเบียน</h2>
        <form method="post">
            <div class="form-group mb-3">
                <label for="name">ชื่อ:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group mb-3">
                <label for="last">นามสกุล:</label>
                <input type="text" class="form-control" name="last" required>
            </div>
            <div class="form-group mb-3">
                <label for="tel">หมายเลขโทรศัพท์:</label>
                <input type="text" class="form-control" name="tel" required>
            </div>
            <div class="form-group mb-3">
                <label for="add">ที่อยู่:</label>
                <input type="text" class="form-control" name="add" required>
            </div>
            <div class="form-group mb-3">
                <label for="mail">อีเมล:</label>
                <input type="email" class="form-control" name="mail" required>
            </div>
            <div class="form-group mb-3">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ลงทะเบียน</button>
            <p class="mt-3 text-center"><a href="login.php">มีบัญชีอยู่แล้ว? เข้าสู่ระบบ</a></p>
        </form>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Tripletoys. สงวนลิขสิทธิ์.</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

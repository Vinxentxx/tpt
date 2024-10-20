<?php
session_start();
include("connectdb3.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ตรวจสอบข้อมูลผู้ใช้
    $stmt = $conn->prepare("SELECT * FROM user WHERE u_user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // ตรวจสอบว่าพบผู้ใช้และรหัสผ่านถูกต้อง
    if ($user && password_verify($password, $user['u_password'])) {
        // เก็บข้อมูลผู้ใช้ใน session
        $_SESSION['user_id'] = $user['cr_id'];
        $_SESSION['username'] = $user['u_user']; // เพิ่มบรรทัดนี้เพื่อเก็บชื่อผู้ใช้ใน session
        
        header("Location: index.php"); // เปลี่ยนไปยังหน้าหลัก
        exit();
    } else {
        $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }
}
?>

<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>เข้าสู่ระบบ</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Mali', sans-serif;
        }
        .form-login {
            max-width: 400px;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #c0392b;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #c0392b;
            border-color: #c0392b;
        }
        .btn-primary:hover {
            background-color: #e74c3c;
        }
        .error-message {
            color: red;
            text-align: center;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 160px;
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
    <div class="form-login">
        <img src="https://img2.pic.in.th/pic/new-logo-trippletoy.png" alt="Logo" class="logo">
        <h2>เข้าสู่ระบบ</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?= $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
            <p class="mt-3 text-center"><a href="register.php">ลงทะเบียนที่นี่</a></p>
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

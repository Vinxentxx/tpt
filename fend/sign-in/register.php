<?php
include("connectdb.php");

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
            // เปลี่ยนเส้นทางไปยังหน้า index.php
            header("Location: index.php");
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
    <title>ลงทะเบียน</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff; /* ฟ้าอ่อน */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* ให้เต็มความสูงของหน้าจอ */
            margin: 0;
        }
        .form-register {
            max-width: 600px; /* กว้างครึ่งหนึ่งของหน้าจอ */
            padding: 20px;
            background-color: white; /* เปลี่ยนพื้นหลังให้เป็นสีขาว */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin: 20px; /* เพิ่ม margin เพื่อให้ฟอร์มไม่ติดขอบหน้าจอ */
            width: 100%; /* ให้ฟอร์มเต็มพื้นที่ */
        }
        h2 {
            color: #ff69b4; /* ชมพู */
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #ff69b4; /* ปุ่มชมพู */
            border-color: #ff69b4;
        }
        .btn-primary:hover {
            background-color: #ff85c0; /* สีชมพูอ่อนลงเมื่อ hover */
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 160px; /* ปรับขนาดโลโก้ */
        }
    </style>
</head>
<body>
    <div class="form-register">
        <img src="https://chat.google.com/u/0/api/get_attachment_url?url_type=FIFE_URL&content_type=image%2Fpng&attachment_token=AOo0EEUi3eojJsDmpWVEaAfoH%2FfD8siJ7CXdf0JJqcMRSPfUu3Jx0OOsyLYBGDWjpYzEGpzvQO8sc4O9hvzXBZhGThm%2FSaAZc3z2qhD2kTjkRf1cz9gLcDpmWND45ZRTsS%2FnSSEo0tC1HSbS6xV%2BgoC2zY3YhzM8AXZMbQyttUT3ZH5kiLKo4a%2BzQAvokZ95Op%2BuvgUqsdR%2B8dwV1lJ6uPrdbsyMa8CR8JP4MRfWuDhTlkjZ91%2FnTdJ3tAiwhj19uMcIvGrCGAyDDgUbEUddnE53SxRJYdawX9WnWSONcBasuruOpUta%2BNCvwRcDyCvCUXOXLBpL4DPE3xFwkpJaOTvcwAtWwth2B86jAoXeAczHYFgJgvJhVKPWd6dxuCvB%2BDFENnGUSuNdXdhQUyaLCtQetud%2BIvBMCG5dinU0f%2FFQvv7p0aSn0u%2FlxHapoF4mOGYv%2BGxWzaQVFgkxJ7Cc%2FuwH87fCsxXETKzmCjEkCPODzAHK%2BKWWvW%2FeJ9v40EQmumjJI9nDO6TgIQgTYG7ODTKxopi%2BXislIR3IajP8Mq4smoNKH1VCAGYfeCiZpY0Dk7WYQBGtwMqrwNdNmuG3JEdl1rQx&sz=w1920-h919" alt="Logo" class="logo">
        <h2>ลงทะเบียน</h2>
        <form method="post">
            <div class="form-group">
                <label for="name">ชื่อ:</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="last">นามสกุล:</label>
                <input type="text" class="form-control" name="last" required>
            </div>
            <div class="form-group">
                <label for="tel">หมายเลขโทรศัพท์:</label>
                <input type="text" class="form-control" name="tel" required>
            </div>
            <div class="form-group">
                <label for="add">ที่อยู่:</label>
                <input type="text" class="form-control" name="add" required>
            </div>
            <div class="form-group">
                <label for="mail">อีเมล:</label>
                <input type="email" class="form-control" name="mail" required>
            </div>
            <div class="form-group">
                <label for="username">ชื่อผู้ใช้:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">รหัสผ่าน:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">ลงทะเบียน</button>
            <p class="mt-3 text-center"><a href="index.php">มีบัญชีอยู่แล้ว? เข้าสู่ระบบ</a></p>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

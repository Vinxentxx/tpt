<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ติดต่อ/สอบถาม</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mali:wght@300;400;500&display=swap" rel="stylesheet"> <!-- เพิ่มฟอนต์ Mali -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- เพิ่มไอคอน Font Awesome -->
    <style>
        body {
            background-color: #ffffff; /* พื้นหลังสีขาว */
            font-family: 'Mali', sans-serif; /* ใช้ฟอนต์ Mali */
        }
        .container {
            margin-top: 50px;
            max-width: 600px; /* จำกัดความกว้างของ container */
        }
        h1 {
            color: #c0392b; /* สีแดงเข้ม */
            margin-bottom: 30px; /* เพิ่มระยะห่างด้านล่าง */
            text-align: center; /* จัดกลางข้อความ */
        }
        .form-label {
            color: #c0392b; /* สีแดงเข้ม */
        }
        .btn-primary {
            background-color: #c0392b; /* ปุ่มสีแดง */
            border-color: #c0392b;
        }
        .btn-primary:hover {
            background-color: #e74c3c; /* สีแดงอ่อนเมื่อ hover */
        }
        .form-control {
            border-radius: 25px; /* ทำให้ขอบมุมกลม */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* เพิ่มเงาให้กับ input */
        }
        .btn-primary {
            border-radius: 25px; /* ทำให้ปุ่มมีขอบมุมกลม */
            padding: 10px 15px; /* เพิ่ม padding ให้ปุ่ม */
            font-size: 1.1rem; /* ขนาดตัวอักษรในปุ่ม */
        }
        .footer {
            text-align: center; /* จัดกลางข้อความใน footer */
            margin-top: 50px; /* เพิ่มระยะห่างด้านบน */
            position: absolute; /* ทำให้ footer อยู่ที่ด้านล่าง */
            bottom: 10px; /* ระยะห่างจากด้านล่าง */
            width: 100%; /* กว้างเต็มพื้นที่ */
        }
        .footer a {
            color: #c0392b; /* เปลี่ยนสีลิงก์ใน footer */
            text-decoration: none; /* ลบขีดเส้นใต้ */
        }
        .footer a:hover {
            text-decoration: underline; /* เพิ่มขีดเส้นใต้เมื่อ hover */
        }
        .home-icon {
            position: fixed;
            top: 20px; /* ระยะห่างจากด้านบน */
            right: 20px; /* ระยะห่างจากด้านขวา */
            background-color: #c0392b; /* สีพื้นหลังของปุ่ม */
            border-radius: 5px; /* ทำให้ปุ่มมีขอบมุมมน */
            padding: 10px; /* เพิ่ม padding */
            color: white; /* สีของไอคอน */
            font-size: 1.5rem; /* ขนาดของไอคอน */
            text-decoration: none; /* ลบขีดเส้นใต้ */
            transition: background-color 0.3s; /* เพิ่มการเปลี่ยนสี */
        }
        .home-icon:hover {
            background-color: #e74c3c; /* เปลี่ยนสีเมื่อ hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>ติดต่อ/สอบถาม</h1>
    <form action="send_message.php" method="post" class="mt-4">
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">ข้อความ</label>
            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">ส่งข้อความ</button>
    </form>
</div>

<a href="index.php" class="home-icon" aria-label="กลับไปที่หน้าแรก">
    <i class="fas fa-home"></i> <!-- ใช้ไอคอนบ้านจาก Font Awesome -->
</a>

<footer class="footer">
    <p>&copy; 2024 Tripletoys. สงวนลิขสิทธิ์.</p>
</footer>

<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

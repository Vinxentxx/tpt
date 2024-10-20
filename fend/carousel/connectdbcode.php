<?php
$servername = "localhost";
$username = "root"; // หรือชื่อผู้ใช้ของคุณ
$password = "220203vinx"; // รหัสผ่านของคุณ
$dbname = "discountcode"; // ชื่อฐานข้อมูลที่คุณต้องการเชื่อมต่อ

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
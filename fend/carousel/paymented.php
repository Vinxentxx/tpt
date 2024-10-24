<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost"; // เปลี่ยนถ้าจำเป็น
$username = "root"; // ชื่อผู้ใช้ฐานข้อมูล
$password = "vinx220203"; // รหัสผ่านฐานข้อมูล
$dbname = "shoponline"; // ชื่อฐานข้อมูล

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("การเชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['payment_image']['name']);
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
        if (!in_array($file_type, $allowed_types)) {
            echo "ไฟล์ประเภทนี้ไม่อนุญาต: " . htmlspecialchars($file_type);
            exit();
        }

        if (move_uploaded_file($_FILES['payment_image']['tmp_name'], $target_file)) {
            // บันทึกข้อมูลลงฐานข้อมูล
            $user_id = $_SESSION['user_id']; // รหัสผู้ใช้จากเซสชัน
            $stmt = $conn->prepare("INSERT INTO payments (cr_id, payment_image) VALUES (?, ?)");
            $stmt->bind_param("is", $user_id, $target_file);

            if ($stmt->execute()) {
                echo "อัปโหลดไฟล์สำเร็จและบันทึกข้อมูลลงฐานข้อมูลเรียบร้อย";
            } else {
                echo "เกิดข้อผิดพลาดในการบันทึกข้อมูลลงฐานข้อมูล: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "อัปโหลดไฟล์ไม่สำเร็จ";
        }
    } else {
        // แสดงข้อผิดพลาดถ้ามี
        switch ($_FILES['payment_image']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "ไฟล์มีขนาดใหญ่เกินไป";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "ไม่มีไฟล์ถูกเลือก";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "ไฟล์ถูกอัปโหลดไม่สมบูรณ์";
                break;
            default:
                echo "เกิดข้อผิดพลาดในการอัปโหลด: " . $_FILES['payment_image']['error'];
        }
    }
}

$conn->close();
?>

<?php
session_start();

// ตรวจสอบการล็อกอิน
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ตรวจสอบว่าไฟล์ถูกส่งมาและไม่มีข้อผิดพลาด
    if (isset($_FILES['payment_image']) && $_FILES['payment_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/"; // โฟลเดอร์ที่จะเก็บไฟล์
        $target_file = $target_dir . basename($_FILES['payment_image']['name']);
        
        // ตรวจสอบว่าต้องสร้างโฟลเดอร์ขึ้นใหม่หรือไม่
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // ตรวจสอบขนาดไฟล์และชนิดไฟล์
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf']; // ประเภทไฟล์ที่อนุญาต
        if (!in_array($file_type, $allowed_types)) {
            echo "ไฟล์ประเภทนี้ไม่อนุญาต: " . htmlspecialchars($file_type);
            exit();
        }

        // อัปโหลดไฟล์
        if (move_uploaded_file($_FILES['payment_image']['tmp_name'], $target_file)) {
            echo "อัปโหลดไฟล์สำเร็จ: " . htmlspecialchars(basename($_FILES['payment_image']['name']));
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
?>

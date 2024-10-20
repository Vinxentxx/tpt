<?php
@session_start();

session_destroy();

echo "<meta charset=\"utf-8\">";
echo "<link href=\"https://fonts.googleapis.com/css2?family=Mali:wght@300;500&display=swap\" rel=\"stylesheet\">"; // เชื่อมต่อฟอนต์ Mali
echo "<div style=\"display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; font-family: 'Mali', sans-serif;\">"; // ใช้ฟอนต์ Mali
echo "<div style=\"text-align: center;\">";
echo "<i class=\"fa fa-spinner fa-spin\" style=\"font-size: 48px; margin-bottom: 20px;\"></i>"; // ไอคอนโหลด
echo "<h3>กำลังลบสินค้า กรุณารอสักครู่....</h3>";
echo "</div>";
echo "</div>";

echo "<meta http-equiv=\"refresh\" content=\"2;URL=basket.php\">";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!-- เชื่อมต่อ Font Awesome -->

<?php
include("connectdb.php");

// รับ ID ของใบสั่งซื้อจากพารามิเตอร์ URL
$orderId = isset($_GET['id']) ? $_GET['id'] : null;

// ตรวจสอบว่ามี ID หรือไม่
if ($orderId === null) {
    die("ไม่มีข้อมูลใบสั่งซื้อ");
}

// ลบรายละเอียดสินค้าที่เกี่ยวข้องกับใบสั่งซื้อในตาราง orders_detail
$sqlDeleteDetail = "DELETE FROM orders_detail WHERE oid = '$orderId'";
if (!mysqli_query($conn, $sqlDeleteDetail)) {
    echo "เกิดข้อผิดพลาดในการลบรายละเอียดสินค้า: " . mysqli_error($conn);
    mysqli_close($conn);
    exit;
}

// ลบใบสั่งซื้อจากฐานข้อมูล
$sqlDeleteOrder = "DELETE FROM orders WHERE oid = '$orderId'";
if (mysqli_query($conn, $sqlDeleteOrder)) {
    echo "<script>alert('ลบใบสั่งซื้อสำเร็จ'); window.location.href = 'view_order.php';</script>";
} else {
    echo "เกิดข้อผิดพลาดในการลบใบสั่งซื้อ: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<?php
include("connectdb register.php");

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $sql = "DELETE FROM customer WHERE cr_id = '$customer_id'";
    $msg = mysqli_query($conn, $sql) ? 'ลบข้อมูลลูกค้าสำเร็จ!' : 'เกิดข้อผิดพลาดในการลบข้อมูล!';
    echo "<script>alert('$msg'); window.location='customer.php';</script>";
}

mysqli_close($conn);
?>

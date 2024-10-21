<?php
@session_start();
include("connectdb.php");

$total = 0; // กำหนดตัวแปรรวมราคา

foreach($_SESSION['sid'] as $pid) {
    $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
    $total += $sum[$pid];
}

// เพิ่ม member_id ในคำสั่ง SQL
$cr_id = isset($_SESSION['cr_id']) ? $_SESSION['cr_id'] : null; // ตรวจสอบค่า member_id

$sql = "INSERT INTO `orders` (odate, ototal, cr_id) VALUES (CURRENT_TIMESTAMP, '$total', '$cr_id');";
mysqli_query($conn, $sql) or die ("insert error: " . mysqli_error($conn));
$id = mysqli_insert_id($conn);

foreach($_SESSION['sid'] as $pid) {
    $sql2 = "INSERT INTO `orders_detail` (oid, pid, item) VALUES ('$id', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."');";
    mysqli_query($conn, $sql2) or die ("insert detail error: " . mysqli_error($conn));
}

echo "<meta http-equiv=\"refresh\" content=\"0;URL=order.php\">";
?>

<meta charset="utf-8">
<?php
@session_start();
include("connectdb.php");

$total = 0; // กำหนดตัวแปรรวมราคา

foreach($_SESSION['sid'] as $pid) {
    $sum[$pid] = $_SESSION['sprice'][$pid] * $_SESSION['sitem'][$pid];
    $total += $sum[$pid];
}

// แก้ไขคำสั่ง SQL ให้ตรงกับโครงสร้างตาราง
$sql = "INSERT INTO `orders` (odate, ototal) VALUES (CURRENT_TIMESTAMP, '$total');"; // ลบ payment_status ออก
mysqli_query($conn, $sql) or die ("insert error: " . mysqli_error($conn));
$id = mysqli_insert_id($conn);

foreach($_SESSION['sid'] as $pid) {
    // ปรับชื่อคอลัมน์ตามที่มีอยู่ในตาราง
    $sql2 = "INSERT INTO `orders_detail` (oid, pid, item) VALUES ('$id', '".$_SESSION['sid'][$pid]."', '".$_SESSION['sitem'][$pid]."');";
    mysqli_query($conn, $sql2) or die ("insert detail error: " . mysqli_error($conn));
}

echo "<meta http-equiv=\"refresh\" content=\"0;URL=order.php\">";
?>

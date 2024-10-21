<?php
session_start();
include("connectdb3.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT cr_id FROM user WHERE u_user = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$cr_id = $row['cr_id'];

if (isset($_GET['address_id'])) {
    $address_id = $_GET['address_id'];

    // ตั้ง is_default ของทุกที่อยู่เป็น 0 ก่อน
    $conn->query("UPDATE addresses SET is_default = 0 WHERE cr_id = $cr_id");

    // ตั้งที่อยู่ที่เลือกให้เป็นที่อยู่หลัก
    $stmt = $conn->prepare("UPDATE addresses SET is_default = 1 WHERE address_id = ? AND cr_id = ?");
    $stmt->bind_param("ii", $address_id, $cr_id);
    
    if ($stmt->execute()) {
        header("Location: profile.php");
        exit;
    } else {
        echo "เกิดข้อผิดพลาด: " . $conn->error;
    }
}
?>

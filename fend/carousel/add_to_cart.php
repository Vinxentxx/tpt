<?php
session_start();
include("connectdb.php");

if (!isset($_SESSION['cart_count'])) {
    $_SESSION['cart_count'] = 0; 
}

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    
    // ดึงข้อมูลสินค้าจากฐานข้อมูล
    $sql = "SELECT * FROM product WHERE p_id = '$productId'";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_array($result);
    
    if ($product) {
        // ตรวจสอบว่าสินค้านี้มีในตะกร้าหรือไม่
        if (isset($_SESSION['sid'][$productId])) {
            $_SESSION['sitem'][$productId]++; // ถ้ามีอยู่แล้ว เพิ่มจำนวน
        } else {
            // ถ้ายังไม่มีในตะกร้า เพิ่มสินค้าใหม่ลงใน session
            $_SESSION['sid'][$productId] = $product['p_id'];
            $_SESSION['sname'][$productId] = $product['p_name'];
            $_SESSION['sprice'][$productId] = $product['p_price'];
            $_SESSION['sdetail'][$productId] = $product['p_detail'];
            $_SESSION['sext'][$productId] = $product['p_ext'];
            $_SESSION['sitem'][$productId] = 1; // เริ่มต้นที่ 1 ชิ้น
        }

        // เพิ่มจำนวนสินค้าลงในตะกร้า
        $_SESSION['cart_count']++;
    }

    // ส่งจำนวนสินค้าปัจจุบันกลับไป
    echo $_SESSION['cart_count'];
} else {
    echo $_SESSION['cart_count']; // ส่งจำนวนสินค้าปัจจุบันกลับไป
}
?>

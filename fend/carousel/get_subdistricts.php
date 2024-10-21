<?php
include("connectdb3.php"); // เชื่อมต่อฐานข้อมูล

if (isset($_POST['district'])) {
    $district = $_POST['district'];
    $stmt = $conn->prepare("SELECT DISTINCT subdistrict FROM your_address_table WHERE district = ?");
    $stmt->bind_param("s", $district);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['subdistrict'] . "'>" . $row['subdistrict'] . "</option>";
    }
}
?>

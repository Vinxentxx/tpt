<?php
include("connectdb register.php");

if (isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customer WHERE cr_id = '$customer_id'"));

    if (isset($_POST['update'])) {
        mysqli_query($conn, "UPDATE customer SET 
            cr_name='{$_POST['cr_name']}', 
            cr_last='{$_POST['cr_last']}', 
            cr_tel='{$_POST['cr_tel']}', 
            cr_add='{$_POST['cr_add']}', 
            cr_mail='{$_POST['cr_mail']}' 
            WHERE cr_id='$customer_id'") 
            ? header("Location: customer.php?msg=updated") 
            : header("Location: customer.php?msg=error");
    }
} else {
    header("Location: customer.php?msg=missing");
}
mysqli_close($conn);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลลูกค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff; /* White background */
        }
        h1 {
            color: #d50000; /* Red heading */
            margin-bottom: 20px;
        }
        .form-container {
            background-color: #ffffff; /* White background for form */
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 30px;
            margin-top: 30px;
            border: 2px solid #d50000; /* Red border for form */
        }
        .btn-custom {
            background-color: #d50000; /* Red button */
            color: white;
        }
        .btn-custom:hover {
            background-color: #b00000; /* Darker red on hover */
        }
        .form-label {
            color: #d50000; /* Red label color */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="form-container mx-auto">
        <h1 class="text-center">แก้ไขข้อมูลลูกค้า</h1>
        <form method="post">
            <div class="mb-3">
                <label for="cr_name" class="form-label">ชื่อ</label>
                <input type="text" name="cr_name" class="form-control" value="<?= htmlspecialchars($data['cr_name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cr_last" class="form-label">นามสกุล</label>
                <input type="text" name="cr_last" class="form-control" value="<?= htmlspecialchars($data['cr_last']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cr_tel" class="form-label">เบอร์โทร</label>
                <input type="text" name="cr_tel" class="form-control" value="<?= htmlspecialchars($data['cr_tel']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cr_add" class="form-label">ที่อยู่</label>
                <textarea name="cr_add" class="form-control" rows="4" required><?= htmlspecialchars($data['cr_add']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="cr_mail" class="form-label">อีเมล</label>
                <input type="email" name="cr_mail" class="form-control" value="<?= htmlspecialchars($data['cr_mail']); ?>" required>
            </div>
            <button type="submit" name="update" class="btn btn-custom">บันทึก</button>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

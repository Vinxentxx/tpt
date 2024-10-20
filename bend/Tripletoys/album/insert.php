<?php
include_once("connectdb.php"); // Connect to database

if (isset($_POST['Submit'])) { // Form submission
    $file_name = $_FILES['pimg']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension

    // Prepare SQL statement to add a new product
    $sql = "INSERT INTO product (p_name, p_detail, p_price, p_ext, pt_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsi', $_POST['pname'], $_POST['pdetail'], $_POST['pprice'], $ext, $_POST['ptype']);
    mysqli_stmt_execute($stmt) or die("Failed to add product");
    $idauto = mysqli_insert_id($conn); // Get new product ID

    // Copy image file to images/ folder
    copy($_FILES['pimg']['tmp_name'], "images/$idauto.$ext");

    echo "<script>alert('Product added successfully'); window.location='index.php';</script>"; // Alert and redirect
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TripleToys - Add Product</title>
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #ffffff; } /* White background */
        h1 { color: #d50000; } /* Red heading */
        .form-container { 
            background-color: #ffffff; /* White background for form */
            border-radius: .5rem; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            padding: 20px; 
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
<div class="container">
    <h1 class="text-center">TripleToys - เพิ่มสินค้าใหม่</h1>
    <div class="form-container mx-auto">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="pname" class="form-label">ชื่อสินค้า</label>
                <input type="text" id="pname" name="pname" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label for="pdetail" class="form-label">รายละเอียดสินค้า</label>
                <textarea id="pdetail" name="pdetail" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="pprice" class="form-label">ราคา</label>
                <input type="text" id="pprice" name="pprice" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pimg" class="form-label">ภาพสินค้า</label>
                <input type="file" id="pimg" name="pimg" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="ptype" class="form-label">ประเภทสินค้า</label>
                <select id="ptype" name="ptype" class="form-select" required>
                    <?php
                    $sql = "SELECT * FROM type ORDER BY t_name ASC";
                    $rs = mysqli_query($conn, $sql);
                    while ($data = mysqli_fetch_assoc($rs)) {
                        echo "<option value='{$data['t_id']}'>{$data['t_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" name="Submit" class="btn btn-custom">เพิ่ม</button>
        </form>
    </div>
</div>

<?php
mysqli_close($conn); // Close database connection
?>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include_once("connectdb.php");
$sql1 = "SELECT * FROM product WHERE `p_id`='{$_GET['pid']}'" ;
$rs1 = mysqli_query($conn, $sql1);
$data1 = mysqli_fetch_array($rs1);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TripleToys - แก้ไขสินค้า</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #d50000;
        }
        h1 {
            color: #d50000;
        }
        .form-container {
            background-color: #f8d7da;
            border-radius: 1rem;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-top: 30px;
        }
        .btn-custom {
            background-color: #d50000;
            color: white;
        }
        .btn-custom:hover {
            background-color: #b00000;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center">TripleToys - แก้ไขสินค้า</h1>
    <div class="form-container mx-auto">
        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="pname" class="form-label">ชื่อสินค้า</label>
                <input type="text" name="pname" class="form-control" required autofocus value="<?= htmlspecialchars($data1['p_name']); ?>">
            </div>
            <div class="mb-3">
                <label for="pdetail" class="form-label">รายละเอียดสินค้า</label>
                <textarea name="pdetail" class="form-control" rows="5" required><?= htmlspecialchars($data1['p_detail']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="pprice" class="form-label">ราคา</label>
                <input type="text" name="pprice" class="form-control" required value="<?= htmlspecialchars($data1['p_price']); ?>">
            </div>
            <div class="mb-3">
                <label for="pimg" class="form-label">รูปภาพ</label>
                <input type="file" name="pimg" class="form-control">
            </div>
            <div class="mb-3">
                <label for="ptype" class="form-label">ประเภทสินค้า</label>
                <select name="ptype" class="form-select" required>
                <?php
                $sql = "SELECT * FROM `type` ORDER BY t_name ASC";
                $rs = mysqli_query($conn, $sql);
                while ($data = mysqli_fetch_array($rs)) {
                    echo "<option value=\"{$data['t_id']}\" " . ($data['t_id'] == $data1['t_id'] ? "selected" : "") . ">{$data['t_name']}</option>";
                }
                ?>
                </select>
            </div>
            <button type="submit" name="Submit" class="btn btn-custom">บันทึก</button>
        </form>
    </div>
</div>

<?php
if (isset($_POST['Submit'])) {
    if (empty($_FILES['pimg']['name'])) {
        $sql = "UPDATE `product` SET `p_name` = '{$_POST['pname']}', `p_detail` = '{$_POST['pdetail']}', `p_price` = '{$_POST['pprice']}', `c_id` = '{$_POST['ptype']}' WHERE `product`.`p_id` = '{$_GET['pid']}'";
    } else {
        $file_name = $_FILES['pimg']['name'];
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $sql = "UPDATE `product` SET `p_name` = '{$_POST['pname']}', `p_detail` = '{$_POST['pdetail']}', `p_price` = '{$_POST['pprice']}', `c_id` = '{$_POST['ptype']}', `p_ext` = '$ext' WHERE `product`.`p_id` = '{$_GET['pid']}'";
        copy($_FILES['pimg']['tmp_name'], "images/" . $_GET['pid'] . "." . $ext);
    }

    mysqli_query($conn, $sql) or die("แก้ไขข้อมูลสินค้าไม่ได้");
    echo "<script>alert('แก้ไขข้อมูลสินค้าสำเร็จ'); window.location='index.php';</script>";
}

mysqli_close($conn);
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

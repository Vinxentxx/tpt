<?php
	include("connectdb.php");
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>รายการสินค้า</title>
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <style>
        body {
            background-color: #f8f9fa; /* สีพื้นหลังเป็นสีขาว */
            font-family: Arial, sans-serif;
        }
        h2 {
            color: #dc3545; /* สีแดงสำหรับหัวข้อ */
            text-align: center;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
        }

        .btn-primary:hover {
            background-color: #c82333;
            transform: translateY(-3px); /* เคลื่อนที่ขึ้นเมื่อ hover */
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2); /* เพิ่มเงาลึกขึ้น */
        }

        .btn-success, .btn-info {
            background-color: #ffc107;
            border-color: #ffc107;
            color: white;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* เพิ่มเงา */
        }

        .btn-info:hover, .btn-success:hover {
            background-color: #e0a800;
            transform: translateY(-3px); /* เคลื่อนที่ขึ้นเมื่อ hover */
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2); /* เพิ่มเงาลึกขึ้น */
        }

        .thumbnail {
            border: 1px solid #dc3545;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .thumbnail:hover {
            transform: scale(1.05);
        }
        .caption {
            background-color: #f8f9fa;
            color: #dc3545;
            padding: 15px;
            text-align: center;
        }
        .form-control {
            border-color: #dc3545;
        }
        .form-control:focus {
            border-color: #c82333;
            box-shadow: 0 0 5px #c82333;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .row {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
<h2>รายการสินค้าทั้งหมด test for reaction</h2>
<p class="text-center">
    <a href="../shoponline/basket.php" class="btn btn-success">ตะกร้าสินค้า</a>
</p>

<?php
	$sql2 = "select * from product_type";
	$rs2 = mysqli_query($conn, $sql2);
?>

<div class="text-center">
    <a href="index1.php" class="btn btn-info">สินค้าทั้งหมด</a> | 
    <?php while ($data2 = mysqli_fetch_array($rs2, MYSQLI_BOTH)) { ?>
        <a href="index1.php?pt=<?=$data2['pt_id'];?>" class="btn btn-info"><?=$data2['pt_name'];?></a> | 
    <?php } ?>
</div>

<br>

<form class="form-inline text-center" action="../shoponline/index.php" method="post">
<fieldset>

    <div class="form-group">
        <label class="control-label" for="textinput">ค้นหา</label>  
        <input name="kw" type="text" placeholder="กรอกคำค้น" class="form-control input-md">
    </div>

    <div class="form-group">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">ค้นหา</button>
    </div>

</fieldset>
</form>

<div class="container">
    <div class="row">
    <?php
        @$kw = $_POST['kw'];
        @$pt = $_GET['pt'];
        $s = isset($_GET['pt']) ? "and (pt_id = '$pt')" : "";	
        $sql = "select * from product where (p_name like '%$kw%' or p_detail like '%$kw%') $s";
        $rs = mysqli_query($conn, $sql);
        $i = 0;
        while ($data = mysqli_fetch_array($rs, MYSQLI_BOTH)) {
            $i++;
            if (($i % 3) == 1) {
                echo "<div class='row' align='center' style='width:100%;'>";
            }
    ?>

        <div class="col-md-4">
            <div class="thumbnail">
                <img src="images/<?=$data['p_id'];?>.<?=$data['p_ext'];?>" class="img-fluid" alt="<?=$data['p_name'];?>" style="height: 300px; object-fit: cover;">
                <div class="caption">
                    <h5><?=$data['p_name'];?></h5>
                    <p><?=$data['p_price'];?> บาท</p>
                    <p><a href="basket.php?id=<?=$data['p_id'];?>" class="btn btn-primary" role="button">เพิ่มลงตะกร้า</a></p>
                </div>
            </div>
        </div>
    <?php 
            if (($i % 3) == 0) {
                echo "</div>";	
            }
        } // end while

        mysqli_close($conn);
    ?>
    </div> <!-- end of row -->
</div> <!-- end of container -->

</body>
</html>

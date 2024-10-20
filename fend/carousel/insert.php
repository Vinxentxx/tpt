<?php
include_once("checklogin.php");
echo $_SESSION[ 'aname' ];
?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TripleToys</title>
</head>

<body>
<h1>TripleToys - เพิ่มสินค้า</h1>

<form method="post" action="" enctype="multipart/form-data">
	ชื่อสินค้า <input type="text" name="pname" required autofocus><br>
    รายละเอียดสินค้า<br>
	<textarea name="pdetail" rows="5" cols="50"></textarea><br>
    ราคา <input type="text" name="pprice" required><br>
    รูปภาพ <input type="file" name="pimg"><br>
    ประเภทสินค้า 
    <select name="ptype">
    <?php	
	include_once("connectdb.php");
	$sql = "SELECT * FROM `type` ORDER BY `type`.`t_name` ASC ";
	$rs= mysqli_query($conn, $sql) ;
	while ($data = mysqli_fetch_array($rs) ){
	?>
    	<option value="<?=$data['t_id'];?>"><?=$data['t_name'];?></option>
    <?php } ?>
    </select>
    <br><br>
    <button type="submit" name="Submit"> เพิ่ม </button>
</form> <hr>

<?php
if(isset($_POST['Submit'])){
	
	//var_dump($_FILES['pimg']['name']); exit;
	$file_name = $_FILES['pimg']['name'] ;
	$ext = substr( $file_name , strpos( $file_name , '.' )+1 ) ;
	
	$sql = "INSERT INTO `product` (`c_id`,`p_id`, `p_name`, `p_detail`, `p_price`, `p_ext`, `t_id`) VALUES (NULL, '{$_POST['pname']}', '{$_POST['pdetail']}', '{$_POST['pprice']}', '{$ext}', '{$_POST['ptype']}') ;";
	mysqli_query($conn, $sql)  or die ("เพิ่มข้อมูลสินค้าไม่ได้");
	$idauto = mysqli_insert_id($conn);
	
	copy($_FILES['pimg']['tmp_name'], "images/".$idauto.".".$ext) ;
	
	echo "<script>";
	echo "alert('เพิ่มข้อมูลสินค้าสำเร็จ');";
	echo "window.location='index.php';";
	echo "</script>";
}
?>



<?php	
	mysqli_close($conn);
?>
</body>
</html>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title> Tripletoys </title>
</head>

<body>
<h1>Tripletoys</h1>
<?php
   $host = "localhost";
   $usr = "root";
   $pwd = "";
   $db = "shop";

    $conn = mysqli_connect($host,$usr,$pwd) or die ("เชื่อมต่อฐานข้อมูลไม่ได้");
	mysqli_select_db($conn,$db) or die ("เลือกฐานข้อมูลไม่ได้");	
	mysqli_query($conn,"SET NAMES utf8");
	
	$sql = "SELECT * FROM `product`";
	$rs = mysqli_query($conn,$sql);
	
	while($data = mysqli_fetch_array($rs)){
		$img = $data['p_id'].".".$data['p_ext'];
		echo"<img src='images/{$img}' width='240'><br>";
		echo $data['p_name']. "<br>";
		echo $data['p_price']. "<hr>";
		
		
	}
	
?>

</body>
</html>
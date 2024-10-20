<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tripletoys </title>
</head>

<body>


<h1>Tripletoys</h1>
 <form method="post" action="">
       ชื่อประเภทสินค้า<input type="text" name="cname" required autocomplete>
        <button type="submit" name="Submit">เพิ่ม</button>
  </form> <hr><hr>

<?php

      include("connectdb.php");
 if(isset($_POST['Submit'])){
     
   $sql= "INSERT INTO type (t_id, t_name) VALUES (NULL, '{$_POST['tname']}');";
   $sql = mysqli_query($conn,$sql);     
     
     }

?>

<?php
$sql = "SELECT * FROM type ORDER BY t_id DESC";
    $rs = mysqli_query($conn,$sql);
    
    while($data = mysqli_fetch_array($rs)){
        echo $data['t_id']. "<br>";
        echo $data['t_name']. "<br>";
  echo"<a href='delete.php?tid={$data['t_id']}' onClick='return confirm(\"ยืนยันการลบ?\")'>ลบ</a> <hr>";
        
    }
    mysqli_close($conn);
?>



</body>
</html>
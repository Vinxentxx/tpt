<?php
include_once("checklogin.php");
if(isset($_GET['tid'])){
      include("connectdb.php");
      
	  $sql = "DELETE FROM type WHERE `type`.`t_id`='{$_GET['tid']}' ";
	  mysqli_query($conn,$sql) or die ("ลบข้อมูลไม่สำเร็จ");
	  echo "<script>";
	  echo"window.location='b.php';";
	  echo"</script>";
	 	 
	  }
?>
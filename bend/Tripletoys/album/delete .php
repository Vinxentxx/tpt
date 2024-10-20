<?php
include_once("checklogin.php");
if(isset($_GET['ptid'])){
      include("connectdb.php");
      
	  $sql = "DELETE FROM type WHERE `type`.`pt_id`='{$_GET['ptid']}' ";
	  mysqli_query($conn,$sql) or die ("ลบข้อมูลไม่สำเร็จ");
	  echo "<script>";
	  echo"window.location='b.php';";
	  echo"</script>";
	 	 
	  }
?>
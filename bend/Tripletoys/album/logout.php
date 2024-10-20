<?php
session_start();

unset($_SESSION[ 'pt_id' ]);
unset($_SESSION[ 'pt_name' ]);

echo "<script>";
echo "window.location = '../sign-in/index.php';"; 
echo "</script>";
?>

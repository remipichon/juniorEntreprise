<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true)
	header('location:tool.php');
	else header('location:connectForm.php');
?>

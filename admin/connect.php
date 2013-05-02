<?php
session_start();
require'bin/params.php';
$pseudo=$_POST['pseudo'];
$password=$_POST['password'];
if($pseudo==$adminPseudo && $password==$adminPassword)$_SESSION['admin']=true;
header('location:index.php');
?>
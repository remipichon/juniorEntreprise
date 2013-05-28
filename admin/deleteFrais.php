<?php

$noFrais = $_GET['id'];
require 'bin/params.php';
mysql_connect($host, $user, $password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die ('la base de donnee n\'existe pas');
$query = "delete from frais where noFrais = '$noFrais'";
mysql_query($query);
header("location:fraisTool.php?return=null");
mysql_close();
?>


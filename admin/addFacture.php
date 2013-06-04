<?php
$name = $_POST['name'];
$adress = $_POST['adress'];
$secuNum = $_POST['secuNum'];
require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);
mysql_query("INSERT INTO etudiant (nomEtudiant,adresseEtudiant,noSecu) VALUES('$name','$adress','$secuNum') ");
mysql_close();
$return = "null";
header("location:studentTool.php?return=$return");
?>
<?php
$name = $_POST['name'];
$adress = $_POST['adress'];
$Num = $_POST['phoneNum'];
require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);
mysql_query("INSERT INTO entreprise (nomEnts,adresseEnts,telEnts) VALUES('$name','$adress','$Num') ");
mysql_close();
$return = "null";
header("location:corpTool.php?return=$return");
?>
<?php
$noEtudiant = $_POST['noEtudiant'];
$date = $_POST['date'];
$noEtude = $_POST['noEtude'];
$montDep = $_POST['montDep'];
$montSej = $_POST['montSej'];
$montAut = $_POST['montAut'];
require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);
mysql_query("INSERT INTO frais (date,montDep,montSejour,montAutre,noEtudiant,noEtude) 
    VALUES('$date','$montDep','$montSej','$montAut','$noEtudiant','$noEtude') ");
mysql_close();
$return = "null";
header("location:fraistool.php?return=$return");
?>
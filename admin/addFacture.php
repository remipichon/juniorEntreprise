<?php
$date = $_POST['date'];
$montant = $_POST['montant'];
$noEtude = $_POST['noEtude'];
require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);
mysql_query("INSERT INTO facture (date,montant,noEtude) VALUES('$date','$montant','$noEtude') ");
mysql_query("UPDATE etude set statut=1 where noEtude=$noEtude ");
mysql_close();
header("location:factureTool.php");
?>
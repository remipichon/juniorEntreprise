<?php
$noEtudiant = $_POST['noEtudiant'];
$date = $_POST['date'];
$noEtude = $_POST['noEtude'];
$montant = $_POST['montant'];
$nbJour = $_POST['nbJour'];

require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);
mysql_query("INSERT INTO indemnites (date,nbJourEtude,montant,noEtudiant,noEtude) 
    VALUES('$date','$nbJour','$montant','$noEtudiant','$noEtude') ");
mysql_close();
$return = "null";
header("location:IndemnitesTool.php?noEtudiant=$noEtudiant");
?>

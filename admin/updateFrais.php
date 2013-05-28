<?php

$id = $_POST['id'];
$noEtude = $_POST['noEtude'];
$noEtudiant = $_POST['noEtudiant'];
$date = $_POST['date'];
$montDep = $_POST['montDep'];
$montSejour = $_POST['montSejour'];
$montAutre = $_POST['montAutre'];

require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donnees n\'existe pas');
$query="UPDATE frais SET date='$date', montDep='$montDep', montSejour='$montSejour', montAutre='$montAutre', noEtudiant='$noEtudiant', noEtude='$noEtude'  WHERE noFrais='$id'";
mysql_query($query);
mysql_close();

$return = "null";
header("location:fraisTool.php?return=$return");
//l'ancre ne fonctionne pas
?>

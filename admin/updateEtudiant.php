<?php

$id = $_POST['id'];
$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$noSecu = $_POST['noSecu'];

require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donnees n\'existe pas');
$query="UPDATE etudiant SET nomEtudiant='$nom', adresseEtudiant='$adresse', noSecu='$noSecu' WHERE noEtudiant='$id'";
mysql_query($query);
mysql_close();

$return = "null";
header("location:studentTool.php?return=$return");
//l'ancre ne fonctionne pas
?>

<?php

$id = $_POST['id'];
$nom = $_POST['nom'];
$adresse = $_POST['adresse'];
$tel = $_POST['tel'];

require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donnees n\'existe pas');
$query="UPDATE entreprise SET nomEnts='$nom', adresseEnts='$adresse', telEnts='$tel' WHERE noEnts='$id'";
mysql_query($query);
mysql_close();

$return = "null";
header("location:CorpTool.php?return=$return");
//l'ancre ne fonctionne pas
?>

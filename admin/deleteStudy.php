<?php

$no = $_GET['id'];
require 'bin/params.php';
$link = mysql_connect($host, $user, $password);
mysql_select_db($base);
$query = "delete from etude where noEtude = '$no'";

// Exécution de la requête
$result = mysql_query($query);

//catch de l'erreur sql
if (mysql_errno() === 1451 || mysql_errno() === 1064) { //contrainte de foreign key
    $return = "alert('contrainte de foreign key, supprimer les etudes entites à cette entreprise')";
} else {
    $return = "null";
}


header("location:studyTool.php?return=$return");

mysql_close();
?>


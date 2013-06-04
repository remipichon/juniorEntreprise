<?php

$no = $_GET['id'];
require 'bin/params.php';
$link = mysql_connect($host, $user, $password);
mysql_select_db($base);
$query = "delete from entreprise where noEnts = '$no'";

// Ex�cution de la requ�te
$result = mysql_query($query);

//catch de l'erreur sql
if (mysql_errno() === 1451 || mysql_errno() === 1064) { //contrainte de foreign key
    $return = "alert('contrainte de foreign key, supprimer les etudes associees a cette entreprise')";
} else {
    $return = "null";
}
mysql_close();
header("location:corpTool.php?return=$return");
?>

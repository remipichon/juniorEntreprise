<?php
$noEtudiant = $_POST['noEtudiant'];
$date = $_POST['date'];
$noEtude = $_POST['noEtude'];
$montant = $_POST['montant'];
$nbJour = $_POST['nbJour'];

require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);

$nombreIndemnitesRequest = "select count(*) from indemnites where (noEtudiant='$noEtudiant' and noEtude='$noEtude')";
$nombreIndemnites = mysql_query($nombreIndemnitesRequest);

if ( $nombreIndemnites<3) {
mysql_query("INSERT INTO indemnites (date,nbJourEtude,montant,noEtudiant,noEtude) 
    VALUES('$date','$nbJour','$montant','$noEtudiant','$noEtude') ");
    $return = "Indemnites enregistree";
}
else {
    $return = "saisie impossible : 3 indemnites ont deja ete saisies";
}
mysql_close();

header("location:IndemnitesTool.php?noEtudiant=$noEtudiant&amp;return=$return");
?>

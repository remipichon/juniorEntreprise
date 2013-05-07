<?php

require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);



//table equipe
$idStudy = $_POST['idStudy'];
$nameResp = $_POST['resp'];
echo "name resp $nameResp--";

//rechercher l'etudiant en fonction de son nom
$idResp = mysql_query("SELECT * FROM etudiant where nomEtudiant = '$nameResp' ");
$idResp = mysql_fetch_object($idResp);
$idResp = $idResp->noEtudiant;
mysql_query("INSERT INTO equipe (noResp,noEtude) VALUES ('$idResp','$idStudy') ");

//table participant
$idTeam = mysql_query("SELECT last_insert_id() as ID FROM equipe");
$idTeam = mysql_fetch_object($idTeam);
$idTeam = $idTeam->ID;


for ($ix = 0; $ix < count($_POST['student']); $ix++) {
    $nameStudent = $_POST['student'][$ix];
    
    if( $nameStudent == '') { //pour palier le champ non rempli        
        continue;
        }
    
    //rechercher l'etudiant en fonction de son nom
    $query = "SELECT * FROM etudiant where nomEtudiant = '$nameStudent' ";
    
    $idStudent = mysql_query($query);
    $idStudent = mysql_fetch_object($idStudent);
    $idStudent = $idStudent->noEtudiant;
    mysql_query("INSERT INTO participant (noEquipe,noEtudiant) VALUES ('$idTeam','$idStudent')");

    
}

mysql_close();
header("location:studyTool.php?return=null");
?>
<?php

$idStudent = $_POST['idetudiantToUpdate'];
$name = $_POST['nameStudent'];
$adress = $_POST['adress'];
$numSecu = $_POST['numSecu'];





if ($idStudent == 'new') {
    echo "<div>add student !</div>";
    $return = 'add';
} else {
    $return = 'update';
}


//
//echo "<div> ID : $idStudent </div>";
//echo "<div> name : $name </div>";
//echo "<div> adress :$adress </div>";
//echo "<div> numsecu :$numSecu </div>";
//session_start();
//if(isset($_SESSION['admin']) && $_SESSION['admin']==true)
//{
//$id=$_POST['id'];
//$nom=$_POST['nom'];
//$designation=$_POST['designation'];
//$prix=$_POST['prix'];
//$quantite=$_post['quantite'];
//require 'bin/params.php';
//mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
//mysql_select_db($base) or die('La base de donn�es n\'existe pas');
//$query="UPDATE Thes SET nom='$nom', designation='$designation', prix='$prix', quantiteStock='$quantite' WHERE ID='$id'";
////echo $query;
//mysql_query($query);
//mysql_close();
///}


$attribut = array('noEtudiant' => 'primaryKey', 'nomEtudiant' => 'nameStudent', 'adresseEtudiant' => 'adress', 'noSecu' => 'numSecu');
$attribut = serialize($attribut);
$table = 'etudiant';

$ancre = "$idStudent";
header("location:../ckeditorInline.php?return=$return&the=$name&table=$table&attr=$attribut#$ancre");
//l'ancre ne fonctionne pas
?>

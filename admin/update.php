<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true)
{
$id=$_POST['id'];
$nom=$_POST['nom'];
$designation=$_POST['designation'];
$prix=$_POST['prix'];
$quantite=$_post['quantite'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donn�es n\'existe pas');
$query="UPDATE Thes SET nom='$nom', designation='$designation', prix='$prix', quantiteStock='$quantite' WHERE ID='$id'";
//echo $query;
mysql_query($query);
mysql_close();
header('location:tool.php');
}
?>

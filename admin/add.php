<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true)
{
$nom=$_POST['nom'];
$designation=$_POST['designation'];
$paysOrigine=$_POST['paysOrigine'];
$prix=$_POST['prix'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donn�es n\'existe pas');
$query="insert into Thes(nom,designation,pays_orig,prix) VALUES('$nom','$designation','$paysOrigine','$prix')";
mysql_query($query);
mysql_close();
header('location:tool.php');
}
?>

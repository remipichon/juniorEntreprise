<?php
session_start();
if(isset($_SESSION['admin']) && $_SESSION['admin']==true)
{
$id=$_GET['id'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donn�es n\'existe pas');
$query="delete from Thes where id='$id'";
mysql_query($query);
mysql_close();
header('location:tool.php');
}
?>

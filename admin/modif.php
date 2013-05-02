<?php
session_start();
if(!isset($_SESSION['admin'])|| $_SESSION['admin']==false)header('location:index.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<?php
$id=$_GET['id'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de donn�es n\'existe pas');
$query="SELECT * from Thes WHERE ID=$id";
$r=mysql_query($query);
if($a=mysql_fetch_object($r))
	{
	$nom=$a->nom;
	$designation=$a->designation;
	$prix=$a->prix;
        $quantite = $a->quantitestock;





	}
mysql_close();
?>
  <body>
  <h2>Modification</h2>
      <form action="update.php" method="post">
      NOM : <input name="nom" type="text" value="<?php echo $nom; ?>"/><br/>
     Designation : <input name="designation" type="text" value="<?php echo $designation; ?>"/><br/>
     Prix : <input name="prix" type="text" value="<?php echo $prix; ?>"/><br/>
     Quantit� en Stock : <input name="quantite" type="text" value="<?php echo $quantite; ?>" </br>
     <input type="submit" value="Modifier" /><br/>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
    </form>
   </body>
</html>
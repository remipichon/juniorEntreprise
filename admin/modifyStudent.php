
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<?php

$id=$_GET['id'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de données n\'existe pas');
$query="SELECT * from etudiant WHERE noEtudiant=$id";
$r=mysql_query($query);
if($a=mysql_fetch_object($r))
	{
	$nom=$a->nomEtudiant;
	$adresse=$a->adresseEtudian;
	$noSecu=$a->noSecu;
	}
mysql_close();
?>
    
  <body>
  <h2>Modification</h2>
     <form action="updateEtudiant.php" method="post">
     NOM : <input name="nom" type="text" value="<?php echo $nom; ?>"/><br/>
     Adresse : <input name="adresse" type="text" value="<?php echo $adresse; ?>"/><br/>
     Numero securite sociale : <input name="noSecu" type="text" value="<?php echo $noSecu; ?>"/><br/>
     <input type="submit" value="Modifier" /><br/>
     <input type="hidden" name="id" value="<?php echo $id; ?>" />
     </form>
   </body>
</html>
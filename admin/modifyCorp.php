
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
        <title>Modifier une entreprises</title>
    </head>

<?php

$id=$_GET['id'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de données n\'existe pas');
$query="SELECT * from entreprise WHERE noEnts=$id";
$r=mysql_query($query);
if($a=mysql_fetch_object($r))
	{
	$nom=$a->nomEnts;
	$adresse=$a->adresseEnts;
	$tel=$a->telEnts;
	}
mysql_close();
?>
    
  <body>
  <h2>Modification</h2>
     <form action="updateCorp.php" method="post">
     NOM : <input name="nom" type="text" value="<?php echo $nom; ?>"/><br/>
     Adresse : <input name="adresse" type="text" value="<?php echo $adresse; ?>"/><br/>
     Numero téléphone : <input name="tel" type="text" value="<?php echo $tel; ?>"/><br/>
     <input type="submit" value="Modifier" /><br/>
     <input type="hidden" name="id" value="<?php echo $id; ?>" />
     </form>
   </body>
</html>
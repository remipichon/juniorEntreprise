
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<?php

$id=$_GET['id'];
require 'bin/params.php';
mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
mysql_select_db($base) or die('La base de données n\'existe pas');
$query="SELECT * from frais WHERE noFrais=$id";
$r=mysql_query($query);

if($a=mysql_fetch_object($r))
	{
	$date=$a->date;
	$montDep=$a->montDep;
	$montSejour=$a->montSejour;
        $noEtudiant=$a->noEtudiant;
	$noEtude=$a->noEtude;
	$montAutre=$a->montAutre;
	}
mysql_close();
?>
    
  <body>
  <h2>Modification</h2>
     <form action="updateFrais.php" method="post">
     Etude : <input name="noEtude" type="text" value="<?php echo $noEtude; ?>"/><br/>
     Num etudiant : <input name="noEtudiant" type="text" value="<?php echo $noEtudiant; ?>"/><br/>
     Date : <input name="date" type="date" value="<?php echo $date; ?>"/><br/>
     Montant deplacement : <input name="montDep" type="text" value="<?php echo $montDep; ?>"/><br/>
     Montant sejour : <input name="montSejour" type="text" value="<?php echo $montSejour; ?>"/><br/>
     Montant autre : <input name="montAutre" type="text" value="<?php echo $montAutre; ?>"/><br/>
     
     <input type="submit" value="Modifier" /><br/>
     <input type="hidden" name="id" value="<?php echo $id; ?>" />
     </form>
   </body>
</html>
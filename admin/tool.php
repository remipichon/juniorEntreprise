<?php
session_start();
if(!isset($_SESSION['admin'])|| $_SESSION['admin']==false)header('location:admin.php');
?>
<!--ceci permet de controler que lorsque le fichier est charg� la session du bonhomme est true-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

  <body>

<h1>Administration</h1>
<a href="disconnect.php">SE DECONNECTER</a><p/>

<h2>Ajout</h2>
    <form action="add.php" method="post">
    NOM : <input name="nom" type="text" /><br/>
   Designation: <input name="designation" type="text" /><br/>
   Pays Origine: <input name="paysOrigine" type="text" /><br/>
   Prix : <input name="prix" type="text"> </br>
   <input type="submit" value="Ajouter" /><br/>

    </form>

<br/><br/>
<?php

require 'bin/params.php';
  mysql_connect($host,$user,$password) or die('Erreur de connexion au SGBD.');
  mysql_select_db($base) or die('La base de donn�es n\'existe pas');
  $query='SELECT * FROM Thes';
  $r=mysql_query($query);
  mysql_close();
  echo'<table><tr><td>nom</td><td>designation</td><td>prix</td></tr>';
  while($a=mysql_fetch_object($r))
    {
    $nom=$a->nom;
    $designation=$a->designation;
    $prix=$a->prix;
    $id=$a->ID;
    echo"<tr><td>$nom</td><td>$designation</td><td>$prix</td><td><a href=\"delete.php?id=$id\">SUPPRIMER</a></td>";
    echo"<td><a href=\"modif.php?id=$id\">MODIFIER</a></td>";
    echo"</tr>";
    }
  echo '</table>';
  ?>
  </body>
</html>

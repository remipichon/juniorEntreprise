<?php

//$table = $_GET['table'];
//
//for ($ix = 0; $ix < count($_POST['amp;attribut']); $ix++) {
//    $nameStudent = $_POST['student'][$ix];
//    
//    ]
//recuperation des attributs par serialiez
$table = $_GET['table'];
$serialized = $_GET['attr'];
$attr = unserialize($serialized);

//obtenir chaque attribut pass� en parametre
foreach ($attr as $attrTable => $attrHtml) {
    echo "$attrTable => $attrHtml </br>";
}




//gestion de alertify en php



echo "<!--Activation des ckeditor sur les div à modifier-->";
echo "<script>";
echo "CKEDITOR.disableAutoInline = true;";
echo "</script>";
echo "<!--input de retour pour la methode POST-->";
echo "      <form id='post".$table."' method='post' action='admin/update".$table."Student.php'>   ";
echo "           <input type='text' hidden='true' id='id".$table."E' name ='id".$table."ToUpdate' value='' />";
echo "";
echo "           <!----------- ici les champs input de report pour le post          ------------>";///foreach
echo "          <input type='text' hidden='true' id='inputName' name='name' />";
echo "           <input type='text' hidden='true' id='inputAdress' name='adress' />";
echo "          <input type='text' hidden='true' id='inputNumSecu' name='numSecu' />";
echo "";
echo "";
echo "          <?php";
echo "          require 'admin/bin/params.php';";
echo "          mysql_connect($host, $user, $password) or die('Erreur le connexion au SGBD.');";
echo "          mysql_select_db($base) or die('La base de donn�es n\'existe pas');";
echo "           $query = 'SELECT * FROM ".$table."';";
echo "          $r = mysql_query($query);";
echo "           mysql_close();";
echo "";
echo "           while ($a = mysql_fetch_object($r)) {";//////foreach
echo "              $id = $a->noEtudiant;";
echo "               $nom = $a->nomEtudiant;";
echo "              $adress = $a->adresseEtudiant;";
echo "               $numSecu = $a->noSecu;";
echo "              ";
echo "               $id".$table." = '$table' . $id;";
echo "              echo '<div  class=\'$table\' id".$table."=\'$id".$table."\'>';";
echo "               echo '<p class=\'nom\' id=\'\' . $id".$table." . '\name\' contenteditable=\'true\'>$nom</p>';";                ////foreach
echo "              echo '<p class=\'adress\' id=\'\' . $id".$table." . \'adress\' contenteditable=\'true\'>$adress</p>';";
echo "               echo '<p class=\'numSecu\' id=\'\' . $id".$table." . \'numSecu\' contenteditable=\'true\'>$numSecu</p>';";
echo "              echo '</div>';";
echo "";
echo "              //init des ckeditor                ";
echo "               echo '<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('' . $id".$table." . 'name'); </script>';"; /////     ///foreach
echo "              echo '<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('' . $idStudent . 'adress'); </script>';"; /////////
echo "              echo '<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('' . $idStudent . 'numSecu'); </script>';"; ////////
echo "";
echo "              // ajout d'un d'un bouton de validation de modification (appel initPostThe et passe les donnéees du formulaires en POST";
echo "              echo '<div id='buttonvalider$id".$table."'>valider</div>';"; ///////////
echo "              echo '<script> $('#buttonvalider$id".$table."').on('click', function() { ';"; //////////////
echo "               echo 'initPost".$table."('$id".$table."'); }); </script>';"; /////////
echo "          }";
echo "          ?>";





echo "  <!--Gestion de la sauvegarde automatique--> ";
echo "  <script>";
echo "  $('.$table') . on('mousedown', function() {";
echo "           console.log('click on '+$(this).attr('idStudent'));";
echo "           $('#idStudentE').attr('value', $(this).attr('idStudent'));";
echo "           $(this) . mouseleave(function() {";
echo "                         console.log('mouseleave '+ $(this).attr('idStudent'));";
echo "                         initPostStudent ($(this).attr('idStudent'));";
echo "          });";
echo "   });";
echo "  </script>";

echo "</forme";
?>
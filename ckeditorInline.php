<!DOCTYPE html>
<html>

    <?php require 'header.php'; ?>


    <body>

        <?php require 'menu.php'; ?>
        
        <?php
        //recuperation des attributs par serialize
        $table = $_GET['table'];
        $serialized = $_GET['attr'];
        echo $serialized;
        $attr = unserialize($serialized);
        echo $attr;

        //fonction javascript gerant l'auto-save

        echo " <script>";
        echo "function initPost" . $table . "(id) {";
        echo "  console.log('init');";
        echo "  $('#id" . $table . "E').attr('value', id.match(/[0-9]/)[0]); ";      //renseigne l'input qui permet de POST l'id 


        foreach ($attr as $attrTable => $attrHtml) {
            if ($attrHtml == 'primaryKey' || $attrHtml == 'imageType') {
                continue;
            }
            echo "console.log(id+'" . $attrHtml . "');";
            echo "    var val = CKEDITOR.instances[id+'" . $attrHtml . "'].getData();";     //recuperer les data des champs maj
            echo "      $('#input" . $attrHtml . "').attr('value', val);";          //renseigne les input pour l'envoie via POST
        }

        echo "       $('#submit" . $table . "').trigger('click');";     //simule le click pour envoyer le formulaire POST
        echo "   }";

        echo " </script>";
        ?>



  <div class="container">


<?php
//recuperation des attributs par serialize
$table = $_GET['table'];
$serialized = $_GET['attr'];
$attr = unserialize($serialized);
echo "$serialized </br>";
echo "$attr </br>";

//preparation de la base de donnÈes
require 'admin/bin/params.php';
mysql_connect($host, $user, $password) or die('Erreur le connexion au SGBD.');
mysql_select_db($base) or die('La base de donnÔøΩes n\'existe pas');
$query = "SELECT * FROM $table";
$r = mysql_query($query);
mysql_close();

//obtenir chaque attribut passÈs en parametre
foreach ($attr as $attrTable => $attrHtml) {
    echo "$attrTable => $attrHtml </br>";
    if ($attrHtml === 'primaryKey') {
        $PK = $attrTable;
    }
}



//gestion de alertify              
$return = $_GET['return'];
if ($return == "update") {
    $name = $_GET['name'];
    echo "<script>";
    echo "alertify.success('$table $name mis ‡ jour')";
    echo "</script>";
} else if ($return == 'add') {
    $name = $_GET['name'];
    echo "<script>";
    echo "alertify.success('$table $name ajoute')";
    echo "</script>";
}



//mise en place du formulaire
echo "<!--Activation des ckeditor sur les div √† modifier-->";
echo "<script>";
echo "CKEDITOR.disableAutoInline = true;";
echo "</script>";
echo "<!--input de retour pour la methode POST-->";
echo "      <form id='post" . $table . "' method='post' action='admin/update_" . $table . ".php'>   ";
echo "           <div style='display:none;'>";
echo "              <input  type='text' hidden='true' id='id" . $table . "E' name ='id" . $table . "ToUpdate' value='' />";
echo "              <input hidden='true' id='submit" . $table . "' type='submit' value ='Valider Modification n'importe laquelle' />";
echo "           </div>";
echo "";


//champs input de report pour le post          
foreach ($attr as $attrTable => $attrHtml) {
    if ($attrHtml == 'primaryKey') {
        continue;
    }
    echo "           <div style='display:none;'>";
    echo "<input type='text' hidden='true' id='input" . $attrHtml . "' name='" . $attrHtml . "' />";
    echo "           </div>";
}


//ajout d'un element    
//ajout des elements de la table
while ($a = mysql_fetch_object($r)) {
    $id = $a->{$PK};
    $idTuple = $table . $id;

    echo "<div  class='$table' id" . $table . "='$idTuple'>";
    echo "<a href='$id'></a>";
    foreach ($attr as $attrTable => $attrHtml) {
        if ($attrHtml == 'primaryKey') {
            continue;
        }
        $valAttr = $a->{$attrTable};
        if ($attrHtml == 'imageType') {
            echo "<img class='image".$table."' src='$valAttr'/>";
            
        } else {
            echo "<p  class='$attrHtml' id='" . $idTuple . "$attrHtml' contenteditable='true'>$valAttr</p>";
        }
    }
    echo "</div>";


    //init des ckeditor 
    foreach ($attr as $attrTable => $attrHtml) {
        if ($attrHtml == 'primaryKey' || $attrHtml=='imageType') {
            continue;
        }
        $valAttr = $a->{$attrTable};
        echo "<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('" . $idTuple . $attrHtml . "'); </script>";
    }


    // ajout d'un d'un bouton de validation de modification (appel initPost et passe les donn√©ees du formulaires en POST
    echo "<div id='buttonvalider$idTuple'>valider</div>";
    echo "<script> $('#buttonvalider$idTuple').on('click', function() { ";
    echo "console.log('button valid   $idTuple');";
    echo "initPost" . $table . "('$idTuple'); }); </script>";
}






//Gestion de la sauvegarde automatique
echo "  <script>";
echo "  $('.$table') . on('mousedown', function() {";
echo "            console.log('mousedown on ck');";
echo "           $('#id" . $table . "E').attr('value', $(this).attr('id" . $table . "'));";
echo "           $(this).mouseleave(function() {";
echo "                         console.log('mouseleave '+ $(this).attr('id" . $table . "'));";
echo "                         initPost" . $table . " ($(this).attr('id" . $table . "'));";
echo "          });";
echo "   });";
echo "  </script>";

echo "</form";
?>



        </div>



    </body>
</html>
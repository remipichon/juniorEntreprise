<!DOCTYPE html>
<html>
    <?php require 'header.php'; ?>
    <body>
        <?php require 'menu.php'; ?>

        <div class="contenu">
            <p>Voici les diffrents Ètudiants </p>

            <?php
            $return = $_GET['return'];
            if ($return == 'update') {
                $name = $_GET['amp;nameStudent'];
                echo "<script>";
                echo "alertify.success('Etudiant $name mis ‡ jour')";
                echo "</script>";
            }
            else if ($return == 'add'){
                $name = $_GET['amp;nameStudent'];
                echo "<script>";
                echo "alertify.success('Etudiant $name ajoute')";
                echo "</script>";
            }
            ?>



            <!--Activation des ckeditor sur les div √† modifier-->
            <script>
                CKEDITOR.disableAutoInline = true;
            </script>

            <!--input de retour pour la methode POST-->
            <form id='postStudent' method="post" action="admin/updateStudent.php">         
                <input type='text' hidden='true' id='idStudentE' name ='idStudentToUpdate' value='' />

                <!----------- ici les champs input de report pour le post          ------------>
                <input type='text' hidden='true' id='inputName' name='name' />
                <input type='text' hidden='true' id='inputAdress' name='adress' />
                <input type='text' hidden='true' id='inputNumSecu' name='numSecu' />


                <!-------------- champ d'ajout d'un Ètudiant -------------->
                <div  class='new' idStudent='new'>
                    <p class='new nom' id='newname' contenteditable='true'>Entrez le nom</p>
                    <p class='new adress' id='newadress' contenteditable='true'>Entrez le prenom</p>
                    <p class='new numSecu' id='newnumSecu' contenteditable='true'>Entrez le numero de securite sociale</p>
                </div>

                <!--//init des ckeditor-->                
                <script> 
                    CKEDITOR.disableAutoInline = true;
                    CKEDITOR.inline('newname');
                    CKEDITOR.inline('newadress');
                    CKEDITOR.inline('newnumSecu');
                </script>
                
               <!--gestion specifique a l'ajout-->
               <script>
                   $('.new').on('click', function(event){
                       event.stopPropagation();                       
                      $(this).html(''); 
                      $(this).removeClass('new');
                   });
               
               
             </script>
                

                <!--// ajout d'un d'un bouton de validation de modification (appel initPostThe et passe les donn√©ees du formulaires en POST-->
                <div id='buttonvalidernew'>Ajouter un etudiant</div>
                <script> $('#buttonvalidernew').on('click', function() {                    
                            initPostStudent('new');                       
                    });
                </script>
                
                
                <!--------------fin champ d'ajout d'un Ètudiant -------------->


                <!--                subit d'envoie de formulaire via POST. 
                                hidden='true' car l'user ne clique jamais dessus, c'est la fonction initPostThe qui s'en charge une fois qu'elle a init les inputs en javascript-->
                <input hidden='true' id='submitStudent' type='submit' value ="Valider Modification n'importe laquelle" />

                <?php
                require 'admin/bin/params.php';
                mysql_connect($host, $user, $password) or die('Erreur le connexion au SGBD.');
                mysql_select_db($base) or die('La base de donnÔøΩes n\'existe pas');
                $query = 'SELECT * FROM etudiant';
                $r = mysql_query($query);
                mysql_close();

                while ($a = mysql_fetch_object($r)) {
                    $id = $a->noEtudiant;
                    $nom = $a->nomEtudiant;
                    $adress = $a->adresseEtudiant;
                    $numSecu = $a->noSecu;

                    $idStudent = "student" . $id;
                    echo"<div  class='student' idStudent='$idStudent'>";
                    echo "<p class='nom' id='" . $idStudent . "name' contenteditable='true'>$nom</p>";
                    echo "<p class='adress' id='" . $idStudent . "adress' contenteditable='true'>$adress</p>";
                    echo "<p class='numSecu' id='" . $idStudent . "numSecu' contenteditable='true'>$numSecu</p>";
                    echo "</div>";

                    //init des ckeditor                
                    echo "<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('" . $idStudent . "name'); </script>";
                    echo "<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('" . $idStudent . "adress'); </script>";
                    echo "<script> CKEDITOR.disableAutoInline = true; CKEDITOR.inline('" . $idStudent . "numSecu'); </script>";

                    // ajout d'un d'un bouton de validation de modification (appel initPostThe et passe les donn√©ees du formulaires en POST
                    echo "<div id='buttonvalider$idStudent'>valider</div>";
                    echo "<script> $('#buttonvalider$idStudent').on('click', function() { ";
                    echo "initPostStudent('$idStudent'); }); </script>";
                }
                ?>

                <!-- Gestion de la sauvegarde automatique -->
                <script>
                    $('.student').on('mousedown', function() {
                        console.log("click on " + $(this).attr('idStudent'));
                        $('#idStudentE').attr('value', $(this).attr('idStudent'));
                        $(this).mouseleave(function() {
                            console.log('mouseleave ' + $(this).attr('idStudent'));
                            initPostStudent($(this).attr('idStudent'));
                        });
                    });
                </script>


            </form>

        </div>



    </body>
</html>
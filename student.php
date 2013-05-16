<!DOCTYPE html>
<html>
    <?php require 'header.php'; ?>
    <body>
        <?php require 'menu.php'; ?>

        <div class="container">
            

            <?php
            $return = $_GET['return'];
            if ($return == 'update') {
                $name = $_GET['amp;nameStudent'];
                echo "<script>";
                echo "alertify.success('Etudiant $name mis ‡ jour')";
                echo "</script>";
            } else if ($return == 'add') {
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
            <form class="row-fluid" id='postStudent' method="post" action="admin/updateStudent.php"> 
                <div style="display:none;">
                    <input type='text' hidden='true' id='idStudentE' name ='idStudentToUpdate' value='' />  

                    <!----------- ici les champs input de report pour le post          ------------>
                    <input type='text' hidden='true' id='inputName' name='name' />
                    <input type='text' hidden='true' id='inputAdress' name='adress' />
                    <input type='text' hidden='true' id='inputNumSecu' name='numSecu' />
                </div>


                <!-------------- champ d'ajout d'un Ètudiant -------------->
                <p class='span12'>Ajouter un etudiant </p>
                <div  class='row-fluid new' idStudent='new'>
                    <p class='span3 new nom' id='newname' contenteditable='true'>Entrez le nom</p>
                    <p class='span3 new adress' id='newadress' contenteditable='true'>Entrez le prenom</p>
                    <p class='span3 new numSecu' id='newnumSecu' contenteditable='true'>Entrez le numero de securite sociale</p>


                    <!--//init des ckeditor-->                
                    <script>
                        CKEDITOR.disableAutoInline = true;
                        CKEDITOR.inline('newname');
                        CKEDITOR.inline('newadress');
                        CKEDITOR.inline('newnumSecu');
                    </script>

                    <!--gestion specifique a l'ajout-->
                    <script>
                        $('.new').on('mousedown.clear', function(event) {
                            event.stopPropagation();
                            $(this).html('');
                            //$(this).off('.clear');
                        });


                    </script>


                    <!--// ajout d'un d'un bouton de validation de modification (appel initPostThe et passe les donn√©ees du formulaires en POST-->
                    <div class="span3" id='buttonvalidernew'>Ajouter un etudiant</div>
                    <script> $('#buttonvalidernew').on('click', function() {
                            initPostStudent('new');
                        });
                    </script>
                </div>


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
                echo "<p class='span12'>Voici les diffrents Ètudiants </p>";
                echo "<div class='row-fluid'>";
                echo "<p class='span4 nom'>Nom </p> ";
                echo "<p class='span4 nom'>Adresse </p> ";
                echo "<p class='span4 numSecu'>Numero Securite Sociale </p> ";
                echo "</div>";
                while ($a = mysql_fetch_object($r)) {
                    $id = $a->noEtudiant;
                    $nom = $a->nomEtudiant;
                    $adress = $a->adresseEtudiant;
                    $numSecu = $a->noSecu;

                    $idStudent = "student" . $id;
                    echo"<div  class='row-fluid student' idStudent='$idStudent'>";
                    echo "<p class='span4 nom' id='" . $idStudent . "name' contenteditable='true'>$nom</p>";
                    echo "<p class='span4 adress' id='" . $idStudent . "adress' contenteditable='true'>$adress</p>";
                    echo "<p class='span4 numSecu' id='" . $idStudent . "numSecu' contenteditable='true'>$numSecu</p>";
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
                        var $this = $(this);


                        //avec mousenter sur une autre div
                        $('.student').mouseenter(function() {
                            console.log($this.attr('idStudent') + '       ' + $(this).attr('idStudent'));
                            if ($this.attr('idStudent') === $(this).attr('idStudent')) {//($this === $(this) ) {
                                console.log("same");
                            } else {
                                console.log("update");
                                initPostStudent($this.attr('idStudent'));

                            }


                        });


//                        $(this).mouseleave(function() {
//                            console.log('mouseleave ' + $(this).attr('idStudent'));
//                            initPostStudent($(this).attr('idStudent'));
//                        });
                    });
                </script>


            </form>

        </div>



    </body>
</html>
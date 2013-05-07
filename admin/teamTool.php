<html>
    <head>
        <title>teamTool</title>
<!--        Cette page permet d'affecter une équipe à une étude. Elle a pour finaliter de renseigner les tables équipes et paticipant.
        La complexité de cette page vient du fait que les noms des étudiants sont proposés lors de la saisie. Cela a le double effet de faciliter la vie 
        de l'user et de s'assurer que le nom saisi existe tel quel dans la base de donnée.
        Il y a deux phase pour cette page :
            -la récupération des noms étudiants pour le AutoComplete de Jquery
            -l'ajout automatique d'un nouveau champ de saisie à partir du moment où une lettre à été saisie dans le champ (cela permet de
        d'ajouter une infinité de participant de manière transparente et facile pour l'user)-->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

        <script type="text/javascript">
            /* récupération des étudiants*/
            /*function qui permet de vérifier que le navigateur est compatible avec le XMLHttpRequest*/
            function getXMLHttpRequest() {
                var xhr = null;

                if (window.XMLHttpRequest || window.ActiveXObject) {
                    if (window.ActiveXObject) {
                        try {
                            xhr = new ActiveXObject("Msxml2.XMLHTTP");
                        } catch (e) {
                            xhr = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                    } else {
                        xhr = new XMLHttpRequest();
                    }
                } else {
                    alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
                    return null;
                }

                return xhr;
            }

          
            /*ka variable xhr permet d'appeler le script php qui récupère les noms étudiants (getStudent.php) et stocke la réponse du script sous forme de 
             * string. C'est cette function qui assure le lien entre le javascript et le php.
             * */
            function request(callback) {
                xhr = getXMLHttpRequest();

                xhr.onreadystatechange = function() {           //lorsque xhr.readyState === 4 la requete est terminée, on peut aller effectuer le traitement javascript sur le string retourné par la requete php (ici, la suite des noms étudiants séparés par ##
                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {     
                        callback(xhr.responseText);
                        initAutocomplete(xhr.responseText);     //initialise le tableau des noms d'étudiants (variable globale)
                        $("#resp").addInput();                  //affecte la fonction type Jquery qui init l'autoComplete (entre autre)


                    }
                };
                xhr.open("GET", "getStudent.php", true);
                xhr.send(null);
            }
            
            /*permet juste une sortie console javascript pour controler le retour de la requete*/
            function readData(sData) {
                console.log("etudiant : " + sData);
            }
            
             //regarder du coté de l'autocomplete, source, function, avec le callback direcement dans source lors de l'init de l'autocomplete
             /*appelée uniquement lorsque la requete est effectuée.
              * Le script Php renvoie un string contenant les noms des étudiants separes par ##
              * Via une expression régulière on stocke les noms dans un tableau arrayStudent avant d'initiliaser l'AutoComplete Jquery premier champ (celui du responsable) 
              * */
            function initAutocomplete(listStudent) {
                for (stu in arrayStudent = listStudent.match(/.+?##/g)) {       //separe le string en utilisant ## comme caractère match, stocke le resultat dans arrayStudent qui est une variable globale (absence du verbe de déclaration var)
                    arrayStudent[stu] = arrayStudent[stu].replace('##', '');     //suppression des ## pour ne garder que les noms dans chaque instance du tableau
                }
                $(".student").autocomplete({                                   //initialisation de l'autoComplete avec le tablea de prenom en données
                    source: arrayStudent
                });
            }

            /*attendre que le dom soit chargé pour lancer la récupération des noms d'étudiants*/
            $(document).ready(function() {
                request(readData);
            });


            /*fonction type Jquery qui rend un champ apte à lancer la création d'un nouvel input lorsqu'une lettre est saisi. Elle n'est appelé
             * qu'une fois que le tableau des étudiants et pret
             */
            jQuery.fn.addInput = function() {                
                $('#resp').autocomplete({source: arrayStudent});   //utile qu'une fois
                
                /*
                 * Lorsqu'on appuie sur une touche dans l'input de this :
                 *      -on ajoute après ce dernier un nouveau champ de saisi (le insertAfter)
                 *      -et on lui affecte la fonction addInput() (celle dans laquelle on est)
                 *      -ensuite on initialise avec le tableau d'étudiants l'input nouvelle insérer dans le DOM
                 * Ce n'est pas traité, mais select: permet de récupérer l'item selectionné et avec un autre bout de code je pourrai le supprimer
                 * du tableau d'étudiant pour qu'un étudiant ne soit selectionnable qu'une fois
                 */
                $(this).on('keydown.add', function() {      
                    $("<label for='participant'> Participant </label><input class='student' type='text' name='student[]'/>").insertAfter($(this)).addInput();
                    //console.log($(this));
                    $(".student").autocomplete({        //pour faire propre il faudrait init l'autocomplete que sur le next syblings de $(this)
                        source: arrayStudent,
                        delay: 100,
                        select: function(event, ui) {
                            //arrayStudent.splice(POSITION DE UI.VALUE,1);
                            //ensuite il faut reinit l'autocomplete
                            console.log(ui.item.value + " a été selectionné (il faut le supprimer de la liste");

                        }
                    });
                    $(this).off(".add");
                });
            };
        </script>

    </head>
    <body>

        <p> affecter une equipe a l'etude numero 
            <span id="idStudy">
                <?php
                echo $_GET['id'];
                
                ?>
            </span>
        </p>

        <!--petit bricolage. Jquery a besoin d'un array contenant les noms des etudiants
            la liste des etudiants est obtenu en php qui echo une div display none
            le code javascript recupere cette liste et en fait un objet javascript-->

        <form action="assignTeam.php" method="post">
            
            
            <?php
            $ID = $_GET['id'];
            echo "<input  hidden='true' type='text' name='idStudy' value='$ID'/>";  //ceci est une petite astuce pour passer via la méthode POST l'id de l'étude auquel on affecte l'équipe et qu'on récupère via la méthode GET
            ?>

                <!--Champ responsable, parce qu'il faut au moins un responsable par équipe, l'ajout des autres champs et l'Autocomplete sont traitées par le javascript présent dans le header-->
              <label for="resp"> Responsable </label>
            <input id="resp" type="text" name="resp"/>


            <input type="submit" value="Affecter equipe et parcipants"/>
        </form>


    </body>
</html>



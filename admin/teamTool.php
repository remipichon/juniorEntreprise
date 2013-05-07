<html>
    <head>
        <title>teamTool</title>
<!--        Cette page permet d'affecter une �quipe � une �tude. Elle a pour finaliter de renseigner les tables �quipes et paticipant.
        La complexit� de cette page vient du fait que les noms des �tudiants sont propos�s lors de la saisie. Cela a le double effet de faciliter la vie 
        de l'user et de s'assurer que le nom saisi existe tel quel dans la base de donn�e.
        Il y a deux phase pour cette page :
            -la r�cup�ration des noms �tudiants pour le AutoComplete de Jquery
            -l'ajout automatique d'un nouveau champ de saisie � partir du moment o� une lettre � �t� saisie dans le champ (cela permet de
        d'ajouter une infinit� de participant de mani�re transparente et facile pour l'user)-->
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

        <script type="text/javascript">
            /* r�cup�ration des �tudiants*/
            /*function qui permet de v�rifier que le navigateur est compatible avec le XMLHttpRequest*/
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

          
            /*ka variable xhr permet d'appeler le script php qui r�cup�re les noms �tudiants (getStudent.php) et stocke la r�ponse du script sous forme de 
             * string. C'est cette function qui assure le lien entre le javascript et le php.
             * */
            function request(callback) {
                xhr = getXMLHttpRequest();

                xhr.onreadystatechange = function() {           //lorsque xhr.readyState === 4 la requete est termin�e, on peut aller effectuer le traitement javascript sur le string retourn� par la requete php (ici, la suite des noms �tudiants s�par�s par ##
                    if (xhr.readyState === 4 && (xhr.status === 200 || xhr.status === 0)) {     
                        callback(xhr.responseText);
                        initAutocomplete(xhr.responseText);     //initialise le tableau des noms d'�tudiants (variable globale)
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
            
             //regarder du cot� de l'autocomplete, source, function, avec le callback direcement dans source lors de l'init de l'autocomplete
             /*appel�e uniquement lorsque la requete est effectu�e.
              * Le script Php renvoie un string contenant les noms des �tudiants separes par ##
              * Via une expression r�guli�re on stocke les noms dans un tableau arrayStudent avant d'initiliaser l'AutoComplete Jquery premier champ (celui du responsable) 
              * */
            function initAutocomplete(listStudent) {
                for (stu in arrayStudent = listStudent.match(/.+?##/g)) {       //separe le string en utilisant ## comme caract�re match, stocke le resultat dans arrayStudent qui est une variable globale (absence du verbe de d�claration var)
                    arrayStudent[stu] = arrayStudent[stu].replace('##', '');     //suppression des ## pour ne garder que les noms dans chaque instance du tableau
                }
                $(".student").autocomplete({                                   //initialisation de l'autoComplete avec le tablea de prenom en donn�es
                    source: arrayStudent
                });
            }

            /*attendre que le dom soit charg� pour lancer la r�cup�ration des noms d'�tudiants*/
            $(document).ready(function() {
                request(readData);
            });


            /*fonction type Jquery qui rend un champ apte � lancer la cr�ation d'un nouvel input lorsqu'une lettre est saisi. Elle n'est appel�
             * qu'une fois que le tableau des �tudiants et pret
             */
            jQuery.fn.addInput = function() {                
                $('#resp').autocomplete({source: arrayStudent});   //utile qu'une fois
                
                /*
                 * Lorsqu'on appuie sur une touche dans l'input de this :
                 *      -on ajoute apr�s ce dernier un nouveau champ de saisi (le insertAfter)
                 *      -et on lui affecte la fonction addInput() (celle dans laquelle on est)
                 *      -ensuite on initialise avec le tableau d'�tudiants l'input nouvelle ins�rer dans le DOM
                 * Ce n'est pas trait�, mais select: permet de r�cup�rer l'item selectionn� et avec un autre bout de code je pourrai le supprimer
                 * du tableau d'�tudiant pour qu'un �tudiant ne soit selectionnable qu'une fois
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
                            console.log(ui.item.value + " a �t� selectionn� (il faut le supprimer de la liste");

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
            echo "<input  hidden='true' type='text' name='idStudy' value='$ID'/>";  //ceci est une petite astuce pour passer via la m�thode POST l'id de l'�tude auquel on affecte l'�quipe et qu'on r�cup�re via la m�thode GET
            ?>

                <!--Champ responsable, parce qu'il faut au moins un responsable par �quipe, l'ajout des autres champs et l'Autocomplete sont trait�es par le javascript pr�sent dans le header-->
              <label for="resp"> Responsable </label>
            <input id="resp" type="text" name="resp"/>


            <input type="submit" value="Affecter equipe et parcipants"/>
        </form>


    </body>
</html>



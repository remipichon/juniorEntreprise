<html>
    <head>
        <title>viewCorp</title>
<!--        Cette page permet d'ajouter une étude en selectionnant une entreprise via un menu déroulant. Les dates sont gérées dans des 
        calendriers jquery, la durée est calculée via javascript, les données sont envoyées par méthode POST à addStudy.php
        
        Cette page permet également d'afficher toutes les études et l'équipe qui lui est affectée. Si aucune équine n'est affectée, 
        un bouton "affectation équipe" permet d'accèder à l'utilitaire d'affectation (assignTeam.php)-->

        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />


    </head>
    <body>
        <div>
            <p> voici les etudes </p>
        </div>
        
<!--        Formulaire d'ajout avec un menu déroulant pour le choix de l'entreprise, deux champs de dates, un champ durée qui est rempli automatique
        un champ text convention et un champ prix journée-->
        <h2>Ajout</h2>
        <form action="addStudy.php" method="post">
            
<!--            menu déroulant pour le choix de l'entreprise. Les données de l'entreprises sont récupérées de la base de données via du php
            ensuite, l'attribut selected du input gere la liste de choix-->
            <select name="corpId">
                <option value="-1" selected="selected">Choisir une entreprise</option>
                <?php
                require 'bin/params.php';
                mysql_connect($hots, $user, $password);
                mysql_select_db($base);
                $result = mysql_query("SELECT * FROM entreprise");
                while ($tuple = mysql_fetch_object($result)) {
                    $id = $tuple->noEnts;
                    echo "<option value='$id'>$id</option>";
                }
                ?>
            </select>


<!--            Gestion des dates, deux input datePicker et un input durée auto-rempli
            La gestion des calendriers se fait en javascript ainsi que le calcul de la durée-->
            <p id="startDateP"> Date debut <input type="text" class="datePicker" name="startDate" id="startDate"/>   </p>
            Duree : <input type='text' name='duration' id="duration" />
            <p> Date fin <input type="text" class="datePicker" name="endDate" id="endDate"/>   </p>
            
            <script type="text/javascript">
                //$(".datePicker").datepicker({dateFormat: "yy-mm-dd"});
                $("#startDate").datepicker({            //initialisation du calendrier de date debut
                    //dateFormat: "yy-mm-dd",
                    onClose: function(value, date) {    //à la fermeture de calendrier date debut, le calendrier date fin est init (ce n'est donc qu'un champ text classique tant qu'on touche pas à date debut. Si tu cliques sur l'input date fin sans passer par date debut, le champ input n'aura pas le calendrier. 
                        $("#endDate").datepicker({
                            minDate: new Date(date.selectedYear, date.selectedMonth, date.selectedDay),     //on init le calendrier date fin afin de restreindre la date à une date plus grande que la date debut
                            onClose: function(valueEnd, dateEnd) {          //à la fermeture du calendrier de date fin, le calcul de la durée est effectuée
                                var d2 = new Date(date.selectedYear, date.selectedMonth, date.selectedDay);
                                var d1 = new Date(dateEnd.selectedYear, dateEnd.selectedMonth, dateEnd.selectedDay);
                                var duration = Math.ceil((d1.getTime() - d2.getTime()) / (1000 * 60 * 60 * 24));
                                $('#duration').attr("value", duration);     //ecriture de la durée dans l'input durée. Cette technique dite Alaromano permet de faire de l'envoie de variable javacsript à un script php en passant par la méthode POST. Il aurait fallu faire du ajax pour être propre
                            }
                        });

                    }
                });


            </script>
            
            <!--Simple input texte (qui recevront bientot le ckeditor-->
            Convention : <input name="convention" type="text" /><br/>
            Prix Journee: <input name="price" type="text" /><br/>
            <input type="submit" value="Ajouter Etude" /><br/>

        </form>

        
        
        <!--affichage des etudes-->
        <?php
        /*Pour récupérer une eventuelle erreur sql passée par la methode GET, utile pour deboguer, disparaitra par la suite
         * le return en question doit être une commande javascript (typiquement une alert() ou un console.log()
         */
        $return = $_GET['return'];
        if ($return && $return != "null") {
            echo "<script type='text/javascript'>  ";
            echo $return;
            echo "</script>";
        }


        require 'bin/params.php';
        mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
        mysql_select_db($base) or die('Base de donnes inexistante');
        $request = mysql_query('SELECT * FROM etude');
        
        /*affichage de toutes les études en mode tableau*/
        echo '<table><tr><td>numero</td><td>convention</td><td>date de debut</td><td>duree</td><td>date de fin</td><td>prix journée</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            $id = $tuple->noEtude;
            $startDate = $tuple->dateDebut;
            $endDate = $tuple->dateFin;
            $duration = $tuple->duree;
            $price = $tuple->prixJournee;
            $convention = $tuple->convention;

            echo "<tr><td>$id</td><td>$convention</td><td>$startDate</td><td>$duration</td><td>$endDate</td><td>$price</td>";
            echo"<td><a href=\"modifyStudy.php?id=$id\">MODIFIER    </a></td>";
            echo "<td><a href=\"deleteStudy.php?id=$id\&amp;test=$id\">DELETE</a></td>";

            
            /*affichage des équipes associées à l'étude qui vient d'être affichée*/
            $team = mysql_query("SELECT * FROM equipe WHERE noEtude='$id'");
            if (mysql_num_rows($team) === 0) {      //si aucune equipe, on affiche le lien qui envoie vers l'outil d'affectation*/
                echo "<td><a href=\"teamTool.php?id=$id&amp;test=$id\">affectation equipe</a></td></tr>";
            } else {
                echo "</tr>";
                while ($tupleTeam = mysql_fetch_object($team)) {
                    $idTeam = $tupleTeam->noEquipe;
                    $idResp = $tupleTeam->noResp;
                    $idEtude = $tupleTeam->noEtude;
                    echo "<tr><td>team : $idTeam</td><td> resp : $idResp</td><td> etude : $idEtude</td><td></td><td></td></tr>";
                }
            }
        }
        mysql_close();
        echo '</table>';
        ?>
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Etudes </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/reset.css" type="text/css" media="all">
        <link rel="stylesheet" href="../css/style.css" type="text/css" media="all">
        <script type="text/javascript" src="../js/jquery-1.4.2.min.js" ></script>
        <script type="text/javascript" src="../js/cufon-yui.js"></script>
        <script type="text/javascript" src="../js/Humanst521_BT_400.font.js"></script>
        <script type="text/javascript" src="../js/Humanst521_Lt_BT_400.font.js"></script>
        <script type="text/javascript" src="../js/cufon-replace.js"></script>
        <script type="text/javascript" src="../js/roundabout.js"></script>
        <script type="text/javascript" src="../js/roundabout_shapes.js"></script>
        <script type="text/javascript" src="../js/gallery_init.js"></script>
        <!--[if lt IE 7]>
              <link rel="stylesheet" href="css/ie/ie6.css" type="text/css" media="all">
        <![endif]-->
        <!--[if lt IE 9]>
              <script type="text/javascript" src="js/html5.js"></script>
          <script type="text/javascript" src="js/IE9.js"></script>
        <![endif]-->
    </head>

    <body>
        <!-- header -->
        <header>
            <div class="container">
                <nav>
                    <ul>
                        <li><a href="studentTool.php?return='null">Etudiant</a></li>
                        <li><a href="corpTool.php?return='null'">Entreprise</a></li>
                        <li><a href="studyTool.php?return='null'">Etude</a></li>
                        <li><a href="fraistool.php?return='null'">Frais</a></li>
                        <li><a href="indemnitesSelectEtudiant.php">Indemnités</a></li>
                        <li><a href="craTool.php">CRA</a></li>
                        <li><a href="factureTool.php">Facturation</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <!-- /#gallery -->
        <div class="main-box">
            <div class="container">
                <div class="inside">
                    <div class="wrapper">
                        <!-- aside -->
                        <aside>
                            <h2>Ajouter <span>Etude</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="addStudy.php" method="post">
                                <fieldset>
                                    <div class="field">
                                        <select name="corpId">
                                            <option value="-1" selected="selected"><label>Choisir une entreprise :</label></option>
                                            <?php
                                            require 'bin/params.php';
                                            mysql_connect($hots, $user, $password);
                                            mysql_select_db($base);
                                            $result = mysql_query("SELECT * FROM entreprise");
                                            while ($tuple = mysql_fetch_object($result)) {
                                                $id = $tuple->noEnts;
                                                $nomEnts = $tuple->nomEnts;
                                                echo "<option value='$id'>$id $nomEnts</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="field">
                                        <label>date de début :</label>
                                        <input type="date" class="datePicker" name="startDate" id="startDate"/> 
                                    </div>
                                    <div class="field">
                                        <label>durée :</label>
                                        <input type='text' name='duration' id="duration" />
                                    </div>
                                    <div class="field">
                                        <label>date de fin :</label>
                                        <input type="date" class="datePicker" name="endDate" id="endDate"/> 
                                    </div>
                                    <div class="field">
                                        <label>Nom de l'étude :</label>
                                        <input name="convention" type="text" /><br/>
                                    </div>
                                    <div class="field">
                                        <label>Prix par journée :</label>
                                        <input name="price" type="text" />
                                    </div>
                                    <div>
                                        <input type="submit" value="Ajouter Etude" /><br/>
                                    </div>
                                </fieldset>
                            </form>

                        </aside>
                        <!-- content -->
                        <section id="content">
                            <article>
                                <h2>Nos <span>Etudes</span></h2>
                                <ul class="contacts">

                                    <?php
                                    /* Pour r�cup�rer une eventuelle erreur sql pass�e par la methode GET, utile pour deboguer, disparaitra par la suite
                                     * le return en question doit �tre une commande javascript (typiquement une alert() ou un console.log()
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

                                    /* affichage de toutes les �tudes en mode tableau */
                                    echo '<table><tr><td>numero</td><td>convention</td><td>date de debut</td><td>duree</td><td>date de fin</td><td>prix journee</td></tr>';
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


                                        /* affichage des �quipes associ�es � l'�tude qui vient d'�tre affich�e */
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
                                </ul>
                            </article> 
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <footer>
            <div class="container">
                <div class="wrapper"></div>
            </div>
        </footer>
        <script type="text/javascript"> Cufon.now();</script>
    </body>
</html>



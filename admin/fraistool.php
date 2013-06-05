<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Frais </title>
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
                        <li><a href="equipeTool.php?return='null">Equipes</a></li>
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
                            <h2>Ajouter <span>Frais</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="addFrais.php" method="post">
                                <fieldset>
                                    <div class="field">
                                        <select name="noEtudiant">
                                            <option value="-1" selected="selected">Choisir le numero d'etudiant</option>
                                            <?php
                                            require 'bin/params.php';
                                            mysql_connect($hots, $user, $password);
                                            mysql_select_db($base);
                                            $result = mysql_query("SELECT * FROM etudiant");
                                            while ($tuple = mysql_fetch_object($result)) {
                                                $id = $tuple->noEtudiant;
                                                echo "<option value='$id'>$id</option>";
                                            }
                                            ?>
                                        </select></div>
                                    <div class="field">
                                        <select name="noEtude">
                                            <option value="-1" selected="selected">Choisir le numero de convention</option>
                                            <?php
                                            require 'bin/params.php';
                                            mysql_connect($hots, $user, $password);
                                            mysql_select_db($base);
                                            $result = mysql_query("SELECT * FROM etude");
                                            while ($tuple = mysql_fetch_object($result)) {
                                                $id = $tuple->noEtude;
                                                $nomEtude = $tuple->convention;
                                                echo "<option value='$id'>$id $nomEtude</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="field">
                                        <label>date du frais :</label>
                                        <input name="date" type="date" /> 
                                    </div>
                                    <div class="field">
                                        <label>Montant déplacement :</label>
                                        <input name="montDep" type="text" />
                                    </div>
                                    <div class="field">
                                        <label>Montant séjour :</label>
                                        <input name="montSej" type="text" />
                                    </div>
                                    <div class="field">
                                        <label>Montant autre :</label>
                                        <input name="montAut" type="text" />
                                    </div>
                                    <div>
                                        <input type="submit" value="Ajouter frais" /><br/>
                                    </div>
                                </fieldset>
                            </form>

                        </aside>
                        <!-- content -->
                        <section id="content">
                            <article>
                                <h2>Les frais <span>enregistrés</span></h2>
                                <ul class="contacts">

                                    <?php
                                    $return = $_GET['return'];
                                    if ($return && $return != "null") {
                                        echo "<script type='text/javascript'>  ";
                                        echo $return;
                                        echo "</script>";
                                    }


                                    require 'bin/params.php';
                                    mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                    mysql_select_db($base) or die('Base de donnes inexistante');
                                    $request = mysql_query('SELECT * FROM frais');

                                    echo '<table><tr><td>num etude</td><td>num etudiant</td><td>num frais</td><td>date</td><td>montant deplacement</td><td>montant sejour</td>
            <td>montant autre</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //etudiant
                                        $noFrais = $tuple->noFrais;
                                        $date = $tuple->date;
                                        $montDep = $tuple->montDep;
                                        $montSejour = $tuple->montSejour;
                                        $montAutre = $tuple->montAutre;
                                        $noEtudiant = $tuple->noEtudiant;
                                        $noEtude = $tuple->noEtude;
                                        echo "<tr><td>$noEtude</td><td>$noEtudiant</td><td>$noFrais</td><td>$date</td><td>$montDep</td><td>$montSejour</td><td>$montAutre</td>";
                                        echo"<td><a href=\"modifyFrais.php?id=$noFrais\">MODIFIER</a></td>";
                                        echo "<td><a href=\"deleteFrais.php?id=$noFrais\">DELETE</a></td></tr>";

                                        //ses �quipes

                                        $participant = mysql_query("SELECT noEquipe FROM participant WHERE noEtudiant='$id'");
                                        while ($tupleparticipant = mysql_fetch_object($participant)) {
                                            $idTeam = $tupleparticipant->noEquipe;
                                            $team = mysql_fetch_object(mysql_query("SELECT * FROM equipe WHERE noEquipe='$idTeam'"));
                                            $idResp = $team->noResp;
                                            $idEtude = $team->noEtude;
                                            echo "<tr><td>team : $idTeam</td><td> resp : $idResp</td><td> etude : $idEtude</td><td></td><td></td></tr>";
                                        }
                                    }
                                    echo '</table>';
                                    mysql_close();
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

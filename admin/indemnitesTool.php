<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Indemnités </title>
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
                            <h2>Ajouter <span>Indemnité</span></h2>
                            <!-- .contacts -->
                            <?php
                            $noEtudiant = $_POST['noEtudiant'];
                            $message = $_POST['return'];
                            echo "Numéro d'étudiant : $noEtudiant<br/>";
                            echo "message : $message<br/>";
                            ?>

                            <form id="contacts-form" action="addIndemnites.php" method="post">
                                <fieldset>
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
                                                $designation = $tuple->convention;
                                                echo "<option value='$id'>$id $designation</option>";
                                            }
                                            ?>

                                        </select></div>


                                    <div class="field">
                                        <label>date de demande d'indémnité :</label>
                                        <input name="date" type="date" /> 
                                    </div>
                                    <div class="field">
                                        <label>Montant demandé :</label>
                                        <input name="montant" type="text" />
                                    </div>
                                    <div class="field">
                                        <label>Nombre jour etude  :</label>
                                        <input name="nbJour" type="text" />
                                    </div>
                                    <div>
                                        <input type="hidden"  name="noEtudiant"  value="<?php echo $noEtudiant; ?>">
                                        <input type="submit" value="Enregistrer indemnités" /><br/>
                                    </div>


                            </form>
                            
                        </aside>
                        <div>

                                <p>Vous ne pouvez effectué que 3 demandes d'indemnités par projet</p>

                            </div> 
                        <!-- content -->
                        <section id="content">
                            <article>

                                <h2>Les indemnités <span>déjà versées</span></h2>
                                <ul class="contacts">

                                    <?php
                                    require 'bin/params.php';
                                    mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                    mysql_select_db($base) or die('Base de donnes inexistante');
                                    $request = mysql_query("select * from indemnites join etude on etude.noEtude=indemnites.noEtude where noEtudiant='$noEtudiant'");

                                    echo '<table><tr class="bold"><td>num indemnité</td><td class="big">nom étude</td><td>date</td><td>montant</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //
                                        $noIndemnite = $tuple->noIndemnite;
                                        $nomEtude = $tuple->convention;
                                        $date = $tuple->date;
                                        $montant = $tuple->montant;
                                        echo "<tr class='nobold'><td>$noIndemnite</td><td>$nomEtude</td><td>$date</td><td>$montant</td></tr>";
                                    }
                                    echo '</table>';
                                    mysql_close();
                                    ?>

                                </ul>

                                <h2>Les études <span>auxquelles vous avez participé</span></h2>
                                <ul class="contacts">

                                    <?php
                                    require 'bin/params.php';
                                    mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                    mysql_select_db($base) or die('Base de donnes inexistante');
                                    $request = mysql_query("select etude.noEtude,etude.convention,cra.duree, prixJournee from etudiant join cra on etudiant.noEtudiant=cra.noEtudiant join etude on cra.noEtude=etude.noEtude where etudiant.noEtudiant='$noEtudiant'");

                                    echo '<table><tr class="bold"><td>num </td><td class="big">nom etude</td><td>temps travaillé</td><td>taux etude</td><td>taux étudiant</td><td>nb etudiants</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //
                                        $noEtude = $tuple->noEtude;
                                        $nomEtude = $tuple->convention;
                                        $duree = $tuple->duree;
                                        $prixJournee = $tuple->prixJournee;
                                        $tauxEtudiant = $prixJournee / 2;
                                        echo "<tr class='nobold'><td>$noEtude</td><td>$nomEtude</td><td>$duree</td><td>$prixJournee</td><td>$tauxEtudiant</td>";
                                    }
                                    echo '</table>';
                                    mysql_close();
                                    ?>

                                    <!-- Les montants sont calculés à partir du nombre d'étudiant par projet : taux jouranlieretudiant=tauxjournalierprojet/nombreetudiant -->
                                    <div><p>
                                            <?php
                                            require 'bin/params.php';
                                            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                            mysql_select_db($base) or die('Base de donnes inexistante');
                                            $nbetudiant = mysql_query("SELECT noEquipe, COUNT(noEtudiant) FROM participant where noEquipe in(SELECT noEquipe FROM participant where noEtudiant='$noEtudiant') group by noEquipe");

                                            echo '<p>Nombre d\'étudiants par équipe <br/>';

                                            // Print out result
                                            $compteur = 0;
                                            while ($row = mysql_fetch_array($nbetudiant)) {
                                                $compteur++;
                                                echo "There are " . $row['COUNT(noEtudiant)'] . " étudiants dans l'équipe " . $row['noEquipe'] . " en charge de l'étude à la ligne " . $compteur;
                                                echo "<br />";
                                            }

                                            echo '</table></p>';
                                            mysql_close();
                                            ?>
                                        </p></div>    
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


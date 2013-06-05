<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Facturation </title>
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

                        </aside>
                    </div>
                        <!-- content -->
                        <div class="wrapper">
                        <section id="content">
                            <article>
                                <h2>Les études <span>non facturées</span></h2>
                                <ul class="contacts">

                                    <?php
                                    require 'bin/params.php';
                                    mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                    mysql_select_db($base) or die('Base de donnes inexistante');
                                    $request = mysql_query("Select * from etude join entreprise on etude.noEnts=entreprise.noEnts where statut=0");

                                    echo 'Voici la liste des etudes dont la facture n\'a pas été éditée <br/>';
                                    echo '<table><tr><td>num etude</td><td>nom entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //
                                        $noEtude = $tuple->noEtude;
                                        $nomEntreprise = $tuple->nomEnts;
                                        $adresseEnts = $tuple->adresseEnts;
                                        $duree = $tuple->duree;
                                        $prixJournee = $tuple->prixJournee;
                                        $convention = $tuple->convention;
                                        $montantTotal = $prixJournee * $duree;
                                        echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotal</td>";
                                        echo"<td><a href=\"editFacture.php?noEtude=$noEtude&amp;nomEntreprise=$nomEntreprise&amp;adresseEnts=$adresseEnts&amp;duree=$duree&amp;
                prixJournee=$prixJournee&amp;convention=$convention&amp;montantTotal=$montantTotal;\">EDITER FACTURE</a></td></tr>";
                                    }
                                    echo '</table>';
                                    mysql_close();
                                    ?>
                                    </div>
                        
                                    <div class="wrapper">
                                    <h2>Facturation <span>Archives</span></h2>
                                    <?php
                                    require 'bin/params.php';
                                    mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
                                    mysql_select_db($base) or die('Base de donnes inexistante');
                                    $request = mysql_query("Select * from etude join entreprise on etude.noEnts=entreprise.noEnts where statut=1");

                                    echo 'Voici la liste des etudes <br/>';
                                    echo '<table><tr><td>num etude</td><td>nom entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //
                                        $noEtude = $tuple->noEtude;
                                        $nomEntreprise = $tuple->nomEnts;
                                        $adresseEnts = $tuple->adresseEnts;
                                        $duree = $tuple->duree;
                                        $prixJournee = $tuple->prixJournee;
                                        $convention = $tuple->convention;
                                        $montantTotal = $prixJournee * $duree;
                                        echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotal</td>";
                                        echo"<td><a href=\"viewFacture.php?noEtude=$noEtude&amp;nomEntreprise=$nomEntreprise&amp;adresseEnts=$adresseEnts&amp;duree=$duree&amp;
                                        prixJournee=$prixJournee&amp;convention=$convention&amp;montantTotal=$montantTotal;\">VISUALISER FACTURE</a></td></tr>";
                                    }
                                    echo '</table>';
                                    mysql_close();
                                    ?>
                                    </div>
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

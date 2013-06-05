<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Equipe </title>
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
                            <h2>Ajouter <span>Equipe</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="addEquipe.php" method="post">
                                <fieldset>
                                    
                                </fieldset>
                            </form>

                        </aside>
                        <!-- content -->
                        <section id="content">
                            <article>
                                <h2>Nos <span>Equipe</span></h2>
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
                                    $requestequipe = mysql_query("select equipe.noEquipe,etude.noEtude,convention,noResp, nomEtudiant from equipe join etude on etude.noEtude=equipe.noEtude join etudiant on etudiant.noEtudiant=equipe.noResp");

                                    while ($tuple = mysql_fetch_object($requestequipe)) {
                                        //etudiant
                                        $id = $tuple->noEquipe;
                                        $noEtude = $tuple->noEtude;
                                        $convention = $tuple->convention;
                                        $noResp = $tuple->noResp;
                                        $nomResp = $tuple->nomEtudiant;
                                        echo "<div><h3>Etude : $convention</h3></br>Responsable : $nomResp</h3></br>";
                                        
                                        $requestteam = mysql_query("select * from equipe join participant on participant.noEquipe=equipe.noEquipe join etudiant on etudiant.noEtudiant=participant.noEtudiant where (equipe.noEquipe='$id' and nomEtudiant !='$nomResp' )");
                                                while ($tuple = mysql_fetch_object($requestteam)) {
                                                    $membre = $tuple->nomEtudiant;
                                                    echo "Membre de l'équipe : $membre</br>";
                                                }
                                                echo "</div></br>";
                               
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

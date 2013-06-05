<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Demande indemnités - Sélection de l'étudiant </title>
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
                            <h2>Sélectionner <span>l'étudiant</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="indemnitesTool.php" method="post">
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
                                                $nom = $tuple->nomEtudiant;
                                                echo "<option value='$id'>$id $nom</option>";
                                            }
                                            ?>
                                        </select></br></div>
                                                                                <div>
                                            <input type="submit" value="Valider l'étudiant sélectionné" /><br/>
                                        </div>
                                </fieldset>
                            </form>

                        </aside>
                        <!-- content -->
                        <section id="content">
                            <article>
                                
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


<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Compte rendu d'activité </title>
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
                            <h2>Ajouter <span>Compte rendu d'activité</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="addCra.php" method="post">
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
                                    <div>
                                        <input type="submit" value="Ajouter CRA" /><br/>
                                    </div>
                                </fieldset>
                            </form>

                        </aside>
                        <!-- content -->
                        <section id="content">
                            <article>
                                <h2>Les CRA <span>enregistrés</span></h2>
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
                                    $request = mysql_query('SELECT * FROM cra');

                                    echo '<table style="border:1px"><tr><td>num etudiant</td><td>num etude</td><td>Date début</td><td>Date fin w</td><td>durée</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //etudiant
                                        $noCra = $tuple->id;
                                        $noEtudiant = $tuple->noEtudiant;
                                        $noEtude = $tuple->noEtude;
                                        $dateDebut = $tuple->dateDebut;
                                        $dateFin = $tuple->dateFin;
                                        $duree = $tuple->duree;
                                        echo "<tr><td>$noEtudiant</td><td>$noEtude</td><td>$dateDebut</td><td>$dateFin</td><td>$duree</td>";
                                        echo"<td><a href=\"modifyCra.php?id=$noCra\">MODIFIER</a></td>";
                                        echo "<td><a href=\"deleteCra.php?id=$noCra\">DELETE</a></td></tr>";
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










<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajout d'un Compte rendu d'activite hebdomadaire</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Compte rendu d'activite hebdomadaire</h2>
        <form action="addCra.php" method="post">

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
            </select></br>
            <select name="noEtude">
                <option value="-1" selected="selected">Choisir le numero de convention</option>
                <?php
                require 'bin/params.php';
                mysql_connect($hots, $user, $password);
                mysql_select_db($base);
                $result = mysql_query("SELECT * FROM etude");
                while ($tuple = mysql_fetch_object($result)) {
                    $id = $tuple->noEtude;
                    echo "<option value='$id'>$id</option>";
                }
                ?>
            </select> </br>

            <p id="startDateP"> Date debut <input type="date" class="datePicker" name="startDate" id="startDate"/>   </p>
            Duree : <input type='text' name='duration' id="duration" />
            <p> Date fin <input type="date" class="datePicker" name="endDate" id="endDate"/>   </p>
            <div>
            <br><br><input type="submit" value="Ajouter CRA" /><br/>
            </div>

        </form>


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
        $request = mysql_query('SELECT * FROM cra');

        echo '<table><tr><td>num etudiant</td><td>num etude</td><td>Date début</td><td>Date fin w</td><td>durée</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            //etudiant
            $noCra = $tuple->id;
            $noEtudiant = $tuple->noEtudiant;
            $noEtude = $tuple->noEtude;
            $dateDebut = $tuple->dateDebut;
            $dateFin = $tuple->dateFin;
            $duree = $tuple->duree;
            echo "<tr><td>$noEtudiant</td><td>$noEtude</td><td>$dateDebut</td><td>$dateFin</td><td>$duree</td>";
            echo"<td><a href=\"modifyCra.php?id=$noCra\">MODIFIER</a></td>";
            echo "<td><a href=\"deleteCra.php?id=$noCra\">DELETE</a></td></tr>";
        }
        echo '</table>';
        mysql_close();
        ?>
    </body>
</html>
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
                            <h2>Ajouter <span>Etudiant</span></h2>
                            <!-- .contacts -->
                            <form id="contacts-form" action="addStudent.php" method="post">
                                <fieldset>
                                    <div class="field">
                                        <label> Nom :</label>
                                        <input name="name" type="text" value=""/>
                                    </div>
                                    <div class="field">
                                        <label>Adresse :</label>
                                        <input name="adress" type="text" value=""/>
                                    </div>
                                    <div class="field">
                                        <label>N° sécurité sociale :</label>
                                        <input name="secuNum" type="text" value=""/>
                                    </div>
                                    <div>
                                        <input type="submit" value="Ajouter Etudiant" /><br/>
                                    </div>
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
                                    $request = mysql_query('select equipe.noEquipe, etude.noEtude, convention, noResp, nomEtudiant from equipe join etude on equipe.noEtude=etude.noEtude join participant on participant.noEquipe=equipe.noEquipe join etudiant on participant.noEtudiant=etudiant.noEtudiant');

                                    echo '<table><tr class="bold"><td>NUM EQUIPE</td><td>NUM ETUDE</td><td class="big">DESIGNATION</td><td>NUM RESP</td><td>NOM ETUDIANT</td></tr>';
                                    while ($tuple = mysql_fetch_object($request)) {
                                        //etudiant
                                        $id = $tuple->noEquipe;
                                        $noEtude = $tuple->noEtude;
                                        $convention = $tuple->convention;
                                        $noResp = $tuple->noResp;
                                        $nomEtudiant = $tuple->nomEtudiant;
                                        echo "<tr><td>$id</td><td>$noEtude</td><td>$convention</td><td>$noResp</td><td>$nomEtudiant</td>";
                                        echo"<td><a href=\"modifyStudent.php?id=$id\">MODIFIER    </a></td>";
                                        echo "<td><a href=\"deleteStudent.php?id=$id\">DELETE</a></td></tr>";

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
  <script type="text/javascript"> Cufon.now(); </script>
</body>
</html>

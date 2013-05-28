<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajout d'un frais</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Ajout d'un frais</h2>
        <form action="addFrais.php" method="post">

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
            
            date : <input name="date" type="date" /><br/>
            Montant Deplacement: <input name="montDep" type="text" /><br/>
            Montant Sejour : <input name="montSej" type="text"> </br>
            Montant Autre : <input name="montAut" type="text"> </br>
            <input type="submit" value="Ajouter Frais" /><br/>

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
            
            $participant=mysql_query("SELECT noEquipe FROM participant WHERE noEtudiant='$id'");
            while( $tupleparticipant = mysql_fetch_object($participant)) {
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
    </body>
</html>
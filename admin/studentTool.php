<html>
    <head>
        <title>viewStudent</title>
    </head>
    <body>
        <div>
            <p> voici les etudiants </p>
        </div>

        <h2>Ajout</h2>
        <form action="addStudent.php" method="post">
            Nom : <input name="name" type="text" /><br/>
            Adresse: <input name="adress" type="text" /><br/>
            Numero de Secu : <input name="secuNum" type="text"> </br>
            <input type="submit" value="Ajouter Etudiant" /><br/>

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
        $request = mysql_query('SELECT * FROM etudiant');
      
        echo '<table><tr><td>num</td><td>nom</td><td>adresse</td><td>num secu</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            //etudiant
            $id = $tuple->noEtudiant;
            $nom = $tuple->nomEtudiant;
            $adresse = $tuple->adresseEtudiant;
            $noSecu = $tuple->noSecu;
            echo "<tr><td>$id</td><td>$nom</td><td>$adresse</td><td>$noSecu</td>";
            echo"<td><a href=\"modifyStudent.php?id=$id\">MODIFIER</a></td>";
            echo "<td><a href=\"deleteStudent.php?id=$id\">DELETE</a></td></tr>";
            
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
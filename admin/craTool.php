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

            <input type="submit" value="Ajouter CRA" /><br/>

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
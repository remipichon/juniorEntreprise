<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Ajout d'un frais</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Demande d'indemnités</h2>
        <form action="addRemboursement.php" method="post">

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
            </select></br>
      
            date : <input name="date" type="date" /><br/>           
            Montant demandé : <input name="montDep" type="text" /><br/>
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
        $request = mysql_query('SELECT * FROM cra');
      
        echo '<table><tr><td>num etudiant</td><td>num etude</td><td>date debut</td><td>date fin</td><td>durée</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            //etudiant
            $id = $tuple->id;
            $noEtudiant = $tuple->noEtudiant;
            $noEtude = $tuple->noEtude;
            $dateDebut = $tuple->dateDebut;
            $dateFin = $tuple->dateFin;
            $duree = $tuple->duree;
            echo "<tr><td>$noEtudiant</td><td>$noEtude</td><td>$dateDebut</td><td>$sec$dateFinu</td><td>$duree</td>";
            echo"<td><a href=\"modifyStudent.php?id=$id\">MODIFIER</a></td>";
            echo "<td><a href=\"deleteStudent.php?id=$id\">DELETE</a></td></tr>";   
        }
        echo '</table>';
          mysql_close();
        ?>
    </body>
</html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Demande d'indemnités</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Demande d'indemnités</h2>
        <form action="addIndemnites.php" method="post">
            <!--recuperation du numero d'etudiant -->
            <p>
            <?php
            $noEtudiant = $_POST['noEtudiant'];
            echo "Numéro d'étudiant : $noEtudiant<br/>";
            ?>
                
            <!-- affichage du montant auquel les etudiants ont droit -->  
            <!-- Les montants sont calculés à partir de la duree saisie dans le cra et du tauxJournee dans la table etude --> 
            <?php              
            require 'bin/params.php';
            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
            mysql_select_db($base) or die('Base de donnes inexistante');
            $request = mysql_query("select etude.noEtude,cra.duree, prixJournee from etudiant join cra on etudiant.noEtudiant=cra.noEtudiant join etude on cra.noEtude=etude.noEtude where etudiant.noEtudiant='$noEtudiant'");
      
            echo 'Voici la liste des etudes et les rémunérations nécessaire<br/>';
            echo '<table><tr><td>num etude</td><td>temps travaillé</td><td>taux journalier</td><td>taux journalier étudiant</td></tr>';
            while ($tuple = mysql_fetch_object($request)) {
            //
            $noEtude = $tuple->noEtude;
            $duree = $tuple->duree;
            $prixJournee = $tuple->prixJournee;
            $tauxEtudiant = $prixJournee/2;
            echo "<tr><td>$noEtude</td><td>$duree</td><td>$prixJournee</td><td>$tauxEtudiant</td>";
            echo"<td><a href=\"modifyIndemnites.php?id=$noEtude\">MODIFIER</a></td>";
            echo "<td><a href=\"deleteIndemnites.php?id=$noEtude\">DELETE</a></td></tr>";   
            }
            echo '</table>';
          mysql_close();
        ?>
            
            
            <?php
                require 'bin/params.php';
                mysql_connect($host, $user, $password);
                mysql_select_db($base);
                $result = mysql_query("SELECT * FROM etude");
                while ($tuple = mysql_fetch_object($result)) {
                    $id = $tuple->noEtude;
                    echo "<option value='$id'>$id</option>";
                }
            ?>
            </p>
            
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
            Montant demandé : <input name="montant" type="text" /><br/>
            nombre jour etude : <input name="nbJour" type="text"> </br>
            <input type="hidden"  name="noEtudiant"  value="<?php echo $noEtudiant; ?>">
            <input type="submit" value="Enregistrer indemnités" /><br/>
            

        </form>


        <?php              
        require 'bin/params.php';
        mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
        mysql_select_db($base) or die('Base de donnes inexistante');
        $request = mysql_query("SELECT * FROM indemnites where noEtudiant='$noEtudiant'");
      
        echo '<table><tr><td>num etudiant</td><td>num etude</td><td>date</td><td>durée</td><td>montant</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            //etudiant
            $id = $tuple->noIndemnite;
            $noEtudiant = $tuple->noEtudiant;
            $noEtude = $tuple->noEtude;
            $date = $tuple->date;
            $duree = $tuple->nbJourEtude;
            $montant = $tuple->montant;
            echo "<tr><td>$noEtudiant</td><td>$noEtude</td><td>$date</td><td>$duree</td><td>$montant</td>";
            echo"<td><a href=\"modifyIndemnites.php?id=$id\">MODIFIER</a></td>";
            echo "<td><a href=\"deleteIndemnites.php?id=$id\">DELETE</a></td></tr>";   
        }
        echo '</table>';
          mysql_close();
        ?>
    </body>
</html>
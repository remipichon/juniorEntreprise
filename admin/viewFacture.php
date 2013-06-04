<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Facturation</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Facturation</h2>
        <form action="addFacture.php" method="post">
            <!--recuperation du numero d'etudiant -->
              
            <!-- affichage du montant auquel les etudiants ont droit -->  
            <!-- Les montants sont calculés à partir de la duree saisie dans le cra et du tauxJournee dans la table etude --> 
            <?php              
            require 'bin/params.php';
            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
            mysql_select_db($base) or die('Base de donnes inexistante');
            $request = mysql_query("Select * from etude join entreprise on etude.noEnts=entreprise.noEnts");
             
            echo 'Voici la liste des etudes <br/>';
            echo '<table><tr><td>num etude</td><td>nom entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';
            while ($tuple = mysql_fetch_object($request)) {
            //
            $noEtude = $tuple->noEtude;
            $nomEntreprise = $tuple->nomEnts;
            $duree = $tuple->duree;
            $prixJournee = $tuple->prixJournee;
            $convention = $tuple->convention;
            $montantTotal = $prixJournee*$duree;
            echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotal</td>";
            echo"<td><a href=\"editFacture.php?id=$noEtude\">EDITER FACTURE</a></td></tr>";
            }
            echo '</table>';
            mysql_close();
            ?>

        </form>

    </body>
</html>
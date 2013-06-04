<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Facturation</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Edition - Factures</h2>
        <?php              
            require 'bin/params.php';
            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
            mysql_select_db($base) or die('Base de donnes inexistante');
            $request = mysql_query("Select * from etude join entreprise on etude.noEnts=entreprise.noEnts where statut=0");
             
            echo 'Voici la liste des etudes <br/>';
            echo '<table><tr><td>num etude</td><td>nom entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';
            while ($tuple = mysql_fetch_object($request)) {
            //
            $noEtude = $tuple->noEtude;
            $nomEntreprise = $tuple->nomEnts;
            $adresseEnts = $tuple->adresseEnts;
            $duree = $tuple->duree;
            $prixJournee = $tuple->prixJournee;
            $convention = $tuple->convention;
            $montantTotal = $prixJournee*$duree;
            echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotal</td>";
            echo"<td><a href=\"editFacture.php?noEtude=$noEtude&amp;nomEntreprise=$nomEntreprise&amp;adresseEnts=$adresseEnts&amp;duree=$duree&amp;
                prixJournee=$prixJournee&amp;convention=$convention&amp;montantTotal=$montantTotal;\">EDITER FACTURE</a></td></tr>";
            }
            echo '</table>';
            mysql_close();
            ?>
        
        <h2>Facturation - Archives</h2>
        <?php              
            require 'bin/params.php';
            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
            mysql_select_db($base) or die('Base de donnes inexistante');
            $request = mysql_query("Select * from etude join entreprise on etude.noEnts=entreprise.noEnts where statut=1");
             
            echo 'Voici la liste des etudes <br/>';
            echo '<table><tr><td>num etude</td><td>nom entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';
            while ($tuple = mysql_fetch_object($request)) {
            //
            $noEtude = $tuple->noEtude;
            $nomEntreprise = $tuple->nomEnts;
            $adresseEnts = $tuple->adresseEnts;
            $duree = $tuple->duree;
            $prixJournee = $tuple->prixJournee;
            $convention = $tuple->convention;
            $montantTotal = $prixJournee*$duree;
            echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotal</td>";
            echo"<td><a href=\"viewFacture.php?noEtude=$noEtude&amp;nomEntreprise=$nomEntreprise&amp;adresseEnts=$adresseEnts&amp;duree=$duree&amp;
                prixJournee=$prixJournee&amp;convention=$convention&amp;montantTotal=$montantTotal;\">VISUALISER FACTURE</a></td></tr>";
            }
            echo '</table>';
            mysql_close();
            ?>

    </body>
</html>
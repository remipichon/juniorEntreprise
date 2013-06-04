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
        <div>

        <?php
        $noEtude = $_GET['noEtude'];
        $nomEntreprise = $_GET['nomEntreprise'];
        $duree = $_GET['duree'];
        $prixJournee = $_GET['prixJournee'];
        $adresseEnts = $_GET['adresseEnts'];
        $convention = $_GET['convention'];
        $montantTotalSansFrais = $prixJournee * $duree;
        $date = date("d-m-Y");
        $heure = date("H:i");
        $frais = 50;
        
        echo '<table border="1"><tr><td>num etude</td><td>nom entreprise</td><td>adresse entreprise</td><td>nom etude</td><td>durée etude</td><td>taux journalier</td><td>montant total</td></tr>';    
        echo "<tr><td>$noEtude</td><td>$nomEntreprise</td><td>$adresseEnts</td><td>$convention</td><td>$duree</td><td>$prixJournee</td><td>$montantTotalSansFrais</td>";
        echo '</table>';
        ?>
        </div>
        
        <div>
            <br><br>Récupération des frais associés à l'étude : 
        </div>
        <?php
            $fraisTotal = 0;
            require 'bin/params.php';
            mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
            mysql_select_db($base) or die('Base de donnes inexistante');
            $request = mysql_query("Select * from etude join frais on etude.noEtude=frais.noEtude where etude.noEtude='$noEtude'");
            while ($tuple = mysql_fetch_object($request)) {
            //
            $noEtude = $tuple->noEtude;
            $montDep = $tuple->montDep;
            $montSejour = $tuple->montSejour;
            $montAutre = $tuple->montAutre;
            $noEtudiant = $tuple->noEtudiant;
            $fraisTotalLigne = $montDep+$montSejour+$montAutre;
            $fraisTotal += $fraisTotalLigne;
            echo'<table border=1>';
            echo "<tr><td>num étude</td><td>num étudiant</td><td>montant déplacement</td><td>montant sejour</td><td>montant autre</td><td>montant total</td></tr>";
            echo "<tr><td>$noEtude</td><td>$noEtudiant</td><td>$montDep</td><td>$montSejour</td><td>$montAutre</td><td>$fraisTotalLigne</td></tr>";
            echo'</table>';
            }
            mysql_close();
            $montantTotalAvecFrais = $montantTotalSansFrais+$fraisTotal;
            $TVA = $montantTotalAvecFrais*0.204;
            $montantTotalAvecTVA = $montantTotalAvecFrais+$TVA;
        ?>
       
        
        <div>
            <p>
                numéro de facture : <br/>
                numéro de SIRET : 176252672 <br/>
                Date facture : <?php echo$date?><br/>
                Nom entreprise : <?php echo$nomEntreprise?> <br/>
                Adresse entreprise : <?php echo$adresseEnts?> <br/>
                Numéro de convention : <?php echo$noEtude?> <br/>
                Nom de l'étude : <?php echo$convention?> <br/>
                Prix de la journée : <?php echo$prixJournee?> <br/>
            </p>
        </div>
        
        <div>
            <table border='1'>
                <tr><td>Nombre jour étude (A)</td><td>Cout étude (A)*prix jour = (B)</td><td>Total frais associés à l'étude</td><td>Somme total HT par convention</td><td>TVA</td><td>Somme total TTC par convention</td></tr>
                <tr><td><?php echo$duree?></td><td><?php echo$montantTotalSansFrais?></td><td><?php echo$fraisTotal?></td><td><?php echo$montantTotalSansFrais+$fraisTotal?></td><td><?php echo$TVA?></td><td><?php echo$montantTotalAvecTVA?></td></tr>
            </table>
        </div>
           
        <div>
        <form action="addFacture.php" method="post">
            
            <input type='hidden' name='date' value=<?php echo$date?>><br/>
            <input type='hidden' name='montant' value=<?php echo$montantTotalAvecTVA?>><br/>
            <input type='hidden' name='noEtude' value=<?php echo$noEtude?>><br/>
            <input type='submit' value='Enregistrer Facture' onClick="window.print()">
        </form>
        </div>
        

    </body>
</html>
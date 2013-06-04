<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
        <title>Entreprises clientes</title>
    </head>
    <body>
        <div>
            <h1>Entreprises clientes</h1>
        </div>

        <h2>Ajout</h2>
        <form action="addCorp.php" method="post">
            Nom : <input name="name" type="text" /><br/>
            Adresse: <input name="adress" type="text" /><br/>
            Numero de Telephone : <input name="phoneNum" type="text"> </br>
            <input type="submit" value="Ajouter Entreprise" /><br/>

        </form>

        <div>
            <h2>Voici la liste des enterprises enregistrées</h2>
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
        $request = mysql_query('SELECT * FROM entreprise');
       
        echo '<table><tr><td>num</td><td>nom</td><td>adresse</td><td>telephone</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            $id = $tuple->noEnts;
            $nom = $tuple->nomEnts;
            $adress = $tuple->adresseEnts;
            $phone = $tuple->telEnts;

            echo "<tr><td>$id</td><td>$nom</td><td>$adress</td><td>$phone</td>";
            echo"<td><a href=\"modifyCorp.php?id=$id\">MODIFIER    </a></td>";
            echo "<td><a href=\"deleteCorp.php?id=$id\">DELETE</a></td></tr>";
            //ses etudes
            
            $etude=mysql_query("SELECT * FROM etude WHERE noEnts='$id'");
            while( $tupleetude = mysql_fetch_object($etude)) {                                
                $idEtude = $tupleetude->noEtude;                
                $convention = $tupleetude->convention;
                echo "<tr><td>etude : $idEtude</td><td> convention : $convention</td></tr>";
                  
            } 
            
            
        }
         mysql_close();
        echo '</table>';
        ?>
    </body>
</html>
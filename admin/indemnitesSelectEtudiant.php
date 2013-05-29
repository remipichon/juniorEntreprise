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
        <form action="indemnitesTool.php" method="post">

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
            <p><input type="submit" value="Valider étudiant sélectionné" /><br/></p>

        </form>
    </body>
</html>
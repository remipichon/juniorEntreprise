<html>
    <head>
        <title>viewCorp</title>

        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />


    </head>
    <body>
        <div>
            <p> voici les etudes </p>
        </div>

        <h2>Ajout</h2>
        <form action="addStudy.php" method="post">

            <select name="corpId">
                <option value="-1" selected="selected">Choisir une entreprise</option>
                <?php
                require 'bin/params.php';
                mysql_connect($hots, $user, $password);
                mysql_select_db($base);
                $result = mysql_query("SELECT * FROM entreprise");
                while ($tuple = mysql_fetch_object($result)) {
                    $id = $tuple->noEnts;
                    echo "<option value='$id'>$id</option>";
                }
                ?>
            </select>

            <p id="startDateP"> Date debut <input type="text" class="datePicker" name="startDate" id="startDate"/>   </p>
            Duree : <input type='text' name='duration' id="duration" />
            <p> Date fin <input type="text" class="datePicker" name="endDate" id="endDate"/>   </p>
            <script type="text/javascript">
                //$(".datePicker").datepicker({dateFormat: "yy-mm-dd"});
                $("#startDate").datepicker({
                    //dateFormat: "yy-mm-dd",
                    onClose: function(value, date) {
                        $("#endDate").datepicker({
                            minDate: new Date(date.selectedYear, date.selectedMonth, date.selectedDay),
                            onClose: function(valueEnd, dateEnd) {
                                var d2 = new Date(date.selectedYear, date.selectedMonth, date.selectedDay);
                                var d1 = new Date(dateEnd.selectedYear, dateEnd.selectedMonth, dateEnd.selectedDay);
                                var duration = Math.ceil((d1.getTime() - d2.getTime()) / (1000 * 60 * 60 * 24));
                                $('#duration').attr("value", duration);
                            }
                        });

                    }
                });


            </script>

            Convention : <input name="convention" type="text" /><br/>
            Prix Journee: <input name="price" type="text" /><br/>
            <input type="submit" value="Ajouter Etude" /><br/>

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
        $request = mysql_query('SELECT * FROM etude');

        echo '<table><tr><td>numero</td><td>convention</td><td>date de debut</td><td>duree</td><td>date de fin</td><td>prix journée</td></tr>';
        while ($tuple = mysql_fetch_object($request)) {
            $id = $tuple->noEtude;
            $startDate = $tuple->dateDebut;
            $endDate = $tuple->dateFin;
            $duration = $tuple->duree;
            $price = $tuple->prixJournee;
            $convention = $tuple->convention;

            echo "<tr><td>$id</td><td>$convention</td><td>$startDate</td><td>$duration</td><td>$endDate</td><td>$price</td>";
            echo"<td><a href=\"modifyStudy.php?id=$id\">MODIFIER    </a></td>";
            echo "<td><a href=\"deleteStudy.php?id=$id\&amp;test=$id\">DELETE</a></td></tr>";

            //ses équipes

            $team = mysql_query("SELECT * FROM equipe WHERE noEtude='$id'");
            while ($tupleTeam = mysql_fetch_object($team)) {
                $idTeam = $tupleTeam->noEquipe;
                $idResp = $tupleTeam->noResp;
                $idEtude = $tupleTeam->noEtude;
                echo "<tr><td>team : $idTeam</td><td> resp : $idResp</td><td> etude : $idEtude</td><td></td><td></td></tr>";
            }
        }
        mysql_close();
        echo '</table>';
        ?>
    </body>
</html>
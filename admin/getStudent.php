<?php

header("Content-type :text/plain");


require 'bin/params.php';
mysql_connect($host, $user, $password) or die('Impossible de se connecter au SGBD');
mysql_select_db($base) or die('Base de donnes inexistante');
$request = mysql_query('SELECT * FROM etudiant');

$return = "";

while ($tuple = mysql_fetch_object($request)) {


    $return .= $tuple->nomEtudiant."##";
}
echo $return;
mysql_close();
?>
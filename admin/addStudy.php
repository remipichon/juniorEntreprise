<?php
/*appeler par studyTool
 * ici on r�cup�re simplement par la m�thode POST les donn�es des input, m�me duration qui a pourtant �t� calcul�e en javascript mais pass�e via la m�thode Alaromano
 */
$noEnts = $_POST['corpId'];
$startDate = $_POST['startDate'];
$duration = $_POST['duration'];
$endDate = $_POST['endDate'];
$price = $_POST['price'];
$convention = $_POST['convention'];


require 'bin/params.php';
mysql_connect($host, $user, $password);
mysql_select_db($base);

mysql_query("INSERT INTO etude (noEnts,dateDebut,duree,dateFin,convention) VALUES('$noEnts','$startDate','$duration','$endDate','$convention') ");

//cath des erreurs sql
if (mysql_errno()) { //1452(clef etrangere non referecee en clef primaire)      1064(parse error,surement int excepted but string receveid)
    $return = "alert(".mysql_errno().")";
}else {
    $return = "null";
}

mysql_close();
//ici on retourne l'erreur sql sous forme de alert javascript
header("location:studyTool.php?return=$return");

?>

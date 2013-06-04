<?
include("config.php");

session_name($sessname);
session_start();

$login="";
$pass="";
$id_session="";
session_unregister($login);
session_unregister($pass);
session_unregister($id_session);

// redirectione vers l'URL $index.
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date du passé
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // toute le temps différente
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache");
include($index);
exit();
?>
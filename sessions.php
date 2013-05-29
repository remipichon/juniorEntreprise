<?
$save_path='/Applications/MAMP/htdocs/sessions'; /* Chemin on l'on va sauver la session sous Windows */
/* 
$save_path='/temp'; // Chemin on l'on va sauver la session sous Linux
*/
session_save_path($save_path); /* Indique au PHP vers ou sauver la session */
session_start(); /* on démarre la session */
session_name("masession"); /* Nom de la session */
session_register("test"); /* Variable de la session à sauvegarder */
$test++; /* On incrémente notre variable de session */
$idsession=session_id(); /* Retourne le numéro de la session */
$nomsession=session_name(); /* Retourne le nom de la session */
echo "Variable test de la session: test=$test<br>Numéro de la session: $idsession<br>Nom de la session: $nomsession";
?>
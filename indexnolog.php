<? /* PHP */
/* Inclusion du fichier auth.php qui permet de créer ou d'ouvrir une session */
include("auth.php");

/* On vérifie que les caractères ne contiennent que les caractères spécifiés*/
function filtrelogpwd($valeur)
{
return ereg("^[ '`,;:ùçéèàa-zA-Z0-9]+$",$valeur);
}

function veriflogin()
{
global $serveur,$loginsql,$passsql,$table,$base,$login,$pass;
$password=$pass;

if (!$login) return false;

if (!filtrelogpwd($login)) return false;

if (!$password) return false;

if (!filtrelogpwd($password)) return false;

// Connexion au serveur
$id=@mysql_connect($serveur,$loginsql,$passsql) or die("Impossible de se connecter à la base de donnée<br>".mysql_error());
mysql_select_db("$base");

// Sélection de la table
$Requete = " SELECT login, pass ";
$Requete.= " FROM $table ";
$Requete.= " WHERE login = '$login' AND pass = '$password' ";
$result = mysql_query($Requete,$id) or die("Requete de vérification de Login et Mot de Passe invalide: ".mysql_error());

// retoune le nombre d'enregistrements dans la table ( ligne )
$lignes = mysql_num_rows($result);

if ($lignes<1)
{
return false;
}else
{
$res=mysql_fetch_row($result);
if ($res[0]==$login && $res[1]==$password) return true;
else return false;
}
} //Fin de la fonction veriflogin()


/* On vérifie que tout les varaible $login,$pass et $id_session sont remplis
*
*/
if ( $login!="" && $pass!="" && $id_session!="" )
{
/* On vérifie si le login et le mot de pass sont bien dans la base de donnée */
if ( !(veriflogin()) )
{
/* Si il y'a une erreur dans le Login ou le mot de Pass on initialise une variable globale avec l'erreur */
$erreur="Erreur Login ou Mot de Passe incorrect";
}else
{
/* Si tout est c'est bien déroulé on rafraîchit la page courante avec la page indexlog.php*/
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); /* Date du passé */
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); /* tout le temps différente */
header("Cache-Control: no-cache, must-revalidate"); /* Pour HTTP/1.1 */
header("Pragma: no-cache");
include($indexlog);
exit();
}
}
?>
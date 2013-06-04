<HTML>
<HEAD>
<TITLE>Vérification de l'inscription en ligne</TITLE>
<META NAME="Description" CONTENT="Inscription">
<META NAME="Author" CONTENT="TITAN">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
</HEAD>
<BODY bgcolor="#6699CC">
<p align="center">&nbsp; <b><font face="Arial, Helvetica, sans-serif" color="#400040" size="6">VALIDATION
DE L'INSCRIPTION</font><br>
&nbsp;</b>&nbsp; <br>

<div align="center">
<table width="402" border="0" height="48" align="center">
<tr>
<td height="20" width="488" valign="middle" align="center">
<?
/* Configuration */
include("config.php");

/* Fonction de vérification de syntaxe d'un email */
function is_email($email)
{
$ret=false;
if(strstr($email, '@') && strstr($email, '.'))
{
if(eregi("^([_a-z0-9]+([\\._a-z0-9-]+)*)@([a-z0-9]{2,}(\\.[a-z0-9-]{2,})*\\.[a-z]{2,3})$", $email))
{
$ret=true;
}
}
return $ret;
}
function formulaire()
{
/* On déclare nos variables provenant du formulaire en global pour y accéder dans les fonctions et en dehors des fonctions */
global $login,$pass1,$pass2,$prenom,$pseudo,$icq,$email,$commentaires,$question;
echo "<p><B><U><FONT SIZE=5>Inscription en ligne</FONT></U></p>";
echo "<p>";

/* On vérifie si le login a été saisi */
if ($login==false)
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez saisir un login</b></font><br><br>";
return false;
}
echo "Votre Login: $login<br>";

/* On vérifie si le mot de passe a été saisi dans les 2champs */
if ($pass1==false ||$pass2==false)
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez inscrire un mot de passe dans les 2champs</b></font><br><br>";
return false;
}

/* On vérifie que les mots de passe dans les deux champs sont identiques */
if ($pass1!=$pass2)
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez inscrire le même mot de passe dans les 2champs</b></font><br><br>";
return false;
}
echo "Votre Mot de Passe: $pass1<br>";

/* On vérifie si le prénom a été saisi */
if ($prenom==false)
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez saisir votre prénom</b></font><br><br>";
return false;
}
echo "Votre Prénom: $prenom<br>";

/* On vérifie si le pseudo a été saisi */
if ($pseudo==false)
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez saisir votre prénom</b></font><br><br>";
return false;
}
echo "Votre Pseudo: $pseudo<br>";

/* Si le No ICQ a été saisi on vérifie qu'il ne contient que des chiffres */
if ($icq)
{
if ((ereg("^[0-9]+$",$icq))==false)
{
echo "<font color=\"#FF0000\"><b>Erreur le champ ICQ doit contenir seulement des chiffres</b></font><br><br>";
return false;
}
}

/* Si le numéro ICQ a été inscrit on l'affiche */
if ($icq==true) echo "Numéro ICQ: $icq<br>";

/* Vérification de l'adresse Email */
if ($email=="")
{
echo "<font color=\"#FF0000\"><b>ERREUR !! Vous devez entrer votre adresse E-Mail</b></font><br><br>";
return false;
}else if (!is_email($email))
{
echo "<font color=\"#FF0000\"><b>ERREUR !! L'adresse E-Mail est incorrect</b></font><br><br>";
return false;
}
echo "Votre Email: $email<br>";

/* Si il y'a des commentaires on les affiches */
if ($commentaires)
{
echo "Vos commentaires: $commentaires<br>";
}
return true;
}

function quitter($erreur)
{
if ($erreur) echo "$erreur";
echo " <A HREF='javascript:history.go(-1)'>Retour au formulaire</A>
</td>
</tr>
</table>
</div>
</BODY>
</HTML>";
exit();
}

$succ=formulaire();
if ($succ==false)
{
quitter("");
}
/* Fin de la gestion du formulaire */

/* Connexion au serveur */
$id=@mysql_connect($serveur,$loginsql,$passsql);
if ($id==false)
{
quitter("<font color=\"#FF0000\"><b>Erreur impossible de se connecter au serveur SQL</b></font><br><br>");
}

/* On séléctionne la base de donnée */
@mysql_select_db("$base") or quitter("<font color=\"#FF0000\"><b>Erreur impossible de séléctionner la base: $base</b></font><br><br>".mysql_error());

/* On vérifie si le login n'est pas déjà utilisé par un autre utilisateur */
$Requete = " SELECT login ";
$Requete.= " FROM $table ";
$Requete.= " WHERE login = '$login'";
$result = mysql_query($Requete,$id) or quitter("<font color=\"#FF0000\"><b>Requête de vérification de Login invalide</b></font><br><br>");
// retoune le nombre d'enregistrements
$lignes = mysql_num_rows($result);
mysql_free_result($result);
if ($lignes>=1)
{
quitter("<font color=\"#FF0000\"><b>Erreur ce login est déjà enregistré<br>Veuillez choisir un autre login</b></font><br><br>");
}

$ip=$REMOTE_ADDR;
$domaine=gethostbyaddr($REMOTE_ADDR);
$navigateur=$HTTP_USER_AGENT;

//$login,$pass1,$pass2,$prenom,$pseudo,$icq,$email,$commentaires,$question;
/* On ajoute des slashs devant tout les caractères spéciaux pour la base de donnée */
$login=addslashes($login);
$pass1=addslashes($pass1);
$prenom=addslashes($prenom);
$pseudo=addslashes($pseudo);
$icq=addslashes($icq);
$email=addslashes($email);
$commentaires=addslashes($commentaires);
$question=addslashes($question);

$query = "INSERT INTO $table VALUES ('0','$login','$pass1','$prenom','$pseudo','$icq','$email','$commentaires','$question','$ip','$domaine','$navigateur',NOW())";
$result = mysql_query($query);
if ($result==true)
{
echo "<br><b>Enregistrement réussi !!</b><br><br>";
}else
{
echo "<br><font color=\"#FF0000\"><b>Erreur enregistrement échoué veuillez contacter le webmaster !!</b></font><br><br>";
}
echo "<A HREF='$index'>Retour à la page d'accueil</A>";
?>
</td>
</tr>
</table>
</div>
</BODY>
</HTML>


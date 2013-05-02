<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

  <body>
<H1>Connexion</h1>
<!--formulaire de connection php, connect.php recoit le login/pwd   -->
    <form action="connect.php" method="post">      
    Pseudo : <input name="pseudo" type="text" /><br/>
    Password : <input name="password" type="password" /><br/>
   <input type="submit" value="Se connecter"/><br/>

    </form>

  </body>
</html>

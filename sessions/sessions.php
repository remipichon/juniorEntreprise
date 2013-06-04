
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Sessions</title>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="../js/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />        
    </head>
    <body>

        <h2>Sessions</h2>
        <div>

            <?
            $save_path = '/Applications/MAMP/htdocs/juniorentreprise/sessions';  /* Chemin on l'on va sauver la session */
            session_save_path($save_path);   /*Indique au PHP vers ou sauver la session */
            session_start(); /* on démarre la session */
            session_name("masession"); /* Nom de la session */
            session_register("test");   /*Variable de la session à sauvegarder */
            $test++; /* On incrémente notre variable de session */
            $idsession = session_id(); /* Retourne le numéro de la session */
            $nomsession = session_name(); /* Retourne le nom de la session */
            echo "Variable test de la session: test=$test<br>Numéro de la session: $idsession<br>Nom de la session: $nomsession";
            ?>
        </div>
        <div>
            <p>Je suis sur la page sessions</p>
        </div>
    </body>
</html>
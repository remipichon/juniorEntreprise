<head>
    <title>Bienvenue</title>
     <link rel="stylesheet" type="text/css" href="css/stylesheet.css"></link>
    <link rel="stylesheet" type="text/css" href="css/alertify.core.css"></link>
    <link rel="stylesheet" type="text/css" href="css/alertify.default.css"></link>   
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/alertify.js"></script>
    <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

    <!--pour google sphere-->
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

    
     <script>

        /* concernant les etudiants
         * pour intialiser les champs input necessaire à transmettre les informations via POST
         */
        function initPostStudent(idStudent) {
             //recuperer les data de l'edutiant maj
            var name = CKEDITOR.instances[idStudent+'name'].getData();                 
            var adress = CKEDITOR.instances[idStudent+'adress'].getData();                 
            var numSecu = CKEDITOR.instances[idStudent+'numSecu'].getData();                 
                    

            $('#idStudentE').attr('value', idStudent);       //renseigne l'input qui permet de POST l'id 
              
            //renseigne les input pour les differentes donnees de l'etudiant
            $('#inputName').attr('value', name);
            $('#inputAdress').attr('value', adress);
            $('#inputNumSecu').attr('value', numSecu);           
            
            
            $('#submitStudent').trigger('click');     //simule le click pour envoyer le formulaire POST
        }
    </script>

</head>
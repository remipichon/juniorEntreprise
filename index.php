<!DOCTYPE html>
<html>
    <?php require 'header.php'; ?>
    <body>
        <?php require 'menu.php'; ?>
        <div>
            google sphere
            <g:panoembed id='sphereHome' imageurl="https://lh4.googleusercontent.com/-Oqf0-IYmTQk/UYvWQLdAoDI/AAAAAAAAAZI/n2soSS9nrZ8/w924-h352-no/13+-+1"
                         fullsize="4096,2048"
                         croppedsize="4096,1380"
                         offset="0,480"
                         displaysize="600,400"
                         autorotate="1"/>

            <script>
                var height = window.innerHeight - 100;
                var disp = window.innerWidth + "," + height;
                $('#sphereHome').attr('displaysize', disp);
                console.log($('#sphereHome').attr('displaysize'));
                gapi.panoembed.go();
            </script>

        </div>


        <div>
            <?php
            $attribut = array('nomEtudiant' => 'nameStudent', 'adresseEtudiant' => 'adress', 'noSecu' => 'numSecu');
            $attribut = serialize($attribut);
            $table = 'etudiant';
            echo "<div><a href='ckeditorInline.php?table=$table&amp;attr=$attribut'>test array</a>   </div> ";
            ?>           


        </div>


    </body>
</html>
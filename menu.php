

<div class="menu" >
    <a href="index.php">Accueil</a>

    <p class="span12"> Mode admin uniquement (old)</p>
    <a class="span3" href="admin/studentTool.php?return='null'">voir/editer etudiant</a>
    <a class="span3" href="admin/corpTool.php?return='null'">voir/editer entreprise</a>
    <a class="span3" href="admin/studyTool.php?return='null'">voir/editer etude</a>


    <p class="span12"> mode hybride wysiwyg</p>
    <a class="span3" href="student.php?return='null'">voir/editer etudiant</a>
    <a class="span3" href="corporation.php?return='null'">voir/editer entreprise</a>
    <a class="span3" href="study.php?return='null'">voir/editer etude</a>


    <?php
    //fichier update_$table.php qui recoit les valeurs par POST
    //tableau de type    Attribut dans la table =>  string pour le passage par POST
    $attribut = array('noEtudiant' => 'primaryKey', 'nomEtudiant' => 'nameStudent', 'adresseEtudiant' => 'adress', 'noSecu' => 'numSecu');
    $attribut = serialize($attribut);
    $table = 'etudiant';
    $return = 'null';
    echo "<div><a href='ckeditorInline.php?return=$return&amp;table=$table&amp;attr=$attribut'>student</a>   </div> ";
    ?>  

    <?php
    $attribut = array('noEnts' => 'primaryKey', 'nomEnts' => 'nameEnts', 'adresseEnts' => 'adress');
    $table = 'entreprise';
    $attribut = serialize($attribut);
    $return = 'null';
    echo "<div><a href='ckeditorInline.php?return=$return&amp;table=$table&amp;attr=$attribut'>entreprise</a>   </div> ";
    ?>    
</div>
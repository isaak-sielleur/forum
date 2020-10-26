<?php

    $link= mysqli_connect("127.0.0.1", "root", "", "forum");

    // AFFICHER LES TOPICS
    $query= mysqli_query($link, "SELECT * FROM `topics` INNER JOIN utilisateurs ON id_createur=id ORDER BY id_topic DESC");
    $resultattopics= mysqli_fetch_all($query, MYSQLI_ASSOC);

?>

<?php foreach($resultattopics as $intitules): ?>
    <main class="topicapparence">
        <div class="orientation">
            <a href="discussion.php?topic=<?=$intitules['id_topic']?>"><?=$intitules['name']?> &nbsp &nbsp</a>
            <div class="id">
                <img src="<?=$intitules['photo_profil']?>" alt="">
                <p>Cree par <b><?=$intitules['login']?></b> le <?=$intitules['date']?></p>
            </div>
        </div>

        <div class="sujet">
            <br/>
            <p><?=$intitules['sujet']?></p>
        </div>
    </main>
<?php endforeach; ?>
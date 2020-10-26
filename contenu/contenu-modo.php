<?php

        // CONNEXION A LA BASE DE DONNEE
        $link= mysqli_connect("127.0.0.1", "root", "", "forum");

        // CREATION D'UN TOPIC
        if (isset($_POST['topic']))
        {  
            // VERRIFIER LA PRESENCE D'UN NOM
            if (!empty($_POST['nom'])) 
            {
                // VERRIFIER LA PRESENCE D'UN SUJET
                if (!empty($_POST['sujet'])) 
                {
                    // POUR POUVOIR ENTRER DES CARACTERES SPECIAUX DANS LA BDD
                    $_POST['sujet'] = addslashes($_POST['sujet']);
                    $_POST['nom'] = addslashes($_POST['nom']);

                    // INSERER UN NOUVEAU TOPIC EN BDD
                    $query= mysqli_query($link, "INSERT INTO topics (id_createur, name, date, acces, sujet) VALUES ('".$_SESSION['id']."','".$_POST['nom']."', NOW(), '".$_POST['acces']."', '".$_POST['sujet']."')");
                }
            }
            else 
            {
                // SI LE NOM EST VIDE
                $erreur1 = 'Veuillez saisir un nom';
            }

            if (empty($_POST['sujet'])) 
                {
                    // SI LE SUJET EST VIDE
                    $erreur2 = 'Veuillez saisir un sujet';
                }
        }

        // AFFICHER LES NOMS DES TOPICS EXISTANTS POUR LES MODIFIER
        $query= mysqli_query($link, "SELECT id_topic, name FROM `topics`");
        $resultatmodif= mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (isset($_POST['topicmodif'])) 
        {

            // POUR POUVOIR ENTRER DES CARACTERES SPECIAUX DANS LA BDD
            $_POST['sujet'] = addslashes($_POST['sujet']);
            $_POST['name'] = addslashes($_POST['name']);

            // METTRE A JOUR LES SUJETS SUR LA BDD
            $query= mysqli_query($link, "UPDATE topics SET name = '".$_POST['name']."', sujet = '".$_POST['sujet']."', acces = '".$_POST['status']."' WHERE id_topic = '".$_POST['nametopic']."'");
            header('location:../moderation/modo.php');
        }

        // AFFICHER LES NOMS DES TOPICS EXISTANTS POUR LES SUPPRIMER
        $query= mysqli_query($link, "SELECT id_topic, name FROM `topics`");
        $resultatsupr= mysqli_fetch_all($query, MYSQLI_ASSOC);
        
        // SUPPRIMER UN TOPIC
        if (isset($_POST['topicsupr'])) 
        {
            $query= mysqli_query($link, "DELETE FROM topics WHERE id_topic = '".$_POST['supprimer']."'");
            header('location:../moderation/modo.php');
        }

?>

<main>
    <p class="adminoptions">Créer un nouveau Topic :</p>
    <form action="modo.php" method="post">
        <label class="adminoptions" for="titre">Nom du Topic :</label>
        <input type="text" name="nom" placeholder="<?php if (isset($erreur1)) { echo $erreur1; }?>">

        <label class="adminoptions" for="titre">Sujet du Topic :</label>
        <input type="text" name="sujet" placeholder="<?php if (isset($erreur2)) { echo $erreur2; }?>">

        <label class="adminoptions" for="titre">Accessibilité :</label>
        <select name="acces" id="">
            <option value="" disabled selected>Veillez selectionner un acces</option>
            <option value="tous">Ouvert à tous</option>
            <option value="inscrits">Membres, administrateurs et moderateurs</option>
            <option value="administration">Administrateurs seulement</option>
            <option value="administrationmodo">Administrateurs et moderateurs seulement</option>
        </select>

        <input type="submit" name="topic" value="Publier">
    </form>
</main>

<br/>
<br/>

<main>
    <p class="adminoptions">Modifier un Topic :</p>
    <form action="modo.php" method="post">
        <label class="adminoptions" for="titre">Nom du Topic :</label>
        <select name="nametopic" id="">
            <?php foreach($resultatmodif as $names): ?>
                <option value="<?=$names['id_topic']?>"><?=$names['name']?></option>
            <?php endforeach; ?>
        </select>

        <label class="adminoptions" for="titre">Nouveau nom du Topic :</label>
        <input type="text" name="name">

        <label class="adminoptions" for="titre">Nouveau sujet du Topic :</label>
        <input type="text" name="sujet">

        <label class="adminoptions" for="titre">Remanier l'accessibilité :</label>
        <select name="status" id="">
            <option value="" disabled selected>Veillez selectionner un nouvel acces</option>
            <option value="inscrits">Membres et administrateurs</option>
            <option value="administration">Administrateurs seulement</option>
            <option value="tous">Ouvert à tous</option>

        <input type="submit" name="topicmodif" value="Modifier">
    </form>
</main>

<br/>
<br/>

<main>
    <p class="adminoptions">Supprimer un Topic :</p>
    <form action="modo.php" method="post">
        <label class="adminoptions" for="titre">Nom du Topic :</label>
        <select name="supprimer" id="">
            <option value="" disabled selected>Veuillez selectionner un topic à supprimer</option>
            <?php foreach($resultatsupr as $names): ?>
                <option value="<?=$names['id_topic']?>"><?=$names['name']?></option>
            <?php endforeach; ?>
        </select>

        <input type="submit" name="topicsupr" value="Supprimer">
    </form>
</main>
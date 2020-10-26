<?php

        // CONNEXION A LA BASE DE DONNEE
        $link= mysqli_connect("127.0.0.1", "root", "", "forum");

        // AFFICHER LES UTILISATEURS ET MODERATEURS
        $query= mysqli_query($link, "SELECT id, login FROM `utilisateurs` WHERE status_compte=2  AND id NOT LIKE '".$_SESSION['id']."'OR status_compte=3 AND id NOT LIKE '".$_SESSION['id']."'");
        $resultat1= mysqli_fetch_all($query, MYSQLI_ASSOC);

        // AFFICHER LES ADMINISTRATEURS ET MODERATEURS
        $query= mysqli_query($link, "SELECT id, login FROM `utilisateurs` WHERE status_compte=1  AND id NOT LIKE '".$_SESSION['id']."' OR status_compte=3 AND id NOT LIKE '".$_SESSION['id']."'");
        $resultat2= mysqli_fetch_all($query, MYSQLI_ASSOC);

        // AFFICHER LES UTILISATEURS ET ADMINISTRATEURS
        $query= mysqli_query($link, "SELECT id, login FROM `utilisateurs` WHERE status_compte=1 AND id NOT LIKE '".$_SESSION['id']."' OR status_compte=2 AND id NOT LIKE '".$_SESSION['id']."'");
        $resultat3= mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (isset($_POST['admin'])) 
        {
            $query= mysqli_query($link, "UPDATE `utilisateurs` SET status_compte=1, photo_profil='medias/image-profil/admin.png' WHERE id = '".$_POST['iduser']."'");
         }

        if (isset($_POST['user'])) 
        {
            $query= mysqli_query($link, "UPDATE `utilisateurs` SET status_compte=2, photo_profil='medias/image-profil/user.png' WHERE id = '".$_POST['idadmin']."'");
            header('location:../administration/admin.php');
        }

        if (isset($_POST['modo'])) 
        {
            $query= mysqli_query($link, "UPDATE `utilisateurs` SET status_compte=3, photo_profil='medias/image-profil/modo.png' WHERE id = '".$_POST['idmodo']."'");
            header('location:../administration/admin.php');
        }

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
            header('location:../administration/admin.php');
        }

        // AFFICHER LES NOMS DES TOPICS EXISTANTS POUR LES SUPPRIMER
        $query= mysqli_query($link, "SELECT id_topic, name FROM `topics`");
        $resultatsupr= mysqli_fetch_all($query, MYSQLI_ASSOC);
        
        // SUPPRIMER UN TOPIC
        if (isset($_POST['topicsupr'])) 
        {
            $query= mysqli_query($link, "DELETE FROM topics WHERE id_topic = '".$_POST['supprimer']."'");
            header('location:../administration/admin.php');
        }

?>

<div class="position-admin">
    <main>
        <form class="formulaire-adminisration" action="admin.php" method="post">
             <p class="adminoptions">Gérer les attributions :</p>
            <label class="adminoptions" for="titre">Donner droit administrateur :</label>
            <br/>
            <select name="iduser" id="">
                <option value="" disabled selected>Veillez selectionner un pseudo</option>
                <?php foreach($resultat1 as $pseudos): ?>
                    <option value="<?=$pseudos['id']?>"><?=$pseudos['login']?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <input type="submit" name="admin" value="Passer administrateur">
        </form>

        <form class="formulaire-adminisration" action="admin.php" method="post">
            <label class="adminoptions" for="titre">Donner droit moderateurs :</label>
            <br/>
            <select name="idmodo" id="">
                <option value="" disabled selected>Veillez selectionner un pseudo</option>
                <?php foreach($resultat3 as $pseudos): ?>
                    <option value="<?=$pseudos['id']?>"><?=$pseudos['login']?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <input type="submit" name="modo" value="Passer moderateur">
        </form>

        <form class="formulaire-adminisration" action="admin.php" method="post">
            <label class="adminoptions" for="titre">Rétrograder au rang utilisateur :</label>
            <br/>
            <select name="idadmin" id="">
                <option value="" disabled selected>Veillez selectionner un pseudo</option>
                <?php foreach($resultat2 as $pseudos2): ?>
                    <option value="<?=$pseudos2['id']?>"><?=$pseudos2['login']?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <input type="submit" name="user" value="Passer utilisateur">
        </form>
    </main>

    <br/>
    <br/>

    <main>
        <form class="formulaire-adminisration" action="../administration/admin.php" method="post">
            <p class="adminoptions">Créer un nouveau Topic :</p>
            <label class="adminoptions" for="titre">Nom du Topic :</label>
            <br/>
            <input type="text" name="nom" placeholder="<?php if (isset($erreur1)) { echo $erreur1; } else { echo 'Saisir un nom'; } ?>">
            <br/>
            <label class="adminoptions" for="titre">Sujet du Topic :</label>
            <br/>
            <input type="text" name="sujet" placeholder="<?php if (isset($erreur2)) { echo $erreur2; } else { echo 'Saisir un sujet'; } ?>">
            <br/>
            <label class="adminoptions" for="titre">Accessibilité :</label>
            <br/>
            <select name="acces" id="">
                <option value="" disabled selected>Veillez selectionner un acces</option>
                <option value="tous">Ouvert à tous</option>
                <option value="inscrits">Membres, administrateurs et moderateurs</option>
                <option value="administration">Administrateurs seulement</option>
                <option value="administrationmodo">Administrateurs et moderateurs seulement</option>
            </select>
            <br/>
            <input type="submit" name="topic" value="Publier">
        </form>
    </main>

    <br/>
    <br/>
    <main>
        <form class="formulaire-adminisration" action="../administration/admin.php" method="post">
            <p class="adminoptions">Modifier un Topic :</p>
            <label class="adminoptions" for="titre">Nom du Topic :</label>
            <br/>
            <select name="nametopic" id="">
                <option value="" disabled selected>Veillez selectionner le topic a modifier</option>
                <?php foreach($resultatmodif as $names): ?>
                    <option value="<?=$names['id_topic']?>"><?=$names['name']?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <label class="adminoptions" for="titre">Nouveau nom du Topic :</label>
            <br/>
            <input type="text" name="name" placeholder="Saisir un nouveau noom (Facultatif)">
            <br/>
            <label class="adminoptions" for="titre">Nouveau sujet du Topic :</label>
            <br/>
            <input type="text" name="sujet" placeholder="Saisir un nouveau sujet (Facultatif)">
            <br/>
            <label class="adminoptions" for="titre">Remanier l'accessibilité :</label>
            <br/>
            <select name="status" id="">
                <option value="" disabled selected>Veillez selectionner un nouvel acces</option>
                <option value="inscrits">Membres et administrateurs</option>
                <option value="administration">Administrateurs seulement</option>
                <option value="tous">Ouvert à tous</option>
                </select>
                <br/>
            <input type="submit" name="topicmodif" value="Modifier">
        </form>
    </main>

    <br/>
    <br/>

    <main>
        <form class="formulaire-adminisration" action="../administration/admin.php" method="post">
        <p class="adminoptions">Supprimer un Topic :</p>
            <label class="adminoptions" for="titre">Nom du Topic :</label>
            <br/>
            <select name="supprimer" id="">
                <option value="" disabled selected>Veillez selectionner un topic</option>
                <?php foreach($resultatsupr as $names): ?>
                    <option value="<?=$names['id_topic']?>"><?=$names['name']?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <input type="submit" name="topicsupr" value="Supprimer">
        </form>
    </main>
</div>
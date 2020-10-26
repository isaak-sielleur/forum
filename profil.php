<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="apparence/forum.css">
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Girassol&family=Josefin+Sans&display=swap" rel="stylesheet">
    <title>Forum Doctor Who</title>
    <link rel="shortcut icon" type="jpg" href="medias/icone.png" />
</head>

<body class="forum">
    <?php include('header-footer/header.php'); ?>

    <?php
    // $ssLogin = $_SESSION['login'];
    //SI SESSION EN COURS 
    // if (isset($ssLogin)) {

    if (isset($_POST['submit'])) {

        $username = htmlspecialchars(trim($_POST['login']));


        $bdd = mysqli_connect('127.0.0.1', 'root', '', 'forum') or die('erreur');
        $requete = "SELECT * FROM utilisateurs WHERE login = '" . $_POST['login'] . "'";
        $query = mysqli_query($bdd, $requete);
        $resultat = mysqli_fetch_all($query, MYSQLI_ASSOC);

        if (!empty($username)) {
            if (empty($resultat)) {
                $requete = "UPDATE utilisateurs SET login ='$username' WHERE id = '" . $_SESSION['id'] . "'";
                $query = mysqli_query($bdd, $requete);
                var_dump($query);
                // header('Location: profil.php');
            }
        } else {
            $erreur = "Ce login est déjà utilisé, veuillez en choisir un autre";
        }
    }




    if (isset($_POST['submit'])) {
        //DEFINITION DES VARIABLES LIEES AUX INPUT 
        $password = htmlspecialchars(trim($_POST['password']));
        $newpassword = htmlspecialchars(trim($_POST['newpassword']));

        //SI LE PASSWORD EST VIDE
        if (!empty($password && $newpassword)) {
            if ($password == $newpassword) {
                if (strlen($password) > 4) {
                    //REQUETE NOUVEAU MOT DE PASSE 


                    // $password = password_hash($password, PASSWORD_DEFAULT);
                    function chiffre($mdp)
                    {
                        $mdp="azerty".$mdp."cvbn";
                        $mdp=hash('sha256',$mdp);
                        return $mdp;
                    }

                    // $newpass = mysqli_query($bdd, "UPDATE utilisateurs SET password ='$password' WHERE id = '" . $_SESSION['id'] . "'");
                    $id = $_SESSION['id'];
                    $password=chiffre($_POST['password']);
                    var_dump($id);
                    $bdd = mysqli_connect('127.0.0.1', 'root', '', 'forum') or die('erreur');
                    $query = "UPDATE `utilisateurs` SET `password`= '$password' WHERE `id` =  $id ";
                    $newpass = mysqli_query($bdd, $query);
                   

                    if ($newpass) {

                        echo "<p class='whitext'>Le mot de passe à été changé</p>";
                    }
                    echo "$newpass";
                } else echo "<p class='whitext'>Mot de passe trop court</p>";
            }
        }
    }

    ?>


    <div class="container">
        <form action="profil.php" method="post">

            <label class="com" for="login">Identifiant:</label>
            <input type="login" id="login" name="login" placeholder="Actuel identifiant:<?= $_SESSION['login'] ?>">

            <label class="com" for="password">Nouveau mot de passe:</label>
            <input type="password" id="password" name="password">

            <label class="com" for="repeatnewpasword">Confirmez votre nouveau mot de passe:</label>
            <input type="password" id="newpassword" name="newpassword">

            <div class="form-example">
                <input class="but" type="submit" name="submit" value="valider!">
            </div>
        </form>
    </div>

    <?php include('header-footer/footer.php'); ?>
</body>

</html>
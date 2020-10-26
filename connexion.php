<?php

    session_start();

?>

<html>

    <head>
        <link rel="stylesheet" type="text/css" href="apparence/forum.css">
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Girassol&family=Josefin+Sans&display=swap" rel="stylesheet">
        <title>Forum Doctor Who</title>
        <link rel="shortcut icon" type="jpg" href="medias/icone.png"/>
    </head>

    <body class="connexion">
        <main id="wrap">
            <?php include('header-footer/header.php'); ?>

            <?php include('forms/formconnexion.php'); ?>

            <?php include('header-footer/footer.php'); ?>
        </main>
    </body>

</html>
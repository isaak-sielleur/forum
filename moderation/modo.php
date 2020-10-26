<?php

    session_start();

    if (empty($_SESSION['login']) )
    {
        header('location:../connexion.php');
    }
    
    if($_SERVER['REQUEST_URI'] == "/forum/moderation/modo.php")
    {
        $tree = "../";
    }

    if ($_SESSION['status_compte'] !== 3) 
    {
        header('location:../index.php');
    }

?>

<html>

    <head>
        <link rel="stylesheet" href="../apparence/forum.css">
        <link href="https://fonts.googleapis.com/css2?family=Alice&family=Girassol&family=Josefin+Sans&display=swap" rel="stylesheet">
        <title>Forum Doctor Who</title>
        <link rel="shortcut icon" type="jpg" href="../medias/icone.png"/>
    </head>

    <body class="modo">
        <?php include('../header-footer/header.php'); ?>

        <?php include('../contenu/contenu-modo.php') ?>

        <?php include('../header-footer/footer.php'); ?>
    </body>

</html>
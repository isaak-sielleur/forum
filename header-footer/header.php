<?php

    // FERMER LA SESSION
    if (isset($_GET['deco'])) {
        session_destroy();
        header("location:index.php");
    }

    // MODIFIER LE BACKGROUND DU HADER SELON LA PAGE OU SE TROUVE L'UNTILISATEUR
    switch ($_SERVER['REQUEST_URI']) {
        case '/forum/index.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(medias/banniere-accueil.jpg);
                }
                </style>";
        break;

        case '/forum/':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(medias/banniere-accueil.jpg);
                }
                </style>";
        break;

        case '/forum/inscription.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url('medias/banniere-inscription.jpg');
                }
                </style>";
        break;

        case '/forum/connexion.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url('medias/banniere-connexion.jpg');
                }
                </style>";
        break;

        case '/forum/forum.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(medias/banniere-forum.jpg);
                }
                </style>";
        break;

        case '/forum/administration/admin.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(../medias/banniere-admin.jpg);
                }
                </style>";
        break;

        case '/forum/moderation/modo.php':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(../medias/banniere-modo.jpg);
                }
                </style>";
        break;

        case '/forum/index.php?deco=true':
            echo "<style type=\"text/css\">
                section {
                    background-image: url(medias/banniere-accueil.jpg);
                }
                </style>";
        break;

    }

?>

<section id="top">
    <img src="<?php if(isset($tree)) echo $tree; ?>medias/nom.png">
</section>

<header>
    <nav>
        <a href="<?php if(isset($tree)) echo $tree; ?>index.php">Accueil</a>
        <a href="<?php if(isset($tree)) echo $tree; ?>forum.php">forum</a>
        <?php
                    if(!isset($_SESSION['login']))
                    { 
        ?>
        <a href="connexion.php">Connexion </a>
        <a href="inscription.php">Inscription</a>

        <?php
                    }
                    else
                    {
        ?>

        <a href="<?php if(isset($tree)) echo $tree; ?>profil.php">Modifier le profil</a>
        <?php
            switch ($_SESSION['status_compte'] == 1) 
            {
                case '/forum/index.php':
                    echo "<a href=\"/forum/administration/admin.php\">Administration</a>";
                break;
            }
        ?>

        <?php
            switch ($_SESSION['status_compte'] == 3) 
            {
                case '/forum/index.php':
                    echo "<a href=\"/forum/moderation/modo.php\">Modération</a>";
                break;
            }
        ?>
        <a href="<?php if(isset($tree)) echo $tree; ?>index.php?deco=true">Deconnexion</a>
        <?php
                    }
                ?>
    </nav>
</header>
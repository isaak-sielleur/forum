<?php

session_start();

// AFFICHER LES DISCUSSIONS

$bdd = mysqli_connect("127.0.0.1", "root", "", "forum");

if (isset($_POST['submit'])) {
    if (!empty($_POST['nom_message'])) {

        $idconv = $_GET['conversation'];
        $idcreator = $_SESSION['id'];
        $nommsg = $_POST['nom_message'];

        $request = "INSERT INTO `messages`( `id_conversations`, `id_createur`, `nom_message`) VALUES ('" . $idconv  . "','" . $idcreator  . "','" . $nommsg . "')";

        $query = mysqli_query($bdd, $request);

        // header('location:../messages.php?conversation=' . $conversation);
    }
}
$requete = "SELECT * FROM `messages` INNER JOIN  utilisateurs ON  messages.id_createur = utilisateurs.id WHERE messages.id_conversations= '" .$_GET['conversation']. "'";
$query = mysqli_query($bdd, $requete);
$messages = mysqli_fetch_all($query);


?>



<html>

<head>
    <link rel="stylesheet" href="apparence/forum.css">
    <link href="https://fonts.googleapis.com/css2?family=Alice&family=Girassol&family=Josefin+Sans&display=swap" rel="stylesheet">
    <title>Forum Doctor Who</title>
    <link rel="shortcut icon" type="jpg" href="medias/icone.png" />
</head>

<body class="forum">
    
    <?php include('header-footer/header.php'); ?>
    <?php foreach ($messages as $message) {  ?>
            <div class="mssg">
                <div class="whait">
                    <h1> <?php echo $message[6] ?></h1>
                    <p> <?php echo $message[3] ?></p>
                </div>
                <p class="whait"><?php echo $message[4]  ?></p>
            </div>

        <?php } ?>
    <!-- include ('forms/formmessage.php'); -->
    <?php if (isset($_SESSION['id'])) :?>
        
    <div class="txtareamsg">
        <form method="post" action="">
            <textarea class="txtare" name="nom_message"></textarea>
            <input class="btncolo2" type="submit" name="submit" value="creer la conversation">
        </form>
    </div>
    <?php endif ?>
    <?php include('header-footer/footer.php'); ?>

</body>

</html>
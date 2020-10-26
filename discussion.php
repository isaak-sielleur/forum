<?php


session_start();


if (!empty($_GET['topic']) && isset($_GET['topic'])) {
    $topic = $_GET['topic'];

    $link = mysqli_connect("127.0.0.1", "root", "", "forum");

    $query = mysqli_query($link, "SELECT id_topic FROM topics WHERE id_topic= $topic");

    $resultattopic = mysqli_fetch_all($query, MYSQLI_ASSOC);

    if (!empty($resultattopic)) {

        $query = mysqli_query($link, "SELECT * FROM conversations WHERE id_topics= $topic");
        $resultatconv = mysqli_fetch_all($query, MYSQLI_ASSOC);
    }
}
// else {
//     header('location:index.php');
// }

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
    <?php
    foreach ($resultatconv as $conv) {

    ?>
        <!-- <h1 class='whitext'><?= $conv['id_createur'] ?></h1> -->
        <h1 class='whitext'><?= $conv['nom_conversation'] ?></h1>
        <p class='whitext'><?= $conv['date'] ?></p>
        <a class="msgconv" href="messages.php?conversation=<?php echo $conv['id_conversation'] ?>">Go to discussion</a>



    <?php } ?> 
 
    <!-- SI JE SUIS CONNECTE  -->
    <?php if (isset($_SESSION['id'])) :?>
        
        
         <div class="cont">
<form method="post" action="forms/formdiscussion.php">
<input type="hidden" name="id_topics" value='<?= $_GET['topic']?>'>
<input type="text" name="nom_conversation" placeholder="titre de conversation" required>

<input class="btncolo" type="submit" name="submit" value="creer la conversation">


</form>
</div>
<?php endif ?>


    <?php include('header-footer/footer.php'); ?>
</body>

</html>
<?php
session_start();
$bdd = mysqli_connect("127.0.0.1", "root", "", "forum");
if (isset($_POST['submit'])) {

 
    $idtopics = $_POST['id_topics'];
    $idcreator =  $_SESSION['id'];
    $nomconv = $_POST['nom_conversation'];
    // Si le nom de la conv est pas vide    
    if (!empty($nomconv) ) {
        // id_topics =    $_POST['topic']  ;

        $request = "INSERT INTO `conversations`( `id_topics`, `id_createur`, `nom_conversation`) VALUES ('" . $idtopics  . "','" . $idcreator  . "','" . $nomconv . "')";
        $query = mysqli_query($bdd, $request);
        header('location:../discussion.php?topic='.$idtopics);



        echo "votre conversation a été creé";
    }
}





?>
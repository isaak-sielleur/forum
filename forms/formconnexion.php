<?php

    function chiffre($mdp)
    {
        $mdp="azerty".$mdp."cvbn";
        $mdp=hash('sha256',$mdp);
        return $mdp;
    }


    if(isset($_POST['connexion']))
    {
        if(!empty($_POST['login']))
        {
            if(!empty($_POST['password']))
            {
                $link= mysqli_connect("127.0.0.1", "root", "", "forum");

                $password= chiffre($_POST['password']);

                $requete="SELECT * FROM utilisateurs WHERE login = '".$_POST['login']."' && password = '".$password."'";
                $query= mysqli_query($link, $requete);
                $resultat= mysqli_fetch_all($query, MYSQLI_ASSOC);

                if(!empty($resultat))
                {   
                    $_SESSION['login']=$_POST['login'];
                    $_SESSION['id']=$resultat[0]['id'];
                    $_SESSION['status_compte']= (int) $resultat[0]['status_compte'];
                    
                    if ($resultat[0]['status_compte']==1) 
                    {
                        // REDIRECTION VERS PAGE ADMIN
                        header('Location: administration/admin.php');
                    }
                    if ($resultat[0]['status_compte']==3) {

                        // REDIRECTION VERS PAGE MODERATION
                        header('Location: moderation/modo.php');
                    }
                    else
                    {
                        // REDIRECTION VERS PAGE D'ACCUEIL
                        header('Location: index.php');
                    }
                }
            }
        }
    }

?>

<div class="box">

    <div class="box-top">

        <div class="box-avatar">
            <img class="box-img" src="medias/clef.png">
        </div>

        <div class="box-title">Se Connecter</div>

        <div class="box-sub-title">Porte d'entrée</div>

    </div>
    
    <form method="POST" class="box-form" id="connection">

        <div class="box-fields">

            <div class="box-field">
                <input required name="login" class="box-text-field" type="text">
                <div class="box-placeholder">Votre identifiant</div>
                <img class="box-icon" src="medias/login.png">
                <div class="box-field-line"></div>
            </div>

            <div class="box-field">
                <input required name="password" class="box-text-field" type="password">
                <div class="box-placeholder">Votre mot de passe</div>
                <img class="box-icon" src="medias/mdp.png">
                <div class="box-field-line"></div>
            </div>

        </div>

    
        <input type="submit" class="submit box-btn" name="connexion" value="Entrer dans le TARDIS">

    </form>

</div>
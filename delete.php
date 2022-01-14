<?php

require('src/connexion.php');

    if (!$_COOKIE['auth']) {
        header('Location: index.php');
    }



if (!empty($_POST['passwordFirst'])) {

 

    $passwordFirst = htmlspecialchars($_POST['passwordFirst']);

    // CHIFFREMENT DU MOT DE PASSE
    $salt = "hhhhoooo123!!312567__asdSdas";
    $passwordFirst = hash('sha256', $salt . $passwordFirst);

    //CONNEXION
    $id = $_SESSION['id'];
    $req = $bdd->prepare("SELECT * FROM user WHERE id =?");
    $req->execute(array($id));

    while ($user = $req->fetch()) {

        if ($passwordFirst == $user['password']) {

                $id = $_SESSION['id'];
                $req = $bdd->prepare("DELETE FROM user WHERE id = ?");
                $req->execute([$id]);
                require('logout.php');
                header('location: index.php');                
                exit();
        }
                   
    }
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Netflix</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
    <link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

    <?php include('src/header.php'); ?>

    <section>
        <div id="login-body">
            <h1><div class="alert alert-danger" role="alert">
  Vous êtes sur votre page de suppression de votre compte !
</div></h1>


                <form method="post" action="delete.php">
                    <p>Pour supprimer votre compte mettre votre passe et clicker sur "SUPPRIMER"</p>
                    <p>Attention votre compte sera supprimer avec toutes vos données</p>
                    <input type="password" name="passwordFirst" placeholder="Votre mot de passe" />
                    <button type="submit" class="btn btn-danger" name="supprimer">SUPPRIMER</button>
                </form>

                <p class="grey">Pour aller sur votre page d'accueil <a href="session.php">c'est ici !</a></p>
                <p class="grey">Pour aller sur votre Forum <a href="forum/forum.php">c'est ici !</a></p>
        </div>
    </section>

    <?php include('src/footer.php'); ?>
</body>

</html>
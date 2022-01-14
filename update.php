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



            if (!empty($_POST['email'])) {




                // VARIABLES 
                $email = htmlspecialchars($_POST['email']);

                //ADRESSE EMAIL NON VALIDE
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
                    exit();
                }

                //ADRESSE EMAIL DEJA UTILISEE
                $req = $bdd->prepare("SELECT count(*) as nbEmail FROM user WHERE email = ?");
                $req->execute(array($email));

                while ($email_verif = $req->fetch()) {
                    if ($email_verif['nbEmail'] != 0) {
                        header('location:inscription.php?error=1&message=Votre adresse email est invalide.');
                        exit();
                    }
                }

                $id = $_SESSION['id'];

                $req = $bdd->prepare("UPDATE user SET email = ? where id = ?");
                $req->execute([$email, $id]);
                header('location: update.php?success=1');
                exit();
            }



            if (!empty($_POST['password']) && !empty($_POST['password_two'])) {



                //VARIABLE
                $password = htmlspecialchars($_POST['password']);
                $password_two = htmlspecialchars($_POST['password_two']);


                // PASSWORD = PASSWORD_TWO ?
                if ($password != $password_two) {
                    header('location: update.php?error=1&message=Les mots de passe doivent être équivalent.');
                    exit();
                }

                // CHIFFREMENT DU MOT DE PASSE
                $salt = "hhhhoooo123!!312567__asdSdas";
                $password = hash('sha256', $salt . $password);
                $id = $_SESSION['id'];

                //UPDATE
                $_SESSION['id'] = $id;
                $req = $bdd->prepare("UPDATE  user set password = ? where id = ?");
                $req->execute([$password, $id]);
                header('location: update.php?success=1');
                exit();
            }

            if (!empty($_POST['pseudo'])) {

                $pseudo = htmlspecialchars($_POST['pseudo']);

                $req = $bdd->prepare("SELECT count(*) as nbPseudo FROM user WHERE pseudo = ?");
                $req->execute(array($pseudo));

                while ($pseudo_verif = $req->fetch()) {
                    if ($pseudo_verif['nbPseudo'] != 0) {
                        header('location:inscription.php?error=1&message=Votre Pseudo est invalide.');
                        exit();
                    }
                }

                //UPDATE
                $_SESSION['id'] = $id;
                $req = $bdd->prepare("UPDATE  user set pseudo = ? where id = ?");
                $req->execute([$pseudo, $id]);
                header('location: update.php?success=1');
                exit();
            }
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
            <h1>Modification de vos données</h1>

            <?php

            if (isset($_GET['error'])) {

                if (isset($_GET['message'])) {
                    echo "<div class='alert error'>" . htmlspecialchars($_GET['message']) . "</div>";
                }
            } else if (isset($_GET['success'])) {
                echo '<div class="alert success">Modification réussie !</div>';
            }

            //Check  membre
            $id = $_SESSION['id'];
            $requete = $bdd->prepare("SELECT * FROM user where id = '$id'");
            $requete->execute(array($id));



            while ($donnee = $requete->fetch()) :

            ?>



                <form method="post" action="update.php">
                    <p>Pour modifier inserez votre mot de passe</p>
                    <input type="password" name="passwordFirst" placeholder="Votre mot de passe" />
                    <input type="email" name="email" placeholder="Email : <?php echo $donnee['email']; ?>" />
                    <input type="text" name="pseudo" placeholder="Votre Pseudo : <?php echo $donnee['pseudo']; ?> " />
                    <input type="password" name="password" placeholder="Votre nouveau mot de passe" />
                <?php endwhile ?>
                <input type="password" name="password_two" placeholder="Retapez votre mot de passe" />
                <button type="submit">Modifier</button>
                </form>

                <p class="grey">Pour aller sur votre page d'accueil <a href="session.php">c'est ici !</a></p>
                <p class="grey">Pour aller sur votre Forum <a href="forum/forum.php">c'est ici !</a></p>
        </div>
    </section>

    <?php include('src/footer.php'); ?>
</body>

</html>
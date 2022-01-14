<?php


require('src/connexion.php');

require('log.php');


if (!empty($_POST['email']) && !empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_two'])) {

    

    // VARIABLES 
    $email = htmlspecialchars($_POST['email']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $password = htmlspecialchars($_POST['password']);
    $password_two = htmlspecialchars($_POST['password_two']);

    // PASSWORD = PASSWORD_TWO ?
    if ($password != $password_two) {
        header('location: inscription.php?error=1&message=Les mots de passe doivent être équivalent.');
        exit();
    }

    // ADRESSE EMAIL NON VALIDE
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
        exit();
    }

    // ADRESSE EMAIL DEJA UTILISEE
    $req = $bdd->prepare("SELECT count(*) as nbEmail FROM user WHERE email = ?");
    $req->execute(array($email));

    while ($email_verif = $req->fetch()) {
        if ($email_verif['nbEmail'] != 0) {
            header('location:inscription.php?error=1&message=Votre adresse email est invalide.');
            exit();
        }
    }

    // PSEUDO DEJA UTILISEE
    $req = $bdd->prepare("SELECT count(*) as nbPseudo FROM user WHERE pseudo = ?");
    $req->execute(array($pseudo));

    while ($pseudo_verif = $req->fetch()) {
        if ($pseudo_verif['nbPseudo'] !== 0) {
            header('location:inscription.php?error=1&message=Votre Pseudo est invalide.');
            exit();
        }
    }



    // HASH
    $secret = sha1($email) . time();
    $secret = sha1($secret) . time();

    // CHIFFREMENT DU MOT DE PASSE
    $salt = "hhhhoooo123!!312567__asdSdas";
    $password = hash('sha256', $salt . $password);
    //$password = password_hash($password, PASSWORD_DEFAULT);

    // ENVOI
    $req = $bdd->prepare("INSERT INTO user(email, pseudo, password, secret) VALUES (?,?,?,?)");
    $req->execute(array($email,$pseudo, $password, $secret));
    header('location: inscription.php?success=1');
    exit();
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
            <h1>S'inscrire</h1>

            <?php if (isset($_GET['error'])) {

                if (isset($_GET['message'])) {
                    echo "<div class='alert error'>" . htmlspecialchars($_GET['message']) . "</div>";
                }
            } else if (isset($_GET['success'])) {
                echo '<div class="alert success">Inscription réussie ! <a href="index.php">Connectez-vous ici</a>.</div>';
            } ?>

            <form method="post" action="inscription.php">
                <input type="email" name="email" placeholder="Votre adresse email" required />
                <input type="text" name="pseudo" placeholder="Votre Pseudo" required />
                <input type="password" name="password" placeholder="Mot de passe" required />
                <input type="password" name="password_two" placeholder="Retapez votre mot de passe" required />
                <button type="submit">S'inscrire</button>
            </form>

            <p class="grey">Déjà sur Netflix ? <a href="index.php">Connectez-vous</a>.</p>
        </div>
    </section>

    <?php include('src/footer.php'); ?>
</body>

</html>
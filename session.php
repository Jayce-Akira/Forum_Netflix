<?php


require('src/connexion.php');

if (!$_COOKIE['auth']) {
    header('Location: index.php');
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
            <h1>Bienvenue sur Netflix</h1>

            <?php if ('session.php?sucess=1') {
                echo '<div class="alert success">Vous êtes maintenant connecté !</div>';
            } ?>

            <div method="post" action="inscription.php">
                <p>Bon visionnnage <?php if ($_SESSION['isAdmin']) {
                                        echo "Mr " . $_SESSION['pseudo'] . "</br></br>";
                                        echo "Pour Aller sur Votre Espace Admin <a href='admin/admin.php'>cliquez-ici !</a>";
                                    } ?></p>
                <p></p>
            </div>
            <p>Pour mettre à jour vos données <a href="update.php">cliquez-ici !</a></p>
            <p>Pour toute question ou réponse rejoignez la communauté <a href="forum/forum.php">cliquez-ici !</a></p>
            <p class="grey"><a href="logout.php">Deconnexion</a>.</p>
            <p>Pour supprimer votre compte <a href="delete.php">cliquez-ici !</a></p>
        </div>
    </section>

    <?php include('src/footer.php'); ?>
</body>

</html>
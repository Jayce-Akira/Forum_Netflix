<?php

// Choper le membre afin de recuperer son ID pour ou le modifier ou le supprimer
//Via son id pouvoir recuperer ses questions ses reponses

require('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
}

if (date("H") < 18)
    $bienvenue = "Bonjour et Bienvenue " .
        $_SESSION['pseudo'] .
        " dans votre espace Administrateur";
else
    $bienvenue = "Bonsoir et Bienvenue " .
        $_SESSION['pseudo'] .
        " dans votre espace Administrateur";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>
</head>

<body>
    <?php include '../includes/head.php';
    include '../includes/navbarAdmin.php'; ?>

    <?php

    $jour = date('d');
    $mois = date('m');
    $annee = date('Y');

    $heure = date('H');
    $minute = date('i');



    ?>
    <section style="margin-top: 50px;">
        <h1 style="display: flex; justify-content:center;"><?php echo  $bienvenue; ?></h1>
        <h2 style="display: flex; justify-content:center; margin-top: 25px;"><?php echo 'Nous sommes le ' . $jour . '/' . $mois . '/' . $annee . ' et il est actuellement ' . $heure . 'h' . $minute; ?></h2>
    </section>


</body>

</html>
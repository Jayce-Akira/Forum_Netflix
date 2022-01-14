<?php

include('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
}
if (isset($_GET['id']) and !empty($_GET['id'])) {

    $usersReq = $bdd->prepare('SELECT * FROM user WHERE id = ?');
    $usersReq->execute(array($_GET['id']));

    if ($usersReq->rowCount() > 0) {

        $getID = htmlspecialchars($_GET['id']);
        $banUser = $bdd->prepare('UPDATE user SET isAdmin = 1 WHERE id = ?');
        $banUser->execute(array($_GET['id']));
        header('Location: user.php');
    } else {
        echo "Aucun membre trouvé";
    }
} else {
    echo "L'identifiant n'a pas pu être récupéré";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ADMIN</title>
    <?php include '../includes/head.php'; ?>
</head>

<body>

</body>

</html>
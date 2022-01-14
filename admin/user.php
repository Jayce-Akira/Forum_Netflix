<?php
include('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
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

    <?php
    include '../includes/navbarAdmin.php';
    $userReq = $bdd->query('SELECT * FROM user');

    ?>
    <br>
    <div class="container">
        <table class="table table-sm align-middle">
            <caption>Liste des utilisateurs</caption>
            <thead>
                <tr>
                    <th scope="col" class="text-center">id</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Pseudo</th>
                    <th scope="col" class="text-center">Date d'inscription</th>
                    <th scope="col" class="text-center">Modify Answer</th>
                    <th scope="col" class="text-center">Modify Question</th>
                    <th scope="col" class="text-center">Modify ?</th>
                    <th scope="col" class="text-center">Ban ?</th>
                    <th scope="col" class="text-center">Blocked ?</th>
                    <th scope="col" class="text-center">Deblock ?</th>
                    <th scope="col" class="text-center">Update Admin ?</th>
                    <th scope="col" class="text-center">Admin ?</th>
                    <th scope="col" class="text-center">Delete Admin ?</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($user = $userReq->fetch()) : ?>
                    <tr>
                        <th scope="row" class="text-center"><?= $user['id'] ?></th>
                        <td class="text-center"><?= $user['email'] ?></td>
                        <td class="text-center"><?= $user['pseudo'] ?></td>
                        <td class="text-center"><?= $user['creation_date'] ?></td>
                        <td class="text-center"><a href="modifyAnswer.php?id=<?= $user['id'] ?>" class="btn btn-secondary">Modify Answer</a></td>
                        <td class="text-center"><a href="modifyQuestion.php?id=<?= $user['id'] ?>" class="btn btn-primary">Modify Question</a></td>
                        <td class="text-center"><a href="modifyUser.php?id=<?= $user['id'] ?>" class="btn btn-warning">Modify infos</a></td>
                        <td class="text-center"><a href="banUser.php?id=<?= $user['id'] ?>" class="btn btn-danger">Ban user</a></td>
                        <td class="text-center"><?= $user['blocked'] ?></td>
                        <td class="text-center"><a href="deblockUser.php?id=<?= $user['id'] ?>" class="btn btn-success">Deblock user</a></td>
                        <td class="text-center"><a href="updateAdmin.php?id=<?= $user['id'] ?>" class="btn btn-dark">Update user</a></td>
                        <td class="text-center"><?= $user['isAdmin'] ?></td>
                        <td class="text-center"><a href="deleteAdmin.php?id=<?= $user['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Admin?');">Delete Admin user</a></td>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
    <?php

    ?>

</body>

</html>
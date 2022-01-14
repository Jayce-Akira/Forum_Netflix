<?php

require('../src/connexion.php');

    if (!$_COOKIE['auth']) {
        header('Location: ../index.php');
    }

?>



<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Forum Netflix</title>
    <link rel="stylesheet" type="text/css" href="stylesforum.css">
    <link rel="icon" type="image/pngn" href="img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body class="d-flex flex-column min-vh-100">

    <?php include('headerForum.php'); ?>

    <section>
        <div class="container">


            <?php


            $id = $_SESSION['id'];
            $requete = $bdd->prepare("SELECT * FROM user where id = '$id'");
            $requete->execute(array($id));
            while ($pseudo = $requete->fetch()) : ?>

                <h1 style="color: white; margin-top: 100px;">Modification des Réponses de l'utilisateur <?= $pseudo['pseudo']; ?></h1>

            <?php endwhile;


            // LIRE DES INFORMATIONS

            $req = $bdd->prepare(
                "  SELECT user.id ,reponse.createDateAnswer, reponse.user_id, reponse.id, reponse.reponseUser, question.id_user, question.questionUser, question.titre FROM user
                                        JOIN reponse ON user.id = reponse.user_id
                                        JOIN question ON reponse.article_id = question.id                                               
                                            WHERE user.id = :id ORDER BY createDateAnswer DESC"

            );

            $req->execute([
                "id" => $id
            ]);



            while ($donnee = $req->fetch()) :

            ?>



                <form method="post" action="reponseUser.php?id=<?= $donnee['id'] ?>" class="row">
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">Titre da la question</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $donnee['titre']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">la question</label>
                        <input type="text" class="form-control" id="questionUser" name="questionUser" placeholder="<?php echo $donnee['questionUser']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">Reponse</label>
                        <input type="text" class="form-control" id="reponse" name="reponse" placeholder="<?php echo $donnee['reponseUser']; ?> ">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">date de la Réponse</label>
                        <input type="text" class="form-control" id="creationDateAnswer" placeholder="<?php echo $donnee['createDateAnswer']; ?> ">
                    </div>
                    <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <a class="btn btn-primary" href="modifyAnswer.php?id=<?= $donnee['id'] ?>" role="button">Mettre à jour</a>
                    </div>
                </form>


            <?php endwhile; ?>




        </div>
    </section>

    <?php include('footerForum.php'); ?>
</body>

</html>
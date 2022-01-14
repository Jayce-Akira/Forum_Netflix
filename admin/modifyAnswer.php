<?php

require('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit();
}


?>



<!DOCTYPE html>
<html>
<?php include '../includes/head.php'; ?>


<body>


    <?php include '../includes/navbarAdmin.php'; ?>

    <section>
        <div class="container">


            <?php

            if (isset($_GET['error'])) {

                if (isset($_GET['message'])) {
                    echo "<div class='alert error'>" . htmlspecialchars($_GET['message']) . "</div>";
                }
            } else if (isset($_GET['success'])) {
                echo '<div class="alert success">Modification réussie !</div>';
            }



            if (isset($_GET['id']) and !empty($_GET['id'])) {


                $id = htmlspecialchars($_GET['id']);
                $requete = $bdd->prepare("SELECT * FROM user where id = '$id'");
                $requete->execute(array($id));
                while ($pseudo = $requete->fetch()) {

                    echo "<h1>Modification des Réponses de l'utilisateur " . $pseudo['pseudo'] . "</h1>";
                }


                // LIRE DES INFORMATIONS
                $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $req = $bdd->prepare(
                    "  SELECT user.id ,reponse.createDateAnswer, reponse.user_id, reponse.id, reponse.reponseUser, question.id_user, question.questionUser, question.titre FROM user
                                        JOIN reponse ON user.id = reponse.user_id
                                        JOIN question ON reponse.article_id = question.id                                               
                                            WHERE user.id = :id "

                );

                $req->execute([
                    "id" => $id
                ]);



                while ($donnee = $req->fetch()) :

            ?>



                    <form method="post" action="modify.php?id=<?= $donnee['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label class="form-label">Titre da la question</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $donnee['titre']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">la question</label>
                            <input type="text" class="form-control" id="questionUser" name="questionUser" placeholder="<?php echo $donnee['questionUser']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Reponse</label>
                            <input type="text" class="form-control" id="reponse" name="reponse" placeholder="<?php echo $donnee['reponseUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" id="id_reponse" name="id_reponse" placeholder="<?php echo $donnee['id']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">date de la Réponse</label>
                            <input type="text" class="form-control" id="creationDateAnswer" placeholder="<?php echo $donnee['createDateAnswer']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <a class="btn btn-primary" href="modifyAnswerUser.php?id=<?= $donnee['id'] ?>" role="button">Mettre à jour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>


</body>

</html>
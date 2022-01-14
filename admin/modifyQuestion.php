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

                    echo "<h1>Modification des Questions de l'utilisateur " . $pseudo['pseudo'] . "</h1>";
                }


                // LIRE DES INFORMATIONS
                $req = $bdd->prepare(
                    "SELECT * FROM user INNER JOIN question ON user.id = question.id_user WHERE user.id = :id "

                );

                $req->execute([
                    "id" => $id
                ]);



                while ($donnee = $req->fetch()) :

            ?>



                    <form method="post" action="modifyQuestion.php?id=<?= $donnee['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $donnee['titre']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="<?php echo $donnee['questionUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" id="id_question" name="id_question" placeholder="<?php echo $donnee['id']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">date de la question</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $donnee['createDate']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <a class="btn btn-primary" href="modifyQuestionUser.php?id=<?= $donnee['id'] ?>" role="button">Mettre à jour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>


</body>

</html>
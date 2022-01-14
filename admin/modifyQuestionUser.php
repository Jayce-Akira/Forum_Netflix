<?php require('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit();
}



if (isset($_POST['modify'])) {

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("SELECT * FROM question WHERE id =?");
        $req->execute(array($id));

        while ($user = $req->fetch()) {


            if (!empty($_POST['titre'])) {

                // VARIABLES 
                $titre = htmlspecialchars($_POST['titre']);

                $id = htmlspecialchars($_GET['id']);

                $req = $bdd->prepare("UPDATE question SET titre = ? where id = ?");
                $req->execute([$titre, $id]);
                header('location: modifyQuestionUser.php?id=' . $_GET['id']);
                exit();
            }



            if (!empty($_POST['question'])) {


                //UPDATE
                $id = htmlspecialchars($_GET['id']);
                $questionUser = htmlspecialchars($_POST['question']);

                $req = $bdd->prepare("UPDATE  question SET questionUser = ? where id = ?");
                $req->execute([$questionUser, $id]);
                header('location: modifyQuestionUser.php?id=' . $_GET['id']);
                exit();
            }
        }
    }
}

if (isset($_POST['delete'])) {

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("DELETE FROM question WHERE id = ?");
        $req->execute(array($id));

        header('location: user.php');
    }
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
                $requete = $bdd->prepare("SELECT * FROM question where id = '$id'");
                $requete->execute(array($id));

                while ($data = $requete->fetch()) :

                    echo "<h1>Modification de la Questions : " . $data['titre'] . "</h1>";


            ?>



                    <form method="post" action="modifyQuestionUser.php?id=<?= $data['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $data['titre']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="<?php echo $data['questionUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">date de la question</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $data['createDate']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn btn-primary" type="submit" name="modify">Modification</button>
                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this question?');">Suppression</button>
                            <a class="btn btn-primary" href="user.php" role="button">Retour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>


</body>

</html>
<?php require('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit();
}

if (isset($_POST['delete'])) {

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("DELETE FROM reponse WHERE id = ?");
        $req->execute(array($id));

        header('location: user.php');
    }
}

if (isset($_POST['modify'])) {

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("SELECT * FROM reponse WHERE id =?");
        $req->execute(array($id));

        while ($user = $req->fetch()) {



            if (!empty($_POST['reponse'])) {


                //UPDATE
                $id = htmlspecialchars($_GET['id']);
                $reponseUser = htmlspecialchars($_POST['reponse']);

                $req = $bdd->prepare("UPDATE reponse SET reponseUser = ? where id = ?");
                $req->execute([$reponseUser, $id]);
                header('location: modifyAnswerUser.php?id=' . $_GET['id']);
                exit();
            }
        }
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
                $requete = $bdd->prepare("SELECT * FROM reponse where id = '$id'");
                $requete->execute(array($id));

                while ($data = $requete->fetch()) :




            ?>



                    <form method="post" action="modifyAnswerUser.php?id=<?= $data['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label class="form-label">Réponse</label>
                            <input type="text" class="form-control" id="reponse" name="reponse" placeholder="<?php echo $data['reponseUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">date de la question</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $data['createDateAnswer']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn btn-primary" type="submit" name="modify">Modification</button>
                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this answer?');">Suppression</button>
                            <a class="btn btn-primary" href="user.php" role="button">Retour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>


</body>

</html>
<?php require('../src/connexion.php');

    if (!$_COOKIE['auth']) {
        header('Location: ../index.php');
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
                header('location: modifyQuestion.php?id=' . $_GET['id']);
                exit();
            }



            if (!empty($_POST['question'])) {


                //UPDATE
                $id = htmlspecialchars($_GET['id']);
                $questionUser = htmlspecialchars($_POST['question']);

                $req = $bdd->prepare("UPDATE  question SET questionUser = ? where id = ?");
                $req->execute([$questionUser, $id]);
                header('location: modifyQuestion.php?id=' . $_GET['id']);
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

        header('location: forum.php');
    }
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

    <?php include('headerForum.php'); ?>>

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

                while ($data = $requete->fetch()) : ?>

                    <h1 style="color: white;">Modification de la Questions : <?= $data['titre'] ?></h1>

                    <form method="post" action="modifyQuestion.php?id=<?= $data['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label style="color: white;" class="form-label">Titre</label>
                            <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $data['titre']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label style="color: white;" class="form-label">Question</label>
                            <input type="text" class="form-control" id="question" name="question" placeholder="<?php echo $data['questionUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label style="color: white;" class="form-label">date de la question</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $data['createDate']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn btn-primary" type="submit" name="modify">Modification</button>
                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this question?');">Suppression</button>
                            <a class="btn btn-primary" href="question.php" role="button">Retour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>

    <?php include('footerForum.php'); ?>
</body>


</html>
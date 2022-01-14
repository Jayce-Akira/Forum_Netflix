<?php require('../src/connexion.php');

if (!$_COOKIE['auth']) {
    header('Location: ../index.php');
}


if (isset($_POST['delete'])) {

    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = htmlspecialchars($_GET['id']);
        $req = $bdd->prepare("DELETE FROM reponse WHERE id = ?");
        $req->execute(array($id));

        header('location: forum.php');
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
                header('location: modifyAnswer.php?id=' . $_GET['id']);
                exit();
            }
        }
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


            if (isset($_GET['id']) and !empty($_GET['id'])) {


                $id = htmlspecialchars($_GET['id']);
                $requete = $bdd->prepare("SELECT * FROM reponse where id = '$id'");
                $requete->execute(array($id));

                while ($data = $requete->fetch()) :




            ?>



                    <form method="post" action="modifyAnswer.php?id=<?= $data['id'] ?>" class="row">
                        <div class="col-md-6">
                            <label style="color: white; margin-top: 100px;" class="form-label">Réponse</label>
                            <input type="text" class="form-control" id="reponse" name="reponse" placeholder="<?php echo $data['reponseUser']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label style="color: white; margin-top: 100px;" class=" form-label">date de la question</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $data['createDateAnswer']; ?> ">
                        </div>
                        <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                            <button class="btn btn-primary" type="submit" name="modify">Modification</button>
                            <button class="btn btn-danger" type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this answer?');">Suppression</button>
                            <a class="btn btn-primary" href="reponseUser.php" role="button">Retour</a>
                        </div>
                    </form>


            <?php endwhile;
            } ?>




        </div>
    </section>

    <?php include('footerForum.php'); ?>
</body>


</html>
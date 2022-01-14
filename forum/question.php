<?php

require('../src/connexion.php');

    if (!$_COOKIE['auth']) {
        header('Location: ../index.php');
    }


if (!empty($_POST['titre']) && !empty($_POST['question'])) {

    // VARIABLES
    $titre = htmlspecialchars($_POST['titre']);
    $question = htmlspecialchars($_POST['question']);
    $id = $_SESSION['id'];

    // ENVOI
    $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $req = $bdd->prepare("INSERT INTO question (titre, questionUser, id_user) VALUES (?,?,?)") or die(print_r($bdd->errorInfo()));
    $req->execute(array($titre, $question, $id)) or die(print_r($bdd->errorInfo()));
    header('location: forum.php?success=1');
    exit();
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
    <div class="container">
        <section style="display: flex; flex-direction:column;">

            <h1 style="color: white; margin-top: 100px;">Tu peux poser ta question <?php echo $_SESSION['pseudo']; ?> .</h1>


            <form method="post" action="question.php">
                <div class="mb-3">
                    <label style="color: white;" for="exampleFormControlInput1" class="form-label">Titre</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="titre" placeholder="Votre titre">
                </div>
                <div class="mb-3">
                    <label style="color: white;" for="exampleFormControlTextarea1" class="form-label">Votre Question</label>
                    <textarea type="text" class="form-control" id="exampleFormControlTextarea1" name="question" placeholder="Enter text here..." rows="3"></textarea>
                </div>
                <button class="btn btn-primary" type="submit">Envoyez Votre Question</button>
            </form>

        </section>
        <section>



            <?php

            $id = htmlspecialchars($_SESSION['id']);
            $requete = $bdd->prepare("SELECT * FROM user where id = '$id'");
            $requete->execute(array($id));
            while ($pseudo = $requete->fetch()) : ?>

                <h1 style="color: white; margin-top: 50px;">Modification de tes Questions <?= $pseudo['pseudo'] ?></h1>

            <?php endwhile;


            // LIRE DES INFORMATIONS
            $req = $bdd->prepare(
                "SELECT * FROM user INNER JOIN question ON user.id = question.id_user WHERE user.id = :id ORDER BY createDate DESC"

            );

            $req->execute([
                "id" => $id
            ]);



            while ($donnee = $req->fetch()) :

            ?>



                <form method="post" action="modifyQuestion.php?id=<?= $donnee['id'] ?>" class="row">
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" placeholder="<?php echo $donnee['titre']; ?>">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" placeholder="<?php echo $donnee['questionUser']; ?> ">
                    </div>
                    <div class="col-md-6">
                        <label style="color: white;" class="form-label">date de la question</label>
                        <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $donnee['createDate']; ?> ">
                    </div>
                    <div class="col-12" style="margin-top: 20px; margin-bottom: 20px;">
                        <a class="btn btn-primary" href="modifyQuestion.php?id=<?= $donnee['id'] ?>" role="button">Mettre à jour</a>
                    </div>
                </form>


            <?php endwhile;
            ?>




    </div>
    </section>
    <?php include('footerForum.php'); ?>


</body>

</html>
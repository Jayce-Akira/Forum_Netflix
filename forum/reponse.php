<?php

require('../src/connexion.php');

  if (!$_COOKIE['auth']) {
    header('Location: ../index.php');
  }


if (isset($_GET['question_id'])) {

  $id_question = htmlspecialchars($_GET['question_id']);

  if (!empty($_POST['reponse'])) {


    // VARIABLES 
    $reponse = htmlspecialchars($_POST['reponse']);
    $id_user = $_SESSION['id'];
    $id_question = htmlspecialchars($_GET['question_id']);

    // ENVOI DANS LA BDD
    $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $req = $bdd->prepare("INSERT INTO reponse (reponseUser, user_id, article_id) VALUES (?,?,?)") or die(print_r($bdd->errorInfo()));
    $req->execute(array($reponse, $id_user, $id_question));

    echo "vous avez bien repondu";
    header('location: reponse.php?question_id=' . $_POST['question_id']);
    exit();
  }
}

//variable
$id_user = $_SESSION['id'];
$id_question = htmlspecialchars($_GET['question_id']);

// LIRE DES INFORMATIONS


?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Forum Netflix</title>
  <link rel="stylesheet" href="stylesforum.css">
  <link rel="icon" type="image/pngn" href="img/favicon.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>


<body class="d-flex flex-column min-vh-100">

  <?php include('headerForum.php'); ?>

  <div class="container">

    <section>
      <div id="answer" style="color: white; margin-top: 25px;">
        <?php
        $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $req = $bdd->prepare(

          "  SELECT * ,reponse.createDateAnswer, reponse.user_id, reponse.reponseUser, reponse.article_id, user.id, user.pseudo FROM question
                                        JOIN user ON question.id_user = user.id
                                        JOIN reponse ON question.id  =  reponse.article_id                                             
                                            WHERE question.id = :question_id "
        );
        $req->execute([
          "question_id" => $id_question
        ]);


        while ($donnees = $req->fetch()) : ?>
          <p style="margin-top: 100px;">Créer le <?php echo $donnees['createDate']; ?> par <?php echo $donnees['pseudo']; ?></p>

          <p>TITRE : <?php echo $donnees['titre']; ?></p>
          <p>QUestion : <?php echo $donnees['questionUser']; ?></p>
          <p class="border-bottom" style="margin-top: 20px;">Réponse déja faite : <?php echo $donnees['reponseUser']; ?> par <?php echo $donnees['pseudo']; ?> le : <?php echo $donnees['createDateAnswer']; ?></p>
        <?php endwhile; ?>
      </div>
      <div style="display: flex; flex-direction:column;">

        <h1 style="color: white;"><?php echo $_SESSION['pseudo']; ?></h1>

      </div>

      <form method="post" action="reponse.php?question_id=<?= $id_question ?>">
        <input type="hidden" name="question_id" value="<?= $id_question ?>">
        <div class="mb-3">
          <label style="color: white;" for="exampleFormControlTextarea1" class="form-label">Votre Réponse</label>
          <textarea type="text" class="form-control" id="exampleFormControlTextarea1" name="reponse" placeholder="Enter text here..." rows="3" required></textarea>
        </div>
        <!--<textarea name="reponse" rows="6" cols="44" placeholder="Enter text here..." required></textarea>-->
        <button class="btn btn-primary" type="submit">Envoyez Votre Réponse</button>
      </form>


    </section>
  </div>
  <?php include('footerForum.php'); ?>


</body>

</html>
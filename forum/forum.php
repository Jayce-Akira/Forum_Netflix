<?php

require('../src/connexion.php');

  if (!$_COOKIE['auth']) {
    header('Location: ../index.php');
  }

if (date("H") < 18)
  $bienvenue = "Bonjour et Bienvenue " .
    $_SESSION['pseudo'] .
    " dans votre espace personnel";
else
  $bienvenue = "Bonsoir et Bienvenue " .
    $_SESSION['pseudo'] .
    " dans votre espace personnel";


$jour = date('d');
$mois = date('m');
$annee = date('Y');

$heure = date('H');
$minute = date('i');

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Forum Netflix</title>
  <link rel="stylesheet" href="stylesforum.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
  <?php include('headerForum.php'); ?>



  <div class="container">
    <h1 style="color: white; margin-top: 100px;"><?= $bienvenue ?></h1>
    <h2 style="color: white;">Nous sommes le <?= $jour . '/' . $mois . '/' . $annee ?> et il est actuellement <?= $heure . 'h' . $minute ?> .</h2>

    <section style="display:flex; flex-direction:column; margin-top:20px;">

      </br></br>

      <h2 style="color: white;">Vous étes <?= $_SESSION['pseudo']; ?></h2>

      <?php

      // LIRE DES INFORMATIONS
      $requete = $bdd->prepare('SELECT *, user.id as userid, question.id as questionid FROM question INNER JOIN user ON question.id_user = user.id ORDER BY createDate DESC');
      $requete->execute();


      while ($donnees = $requete->fetch()) :

      ?>

        <h4 style="color: white; margin-top:25px;">Créer le <?php echo $donnees['createDate']; ?> par <?php echo $donnees['pseudo']; ?></h4>
        <h5 style="color: white;"><?php echo $donnees["titre"]; ?></h5>
        <p style="color: white;"><?php echo $donnees['questionUser']; ?></p>
        <button class="btn btn-danger" type="submit" onclick="document.location.href='reponse.php?question_id=<?= $donnees['questionid'] ?>'">Pour répondre / Voir les réponses</button>
      <?php endwhile ?>
    </section>
 
  </div>

  <?php include('footerForum.php'); ?>



</body>

</html>
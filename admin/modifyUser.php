<?php

require('../src/connexion.php');

if (!$_SESSION['isAdmin']) {
    header('Location: ../index.php');
    exit();
}


if (isset($_POST['modify'])) {
    if (isset($_GET['id']) and !empty($_GET['id'])) {

        //CONNEXION
        $id = $_GET['id'];
        $req = $bdd->prepare("SELECT * FROM user WHERE id =?");
        $req->execute(array($id));

        while ($user = $req->fetch()) {


            if (!empty($_POST['email'])) {

                // VARIABLES 
                $email = htmlspecialchars($_POST['email']);

                //ADRESSE EMAIL NON VALIDE
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
                    exit();
                }

                //ADRESSE EMAIL DEJA UTILISEE
                $req = $bdd->prepare("SELECT count(*) as nbEmail FROM user WHERE email = ?");
                $req->execute(array($email));

                while ($email_verif = $req->fetch()) {
                    if ($email_verif['nbEmail'] != 0) {
                        header('location:inscription.php?error=1&message=Votre adresse email est invalide.');
                        exit();
                    }
                }

                $id = $_GET['id'];

                $req = $bdd->prepare("UPDATE user SET email = ? where id = ?");
                $req->execute([$email, $id]);
                header('location: modifyUser.php?id=' . $_GET['id']);
                exit();
            }



            if (!empty($_POST['password'])) {

                //VARIABLE
                $password = htmlspecialchars($_POST['password']);

                // CHIFFREMENT DU MOT DE PASSE
                $salt = "hhhhoooo123!!312567__asdSdas";
                $password = hash('sha256', $salt . $password);
                $id = $_GET['id'];

                //UPDATE
                $_GET['id'] = $id;
                $req = $bdd->prepare("UPDATE  user set password = ? where id = ?");
                $req->execute([$password, $id]);
                header('location: modifyUser.php?id=' . $_GET['id']);
                exit();
            }

            if (!empty($_POST['pseudo'])) {

                $pseudo = htmlspecialchars($_POST['pseudo']);

                $req = $bdd->prepare("SELECT count(*) as nbPseudo FROM user WHERE pseudo = ?");
                $req->execute(array($pseudo));

                while ($pseudo_verif = $req->fetch()) {
                    if ($pseudo_verif['nbPseudo'] != 0) {
                        header('location:inscription.php?error=1&message=Votre Pseudo est invalide.');
                        exit();
                    }
                }

                //UPDATE
                $_GET['id'] = $id;
                $req = $bdd->prepare("UPDATE  user set pseudo = ? where id = ?");
                $req->execute([$pseudo, $id]);
                header('location: modifyUser.php?id=' . $_GET['id']);
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
    <title>ADMIN</title>
    <link rel="stylesheet" type="text/css" href="design/default.css">
    <link rel="icon" type="image/pngn" href="img/favicon.png">
</head>

<body>

    <?php include '../includes/head.php';
    include '../includes/navbarAdmin.php'; ?>

    <section>



        <?php

        if (isset($_GET['error'])) {

            if (isset($_GET['message'])) {
                echo "<div class='alert error'>" . htmlspecialchars($_GET['message']) . "</div>";
            }
        } else if (isset($_GET['success'])) {
            echo '<div class="alert success">Modification réussie !</div>';
        }



        if (isset($_GET['id']) and !empty($_GET['id'])) {

            //Check  membre
            $id = $_GET['id'];
            $requete = $bdd->prepare("SELECT * FROM user where id = '$id'");
            $requete->execute(array($id));


            while ($donnee = $requete->fetch()) :

        ?>
                <h1 style="display: flex; justify-content:center; margin-top: 20px;">Modification des données de l'utilisateur <?php echo $donnee['pseudo'] ?></h1>
                <div class="container" style="margin-top: 50px;">
                    <form method="post" action="modifyUser.php?id=<?= $donnee['id'] ?>" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="<?php echo $donnee['email']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pseudo</label>
                            <input type="text" class="form-control" id="pseudo" name="pseudo" placeholder="<?php echo $donnee['pseudo']; ?> ">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="text" class="form-control" id="password" name="password" placeholder="New Password">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">date d'enregistrement</label>
                            <input type="text" class="form-control" id="creation_date" placeholder="<?php echo $donnee['creation_date']; ?> ">
                        </div>
                <?php endwhile;
        } ?>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit" name="modify">Modification</button>
                </div>

                    </form>
                </div>
    </section>


</body>

</html>
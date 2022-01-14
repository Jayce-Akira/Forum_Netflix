<?php


require('src/connexion.php');

if (!empty($_POST['email']) && !empty($_POST['password'])) {
	
	

	//VARIABLE
	$email= htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);

	//ADRESSE MAIL CORRECT ?
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
		exit();
	}

	// CHIFFREMENT DU MOT DE PASSE
	$salt = "hhhhoooo123!!312567__asdSdas";
	$password = hash('sha256', $salt . $password);

	// EMAIL DEJA UTILISE ?
	$req = $bdd->prepare("SELECT count(*) as nbEmail FROM user where email = ?");
	$req->execute(array($email));

	while($email_verif = $req->fetch()){
		if($email_verif['nbEmail'] !=1){
			header('location:inscription.php?error=1&message=Impossible de vous authentifier correctement.');
			exit();
		}
	}

	//CONNEXION
	$req = $bdd->prepare("SELECT * FROM user WHERE email =?");
	$req->execute(array($email));

	while($user = $req->fetch()){

		if($password == $user['password'] && $user['blocked'] == 0){
			$_SESSION['connect'] = 1;
			$_SESSION['email'] = $user['email'];
			$_SESSION['id'] = $user['id'];
			$_SESSION['pseudo'] = $user['pseudo'];
			$_SESSION['isAdmin'] = $user['isAdmin'];

			if(isset($_POST['auto'])){
				setcookie('auth', $user['secret'], time() + 364*24*3600, '/', null, false, true);
			}

			header('location: session.php?sucess=1');
			exit();
		}else{

			header('location: index.php?error=1&message=Impossible de vous authentifier correctement.');
			exit();
		}
	}

}

	
?>

<!DOCTYPE html>

<html>

<head>

	<meta charset="utf-8">

	<title>Netflix</title>

	<link rel="stylesheet" type="text/css" href="design/default.css">

	<link rel="icon" type="image/pngn" href="img/favicon.png">

</head>

<body>



	<?php include('src/header.php'); ?>



	<section>

		<div id="login-body">

			<h1>S'identifier</h1>



			<form method="post" action="index.php">

				<input type="email" name="email" placeholder="Votre adresse email" required />

				<input type="password" name="password" placeholder="Mot de passe" required />

				<button type="submit" name="log">S'identifier</button>

				<label id="option"><input type="checkbox" name="auto" checked />Se souvenir de moi</label>

			</form>





			<p class="grey">Première visite sur Netflix ? <a href="inscription.php">Inscrivez-vous</a>.</p>

		</div>

	</section>



	<?php include('src/footer.php'); ?>

</body>

</html>
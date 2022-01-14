<?php

	/* 
	
	Structure : 
		index.php
		inscription.php
		logout.php
		* design
			default.css
		* img
			background.jpg
			favicon.jpg
			logo.png
		* src 
			connexion.php
			footer.php
			header.php
			log.php

	Partie 1 : tables

	Partie 2 : inscription --> index.php

		- créer un formulaire de connexion - utiliser les sessions
		- détecter l'envoi du formulaire
		- bien penser à vérifier vos variables $_POST avec htmlspecialchars() pour augmenter la sécurité
		- tester si les mdp sont identiques, sinon rediriger l'utilisateur avec un message d'erreur
		- vérifier que la syntaxe de l'adresse email soit bonne

			// ADRESSE EMAIL SYNTAXE
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header('location: inscription.php?error=1&message=Votre adresse email est invalide.');
				exit();
			}

		- vérifier que l'email n'est pas déjà utilisé 
			(voir PDO dans le support PDF)
			
			SELECT count(*) as nbEmail FROM user WHERE email = ?

		- générer une variable unique $secret (laissez libre court à votre imagination)
		- envoyer nos informations et créer un utilisateur
		- trouver un moyen de chiffrer les mdp dans la BDD

	 Partie 3 : connexion de l'utilisateur

	 Partie 4 : cacher des parties selon si l'utilisateur est connecté ou non 

	 Partie 5 : permettre de déconnecter l'utilisateur

	 Partie 6 : connexion automatique via les cookies


	 
	1	id Primaire	int(11)			Non	Aucun(e)		AUTO_INCREMENT	Modifier Modifier	Supprimer Supprimer	
Plus Plus
	2	email	text	utf8_general_ci		Non	Aucun(e)			Modifier Modifier	Supprimer Supprimer	
Plus Plus
	3	password	text	utf8_general_ci		Non	Aucun(e)			Modifier Modifier	Supprimer Supprimer	
Plus Plus
	4	secret	text	utf8_general_ci		Non	Aucun(e)			Modifier Modifier	Supprimer Supprimer	
Plus Plus
	5	creation_date	datetime			Non	CURRENT_TIMESTAMP			Modifier Modifier	Supprimer Supprimer	
Plus Plus
	6	blocked	int(11)			Non	0			Modifier Modifier	Supprimer Supprimer	
Plus Plus


tips

    /*function isAdmin() {
        return $_SESSION['isAdmin'] === $bddAdmin;
    }
     $isAdmin = true;
     if($isAdmin)
     die('message d'eereur')
	 
	 
	 Pour éviter echo faire <?=        ?>
	 
	 $bdd->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	 */	 

// tab equivalent
/*$tabnums = [
    "ok" => 1,
    "ok" => 5,
    "ka" => 6
];

foreach($tabnums as $key => $tabnum ){
    echo $tabnum . ' ' . $key;
}

for ($i=0; $i < 100 ; $i++) { 
    echo $i;
}

$i = 0;
while ($i <= 100) {
    $i++;
}*/

# Projet Netflix Module Php_SQL

## 1. Contexte de l'évaluation 
Lors du module de formation Php_My SQL on doit créer une interface de connexion ressemblant à Netflix.  
Ce projet doit ensuite évoluer en forum.
Il doit aussi avoir une interface ADMIN.

#### Fonctionnalitées désirées :
- Création de compte.
- Accès au site par l'interface de connexion.
- Un espace Admin pour gérer les membres.
- Affichage des questions sur la page forum.
- Formulaire pour le membre afin de mettre à jour ses questions et/ou ses réponses.
- Système de ban pour les membres.
- Système afin de rajouter un Admin.


## 2. Environnement technique

- Front: HTML 5 / CSS 3 / BOOTSTRAP 5
- Back: PHP 7.4 à 8 BDD relationnelle MySQL (SGBDR: InnoDB)
- Serveur: Local: WAMP Local Web Server
- Le patron de concéption n'existe pas aucun Design Pattern (c'est brouillon je sais mais c'était mon premier projet, je suis partie dans le sens du vent. Ne regardez pas trop prêt, ça va vous faire mal aux yeux !!!!) 


## Procédure de mise en place en local

- Cloner le fichier sur votre ordinateur avec  
  `git clone https://github.com/Jayce-Akira/Forum_Netflix.git`
- Installer le projet de l'application dans le dossier www de WAMP

- Importer la BDD avec phpmyadmin le fichier netflix.sql  

-Pour vous connecter en admin : azerty@test.fr mdp: az

Vous pouvez désormais naviguer sur le site en tant qu'Admin ou créer un compte afin de naviguer en tant que membre.

Enjoy
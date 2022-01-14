<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=netflix', 'root', '');
} catch (Exception $e) {

    die('Erreur : ' . $e->getMessage());
}

?>
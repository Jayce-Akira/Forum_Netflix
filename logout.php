<?php
//détruit la session
session_destroy();

//détruit le Cookie d'authentification
unset($_COOKIE['auth']);
setcookie('auth', '', time() - 6200, '/');
setcookie('PHPSESSID', '', time() - 6200, '/');


//Direction à la page index
header('location: index.php');

?>
<?php


if(isset($_COOKIE['auth']) && !isset($_SESSION['connect'])){

    //VARIABLE
    $secret = htmlspecialchars($_COOKIE['auth']);

    //VERIFICATION
    

    $req = $bdd->prepare("SELECT count(*) as nbAccount FROM user WHERE $secret = ?");
    $req->execute(array($secret));

    while($user = $req->fetch()){

        if($user['nbAccount'] == 1){
            $reqUser = $bdd->prepare("SELECT * FROM user WHERE secret = ?");
            $reqUser->execute(array($secret));

            while($userAccount = $reqUser->fetch()){
                $_SESSION['connect'] = 1;
                $_SESSION['email'] = $userAccount['email'];
            }
        }
    }
}



if(isset($_SESSION['connect'])){

    

    $reqUser = $bdd->prepare("SELECT * FROM user WHERE email = ?");
    $reqUser->execute(array($_SESSION['email']));

    while($userAccount = $reqUser->fetch()){

        if($userAccount['blocked'] == 1){
            header('location:logout.php');
            exit();
        }
    }
}
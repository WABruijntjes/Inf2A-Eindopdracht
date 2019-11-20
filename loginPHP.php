<?php
if(!isset($_POST["loginSubmit"])){
    header("location:login.php");
}
    
    include_once 'Logic/User_Service.php';

    session_start();


    $enteredEmail = strip_tags((string)$_POST['userEmail']);
    $enteredPassword = strip_tags((string)$_POST ['userPassword']);

    $User_Service = new User_Service();
    $loggedInUser = $User_Service->service_userLogin($enteredEmail, $enteredPassword);

    if($loggedInUser->userEMail == $enteredEmail && (password_verify($enteredPassword, $loggedInUser->userPassword))){  
        $_SESSION['login'] = $loggedInUser;
        header('location:index.php');
    }else{
        header('location:login.php?login=failed');
    }

?>


<?php
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_POST["resetPasswordSubmit"])){
    header("location:index.php");
}

$loggedInUser = $_SESSION['login'];

$currentPassword = strip_tags((string)$_POST['currentPassword']);
$newPassword = strip_tags((string)$_POST['newPassword']);
$repeatPassword = strip_tags((string)$_POST['repeatPassword']);

$User_Service = new User_Service();

if($repeatPassword == $newPassword){
    if(password_verify($currentPassword, $loggedInUser->userPassword)){
        $User_Service->service_userUpdateUserPassword($loggedInUser->userID, $newPassword);
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $loggedInUser->userPassword = $hashedNewPassword;
        header('location:userSettings.php?passwordUpdate=success');
    }else{
        header('location:userSettings.php?passwordError=incorrectCurrent');
    }
}else{
    header('location:userSettings.php?passwordError=noMatch');
}




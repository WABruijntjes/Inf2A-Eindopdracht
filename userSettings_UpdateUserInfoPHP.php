<?php
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_POST["updateUserInfoSubmit"])){
    header("location:login.php");
}

$loggedInUser = $_SESSION['login'];

$userName = strip_tags((string)$_POST['userName']);
$userSurname = strip_tags((string)$_POST['userSurname']);
$userEmail = strip_tags((string)$_POST['userEmail']);

$User_Service = new User_Service();

$User_Service->service_userUpdateUserInfo($loggedInUser->userID, $userName, $userSurname, $userEmail);

$loggedInUser->userName = $userName;
$loggedInUser->userSurname = $userSurname;
$loggedInUser->userEmail = $userEmail;

header('location:userSettings.php?userInfo=updated');




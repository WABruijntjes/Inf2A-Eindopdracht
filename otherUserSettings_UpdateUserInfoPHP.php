<?php
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_POST["updateOtherUserInfoSubmit"])){
    header("location:login.php");
}

$userID = $_POST['userID'];
$userName = strip_tags((string)$_POST['userName']);
$userSurname = strip_tags((string)$_POST['userSurname']);
$userEmail = strip_tags((string)$_POST['userEmail']);
$userRole = $_POST['userRole'];

$User_Service = new User_Service();

$User_Service->service_userUpdateOtherUserInfo($userID, $userName, $userSurname, $userEmail, $userRole);

header('location:userList.php?otherUserInfo=updated');




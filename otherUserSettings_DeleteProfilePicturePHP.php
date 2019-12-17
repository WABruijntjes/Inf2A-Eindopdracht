<?php
if(!isset($_POST["deleteProfilePictureSubmit"])){
    header("location:login.php");
}

session_start();
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}

$userID = $_POST['userID']; 

$User_Service = new User_Service();
$User_Service->service_userDeleteOtherUserProfilePicture($userID);

header("Location: userList.php?delete=success");



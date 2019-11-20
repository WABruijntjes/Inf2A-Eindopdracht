<?php

include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_POST["deleteOtherUser"])){
    header("location:login.php");
}

$userID = $_POST['userID'];
$loggedInUser = $_SESSION['login'];

if($userID != $loggedInUser->userID){
    $User_Service = new User_Service();

    $User_Service->service_userDeleteOtherUser($userID);

    header('location:userList.php?userDeleted=success');
}else{
    header('location:userList.php?userDeleted=selfDeleteFail');
}


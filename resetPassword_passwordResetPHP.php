<?php

if(!isset($_POST['resetPasswordSubmit'])){
    header('location:login.php');
}

include 'Logic/User_Service.php';
$User_Service = new User_Service();

/////ZONDER MAIL SERVER WERKT DIT NIET!

/*$selector = $_POST['selector'];
$validator = $_POST['validator'];
$newPassword = $_POST['newPassword'];
$repeatPassword = $_POST['repeatPassword'];

if($repeatPassword == $newPassword){
    
    $currentDate = date("U");
    
    $User_Service->service_userResetPassword($selector,$validator,$currentDate, $newPassword);
    header('location:login.php?passwordReset=successs');
    
    
    
}*/
//////////////////////////////////////////////////////

//////////////NO MAIL SERVER CODE////////////////////////
$userEmail = strip_tags((string)$_POST['userEmail']);
$newPassword = strip_tags((string)$_POST['newPassword']);
$repeatPassword = strip_tags((string)$_POST['repeatPassword']);

if($repeatPassword == $newPassword){
    $User_Service->service_userResetPassword_NOMAILSERVER($userEmail,$newPassword);
    header('location:login.php?passwordReset=successs');
}



<?php
if(!isset($_POST["registerSubmit"])){
    header("location:login.php");
}


    include_once 'Logic/User_Service.php';

    session_start();

    $enteredName = strip_tags((string)$_POST["userName"]);
    $enteredSurname = strip_tags((string)$_POST["userSurname"]);
    $enteredEmail = strip_tags((string)$_POST["userEmail"]);
    $enteredPassword = strip_tags((string)$_POST ["userPassword"]);
    $enteredRepeatPassword = strip_tags((string)$_POST ["userRepeatPassword"]);
    
    $User_Service = new User_Service();
    
    if($enteredRepeatPassword == $enteredPassword){

        if(!($User_Service->service_userExistCheck($enteredEmail))){
          $User_Service->service_userRegister($enteredName, $enteredSurname, $enteredEmail, $enteredPassword);
          header('location:login.php?signUp=succesful');

        }else{
          header('location:register.php?registerUserExists=true');
        }
    }else{
        header('location:register.php?passwordRepeat=false');
    }

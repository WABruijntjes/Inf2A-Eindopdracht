<?php

if(!isset($_POST["changeUserBackgroundSubmit"])){
    header("location:login.php");
}

$chosenColor = $_GET['backgroundColor']; 

setcookie("userBackgroundColor", $chosenColor, 2147483647);

header("Location: userSettings.php?backgroundColor=changed");

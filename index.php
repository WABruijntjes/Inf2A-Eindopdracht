<?php
include_once 'Logic/User_Service.php';
include_once 'Model/User.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Homepage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css/stylesheet.css">
        
    </head>
    <body>
        <?php
            $loggedInUser = $_SESSION['login'];
            $User_Service = new User_Service();
            
            $loggedInUser->user_backgroundColorSelect();
        ?>
        <div class="custom-container">
            <div class="custom-container-header">
                <a href="logoutPHP.php"><button class="logout"><i class="material-icons">settings_power</i>Log-Out</button></a>
                <?php echo "<img class='profilePicture' src='Uploads/$loggedInUser->userProfilePicture'>" ?>
                <h1 class="userName"><?php echo $loggedInUser->userName." ".$loggedInUser->userSurname ?> </h1>
            </div>
            <div class="custom-container-center">
                
                <ul class="userOptionsMenu">
                    <a href="userList.php"><li class="userOptionsMenuItem"><i class="material-icons">account_box</i>User List</li></a>
                    <a href="userSettings.php"><li class="userOptionsMenuItem"><i class="material-icons">settings_applications</i>User Settings</li></a>
                    <a href="webshop.php"><li class="userOptionsMenuItem"><i class="material-icons">shopping_cart</i>Webshop</li></a>
                </ul>
            </div>
        </div>
    </body>
</html>


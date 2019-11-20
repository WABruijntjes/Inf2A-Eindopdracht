<?php
include_once 'Model/User.php';
include_once 'Model/UserRole.php';
include_once 'Logic/User_Service.php';

session_start();
$User_Service = new User_Service();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}

if(!isset($_GET["otherUserSettings"])){
    header("location:index.php");
}

$loggedInUser = $_SESSION['login'];
$userID = $_GET["userID"];
$otherUser = $User_Service->service_userGetOtherUser($userID);
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php ?> Settings</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css/stylesheet.css">
    </head>
    <body>
        <?php $loggedInUser->user_backgroundColorSelect(); ?>
        <div class="custom-container">
            <div class="custom-container-header">
            </div>
            <div class="custom-container-center">
                <h2 class="userSettingh2">Change information about <?php echo $otherUser->userName." ".$otherUser->userSurname; ?></h2>
                <form action="otherUserSettings_UpdateUserInfoPHP.php" method="POST">
                    <input type="hidden" name="userID" value="<?php echo $otherUser->userID ?>">
                    Name: <input type="text" name="userName" class="" required value="<?php echo $otherUser->userName;  ?>">
                    Surname: <input type="text" name="userSurname" class="" required value="<?php echo $otherUser->userSurname;  ?>">
                    E-Mail: <input type="email" name="userEmail" class="" required value="<?php echo $otherUser->userEMail; ?>">
                    
                    User Role: 
                    <select name="userRole">
                        <option <?php if($otherUser->userRole == userRole::User){echo "selected";} ?> value="<?php echo userRole::User?>"><?php echo $otherUser->user_userRoleCalc(userRole::User) ?></option>
                        <option <?php if($otherUser->userRole == userRole::Admin){echo "selected";} ?>  value="<?php echo userRole::Admin?>"><?php echo $otherUser->user_userRoleCalc(userRole::Admin) ?></option>
                        <option <?php if($otherUser->userRole == userRole::SuperAdmin){echo "selected";} ?>  value="<?php echo userRole::SuperAdmin?>"><?php echo $otherUser->user_userRoleCalc(userRole::SuperAdmin) ?></option>
                    </select>
                    
                    <br><br>
                    
                    <button class="submitButton" type="submit" name="updateOtherUserInfoSubmit"><i class="material-icons">info</i>Update user info</button>
                </form>
                <?php
                if(isset($_GET["userInfo"])){
                    if($_GET["userInfo"] == "updated"){
                        echo '<p class="successMessage"> information has been updated!</p>';
                    }
                }
                ?>
                <hr>
                <form action="otherUserSettings_DeleteProfilePicturePHP.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="userID" value="<?php echo $otherUser->userID ?>">
                    <table class="profilePictureUploadTable">
                        <tr>
                            <h2 class="userSettingh2">Delete profile picture</h2>
                            <td><img class="userListprofilePicture" src="Uploads/<?php echo $otherUser->userProfilePicture ?>"></td>
                            <td><button class="deleteButton" type="submit" name="deleteProfilePictureSubmit"><i class="material-icons">image</i>Delete</button></td>
                        </tr>
                    </table>
                </form>
            <hr>
            <form action="otherUserSettings_DeleteUserPHP.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="userID" value="<?php echo $otherUser->userID ?>">
                <button onclick="return confirm('Are you sure you want to delete <?php echo $otherUser->userName.' '.$otherUser->userSurname ?> PERMANENTELY?')" class="deleteButton" type="submit" name="deleteOtherUser"><i class="material-icons">delete_forever</i>DELETE USER</button>
            </form>
            <hr>
            <a href="userList.php"><button class="backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            </div>
        </div>
        
    </body>
</html>

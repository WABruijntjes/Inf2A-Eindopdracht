<?php
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: index.php");
}
$loggedInUser = $_SESSION['login'];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>User Settings</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <?php $loggedInUser->user_backgroundColorSelect(); ?>
        <div class="custom-container">
            <div class="custom-container-header">
            </div>
            <div class="custom-container-center">
                <h2 class="userSettingh2">Change information about yourself</h2>
                <form action="userSettings_UpdateUserInfoPHP.php" method="POST">
                    Name: <input type="text" name="userName" class="" required value="<?php echo $loggedInUser->userName ?>">
                    Surname: <input type="text" name="userSurname" class="" required value="<?php echo $loggedInUser->userSurname ?>">
                    E-Mail: <input type="email" name="userEmail" class="" required value="<?php echo $loggedInUser->userEMail ?>">
                    
                    User Role: <font class="role<?php echo $loggedInUser->user_userRoleCalc($loggedInUser->userRole)?>">
                    <?php 
                    echo $loggedInUser->user_userRoleCalc($loggedInUser->userRole);
                    ?>
                    </font>
                    
                    <br><br>
                    
                    <button class="button submitButton" type="submit" name="updateUserInfoSubmit"><i class="material-icons">info</i>Update user info</button>
                </form>
                <?php
                if(isset($_GET["userInfo"])){
                    if($_GET["userInfo"] == "updated"){
                        echo '<p class="successMessage">Your information has been updated!</p>';
                    }
                }
                ?>
                <hr>
                <h2 class="userSettingh2">Change your password</h2>
                <form action="userSettings_UpdateUserPasswordPHP.php" method="POST">
                    <input type="password" name="currentPassword" placeholder="Enter your current password" required>
                    <input type="password" name="newPassword" placeholder="Enter a new password" required>
                    <input type="password" name="repeatPassword" placeholder="Repeat the new password" required>
                    <button class="button submitButton"type="submit" name="resetPasswordSubmit"><i class="material-icons">save</i>Save new password</button>
                </form>
                <?php
                if(isset($_GET["passwordError"])){
                    if($_GET["passwordError"] == "noMatch"){
                        echo '<p class="errorMessage">The passwords do not match</p>';
                    }
                    if($_GET["passwordError"] == "incorrectCurrent"){
                        echo '<p class="errorMessage">The current password you entered does not match your current password</p>';
                    }
                }
                if(isset($_GET["passwordUpdate"])){
                    if($_GET["passwordUpdate"] == "success"){
                        echo '<p class="successMessage">Your password has been updated!</p>';
                    }
                }
                ?>
                <hr>
                <form action="userSettings_UploadProfilePicturePHP.php" method="POST" enctype="multipart/form-data">
                    <table class="profilePictureUploadTable">
                        <tr>
                            <h2 class="userSettingh2">Upload a personal profile picture</h2>
                            <td><input class="uploadProfilePicture" type="file" name="profilePicture"></td>
                            <td><button class="button submitButton" type="submit" name="uploadProfilePictureSubmit"><i class="material-icons">image</i>Upload</button></td>
                        </tr>
                    </table>
                </form> 
                <?php
                if(isset($_GET["upload"])){
                    if($_GET["upload"] == "successs"){
                        echo '<p class="successMessage">Your profile picture has been successfully changed</p>';
                    }
                    if($_GET["upload"] == "sizeFail"){
                        echo '<p class="errorMessage">The image you tried to upload is too large! Upload an image smaller than 100MB</p>';
                    }
                    if($_GET["upload"] == "errorFail"){
                        echo '<p class="errorMessage">Uploading file failed due to error in file</p>';
                    }
                    if($_GET["upload"] == "typeFail"){
                        echo '<p class="errorMessage">You can only upload .jpg , .jpeg, .gif or .png images!</p>';
                    }
                }
                ?>
                <hr>
                <form action="userSettings_ChangeBackgroundColorPHP.php" method="GET">
                    <table class="backgroundColorChangerTable">
                        <tr>
                            <h2 class="userSettingh2">Select a custom website background color</h2>
                        </tr>
                        <tr>
                            <td><?php 
                                    if(isset($_COOKIE['userBackgroundColor'])){
                                        echo "<input name='backgroundColor' class='colorPicker' type='color' value='".$_COOKIE['userBackgroundColor']."'>";
                                    }else{
                                        echo "<input name='backgroundColor' class='colorPicker' type='color' value='#6CADDF'>";
                                    }
                                ?>
                            </td>
                            <td><button type="submit" class="button submitButton" name="changeUserBackgroundSubmit"><i class="material-icons">color_lens</i>Change color</button></td>
                        </tr>
                    </table>
                </form>
                <?php
                if(isset($_GET["backgroundColor"])){
                    if($_GET["backgroundColor"] == "changed"){
                        echo '<p class="successMessage">The background color of the website has been changed and saved in your browser.</p>';
                    }
                }
                ?>
            <hr>
            <form action="userSettings_deleteAllCookies.php" method="POST" enctype="multipart/form-data">
                <button onclick="return confirm('Are you sure you want to delete All 631290.infHaarlem.nl Cookies?')" class="button deleteButton" type="submit" name="deleteAllCookies"><i class="material-icons">delete_forever</i>DELETE ALL COOKIES</button>
            </form>
            <?php
                if(isset($_GET["cookiesDeleted"])){
                    if($_GET["cookiesDeleted"] == "success"){
                        echo '<p class="successMessage">All cookies regarding this website have been deleted!</p>';
                    }
                }
                ?>
            <hr>
            <a href="index.php"><button class="button backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            </div>
        </div>
        
    </body>
</html>

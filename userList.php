<?php
include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}

$loggedInUser = $_SESSION['login'];
$User_Service = new User_Service();

if(isset($_GET["search"])){
    $searchTerm = $_GET["search"];
    if($_GET["search"] == $searchTerm){
        $users = $User_Service->service_userListSearch($searchTerm);
    }
} else{
    $users = $User_Service->service_getAllUsers();
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>User List</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="css/stylesheet.css">
        
    </head>
    <body>  
        <?php $loggedInUser->user_backgroundColorSelect(); ?>
        <div class="custom-container userListContainer">
            <div class="custom-container-header">
                <h1>User List</h1>
            </div>
            
            <form class="searchForm" action="userList_userSearchPHP.php" method="POST">
                    <input type="text" name="search" class="userListSearch" placeholder="Type your search term(Name / Surname / E-Mail / Registration date)">
                    <button class="userListSubmitButton" type="submit" name="searchSubmit"><i class="material-icons">search</i>Search</button>
            </form> 
            
            <div class="custom-container-center">  
            <?php if(!empty($users)){
            ?>
                <table class="userTable" border="1">
                    <thead>
                    <tr>
                        <th></th>
                        <th>User name</th>
                        <th>User E-Mail</th>
                        <th>User Registration Date</th>
                        <th>User role</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($users as $user){
                    ?>
                        <tr>
                            <td><img class="userListprofilePicture" src="Uploads/<?php echo $user->userProfilePicture; ?>"></td>
                            <td><?php echo $user->userName . " " . $user->userSurname; ?></td>
                            <td><?php echo $user->userEMail ?></td>
                            <td><?php echo $user->userRegDate ?></td>
                            <td>
                                <font class="role<?php echo $user->user_userRoleCalc($user->userRole)?>">
                                <?php 
                                echo $user->user_userRoleCalc($user->userRole);
                                ?>
                                </font>
                            </td>
                            <?php
                            if($loggedInUser->userRole == userRole::Admin || $loggedInUser->userRole == userRole::SuperAdmin){
                            ?>
                            <td>
                                <form action="otherUserSettings.php" method="GET">
                                    <?php echo "<input type='hidden' name='userID' value='$user->userID'>"?>
                                    <button type="submit" class="settingsButton" name="otherUserSettings"><i class="material-icons">settings_applications</i>Settings</button>
                                </form>
                            </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <?php
                }else{
                    echo "<p>No users match the search term</p>";
                }
                ?>
                <hr>
                <a href="index.php"><button class="backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            <?php
                if(isset($_GET["delete"])){
                    if($_GET["delete"] == "success"){
                        echo '<p class="successMessage"> User profile picture has been deleted!</p>';
                    }
                }
                
                if(isset($_GET["otherUserInfo"])){
                    if($_GET["otherUserInfo"] == "updated"){
                        echo '<p class="successMessage"> The user info has been updated</p>';
                    }
                }
                
                if(isset($_GET["userDeleted"])){
                    if($_GET["userDeleted"] == "success"){
                        echo '<p class="successMessage"> The user has been deleted permanentely!</p>';
                    }
                    
                    if($_GET["userDeleted"] == "selfDeleteFail"){
                        echo '<p class="errorMessage"> You cannot delete yourself</p>';
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>


<?php
if(!isset($_POST["uploadProfilePictureSubmit"])){
    header("location:login.php");
}
    

include_once 'Model/User.php';
include_once 'Logic/User_Service.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}

if(isset($_POST['uploadProfilePictureSubmit'])){ //Checks if there is a file selected

        $image = $_FILES['profilePicture'];
        $imageExtPoint = explode('.', $image['name']);
        $imageExt = strtolower(end($imageExtPoint)); //Check which extension the uploaded file has

        $allowedFiles = array('jpg', 'jpeg', 'gif', 'png');

        if(in_array($imageExt, $allowedFiles)){
            if($image['error'] === 0){
                if($image['size'] < 500000){
                    $imageName = $_SESSION['login']->userName . "_" . $_SESSION['login']->userSurname . "_" . $_SESSION['login']->userID . "." . $imageExt;
                    move_uploaded_file($image['tmp_name'], 'Uploads/'.$imageName);
                    
                    $User_Service = new User_Service();
                    
                    $User_Service->service_userUploadProfilePictureToDB($imageName,$_SESSION['login']->userID);
                    
                    $_SESSION['login']->userProfilePicture = $imageName;
                    
                    header("Location: userSettings.php?upload=successs");
                }else{
                    header("Location: userSettings.php?upload=sizeFail");
                }
            }else{
                header("Location: userSettings.php?upload=errorFail");
            }
        }else{
            header("Location: userSettings.php?upload=typeFail");
        }

}
?>


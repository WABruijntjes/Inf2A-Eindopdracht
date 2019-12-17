<?php
include_once 'DAL/dbConfig.php';
include_once 'Model/User.php';
include_once 'Model/UserRole.php';

class User_DAO{
    
    public function DAO_getAllUsers(){
        $conn = $GLOBALS['database']->dbconnect();
        
        $userArray = [];
        $userQuery = mysqli_query($conn, "SELECT * FROM users");
        
            while ($userInfo = $userQuery->fetch_object())
            {
                $user = new User();
                
                $user->userID = $userInfo->userID;
                $user->userName = $userInfo->userName;
                $user->userSurname = $userInfo->userSurname;
                $user->userEMail = $userInfo->userEMail;
                $user->userRole = $userInfo->userRole;
                $user->userProfilePicture = $userInfo->userProfilePicture;
                $user->userRegDate = $userInfo->userRegDate;
                
                array_push($userArray, $user);
            }
            
            return $userArray;
    }
    
    public function DAO_userLogin($enteredEmail){
        $conn = $GLOBALS['database']->dbconnect();
        
        $userQuery = "SELECT * FROM users WHERE userEMail = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("s", $enteredEmail);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $user = new User();
        
        while ($userInfo = $result->fetch_object())
        { 
            $user->userID = $userInfo->userID;
            $user->userName = $userInfo->userName;
            $user->userSurname = $userInfo->userSurname;
            $user->userEMail = $userInfo->userEMail;
            $user->userPassword = $userInfo->userPassword;
            $user->userRole = $userInfo->userRole;
            $user->userProfilePicture = $userInfo->userProfilePicture;
            $user->userRegDate = $userInfo->userRegDate;
        }
        
        return $user; 
        
        
    }
    
    public function DAO_userRegister($enteredName, $enteredSurname, $enteredEmail, $enteredPassword){
        $conn = $GLOBALS['database']->dbconnect();
        
        $hashedPassword = password_hash($enteredPassword, PASSWORD_DEFAULT);
        
        $userRole = userRole::User;
        $userRegDate = date('Y-m-d H:i:s');
        $userProfilePicture = "default.jpg";
        
        $userQuery = "INSERT INTO users (userName, userSurname, userEmail, userPassword, userRole, userProfilePicture, userRegDate) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("ssssiss", $enteredName, $enteredSurname, $enteredEmail, $hashedPassword, $userRole, $userProfilePicture, $userRegDate);
        $stmt->execute();  
    }
    
    public function DAO_userExistCheck($enteredEmail){
        $conn = $GLOBALS['database']->dbconnect();

        $userQuery = "SELECT userEMail FROM users WHERE userEMail = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("s", $enteredEmail);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function DAO_userUploadProfilePictureToDB($imageName,$userID){
        $conn = $GLOBALS['database']->dbconnect();
        $userQuery = "UPDATE users SET userProfilePicture = ? WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("si", $imageName, $userID);
        $stmt->execute();
    }
    
    public function DAO_userUpdateUserInfo($userID, $userName, $userSurname, $userEmail){
        $conn = $GLOBALS['database']->dbconnect();
        $userQuery = "UPDATE users SET userName = ?, userSurname = ?, userEMail = ? WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("sssi", $userName, $userSurname, $userEmail, $userID);
        $stmt->execute();
    }
    
    public function DAO_userUpdateUserPassword($userID, $newPassword){
        $conn = $GLOBALS['database']->dbconnect();
        
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        $userQuery = "UPDATE users SET userPassword = ? WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("si", $hashedNewPassword, $userID);
        $stmt->execute();
    }
    
    public function DAO_userDeletePwdResetTokens($userEmail){
        $conn = $GLOBALS['database']->dbconnect();
        $userQuery = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
    }
    
    public function DAO_userInsertPwdResetTokens($userEmail,$hexSelector,$token,$expire){
        $conn = $GLOBALS['database']->dbconnect();
        
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        
        $userQuery = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("ssss", $userEmail, $hexSelector, $hashedToken, $expire);
        $stmt->execute();
    }
    
    public function DAO_userResetPassword($selector,$validator,$currentDate, $newPassword){
        $conn = $GLOBALS['database']->dbconnect();       
        $userQuery = "SELECT * FROM pwdReset WHERE pwdResetSelector = ? AND pwdResetExpires >= ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("si", $selector, $currentDate);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if($row = mysqli_fetch_assoc($result)){
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row->pwdResetToken);
            
            if($tokenCheck){
                $tokenEmail = $row->pwdResetEmail;
                
                $userQuery2 = "SELECT * FROM users WHERE userEMail = ?";
                $stmt2 = $conn->prepare($userQuery2);
                $stmt2->bind_param("s", $tokenEmail);
                $stmt2->execute();
                
                $result2 = $stmt2->get_result();
                
                if($row2 = mysqli_fetch_assoc($result2)){
                    $userQuery3 = "UPDATE users SET userPassword = ? WHERE userEMail = ?";
                    
                    $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                    
                    $stmt3 = $conn->prepare($userQuery3);
                    $stmt3->bind_param("ss", $newPasswordHash,$tokenEmail);
                    $stmt3->execute();
                    
                    DAO_userDeletePwdResetTokens($tokenEmail);
                }
            }else{
                echo "Error while checking Password Reset Token";
                exit(); 
            }
        }else{
            echo "Please re-submit your reset request";
            exit();
        }
    }
    
    public function DAO_userResetPassword_NOMAILSERVER($userEmail,$newPassword){
        $conn = $GLOBALS['database']->dbconnect();
        
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
      
        $userQuery = "UPDATE users SET userPassword = ? WHERE userEMail = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("ss", $newPasswordHash, $userEmail);
        $stmt->execute();
    }
    
    public function DAO_userListSearch($searchTerm){
        $conn = $GLOBALS['database']->dbconnect();
        
        $userArray = [];
        $userQuery = "SELECT * FROM users WHERE userName LIKE ? OR userSurname LIKE ? OR userEMail LIKE ? OR userRegDate LIKE ?";
        $stmt = $conn->prepare($userQuery);
        $parameterSearchTerm = "%$searchTerm%";
        $stmt->bind_param("ssss", $parameterSearchTerm, $parameterSearchTerm, $parameterSearchTerm, $parameterSearchTerm);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
            while ($userInfo = $result->fetch_object())
            {
                $user = new User();
                
                $user->userID = $userInfo->userID;
                $user->userName = $userInfo->userName;
                $user->userSurname = $userInfo->userSurname;
                $user->userEMail = $userInfo->userEMail;
                $user->userRole = $userInfo->userRole;
                $user->userProfilePicture = $userInfo->userProfilePicture;
                $user->userRegDate = $userInfo->userRegDate;
                
                array_push($userArray, $user);
            }
            return $userArray;
    }
    
    public function DAO_userGetOtherUser($userID){
        $conn = $GLOBALS['database']->dbconnect();
        
        $userQuery = "SELECT * FROM users WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $user = new User();
        
        while ($userInfo = $result->fetch_object())
        { 
            $user->userID = $userInfo->userID;
            $user->userName = $userInfo->userName;
            $user->userSurname = $userInfo->userSurname;
            $user->userEMail = $userInfo->userEMail;
            $user->userRole = $userInfo->userRole;
            $user->userProfilePicture = $userInfo->userProfilePicture;
            $user->userRegDate = $userInfo->userRegDate;
        }
        
        return $user;
    }
    
     public function DAO_userUpdateOtherUserInfo($userID, $userName, $userSurname, $userEmail, $userRole){
        $conn = $GLOBALS['database']->dbconnect();
        $userQuery = "UPDATE users SET userName = ?, userSurname = ?, userEMail = ?, userRole= ? WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("sssii", $userName, $userSurname, $userEmail, $userRole, $userID);
        $stmt->execute();
    }
    
    public function DAO_userDeleteOtherUserProfilePicture($userID){
        $conn = $GLOBALS['database']->dbconnect();
  
        $userQuery = "UPDATE users SET userProfilePicture = 'default.jpg' WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
    }
    
    public function DAO_userDeleteOtherUser($userID){
        $conn = $GLOBALS['database']->dbconnect();
  
        $userQuery = "DELETE FROM users WHERE userID = ?";
        $stmt = $conn->prepare($userQuery);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
    }
}
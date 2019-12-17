<?php
include_once 'DAL/User_DAO.php';



class User_Service{
    
    public $User_DAO;
    
    public function service_getAllUsers(){
        $User_DAO = new User_DAO();
        
        try{ 
            $userArray = $User_DAO->DAO_getAllUsers();
            return $userArray;
            
        } catch (Exception $ex) {
            echo $ex."- Something went wrong getting users in the User Service layer";
        }
    }
    
    public function service_userLogin($enteredEmail){
        $User_DAO = new User_DAO();
        
        try{ 
            $loggedInUser = $User_DAO->DAO_userLogin($enteredEmail);
            return $loggedInUser;
        } catch (Exception $ex) {
            echo $ex."- Something went wrong logging in through the User Service layer";
        }
    }
    
    public function service_userRegister($enteredName, $enteredSurname, $enteredEmail, $enteredPassword){
        $User_DAO = new User_DAO();
        
        try{ 
           $User_DAO->DAO_userRegister($enteredName, $enteredSurname, $enteredEmail, $enteredPassword); 
        } catch (Exception $ex) {
            echo $ex."- Something went wrong registering the user in the User Service layer";
        }
    }
    
    public function service_userExistCheck($enteredEmail){
        $User_DAO = new User_DAO();
        
        try{ 
            $userExists = $User_DAO->DAO_userExistCheck($enteredEmail);
            return $userExists;
        } catch (Exception $ex) {
            echo $ex."- Something went wrong checking email existence in the User Service layer";
        }
    }
    
    public function service_userUploadProfilePictureToDB($imageName, $userID){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userUploadProfilePictureToDB($imageName,$userID);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong checking email existence in the User Service layer";
        }
    }
    
    public function service_userUpdateUserInfo($userID, $userName, $userSurname, $userEmail){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userUpdateUserInfo($userID, $userName, $userSurname, $userEmail);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong updating user info in the User Service layer";
        }
    }
    
    public function service_userUpdateUserPassword($userID, $newPassword){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userUpdateUserPassword($userID, $newPassword);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong updating new user password in the User Service layer";
        }
    }
    
    public function service_userDeletePwdResetTokens($userEmail){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userDeletePwdResetTokens($userEmail);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong deleting password reset tokens in the User Service layer";
        }
    }
    
    public function service_userInsertPwdResetTokens($userEmail,$hexSelector,$token,$expire){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userInsertPwdResetTokens($userEmail,$hexSelector,$token,$expire);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong inserting password reset tokens in the User Service layer";
        }
    }
    
    public function service_userResetPassword($selector,$validator,$currentDate, $newPassword){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userResetPassword($selector,$validator,$currentDate, $newPassword);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong resetting the  password in the User Service layer";
        }
    }
    
    public function service_userResetPassword_NOMAILSERVER($userEmail,$newPassword){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userResetPassword_NOMAILSERVER($userEmail,$newPassword);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong  resetting the password  in the User Service layer";
        }
    }
    
    public function service_userListSearch($searchTerm){
        $User_DAO = new User_DAO();
        
        try{ 
            $users = $User_DAO->DAO_userListSearch($searchTerm);
            return $users;
        } catch (Exception $ex) {
            echo $ex."something went wrong searching for a user in the User Service layer";
        }
    }
    
    public function service_userGetOtherUser($userID){
        $User_DAO = new User_DAO();
        
        try{ 
            $user = $User_DAO->DAO_userGetOtherUser($userID);
            return $user;
        } catch (Exception $ex) {
            echo $ex."something went wrong getting the user in the User Service layer";
        }
    }
    
    public function service_userUpdateOtherUserInfo($userID, $userName, $userSurname, $userEmail, $UserRole){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userUpdateOtherUserInfo($userID, $userName, $userSurname, $userEmail , $UserRole);
        } catch (Exception $ex) {
            echo $ex."- Something went wrong updating user info in the User Service layer";
        }
    }
    
    public function service_userDeleteOtherUserProfilePicture($userID){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userDeleteOtherUserProfilePicture($userID);
        } catch (Exception $ex) {
            echo $ex."something went wrong deleting the profile picture in the User Service layer";
        }
    }
    
    public function service_userDeleteOtherUser($userID){
        $User_DAO = new User_DAO();
        
        try{ 
            $User_DAO->DAO_userDeleteOtherUser($userID);
        } catch (Exception $ex) {
            echo $ex."something went wrong deleting the user in the User Service layer";
        }
    }
}
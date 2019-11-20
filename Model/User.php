<?php

class User{
    public $userID;
    public $userName;
    public $userSurname;
    public $userEMail;
    public $userPassword;
    public $userRole;
    public $userProfilePicture;
    public $userRegDate;
    
    function user_backgroundColorSelect(){
        echo "<style>
            body {";
                if(isset($_COOKIE['userBackgroundColor'])){
                    echo "background-color:".$_COOKIE['userBackgroundColor'];
                }else{
                    echo "background-color: #6CADDF;";
                }
        echo "}</style>";
    }
    
    function user_userRoleCalc($userRole){
        $role = "";
        switch($userRole){
                        case 0:
                            $role = "User";
                            break;
                        case 1:
                            $role = "Admin";
                            break;
                        case 2:
                            $role = "SuperAdmin";
                            break;
                        default:
                            $role = "User";
                            break;
        }
        
        return $role;
    }
}

?>


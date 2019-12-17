<?php

if(!isset($_POST["resetPasswordSubmit"])){
    header("location:login.php");
}

include 'Logic/User_Service.php';
$User_Service = new User_Service();

/* //ZONDER MAIL SERVER WERKT DEZE CODE NIET. HIERONDER IS DE VERVANGENDE CODE DIE EEN WEBPAGINA OPENT DIE DE MAIL SIMULEERT//////////////////////////////////////////


//Create 2 tokens and convert to Hexadecimal
$selector = random_bytes(8);
$hexSelector =  bin2hex($selector); 
$token = random_bytes(32); 
$hexToken =  bin2hex($token);
        
$url = "www.631290infhaarlem.nl/create-new-password.php?selector=$selector&validator=$token";

$expires = date("U") + 1800; //Expiry date after 1 hour

$userEmail = $_POST["userEMail"];

$User_Service->service_userDeletePwdResetTokens($userEmail);
$User_Service->service_userInsertPwdResetTokens($userEmail,$hexSelector,$token,$expires);

//Creating email
$subject = "Reset your password for 631290infhaarlem.nl";
$message = "<p>We received a password reset request. You can click the link below to reset your password. If you didn't send this request, you may ignore this e-mail.</p>"
        . "<p>Here is your password reset link: <a href=$url>RESET PASSWORD</a></p>";

$headers = "From: 631290InfHaarlem <william@bruijntjes.com>\r\n"
        . "Reply-To: william@bruijntjes.com\r\n"
        . "Content-type: text/html\r\n>";

mail($userEmail, $subject, $message, $headers);

header("location: resetPassword.php?reset=success");*/  




///////////NO MAIL SERVER CODE ///////////////////////////////////////////////////////
$userEmail = strip_tags((string)$_POST['userEMail']);

if(($User_Service->service_userExistCheck($userEmail))){
echo "THIS PAGE IS SUPPOSED TO BE YOUR PERSONAL E-MAIL INBOX. WITHOUT A MAIL SERVER, REAL E-MAILS COULD NOT BE SENT TO AN E-MAIL ADDRESS SO THIS PAGE IS SUPPOSED TO SIMULATE THAT.<br><br>";
echo "<hr>";
    echo "RESET PASSWORD<br><br>"
    . "<p>We received a password reset request. You can click the link below to reset your password. If you didn't send this request, you may ignore this e-mail.</p>"
    . "<p>Here is your password reset link: <a href=resetPassword_createNewPassword.php?userEmail=$userEmail>RESET PASSWORD</a></p>";
}else{
   echo "E-Mail was not sent because the entered e-mail address is not registered on the website. <a href=register.php>Click here to sign up!</a>";
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
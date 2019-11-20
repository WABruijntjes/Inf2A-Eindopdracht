<!-- //ZONDER MAIL SERVER WERKT DEZE CODE NIET --->
<!------<html>
    <head>

      <title>Password Reset</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylesheet.css">
   
    </head>
    <body>
        <div class="logReg-container">
            <h1 class="logReg-container-header"> Password Reset! </h1>
            <div class="logReg-container-center">
                <?php
                    /*$selector = $_GET["selector"];
                    $validator = $_GET["validator"];
                    
                    if(!empty($selector) || !empty($validator)){
                        if(ctype_xdigit($selector) && ctype_xdigit($validator)){
                ?>
                <form action="resetPassword_passwordResetPHP.php" method="POST">
                    <input type="hidden" name="selector" value="<?php echo  $selector; ?>">
                    <input type="hidden" name="validator" value="<?php echo  $validtor; ?>">
                    <input type="password" name="newPassword" placeholder="Enter a new password" required>
                    <input type="password" name="repeatPassword" placeholder="Repeat the new password" required>
                    <button type="submit" name="resetPasswordSubmit">Save new password</button>
                </form>
                <?php
                        }
                    }else{
                        echo "Could not validate your request";
                    }
                      */
                ?>
            </div>
        </div>
    </body>
</html> 
-------------------------------------------------------------------------------------------------------------------------------->

<!--------  NO MAIL SERVER CODE ------------------------------------------------------------------------------------------------>
<html>
    <head>

      <title>Password Reset</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylesheet.css">
   
    </head>
    <body>
        <div class="logReg-container">
            <h1 class="logReg-container-header"> Password Reset </h1>
            <div class="logReg-container-center">
                <form action="resetPassword_passwordResetPHP.php" method="POST">
                    <input type="hidden" name="userEmail" value="<?php echo  $_GET["userEmail"] ?>">
                    <input type="password" name="newPassword" placeholder="Enter a new password" required>
                    <input type="password" name="repeatPassword" placeholder="Repeat the new password" required>
                    <button class="submitButton"type="submit" name="resetPasswordSubmit">Save new password</button>
                </form>
            </div>
        </div>
    </body>
</html>
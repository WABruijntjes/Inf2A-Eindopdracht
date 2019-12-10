<?php
session_start();
?>

<html>
    <head>

      <title>Register</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylesheet.css">
      <script src="scripts/registerJS.js"></script>
    </head>
    <body>
        <div class="logReg-container">
            <h1 class="logReg-container-header"> Register </h1>
            <div class="logReg-container-center">
                <form action="registerPHP.php" method="POST">
                <input type="text" name="userName" placeholder="First name" required>
                <input type="text" name="userSurname" placeholder="Last name" required>
                <input type="email" id="email" name="userEmail" placeholder="E-mail" required onkeyup="checkMail();">
                <input type="password" id="password" name="userPassword" placeholder="Password" required onkeyup="checkPass();">
                <input type="password" id="repeatPassword" name="userRepeatPassword" placeholder="Repeat Password" required onkeyup="checkPass();">
                <span id="emailMessage" class="emailMessage"></span>
                <br>
                <span id="repeatMessage" class="repeatMessage"></span>
                <br><br>
                <button id="submitButton" class="logReg-button" type="submit" name="registerSubmit">Sign Up</button>
              <?php 
                if(isset($_GET["registerUserExists"])){
                    if($_GET["registerUserExists"] == "true"){
                        echo '<p class="errorMessage">An account with this e-mail already exists. <a href=resetPassword.php>Forgot your password?</a></p>';
                    }
                }
                if(isset($_GET["passwordRepeat"])){
                    if($_GET["passwordRepeat"] == "false"){
                        echo '<p class="errorMessage">The passwords do not match</p>';
                    }
                }
                ?>
            </form>
                
                
                Already have an account? <a href="login.php">Log-In</a>
                
            </div>
        </div>
    </body>
</html>
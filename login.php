<?php
session_start();
?>
<html>
    <head>

      <title>Log-In</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylesheet.css">
   
    </head>
    <body>
        <div class="logReg-container">
            <h1 class="logReg-container-header"> Log-In </h1>
            <div class="logReg-container-center">
            <form action="loginPHP.php" method="POST">
                <input type="email" name="userEmail" placeholder="E-Mail" required>
              <input type="password" name="userPassword" placeholder="Password" required>
              <button class="logReg-button" type="submit" name="loginSubmit">Log-In</button>
              <?php 
                if(isset($_GET["login"])){
                    if($_GET["login"] == "failed"){
                        echo '<p class="errorMessage">E-Mail and password combination are incorrect! Try again</p>';
                    }
                }
                if(isset($_GET["passwordReset"])){
                    if($_GET["passwordReset"] == "successs"){
                        echo '<p class="successMessage">Your password has been reset! You may login with your new password now</p>';
                    }
                }
                if(isset($_GET["signUp"])){
                    if($_GET["signUp"] == "succesful"){
                        echo '<p class="successMessage">You have been succesfully registered and can now login with your credentials</p>';
                    }
                }
                ?>
            </form>
                
                Don't have an account yet? <a class="loginPageLink" href="register.php">Sign Up</a>
                <br><br>
                <a class="loginPageLink" href="resetPassword.php">Forgot your password?</a>
                
            </div>
        </div>
    </body>
</html>
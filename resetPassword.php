<html>
    <head>

      <title>Reset Password</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="css/stylesheet.css">
   
    </head>
    <body>
        <div class="logReg-container">
            <h1 class="logReg-container-header"> Password Reset </h1>
            <p>&emsp; An e-mail will be sent to you with instructions on how to reset your password</p>
            <div class="logReg-container-center">
            
                <form action="resetPassword_resetRequestPHP.php" method="POST">
                    <input name="userEMail" type="email" placeholder="Enter your e-mail address..." required>
                    <button class="submitButton" type="submit" name="resetPasswordSubmit">Receive new password by e-mail</button>
                </form>
                <br>
                <a href="login.php"><button class="button backButton">BACK</button></a>
                
                <?php 
                if(isset($_GET["reset"])){
                    if($_GET["reset"] == "successs"){
                        echo '<p class="successsMessage">Check your e-mail!</p>';
                    }
                }
                ?>
            </div>
        </div>
    </body>
</html>
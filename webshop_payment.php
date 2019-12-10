<?php
include_once 'Logic/User_Service.php';
include_once 'Logic/Webshop_Service.php';
include_once 'Model/User.php';
include_once 'Model/Product.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Webshop</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/stylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
    </head>
    <body>
        <?php
            $loggedInUser = $_SESSION['login'];
            $Webshop_Service = new Webshop_Service();
            
            $loggedInUser->user_backgroundColorSelect();
            
            $product = $Webshop_Service->service_getProduct();
        ?>
        <div class="custom-container">
            <div class="custom-container-header">
                <h1>Payment</h1>
            </div>         
            <div class="custom-container-center">
                <div class="progress-bar">
                    <div class="step active"></div>
                    <div class="step"></div>
                    <div class="step"></div>
                    <div class="step"></div>
                </div> 
                <form class="payment">
                    <label>
                        <input type="radio" name="payment" value="Visa" checked>
                        <img class="paymentImage" src="images/Visa.png">
                     </label>

                     <label>
                        <input type="radio" name="payment" value="iDeal">
                        <img class="paymentImage" src="images/iDeal.png">
                     </label>
                    
                    <label>
                        <input type="radio" name="payment" value="PayPal">
                        <img class="paymentImage" src="images/PayPal.png">
                     </label>
                    <br><br>
                    <button type="submit" class="submitButton"><i class="material-icons">payment</i>Pay order</button>
                </form>
                </div>
                <hr>
                <a href="index.php"><button class="backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            
        </div>
    </body>
</html>
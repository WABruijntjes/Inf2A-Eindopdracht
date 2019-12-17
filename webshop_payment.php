<?php
include_once 'Logic/User_Service.php';
include_once 'Logic/Webshop_Service.php';
include_once 'Model/User.php';
include_once 'Model/Product.php';

session_start();

if(!isset($_SESSION['login'])){ //if login in session is not set
    header("Location: index.php");
}

if(!isset($_GET["orderProduct"])){
    header("location:index.php");
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
            
            $product = new product();
            $product->productID = $_GET["productID"];
            $product->productName = $_GET["productName"];
            $product->productPrice = $_GET["productPrice"];
            $product->productImage = $_GET["productImage"];
            
            setcookie("productCookie", serialize($product), time() + 86400); //86400 = 1Day
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
                <h1>Order:</h1>
                <div class="orderSummary">
                    <table>
                            <tr>
                                <td rowspan="2">
                                    <img class="orderProductImage" src="images/<?php echo $product->productImage; ?>">
                                </td>
                                <td class="orderProductName"><?php echo $product->productName ?></td>
                            </tr>
                            <tr>
                                <td class="orderProductPrice">
                                    € <?php echo number_format((float)$product->productPrice, 2, '.', ''); ?>
                                </td>
                            </tr>
                    </table>
                </div>
                <a target="_blank" href="webshop_generateInvoice.php"><button class="button invoiceButton"><i class="material-icons">picture_as_pdf</i>Generate invoice</button></a>
                <form action="webshop_" class="payment" method="GET">
                    <label>
                        <input type="radio" name="payment" value="Visa">
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
                    <button type="submit" class="button submitButton"><i class="material-icons">payment</i>Pay order</button>
                </form>
                </div>
                <hr>
                <a href="webshop.php"><button class="button backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            
        </div>
    </body>
</html>
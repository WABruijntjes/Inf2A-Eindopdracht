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
                <h1>[EXCLUSIVE] <?php echo $product->productName ?> | Limited Stock!</h1>
            </div>
            <div class="custom-container-center">
                <table>
                    <tr>
                        <td rowspan="3">
                            <img class="productImage" src="images/<?php echo $product->productImage ?>">
                        </td>
                        <td class="productTitle" colspan="2">
                            <?php echo $product->productName ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="productDescription">
                            <?php echo $product->productDescription ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="productOrderButton">
                            <form action="webshop_payment.php" method="GET">
                                <input name="productID" type="hidden" value="<?php echo $product->productID ;?>">
                                <input name="productName" type="hidden" value="<?php echo $product->productName ;?>">
                                <input name="productPrice" type="hidden" value="<?php echo $product->productPrice ;?>">
                                <input name="productImage" type="hidden" value="<?php echo $product->productImage ;?>">
                                <input name="orderProduct" type="submit" class="orderButton" value="Order">
                            </form>
                        </td>
                        <td class="productPrice">
                            € <?php echo number_format((float)$product->productPrice, 2, '.', '');  ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="productRating" colspan="3">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><iframe width="100%" height="400" src="<?php echo $product->productVideo ?>" frameborder="0" allow="fullscreen"></iframe></td>
                    </tr>
                </table>
                <hr>
                <a href="index.php"><button class="button button backButton"><i class="material-icons">arrow_back</i>BACK</button></a>
            </div>
        </div>
    </body>
</html>
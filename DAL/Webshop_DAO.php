<?php
include_once 'DAL/dbConfig.php';
include_once 'Model/User.php';
include_once 'Model/UserRole.php';

class Webshop_DAO{

    public function DAO_getProduct(){
        $conn = $GLOBALS['database']->dbconnect();
        
        $webshopQuery = "SELECT * FROM products";
        $stmt = $conn->prepare($webshopQuery);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        $product = new Product();
        
        while ($productInfo = $result->fetch_object())
        { 
            $product->productID = $productInfo->productID;
            $product->productName = $productInfo->productName;
            $product->productDescription = $productInfo->productDescription;
            $product->productPrice = $productInfo->productPrice;
            $product->productImage = $productInfo->productImage;
            $product->productVideo = $productInfo->productVideo;
        }
        
        return $product; 
    }
    
    public function DAO_CRONJOB_changeProductPrice(){
        $randomPrice = rand(10,100);
        
        $conn = $GLOBALS['database']->dbconnect();
        $webshopQuery = "UPDATE products SET productPrice = ?";
        $stmt = $conn->prepare($webshopQuery);
        $stmt->bind_param("d", $randomPrice);
        $stmt->execute();
        
        return $randomPrice;
    }
}

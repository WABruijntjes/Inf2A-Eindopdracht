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
}

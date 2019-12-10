<?php
include_once 'DAL/Webshop_DAO.php';

class Webshop_Service{
    public $Webshop_DAO;
    
    public function service_getProduct(){
        $Webshop_DAO = new Webshop_DAO();
        
        try{ 
            $product = $Webshop_DAO->DAO_getProduct();
            return $product;
            
        } catch (Exception $ex) {
            echo $ex."- Something went wrong getting the product from the database in the service layer";
        }
    }
}


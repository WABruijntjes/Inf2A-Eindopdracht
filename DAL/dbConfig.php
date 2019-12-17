<?php

$GLOBALS['database'] = new database();

class database{
    public function __construct() {
        define ( 'DB_HOST', 'localhost' );
        define ( 'DB_USER', 'root' );//s631290_user
        define ( 'DB_PASSWORD', '' );//4Eo4z7F11
        define ( 'DB_DB', 's631290_eindopdracht' );
        
    }
    
    public function dbconnect() {
        
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD) 
                or die($conn = false);
        
        mysqli_select_db($conn, DB_DB) 
                or die($conn = false);
        
        return $conn;
    }
}


?>

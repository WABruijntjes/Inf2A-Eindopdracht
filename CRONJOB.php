<?php
include_once 'Logic/Webshop_Service.php';

$Webshop_Service = new Webshop_Service();

$price = $Webshop_Service->service_CRONJOB_changeProductPrice();





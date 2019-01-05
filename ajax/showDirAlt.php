<?php

require_once "../controllers/business.controller.php";
require_once "../models/business.model.php";
require_once "../models/connection.php";

header('Content-Type: application/json');

$showBusiness = BusinessController::controllershowAddressAlt($_GET['id']);

foreach($showBusiness as $key => $value){
    $array['data'] = array($showBusiness[$key]);
}
echo json_encode($array);

?>
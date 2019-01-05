<?php

require_once "../controllers/business.controller.php";
require_once "../models/business.model.php";
require_once "../models/connection.php";

header('Content-Type: application/json');

$showBusiness = BusinessController::controllershowBusinessAjax();

foreach($showBusiness as $key => $value){
    $array[] = $showBusiness[$key]['commercial_name'];
}
echo json_encode($array);

?>
<?php

require_once "controllers/template.controller.php";
require_once "controllers/user.controller.php";
require_once "controllers/contact.controller.php";
require_once "controllers/business.controller.php";
require_once "controllers/owner.controller.php";

require_once "models/user.model.php";
require_once "models/contact.model.php";
require_once "models/business.model.php";
require_once "models/owner.model.php";
require_once "models/template.model.php";


require_once "models/route.php";

require_once "models/helper.php";


if(isset($_GET['view'])){

    $viewsJSON = explode("/", $_GET["view"]);

    $value1json = $viewsJSON[0];
    if(isset($viewsJSON[1]) && $value1json == 'jsonFiles'){

        $value2json = $viewsJSON[1];
        include 'views/modules/json_files/json_files.php';

    } else {
        $template = new ControllerTemplate();
        
        $template -> template();
    }
    
} else {
    $template = new ControllerTemplate();
    
    $template -> template();
}




?>
<?php

require_once "controllers/template.controller.php";
require_once "controllers/user.controller.php";
require_once "controllers/contact.controller.php";
require_once "controllers/business.controller.php";
require_once "controllers/owner.controller.php";
require_once "controllers/contract.controller.php";

require_once "models/user.model.php";
require_once "models/contact.model.php";
require_once "models/business.model.php";
require_once "models/owner.model.php";
require_once "models/template.model.php";
require_once "models/contract.model.php";


require_once "models/route.php";

require_once "models/helper.php";
  
require __DIR__."/vendor/autoload.php"; 

$template = new ControllerTemplate();

$template -> template();
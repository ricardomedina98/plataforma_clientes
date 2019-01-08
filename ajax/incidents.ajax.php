<?php

require_once "../controllers/contact.controller.php";
require_once "../models/contact.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";

class IncidentsAjax{

    public $id_incident;

    public function ajaxAddIncident(){

       $datos = array("id_incident" => $this->id_incident);

        
        $request = ContactController::controllerAddIncident($datos);

        echo json_encode($request, true);

    }


}

if(isset($_POST["id_user"])){
    $incidents = new IncidentsAjax();
    $incidents -> id_incident = $_POST['id_incident'];

    $incidents ->ajaxAddIncident();
}

?>
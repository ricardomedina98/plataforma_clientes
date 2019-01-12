<?php

require_once "../controllers/contact.controller.php";
require_once "../models/contact.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";

class IncidentsAjax{

    public $id_incident;

    public function ajaxShowOneIncident(){

       $data = array("id_incident" => $this->id_incident);

        
        $request = ContactController::controllerShowOneIndicents($data);

        echo json_encode($request, true);

    }

    public function ajaxDeleteIncident(){

        $data = array("id_incident" => $this->id_incident);
 
         
         $request = ContactController::controllerDeleteIncident($data);
 
         echo json_encode($request, true);
 
     }


}

if(isset($_POST["id_incident"])){
    $incidents = new IncidentsAjax();
    $incidents -> id_incident = $_POST['id_incident'];
    $incidents ->ajaxShowOneIncident();
}

if(isset($_POST["id_incident_delete"])){
    $incidents = new IncidentsAjax();
    $incidents -> id_incident = $_POST['id_incident_delete'];
    $incidents ->ajaxDeleteIncident();
}

?>
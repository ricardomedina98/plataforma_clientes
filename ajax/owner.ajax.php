<?php

require_once "../controllers/owner.controller.php";
require_once "../models/owner.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";

class AjaxOwner{

    public $id_owner_delete;

    public function ajaxDeleteOwner(){

        $data = array("id_owner_delete" => $this->id_owner_delete);

        $request = OwnerController::controllerDeleteOwner($data);

        echo json_encode($request);

    }

}

if(isset($_POST['id_owner_delete'])){
    $deleteOwner = new AjaxOwner();
    $deleteOwner -> id_owner_delete = $_POST['id_owner_delete'];
    $deleteOwner -> ajaxDeleteOwner();
}

?>
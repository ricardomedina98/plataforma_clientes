<?php

    require_once "../controllers/business.controller.php";
    require_once "../models/business.model.php";
    require_once "../models/helper.php";
    require_once "../models/connection.php";


    class AjaxBusiness{

        public $id_user_addressAlt;
        public $id_business_delete;

        public function ajaxEditAddressAlt(){

            $datos = array("id_user_address" => $this->id_user_addressAlt);

            $request = BusinessController::controllerShowOneAddress($datos);

            echo json_encode($request);

        }

        public function ajaxDeleteBusiness(){

            $datos = array("id_user_address" => $this->id_user_addressAlt);

            $request = BusinessController::controllerDeleteBusiness($datos);

            echo json_encode($request);

        }

    }


    if(isset($_POST['id_user_address'])){
        $businessAddress = new AjaxBusiness();
        $businessAddress -> id_user_addressAlt = $_POST['id_user_address'];
        $businessAddress -> ajaxEditAddressAlt();
    }

    if(isset($_POST['id_business_delete'])){
        $businessAddress = new AjaxBusiness();
        $businessAddress -> id_user_addressAlt = $_POST['id_business_delete'];
        $businessAddress -> ajaxDeleteBusiness();
    }

?>
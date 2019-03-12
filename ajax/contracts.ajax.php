<?php

require_once "../controllers/contract.controller.php";
require_once "../models/contract.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";




class ContractAjax{

    public $id_employee;

    public function ajaxShowOneEmployee(){       
        
        $request = ContractController::controllerShowOneEmployee($this->id_employee);

        echo json_encode($request, true);

    }

    public function ajaxDeleteEmployee(){       
        
        $request = ContractController::controllerDeleteEmployee($this->id_employee);

        echo json_encode($request, true);

    }

}

if(isset($_POST["id_employeeEdit"])){
    $incidents = new ContractAjax();
    $incidents -> id_employee = $_POST['id_employeeEdit'];
    $incidents ->ajaxShowOneEmployee();
}

if(isset($_POST["id_employeeDelete"])){
    $incidents = new ContractAjax();
    $incidents -> id_employee = $_POST['id_employeeDelete'];
    $incidents ->ajaxDeleteEmployee();
}




?>
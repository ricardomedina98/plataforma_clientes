<?php

require_once "../controllers/employee.controller.php";
require_once "../models/employee.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";




class ContractAjax{

    public $id_employee;
    public $data;

    public function ajaxShowOneEmployee(){       
        
        $request = EmployeeController::controllerShowOneEmployee($this->id_employee);

        echo json_encode($request, true);

    }

    public function ajaxDeleteEmployee(){       
        
        $request = EmployeeController::controllerDeleteEmployee($this->id_employee);

        echo json_encode($request, true);

    }

    public function ajaxUpdateContract() {
        $request = EmployeeController::controllerUpdateContract($this->data);

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

if(count($_POST) == 7) {
    $contract = new ContractAjax();
    $contract -> data = $_POST;
    $contract ->ajaxUpdateContract();
}




?>
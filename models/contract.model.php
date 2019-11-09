<?php

require_once "connection.php";

class ModelContract{

    public static function modelCreateEmployee($data){

        $connection = Connection::connect();

        $connection->beginTransaction();

        $createEmployee = $connection -> prepare("INSERT INTO employees (name_employee, first_surname, second_surname, sex_employee, 
                                                        position_employee, date_birthday_empl, civil_status, nss_employee, num_employee)
        VALUES (:name_employee, :first_surname, :second_surname, :sex_employee, :position_employee, :date_birthday_empl, :civil_status, :nss_employee, :num_employee)");

        $createEmployee -> bindParam(":name_employee", $data['nameEmployee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":first_surname", $data['surName1Employee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":second_surname", $data['surName2Employee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":sex_employee", $data['sexEmployee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":position_employee", $data['position_employee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":date_birthday_empl", $data['birthdayEmployee'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":civil_status", $data['civil_status'], PDO::PARAM_STR);
        $createEmployee -> bindParam(":nss_employee", $data['nss_employee'], PDO::PARAM_STR);
        $num_employee = (empty($data['num_employee']) ? null : $data['num_employee']);
        $createEmployee -> bindParam(":num_employee", $num_employee, PDO::PARAM_STR);

        if($createEmployee->execute()){

            $id = (int)$connection->lastInsertId();

            $createEmpAddressBirth = $connection -> prepare("INSERT INTO addressBirthday_employee (id_employee, placeCityBirthday, placeStateBirthday)
            VALUES (:id_employee, :placeCityBirthday, :placeStateBirthday)");

            $createEmpAddress = $connection -> prepare("INSERT INTO employee_address (id_employee, state, city, street, colony, postal_code)
            VALUES (:id_employee, :state, :city, :street, :colony, :postal_code)");

            $createEmpInfoContract = $connection -> prepare("INSERT INTO employees_contract_info (id_employee, start_contract, end_contract, contract_created, weekly_balance, punctuality_award, attendance_prize)
            VALUES (:id_employee, :start_contract, :end_contract, :contract_created, :weekly_balance, :punctuality_award, :attendance_prize)");
            
            $createEmpAddressBirth -> bindParam(":id_employee", $id, PDO::PARAM_INT);
            $createEmpAddressBirth -> bindParam(":placeCityBirthday", $data['addressCityPlaceBirth'], PDO::PARAM_STR);
            $createEmpAddressBirth -> bindParam(":placeStateBirthday", $data['addressStatePlaceBirth'], PDO::PARAM_STR);

            $createEmpAddress -> bindParam(":id_employee", $id, PDO::PARAM_INT);
            $createEmpAddress -> bindParam(":state", $data['addressStateA'], PDO::PARAM_STR);
            $createEmpAddress -> bindParam(":city", $data['addressCityA'], PDO::PARAM_STR);
            $createEmpAddress -> bindParam(":street", $data['addressStreet'], PDO::PARAM_STR);
            $createEmpAddress -> bindParam(":colony", $data['addressColony'], PDO::PARAM_STR);
            $createEmpAddress -> bindParam(":postal_code", $data['addressCodePostal'], PDO::PARAM_STR);

            $createEmpInfoContract -> bindParam(":id_employee", $id, PDO::PARAM_INT);
            $createEmpInfoContract -> bindParam(":start_contract", $data["dateTimeContract"]["Start"], PDO::PARAM_STR);
            $createEmpInfoContract -> bindParam(":end_contract", $data["dateTimeContract"]["End"], PDO::PARAM_STR);
            $createEmpInfoContract -> bindParam(":contract_created", $data['contract_created'], PDO::PARAM_STR);
            $createEmpInfoContract -> bindParam(":weekly_balance", $data['monthly_balance'], PDO::PARAM_STR);
            $createEmpInfoContract -> bindParam(":punctuality_award", $data['punctuality_award'], PDO::PARAM_STR);
            $createEmpInfoContract -> bindParam(":attendance_prize", $data['attendance_prize'], PDO::PARAM_STR);            

            $createEmpAddressBirthbool = $createEmpAddressBirth -> execute();
            $createEmpAddressbool = $createEmpAddress -> execute();
            $createEmpInfoContractbool = $createEmpInfoContract -> execute();
            if($createEmpAddressBirth -> execute() && $createEmpAddress -> execute() && $createEmpInfoContract -> execute()){
                $connection->commit();
                return true;
            } else {
                $connection->rollback();
                return false;
            }
        } else {
            $connection->rollback();
                return false;
        }

        
    }

    public static function modelShowEmployees(){

        $showEmployees = Connection::connect() -> prepare("SELECT * FROM view_employees_a;");

        $showEmployees -> execute();        
        
        $request = $showEmployees -> fetchAll(PDO::FETCH_ASSOC);
    
        return $request;

    }

    public static function modelShowOneEmployees($id_employee){

        $showEmployees = Connection::connect() -> prepare("select * from view_employees_a where id_employee = :id_employee");


        $showEmployees -> bindParam(":id_employee", $id_employee, PDO::PARAM_INT);        

        $showEmployees -> execute();    
                    
        $request = $showEmployees -> fetch(PDO::FETCH_ASSOC);
    
        return $request;
    }

    public static function modelUpdateEmployee($data){
        
        $connection = Connection::connect();
        $connection->beginTransaction();

        $updateEmployee = $connection-> prepare("UPDATE employees e SET name_employee = :name_employee, first_surname = :first_surname, second_surname = :second_surname, sex_employee = :sex_employee,
        position_employee = :position_employee, date_birthday_empl = :date_birthday_empl, civil_status = :civil_status, nss_employee = :nss_employee, 
        num_employee = :num_employee WHERE id_employee = :id_employee");
        
        $updateEmpAddressBirth = $connection -> prepare("UPDATE addressbirthday_employee SET placeCityBirthday = :placeCityBirthday, placeStateBirthday = :placeStateBirthday WHERE id_employee = :id_employee");

        $updateEmpAddress = $connection -> prepare("UPDATE employee_address SET state = :state, city = :city, street = :street, colony = :colony, postal_code = :postal_code WHERE id_employee = :id_employee;");

        $updateEmpInfoContract = $connection -> prepare("UPDATE employees_contract_info SET start_contract = :start_contract, end_contract = :end_contract, contract_created = :contract_created, weekly_balance = :weekly_balance,
        punctuality_award = :punctuality_award, attendance_prize = :attendance_prize WHERE id_employee = :id_employee;");
        
        $updateEmployee -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmployee -> bindParam(":name_employee", $data['nameEmployee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":first_surname", $data['surName1Employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":second_surname", $data['surName2Employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":sex_employee", $data['sexEmployee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":position_employee", $data['position_employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":date_birthday_empl", $data['birthdayEmployee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":civil_status", $data['civil_status'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":nss_employee", $data['nss_employee'], PDO::PARAM_STR);
        $num_employee = (empty($data['num_employee']) ? null : $data['num_employee']);
        $updateEmployee -> bindParam(":num_employee", $num_employee, PDO::PARAM_INT);
        
        $updateEmpAddressBirth -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmpAddressBirth -> bindParam(":placeCityBirthday", $data['addressCityPlaceBirth'], PDO::PARAM_STR);
        $updateEmpAddressBirth -> bindParam(":placeStateBirthday", $data['addressStatePlaceBirth'], PDO::PARAM_STR);

        $updateEmpAddress -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmpAddress -> bindParam(":state", $data['addressStateA'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":city", $data['addressCityA'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":street", $data['addressStreet'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":colony", $data['addressColony'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":postal_code", $data['addressCodePostal'], PDO::PARAM_STR);

        $updateEmpInfoContract -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmpInfoContract -> bindParam(":start_contract", $data["dateTimeContract"]["Start"], PDO::PARAM_STR);
        $updateEmpInfoContract -> bindParam(":end_contract", $data["dateTimeContract"]["End"], PDO::PARAM_STR);
        $updateEmpInfoContract -> bindParam(":contract_created", $data['contract_created'], PDO::PARAM_STR);
        $updateEmpInfoContract -> bindParam(":weekly_balance", $data['monthly_balance'], PDO::PARAM_STR);
        $updateEmpInfoContract -> bindParam(":punctuality_award", $data['punctuality_award'], PDO::PARAM_STR);
        $updateEmpInfoContract -> bindParam(":attendance_prize", $data['attendance_prize'], PDO::PARAM_STR);
                

        if ($updateEmployee -> execute() && $updateEmpAddressBirth -> execute() 
            && $updateEmpAddress -> execute() && $updateEmpInfoContract->execute()){            
            $connection->commit();
            return true;
        } else {
            $connection->rollback();
            return false;
        }
        
    }

    public static function modelDeleteEmployee($id_employee){

        $deleteEmployee = Connection::connect() -> prepare("UPDATE employees e set e.status_employee = 'I' WHERE e.id_employee = :id_employee");

        $deleteEmployee -> bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $rowsAffected = $deleteEmployee->rowCount();

        if ($deleteEmployee -> execute() && $rowsAffected>0){
            return true;
        } else {
            return false;
        }
    }

}
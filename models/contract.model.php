<?php

require_once "connection.php";

class ModelContract{

    public static function modelCreateContract($data){

        $stmt = Connection::connect() -> prepare("CALL create_employee(:nameEmployee, :surName1Employee, :surName2Employee, :sexEmployee, :position_employee, :birthdayEmployee, :civil_status, :nss_employee, :num_employee, :addressCityPlaceBirth, :addressStatePlaceBirth,
                                                :addressStateA, :addressCityA, :addressStreet, :addressColony, :addressCodePostal,
                                                :dateTimeStartContract, :dateTimeEndContract, :contract_created, :monthly_balance, :punctuality_award, :attendance_prize
                                                )");

        $stmt -> bindParam(":nameEmployee", $data['nameEmployee'], PDO::PARAM_STR);
        $stmt -> bindParam(":surName1Employee", $data['surName1Employee'], PDO::PARAM_STR);
        $stmt -> bindParam(":surName2Employee", $data['surName2Employee'], PDO::PARAM_STR);
        $stmt -> bindParam(":sexEmployee", $data['sexEmployee'], PDO::PARAM_STR);
        $stmt -> bindParam(":position_employee", $data['position_employee'], PDO::PARAM_STR);
        $stmt -> bindParam(":birthdayEmployee", $data['birthdayEmployee'], PDO::PARAM_STR);
        $stmt -> bindParam(":civil_status", $data['civil_status'], PDO::PARAM_STR);
        $stmt -> bindParam(":nss_employee", $data['nss_employee'], PDO::PARAM_STR);
        $stmt -> bindParam(":num_employee", $data['num_employee'], PDO::PARAM_STR);
        
        $stmt -> bindParam(":addressCityPlaceBirth", $data['addressCityPlaceBirth'], PDO::PARAM_STR);
        $stmt -> bindParam(":addressStatePlaceBirth", $data['addressStatePlaceBirth'], PDO::PARAM_STR);

        $stmt -> bindParam(":addressStateA", $data['addressStateA'], PDO::PARAM_STR);
        $stmt -> bindParam(":addressCityA", $data['addressCityA'], PDO::PARAM_STR);
        $stmt -> bindParam(":addressStreet", $data['addressStreet'], PDO::PARAM_STR);
        $stmt -> bindParam(":addressColony", $data['addressColony'], PDO::PARAM_STR);
        $stmt -> bindParam(":addressCodePostal", $data['addressCodePostal'], PDO::PARAM_STR);

        $stmt -> bindParam(":dateTimeStartContract", $data["dateTimeContract"]["Start"], PDO::PARAM_STR);
        $stmt -> bindParam(":dateTimeEndContract", $data["dateTimeContract"]["End"], PDO::PARAM_STR);

        $stmt -> bindParam(":contract_created", $data['contract_created'], PDO::PARAM_STR);
        $stmt -> bindParam(":monthly_balance", $data['monthly_balance'], PDO::PARAM_STR);
        $stmt -> bindParam(":punctuality_award", $data['punctuality_award'], PDO::PARAM_STR);
        $stmt -> bindParam(":attendance_prize", $data['attendance_prize'], PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        } else {
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

        $showEmployees = Connection::connect() -> prepare("
        
        SELECT empl.id_employee, name_employee, first_surname, second_surname, sex_employee, position_employee, 
		date_birthday_empl, civil_status,nss_employee, num_employee, status_employee,
        
        placeCityBirthday, placeStateBirthday,
        
        state, city, street, colony, postal_code,
        
        start_contract, end_contract, contract_created, weekly_balance, punctuality_award, attendance_prize
        
        FROM employees empl inner join addressBirthday_employee Baddress on empl.id_employee = Baddress.id_employee
            inner join employee_address emplAddress on empl.id_employee = emplAddress.id_employee 
            inner join employees_contract_info infoContract on empl.id_employee = infoContract.id_employee
            WHERE status_employee = 'A' AND empl.id_employee = :id_employee"
        
        );


        $showEmployees -> bindParam(":id_employee", $id_employee, PDO::PARAM_STR);        

        $showEmployees -> execute();    
                    
        $request = $showEmployees -> fetch(PDO::FETCH_ASSOC);
    
        return $request;
    }

    public static function modelUpdateEmployee(){
        
    }

}
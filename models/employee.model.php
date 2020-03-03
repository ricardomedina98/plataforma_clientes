<?php

require_once "connection.php";

class EmployeeModel{

    public static function modelCreateEmployee($data){

        $connection = Connection::connect();
        $connection->beginTransaction();

        $employee = $connection -> prepare("insert into employees(name_employee, first_surname, second_surname, sex, category, position, civil_status, nss_employee, num_employee)
        values (:name_employee, :first_surname, :second_surname, :sex, :category, :position, :civil_status, :nss_employee, :num_employee);");

        $num_employee = (empty($data['num_employee']) ? null : $data['num_employee']);
        $employee -> bindParam(":num_employee", $num_employee, PDO::PARAM_STR);

        $employee -> bindParam(":name_employee", $data['nameEmployee'], PDO::PARAM_STR);
        $employee -> bindParam(":first_surname", $data['surName1Employee'], PDO::PARAM_STR);
        $employee -> bindParam(":second_surname", $data['surName2Employee'], PDO::PARAM_STR);
        $employee -> bindParam(":sex", $data['sexEmployee'], PDO::PARAM_STR);
        $employee -> bindParam(":position", $data['position_employee'], PDO::PARAM_STR);
        $employee -> bindParam(":category", $data['category_employee'], PDO::PARAM_STR);        
        $employee -> bindParam(":civil_status", $data['civil_status'], PDO::PARAM_STR);
        $employee -> bindParam(":nss_employee", $data['nss_employee'], PDO::PARAM_STR);

        if($employee->execute()) {
            $id_employee = (int)$connection->lastInsertId();
    
            $employeeAddress = $connection -> prepare("insert into employee_address(id_employee, state, city, street, colony, postal_code) 
                values (:id_employee, :state, :city, :street, :colony, :postal_code)");
    
            $employeeAddress -> bindParam(":id_employee", $id_employee, PDO::PARAM_STR);
            $employeeAddress -> bindParam(":street", $data['street'], PDO::PARAM_STR);
            $employeeAddress -> bindParam(":colony", $data['colony'], PDO::PARAM_STR);
            $employeeAddress -> bindParam(":city", $data['city'], PDO::PARAM_STR);
            $employeeAddress -> bindParam(":state", $data['state'], PDO::PARAM_STR);
            $employeeAddress -> bindParam(":postal_code", $data['postal_code'], PDO::PARAM_STR);
    
            if($employeeAddress->execute()){
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

        $showEmployees = Connection::connect() -> prepare("select e.id_employee, e.name_employee, e.first_surname, second_surname,
		e.sex, e.category, e.position, e.civil_status, e.nss_employee, 
            e.num_employee, e.status, c.id_contract, c.begin_contract, c.end_contract from employees e
            left join contract c on e.id_employee = c.id_employee
            where status = 'A';");

        $showEmployees -> execute();        
        
        $request = $showEmployees -> fetchAll(PDO::FETCH_ASSOC);
    
        return $request;

    }

    public static function modelShowOneEmployees($id_employee){

        $showEmployees = Connection::connect() -> prepare("SELECT e.id_employee, e.name_employee, e.first_surname, 
        e.second_surname, e.sex, e.category,
        e.position, e.civil_status, e.nss_employee, e.num_employee, e.status, e.created_at, e.updated_at,
		ea.id_employee_address, ea.id_employee, ea.state, ea.city, ea.street, ea.colony, ea.postal_code,
        c.begin_contract, c.end_contract, c.contract_created, c.daily_balance, c.weekly_balance,
        c.punctuality_award, c.assistance_award, c.id_contract, c.created_at, c.updated_at
        FROM employees e 
        INNER JOIN employee_address ea on e.id_employee = ea.id_employee
        LEFT JOIN contract c on c.id_employee = e.id_employee
        WHERE e.id_employee = :id_employee AND e.status = 'A';");


        $showEmployees -> bindParam(":id_employee", $id_employee, PDO::PARAM_INT);        

        $showEmployees -> execute();    
                    
        $request = $showEmployees -> fetch(PDO::FETCH_ASSOC);
    
        return $request;
    }

    public static function modelUpdateEmployee($data){
        
        $connection = Connection::connect();
        $connection->beginTransaction();

        $updateEmployee = $connection-> prepare("UPDATE employees SET name_employee = :name_employee, first_surname = :first_surname, second_surname = :second_surname, sex = :sex, category =  :category,
		position = :position, civil_status = :civil_status, nss_employee = :nss_employee, num_employee = :num_employee, updated_at = NOW() WHERE id_employee = :id_employee;");
        
        

        $updateEmpAddress = $connection -> prepare("UPDATE employee_address SET state = :state, city = :city, street = :street, colony = :colony, postal_code = :postal_code WHERE id_employee = :id_employee;");

        $num_employee = (empty($data['num_employee']) ? null : $data['num_employee']);
        
        $updateEmployee -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmployee -> bindParam(":name_employee", $data['nameEmployee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":first_surname", $data['surName1Employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":second_surname", $data['surName2Employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":sex", $data['sexEmployee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":category", $data['category_employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":position", $data['position_employee'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":civil_status", $data['civil_status'], PDO::PARAM_STR);
        $updateEmployee -> bindParam(":nss_employee", $data['nss_employee'], PDO::PARAM_STR); 
        $updateEmployee -> bindParam(":num_employee", $num_employee, PDO::PARAM_INT);       

        $updateEmpAddress -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateEmpAddress -> bindParam(":state", $data['state'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":city", $data['city'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":street", $data['street'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":colony", $data['colony'], PDO::PARAM_STR);
        $updateEmpAddress -> bindParam(":postal_code", $data['postal_code'], PDO::PARAM_STR);

        if ($updateEmployee -> execute() 
        && $updateEmpAddress -> execute()){            
            $connection->commit();
            return true;
        } else {
            $connection->rollback();
            return false;
        }
        
    }

    public static function modelDeleteEmployee($id_employee){

        $deleteEmployee = Connection::connect() -> prepare("UPDATE employees set status = 'I' WHERE id_employee = :id_employee");

        $deleteEmployee -> bindParam(":id_employee", $id_employee, PDO::PARAM_INT);

        $rowsAffected = $deleteEmployee->rowCount();

        if ($deleteEmployee -> execute() && $rowsAffected>0){
            return true;
        } else {
            return false;
        }
    }

    public static function modelUpdateContract($data){

        $updateContract = Connection::connect() -> prepare("update contract set begin_contract = :begin_contract, end_contract = :end_contract, weekly_balance = :weekly_balance, punctuality_award = :punctuality_award, assistance_award = :assistance_award, daily_balance = :daily_balance, updated_at = now() where id_employee = :id_employee");

        $updateContract -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);
        $updateContract -> bindParam(":begin_contract", $data['begin_contract'], PDO::PARAM_STR);
        $updateContract -> bindParam(":end_contract", $data['end_contract'], PDO::PARAM_STR);
        $updateContract -> bindParam(":weekly_balance", $data['weekly_balance'], PDO::PARAM_STR);
        $updateContract -> bindParam(":daily_balance", $data['daily_balance'], PDO::PARAM_STR);        
        $updateContract -> bindParam(":punctuality_award", $data['punctuality_award'], PDO::PARAM_STR);
        $updateContract -> bindParam(":assistance_award", $data['assistance_award'], PDO::PARAM_STR);

        if ($updateContract -> execute()){
            return true;
        } else {
            return false;
        }
    }

    public static function modelCreateContract($data){

        $createContract = Connection::connect() -> prepare("
        insert into contract(id_employee, begin_contract, 
                            end_contract, weekly_balance, 
                            punctuality_award, assistance_award, daily_balance, contract_created)
                    values (:id_employee, :begin_contract, 
                            :end_contract, :weekly_balance,
                            :punctuality_award, :assistance_award, :daily_balance, :contract_created);
        ");

        $createContract -> bindParam(":id_employee", $data['id_employee'], PDO::PARAM_INT);  
        $createContract -> bindParam(":begin_contract", $data['begin_contract'], PDO::PARAM_STR);
        $createContract -> bindParam(":end_contract", $data['end_contract'], PDO::PARAM_STR);
        $createContract -> bindParam(":weekly_balance", $data['weekly_balance'], PDO::PARAM_STR);
        $createContract -> bindParam(":punctuality_award", $data['punctuality_award'], PDO::PARAM_STR);
        $createContract -> bindParam(":assistance_award", $data['assistance_award'], PDO::PARAM_STR);
        $createContract -> bindParam(":daily_balance", $data['daily_balance'], PDO::PARAM_STR);
        $createContract -> bindParam(":contract_created", $data['begin_contract'], PDO::PARAM_STR);

        if ($createContract -> execute()){
            return true;
        } else {
            return false;
        }
    }

}

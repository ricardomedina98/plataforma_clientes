<?php
    
    class EmployeeController{

        public static function controllerCreateEmployee(){

            if(isset($_POST['addEmployee'])){
                
                $data = array('nameEmployee' => $_POST['nameEmployee'], 'surName1Employee' => $_POST['surName1Employee'],
                             'surName2Employee' => $_POST['surName2Employee'], 
                             'sexEmployee' => $_POST['sexEmployee'], 
                             'civil_status' => $_POST['civil_status'], 
                             'nss_employee' => $_POST['nss_employee'], 
                             'num_employee' => $_POST['num_employee'],                             
                             'category_employee' => $_POST['category_employee'],
                             'position_employee' => $_POST['position_employee'],
                             'street' => $_POST['addressStreet'],
                             'colony' => $_POST['addressColony'],
                             'city' => $_POST['addressCity'],
                             'state' =>$_POST['addressState'],
                             'postal_code' => $_POST['addressCodePostal'] 
                );
                
                $request = EmployeeModel::modelCreateEmployee($data);      
                
                return $request;
            }

        }

        public static function controllerUpdateEmployee(){
            
            if(isset($_POST['updateEmployee'])){
                
                $data = array(
                            'id_employee' => $_POST['id_employee'],
                            'nameEmployee' => $_POST['nameEmployee'], 'surName1Employee' => $_POST['surName1Employee'],
                            'surName2Employee' => $_POST['surName2Employee'], 'sexEmployee' => $_POST['sexEmployee'], 
                            'civil_status' => $_POST['civil_status'], 'nss_employee' => $_POST['nss_employee'], 
                            'birthdayEmployee' => Helper::fixDate($_POST['birthdayEmployee']), 

                            'num_employee' => $_POST['num_employee'],
                            
                            'addressCityPlaceBirth' => $_POST['addressCityPlaceBirth'],                             
                            'addressStatePlaceBirth' => $_POST['addressStatePlaceBirth'], 
                            
                            'position_employee' => $_POST['position_employee'],

                            'addressStreet' => $_POST['addressStreet'], 
                            'addressColony' => $_POST['addressColony'], 
                            'addressCodePostal'=> $_POST['addressCodePostal'],
                            'addressCityA' => $_POST['addressCityA'], 
                            'addressStateA' => $_POST['addressStateA'], 

                            'dateTimeContract' => Helper::RangeDateFix($_POST['dateTimeContract']),
                            'contract_created' => Helper::fixDateTime($_POST['contract_created']),
                            'monthly_balance' => $_POST['monthly_balance'],
                            'punctuality_award' => $_POST['punctuality_award'],
                            'attendance_prize' => $_POST['attendance_prize']
                );
                
                $request = EmployeeModel::modelUpdateEmployee($data);  
                
                return $request;
            }
        }

        public static function controllerShowEmployees(){

            $request = EmployeeModel::modelShowEmployees();

            return $request;

        }

        public static function controllerShowOneEmployee($id_employee){

            $request = EmployeeModel::modelShowOneEmployees($id_employee);

            $request = array('id_employee' => $request['id_employee'], 
                             'nameEmployee' => $request['name_employee'], 'surName1Employee' => $request["first_surname"],
                             'surName2Employee' => $request["second_surname"], 'sexEmployee' => $request["sex_employee"], 
                             'civil_status' => $request["civil_status"], 'nss_employee' => $request["nss_employee"], 
                             'num_employee' => $request['num_employee'],

                             'birthdayEmployee' => Helper::ConvertDate($request["date_birthday_empl"]), 
                             
                             'num_employee' => $request["num_employee"],

                             'addressCityPlaceBirth' => $request['placeCityBirthday'],                             
                             'addressStatePlaceBirth' => $request['placeStateBirthday'], 
                             
                             'position_employee' => $request["position_employee"],

                             'addressStreet' => $request["street"], 
                             'addressColony' => $request["colony"], 
                             'addressCodePostal'=> $request["postal_code"],
                             'addressCityA' => $request["city"], 
                             'addressStateA' => $request["state"], 

                             'start_contract' => Helper::ConvertRangeDatesStart($request['start_contract']),
                             'end_contract' => Helper::ConvertRangeDatesEnd($request['end_contract']),
                             
                             'contract_created' => $request['contract_created'],
                             'weekly_balance' => $request['weekly_balance'],
                             'punctuality_award' => $request['punctuality_award'],
                             'attendance_prize' => $request['attendance_prize']
            );

            return $request;
        }

        public static function controllerShowOneEmployeePDF($id_employee){

            $request = EmployeeModel::modelShowOneEmployees($id_employee);

            $request = array('id_employee' => $request['id_employee'], 
                             'nameEmployee' => $request['name_employee'], 'surName1Employee' => $request["first_surname"],
                             'surName2Employee' => $request["second_surname"], 'sexEmployee' => $request["sex_employee"], 
                             'civil_status' => $request["civil_status"], 'nss_employee' => $request["nss_employee"], 
                             'num_employee' => $request['num_employee'],

                             'birthdayEmployee' => $request["date_birthday_empl"], 
                             
                             'num_employee' => $request["num_employee"],

                             'addressCityPlaceBirth' => $request['placeCityBirthday'],                             
                             'addressStatePlaceBirth' => $request['placeStateBirthday'], 
                             
                             'position_employee' => $request["position_employee"],

                             'addressStreet' => $request["street"], 
                             'addressColony' => $request["colony"], 
                             'addressCodePostal'=> $request["postal_code"],
                             'addressCityA' => $request["city"], 
                             'addressStateA' => $request["state"], 

                             'start_contract' => $request['start_contract'],
                             'end_contract' => $request['end_contract'],
                             
                             'contract_created' => $request['contract_created'],
                             'weekly_balance' => $request['weekly_balance'],
                             'punctuality_award' => $request['punctuality_award'],
                             'attendance_prize' => $request['attendance_prize']
            );

            return $request;
        }

        public static function controllerDeleteEmployee($id_employee){

            $request = EmployeeModel::modelDeleteEmployee($id_employee);
            return $request;

        }
        
    }

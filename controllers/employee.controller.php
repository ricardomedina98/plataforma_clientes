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

                return EmployeeModel::modelCreateEmployee($data);
            }

        }

        public static function controllerUpdateEmployee(){
            
            if(isset($_POST['updateEmployee'])){
                
                $data = array(
                    'id_employee' => $_POST['id_employee'],
                    'nameEmployee' => $_POST['nameEmployee'], 'surName1Employee' => $_POST['surName1Employee'],
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

                return EmployeeModel::modelUpdateEmployee($data);
            }
        }

        public static function controllerShowEmployees(){

            return EmployeeModel::modelShowEmployees();

        }

        public static function controllerShowOneEmployee($id_employee){

            return EmployeeModel::modelShowOneEmployees($id_employee);
        }

        public static function controllerDeleteEmployee($id_employee){

            return EmployeeModel::modelDeleteEmployee($id_employee);

        }

        public static function controllerUpdateContract($data){

            return EmployeeModel::modelUpdateContract($data);

        }

        public static function controllerCreateContract(){
            
            if(isset($_POST['createContract'])){                         
                
                $data = array(
                    'id_employee' => $_POST['id_employee'],
                    'begin_contract' => $_POST['begin_contract'],
                    'end_contract' => $_POST['end_contract'],
                    'weekly_balance' => $_POST['weekly_balance'],
                    'daily_balance' => $_POST['daily_balance'],
                    'punctuality_award' => $_POST['punctuality_award'],
                    'assistance_award' => $_POST['assistance_award']
                );

                return EmployeeModel::modelCreateContract($data);
            }
        }
        
    }

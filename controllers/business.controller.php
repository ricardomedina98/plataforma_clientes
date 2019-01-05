<?php

class BusinessController{

    public static function controllerAddBusiness(){

        if(isset($_POST['saveBusiness']) || isset($_POST['saveShowBusiness'])){

            $data = $_POST;
            $mode = null;

            if(!empty($_FILES['imageProfileBusiness']['tmp_name'])){
                $data['profile_photo'] = $_FILES['imageProfileBusiness']['tmp_name'];
            }

            if(isset($_POST['saveBusiness'])){
                $mode = true;
            } elseif(isset($_POST['saveShowBusiness'])){
                $mode = false;
            }

            $request = BusinessModel::modeladdBusiness($data);

            if(isset($request['result'])){
                if($request['result'] == 'OK'){
                    if($mode){
                        echo '<script>
                            showAlert("Correcto!", "Datos guardados correctamente", true);
                        </script>';
                    } else {
                        echo '<script>
                            location.href="'.Routes::modelRoute().$request['nameFolder'].'/'.$request['id'].'";
                            </script>';
                    }
                } else if($request['result'] == 'ERROR') {
                    echo '<script>
                            showAlert("Error!", "Error al guardar la informacion", false);
                        </script>';
                }
            } else {
                echo '<script>
                            showAlert("Error!", "Por favor llene los campos requeridos", false);
                        </script>';
            }
            
            
        }


    }

    public static function controllerprofileBusiness($value){
        
        $request = BusinessModel::modelprofileBusiness($value);

        return $request;

    }

    public static function controllershowBusiness($base, $tope){

        $request = BusinessModel::modelShowBusiness($base, $tope);

        return $request;

    }

    public static function controllerUpdateBusiness(){
        

        if(isset($_POST['saveBusinessEdit'])){    

            $data = $_POST;

            if(!empty($_FILES['imageProfileBusiness']['tmp_name'])){
                $data['profile_photo'] = $_FILES['imageProfileBusiness']['tmp_name'];
            }        

            $request = BusinessModel::modelUpdateBusiness($data);

            return $request;
        }
    }

    public static function controllershowBusinessAjax(){

        $request = BusinessModel::modelShowBusinessAjax();

        return $request;

    }

    public static function controllershowAddressAlt($id){
        $request = BusinessModel::modelTableAddressAlt($id);

        return $request;
    }

    public static function controllerShowOneAddress($data){
        
        $request = BusinessModel::modelTableOneAddressAlt($data);

        return $request;
    }

    public static function controllerAddAddressAlt(){

        if(isset($_POST['btnAddAddressAlt'])){

            $data = $_POST;
            BusinessModel::modelAddAddressAlt($data);

        }

    }

    public static function controllerUpdateAlt(){
        if(isset($_POST['btnUpdAddressAlt'])){

            $data = $_POST;
            BusinessModel::modelUpdateAddressAlt($data);

        }
    }

    public static function controllerDeleteBusiness($datos){

        $request = BusinessModel::modelDeleteBusiness($datos['id_user_address']);
        return $request;

    }

    public static function controllerSearchBusiness($base, $tope){
        if(!empty($_POST)){

            $data = $_POST;

            switch ($_POST['filterSQL']) {
                case 'searchComercialName':
                    $data['filterSQL'] = "commercial_name like '%".$data["searchText"]."%'";
                    break;
                case 'searchNameFiscal':
                    $data['filterSQL'] = "fiscal_name like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%'";
                    break;
                case 'searchEmail':
                    $data['filterSQL'] = "email like '%".$data["searchText"]."%'";
                    break;
                default:
                $data['filterSQL'] = "commercial_name like '%".$data["searchText"]."%' or fiscal_name like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%'";
                    break;
            }

            if(!empty($data['filterState']) && !empty($data['filterCity']) && !empty($data['filterSQL'])) {

                $where = "where ".$data['filterSQL']." and "."state = '".$data['filterState']."' and city = '".$data['filterCity']."'";

            } elseif(!empty($data['filterState']) && !empty($data['filterCity'])){  

                $where = "where "."state = '".$data['filterState']."' and city = '".$data['filterCity']."'";

            } elseif(!empty($data['filterState']) && !empty($data['filterSQL'])) {

                $where = "where ".$data['filterSQL']." and "."state = '".$data['filterState']."'";
            }
            
            elseif(!empty($data['filterState'])) {

                $where = "where "."state = '".$data['filterState']."' ".$data['filterSQL'];

            } elseif(!empty($data['filterCity'])){

                $where = "where "."city = ".$data['filterCity'].$data['filterSQL'];

            } elseif(!empty($where) && !empty($data['filterSQL'])) {

                $where = "where ".$where. " and ".$data['filterSQL'];

            } elseif(!empty($data['filterSQL'])){

                $where = "where ".$data['filterSQL'];

            } elseif(!empty($data['searchText'])){
                $where = "where commercial_name like '%".$data["searchText"]."%' or fiscal_name like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%'";
            }
            if(!empty($where)){
                $request = BusinessModel::modelSearchBusiness($base, $tope, $where);                
                return $request;
                
            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    public static function controlerCountBusiness(){

        $request = BusinessModel::modelCountBusiness();

        return $request;
    }
}

?>
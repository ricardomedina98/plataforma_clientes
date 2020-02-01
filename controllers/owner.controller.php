<?php
class OwnerController{

    public static function controllerAddOwn(){

        if(isset($_POST['saveOwner']) || isset($_POST['saveShowOwner'])){
            
            $data = $_POST;
            $mode = null;

            if(!empty($_FILES['imageProfileOwner']['tmp_name'])){
                $data['profile_photo'] = $_FILES['imageProfileOwner']['tmp_name'];
            }

            if(isset($_POST['saveOwner'])){
                $mode = true;
            } elseif(isset($_POST['saveShowOwner'])){
                $mode = false;
            }

            $request = OwnerModel::modelAddOwn($data);

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

    public static function controllerShowOwners($base, $tope){

        $request = OwnerModel::modelshowOwners($base, $tope);

        return $request;
    }

    public static function controllerShowProfile($value){

        $request = OwnerModel::modelShowProfile($value);

        return $request;

    }

    public static function controllerGetBussiness($value){

        $request = OwnerModel::modelGetBusiness($value);

        return $request;

    }

    public static function controllerUpdateOwner(){

        if(isset($_POST['saveOwnerEdit'])){  
            
            $data = $_POST;

            if(!empty($_FILES['imageProfileOwner']['tmp_name'])){
                $data['profile_photo'] = $_FILES['imageProfileOwner']['tmp_name'];
            }

            $request = OwnerModel::modelUpdateOwner($data);

            return $request;
        }

    }

    public static function controllerDeleteOwner($data){

        $request = OwnerModel::modelDeleteOwner($data);

        return $request;

    }
    public static function controllerSearchOwners($base, $tope) {
        if(!empty($_POST)){

            $data = $_POST;

            switch ($_POST['filterSQL']) {
                case 'searchNames':
                    $data['filterSQL'] = "name_owner like '%".$data["searchText"]."%'";
                    break;
                case 'searchSurNames':
                    $data['filterSQL'] = "first_surname like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%'";
                    break;
                case 'searchAlias':
                    $data['filterSQL'] = "alias like '%".$data["searchText"]."%'";
                    break;
                case 'searchEmail':
                    $data['filterSQL'] = "email like '%".$data["searchText"]."%'";
                    break;
                case 'searchPhone':
                    $data['filterSQL'] = "mobile_phone like '%".$data["searchText"]."%'";
                    break;
                case '':
                    $data['filterSQL'] = "";
                    break;
                default:
                $data['filterSQL'] = "name_owner like '%".$data["searchText"]."%' or first_surname like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%' or alias like '%".$data["searchText"]."%' or mobile_phone like '%".$data["searchText"]."%'";
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
                $where = "where name_owner like '%".$data["searchText"]."%' or first_surname like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%' or alias like '%".$data["searchText"]."%' or mobile_phone like '%".$data["searchText"]."%'";
            }
            if(!empty($where)){
                $request = OwnerModel::modelSearchOwners($base, $tope, $where);
                return $request;
                
            } else {
                return null;
            }


        } else {
            return null;
        }
    }

    public static function controllershowOwnerAll(){

        $request = OwnerModel::modelShowOwnerAll();

        return $request;

    }

}

?>
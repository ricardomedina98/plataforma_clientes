<?php

class ContactController{

    public static function controllershowContacts($base, $tope){

        $request = ContactModel::modelshowContacts($base, $tope);

        return $request;

    }

    public static function controllerCountContacts(){

        $request = ContactModel::modelCountContacts();

        return $request;

    }

    public static function controllerSearchContacts($base, $tope){

        if(!empty($_POST)){

            $data = $_POST;

            switch ($_POST['filterSQL']) {
                case 'searchNames':
                    $data['filterSQL'] = "name_contact like '%".$data["searchText"]."%'";
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
                case '':
                    $data['filterSQL'] = "";
                    break;
                default:
                $data['filterSQL'] = "name_contact like '%".$data["searchText"]."%' or first_surname like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%' or alias like '%".$data["searchText"]."%'";
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
                $where = "where name_contact like '%".$data["searchText"]."%' or first_surname like '%".$data["searchText"]."%' or second_surname like '%".$data["searchText"]."%' or email like '%".$data["searchText"]."%' or alias like '%".$data["searchText"]."%'";
            }
            if(!empty($where)){
                $request = ContactModel::modelSearchContacts($base, $tope, $where);
                return $request;
                
            } else {
                return null;
            }

            

            

        } else {
            return null;
        }

    }

    public static function controllerprofileContact($value){

        $request = ContactModel::modelprofileContact($value);

        return $request;

    }

    public static function controllerAddContact(){
        

        if(isset($_POST['saveContact']) || isset($_POST['saveShowContact'])){

            $data = $_POST;
            $mode = null;

            if(isset($_FILES['imageProfileContact']['tmp_name'])){
                $data['profile_photo'] = $_FILES['imageProfileContact']['tmp_name'];
            }

            if(isset($_POST['saveContact'])){
                $mode = true;
            } elseif(isset($_POST['saveShowContact'])){
                $mode = false;
            }

            $request = ContactModel::modelAddConatct($data);

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
            } else if($request == 'ERROR') {
                echo '<script>
                        showAlert("Error!", "Error al guardar la informacion", false);
                    </script>';
            }
            
        }
        
    }

    public static function controllerUpdateContact(){
        
        $data = $_POST;

        if(!empty($_FILES['imageProfileContact']['tmp_name'])){
            $data['profile_photo'] = $_FILES['imageProfileContact']['tmp_name'];
        }

        if(isset($_POST['saveContactEdit'])){            

            $request = ContactModel::modelUpdateContact($data);

            return $request;
        }
        
    }

    public static function controllerGetBussines($id){

        $request = ContactModel::modelGetContact($id);

        return $request;
    }

    public static function controllerAddIncident(){

        if(isset($_POST['subjectIncident']) && isset($_POST['commentsIncident'])){

            $datos = array("id_contact" => $_POST['id_contact'], "cause" => $_POST['subjectIncident'], "description" => $_POST['commentsIncident']);

            $request = ContactModel::modelAddIncident($datos);
            return $request;

        }

    }

    public static function controllerShowIndicents(){

        $request = ContactModel::modelShowIncidents();

        return $request;
    }

    
    public static function controllerShowOneIndicents($datos){

        $request = ContactModel::modelShowOneIncidents($datos);

        return $request;
    }
    

    /*AJAX */

    public static function controllerAddTicket($datos){

        $request = ContactModel::modelAddTicket($datos);

        return $request;

    }

    public static function controllerShowTickets($datos){

        $request = ContactModel::modelShowTickets($datos);

        return $request;

    }

    public static function controllerDeleteTicket($datos){

        $request = ContactModel::modelDeleteTicket($datos);

        return $request;

    }

    public static function controllerDeleteContact($datos){
        
        $request = ContactModel::modelDeleteContact($datos['id_user_delete']);
        return $request;
        
    }

    

}


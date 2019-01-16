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

}

?>
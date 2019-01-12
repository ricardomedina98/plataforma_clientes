<?php

    class UserController{

        public static function controllerAddUser(){

            if(isset($_POST['nameUser']) && isset($_POST['userName']) && isset($_POST['userPassword']) && isset($_POST['newProfile'])){
                
                $encrypt = crypt($_POST["userPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGAlconsn2018$');

                $data =  array("nameUser" => $_POST['nameUser'], 
                                "userName" => $_POST['userName'],
                                "userPassword" => $encrypt,
                                "typeUser" => $_POST['newProfile']
                );

                $request = ModelUser::modelAddUser($data);

                return $request;
                
    
            }

        }

        public static function log_in(){

            if(isset($_POST['loginUser']) && isset($_POST['loginPassword'])) {

                $encrypt = crypt($_POST["loginPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGAlconsn2018$');
                
                $data = array ("userName" => $_POST['loginUser'], "userPassword" => $encrypt);
                
                $request = ModelUser::Log_in($data);

                if($request['user_name'] == $data['userName'] && $request['password_user'] == $encrypt){

                    if($request["status"]){

                        $_SESSION['login'] = true;
                        $_SESSION['name_user'] = $request["id_user"];
                        $_SESSION['name_user'] = $request["name_user"];
                        $_SESSION['user_name'] = $request["user_name"];
                        $_SESSION['type_user'] = $request["type_user"];

                        date_default_timezone_set('America/Monterrey');

                        $date = date('Y-m-d H:i:s', time());

                        $dataLastLogged = array("id_user" => $request["id_user"], "date" => $date);

                        $lastLogged = ModelUser::last_logged($dataLastLogged);

                        if($lastLogged){
                            echo '<script>

                                window.location = "inicio";

                            </script>';
                        }

                        
                    } else {
                        echo '<br><div class="alert alert-danger">El usuario aun esta activado</div>';
                    }
                    
                    
                    
                } else {

                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

                }



            }

        }

        public static function controllerUpdateUser(){

            if(isset($_POST['nameEditUser']) && isset($_POST['userEditPassword']) && isset($_POST['newEditProfile'])){

                if(!empty($_POST['userEditPassword'])){

                    $encrypt = crypt($_POST["userEditPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGAlconsn2018$');

                } else {
                    $encrypt = "";
                }
                
                

                $data =  array("id_user" => $_POST["id_userEdit"],
                                "nameUser" => $_POST['nameEditUser'],
                                "userPassword" => $encrypt,
                                "typeUser" => $_POST['newEditProfile']
                );

                $request = ModelUser::modelUpdateUser($data);

                return $request;
                
    
            }

        }

        public static function controllerShowUsers(){

            $request = ModelUser::modelShowUsers();

            return $request;

        }

        public static function controllerShowOneUser($data){

            $request = ModelUser::modelShowOneUser($data);

            return $request;

        }

        public static function controllerDeletUser($data){

            $request = ModelUser::modelDeletUser($data);

            return $request;

        }

        public static function controllerCheckUserExist($data){

            $request = ModelUser::modelCheckUserExist($data);

            return $request;


        }

        public static function controllerChangeStatus($data){

            $request = ModelUser::modelChangeStatus($data);

            return $request;

        }

        

    }

<?php

    class UserController{

        public static function log_in(){

            if(isset($_POST['loginUser']) && isset($_POST['loginPassword'])) {
                

                
                $username = $_POST['loginUser'];
                $passowrd = $_POST['loginPassword'];
                $request = ModelUser::Log_in($username, $passowrd);

                if($request['user_name'] == $username && $request['password_user'] == $passowrd){
                    
                    $_SESSION['login'] = "ok";

                    echo '<script>

                        window.location = "inicio";

                    </script>';
                } else {

                    echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';

                }



            }

        }

    }

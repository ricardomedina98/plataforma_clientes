<?php

    require_once "../controllers/user.controller.php";
    require_once "../models/user.model.php";
    require_once "../models/helper.php";
    require_once "../models/connection.php";


    class AjaxUser{

        public $id_user;
        public $user_name;
        public $status;
        public $type_user;

        public function ajaxShowOneUser(){

            $data = array("id_user" => $this->id_user);

            $request = UserController::controllerShowOneUser($data);

            echo json_encode($request);

        }

        public function ajaxDeleteUser(){

            $data = array("id_user" => $this->id_user, "type_user" => $this->type_user);

            $request = UserController::controllerDeletUser($data);

            echo json_encode($request);

        }

        public function ajaxCheckUser(){

            $data = array("user_name" => $this->user_name);

            $request = UserController::controllerCheckUserExist($data);

            echo json_encode($request);

        }

        public function ajaxChangeStatus(){

            $data = array("id_user" => $this->id_user, "status" => $this->status);

            $request = UserController::controllerChangeStatus($data);

            echo json_encode($request);

        }

    }


    if(isset($_POST['id_user'])){
        $showOneUser = new AjaxUser();
        $showOneUser -> id_user = $_POST['id_user'];
        $showOneUser -> ajaxShowOneUser();
    }

    if(isset($_POST['id_user_delete']) && isset($_POST["type_user"])){
        $deleteUser = new AjaxUser();
        $deleteUser -> id_user = $_POST['id_user_delete'];
        $deleteUser -> type_user = $_POST['type_user'];
        $deleteUser -> ajaxDeleteUser();
    }

    if(isset($_POST['user_name'])){
        $userName = new AjaxUser();
        $userName -> user_name = $_POST['user_name'];
        $userName -> ajaxCheckUser();
    }

    if(isset($_POST['id_user_status']) && isset($_POST['status'])){
        $changeStatus = new AjaxUser();
        $changeStatus -> id_user = $_POST['id_user_status'];
        $changeStatus -> status = $_POST['status'];
        $changeStatus -> ajaxChangeStatus();
    }

?>
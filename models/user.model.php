<?php

require_once "connection.php";

class ModelUser{


    public static function modelAddUser($data){

        $stmt = Connection::connect() -> prepare("insert into users(name_user, user_name, password_user, type_user) values (:nameUser, :userName, :userPassword, :typeUser);");

        $stmt -> bindParam(":nameUser", $data['nameUser'], PDO::PARAM_STR);

        $stmt -> bindParam(":userName", $data['userName'], PDO::PARAM_STR);

        $stmt -> bindParam(":userPassword", $data['userPassword'], PDO::PARAM_STR);

        $stmt -> bindParam(":typeUser", $data['typeUser'], PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        } else {
            return false;
        }

    }

    public static function Log_in($data){

        $stmt = Connection::connect() -> prepare("select id_user, name_user, user_name, password_user, type_user, status from users where user_name = :user_name and password_user = :password_user");

        $stmt -> bindParam(":user_name", $data['userName'], PDO::PARAM_STR);

        $stmt -> bindParam(":password_user", $data['userPassword'], PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

    }

    public static function last_logged($dataLastLogged){

        $stmt = Connection::connect() -> prepare("update users set last_logged = :date where id_user = :id_user;");

        $stmt -> bindParam(":id_user", $dataLastLogged['id_user'], PDO::PARAM_STR);

        $stmt -> bindParam(":date", $dataLastLogged['date'], PDO::PARAM_STR);

        if($stmt -> execute()){
            return true;
        } else {
            return false;
        }

    }

    public static function modelShowUsers(){

        $stmt = Connection::connect() -> prepare("select id_user, name_user, user_name, type_user, status, last_logged from users;");

        $stmt -> execute();

        return $stmt -> fetchAll(PDO::FETCH_ASSOC);

    }

    public static function modelShowOneUser($data){

        $stmt = Connection::connect() -> prepare("select id_user, name_user, user_name, type_user, status, last_logged from users where id_user = :id_user;");

        $stmt -> bindParam(":id_user", $data['id_user'], PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

    }

    public static function modelDeletUser($data){

        if($data['type_user'] == "Administrador"){
            $validate = self::checkIfAdminExist();
        } else {
            $validate = true;
        }

        if($validate){

            $stmt = Connection::connect() -> prepare("delete from users where id_user = :id_user;");

            $stmt -> bindParam(":id_user", $data['id_user'], PDO::PARAM_INT);

            $stmt -> execute();

            $rowsAffected = $stmt -> rowCount();

            if($rowsAffected > 0){
                return true;
            } else {
                return false;
            }
            
        } else {
            return "admin";
        }

        

    }

    public static function modelCheckUserExist($data){

        $stmt = Connection::connect() -> prepare("select user_name from users where user_name = :user_name;");

        $stmt -> bindParam(":user_name", $data['user_name'], PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);;

    }

    public static function modelUpdateUser($data){

        if($data['typeUser'] != "Administrador"){

            !$validate = self::checkIfAdminExist();
            
        } else {
            
            $validate = true;
        } 
        
        if($validate){

            if(!empty($data['userPassword'])){

                $stmt = Connection::connect() -> prepare("update users set name_user = :nameUser, password_user = :userPassword, type_user = :typeUser where id_user = :id_user;");
                $stmt -> bindParam(":userPassword", $data['userPassword'], PDO::PARAM_STR);
    
            } else {
    
                $stmt = Connection::connect() -> prepare("update users set name_user = :nameUser, type_user = :typeUser where id_user = :id_user;");
    
            }
    
            $stmt -> bindParam(":id_user", $data['id_user'], PDO::PARAM_INT);
    
            $stmt -> bindParam(":nameUser", $data['nameUser'], PDO::PARAM_STR);
    
            $stmt -> bindParam(":typeUser", $data['typeUser'], PDO::PARAM_STR);
    
            if($stmt -> execute()){
                return true;
            } else {
                return false;
            }

        } else {

            return "admin";

        }

        

    }

    public static function modelChangeStatus($data){

        $stmt = Connection::connect() -> prepare("update users set status = :status where id_user = :id_user");

        $stmt -> bindParam(":id_user", $data['id_user'], PDO::PARAM_STR);

        $stmt -> bindParam(":status", $data['status'], PDO::PARAM_STR);

        $stmt -> execute();

        $rowsAffected = $stmt -> rowCount();

        if($rowsAffected > 0){
            return true;
        } else {
            return false;
        }

    }

    public static function checkIfAdminExist(){

        $stmt = Connection::connect() -> prepare("select count(id_user) admins from users where type_user = 'Administrador';");
        
        $stmt -> execute();

        $rows = $stmt -> fetch(PDO::FETCH_ASSOC);

        if($rows["admins"] > 1){
            return true;
        } else {
            return false;
        }

    }

}
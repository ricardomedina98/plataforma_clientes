<?php

require_once "connection.php";

class ModelUser{

    public static function Log_in($username, $password){

        $stmt = Connection::connect() -> prepare("select user_name, password_user from users where user_name = :user_name and password_user = :password_user");

        $stmt -> bindParam(":user_name", $username, PDO::PARAM_STR);

        $stmt -> bindParam(":password_user", $password, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

    }

}
<?php

class TemplateModel{

    public static function modelgetTotal(){

        $showTotal = Connection::connect() -> prepare("SELECT (SELECT COUNT(*) FROM owners) owners, (SELECT COUNT(*) FROM contacts) contacts, (SELECT COUNT(*) FROM business) business;");
        $showTotal -> execute();        
        
        $request = $showTotal -> fetch(PDO::FETCH_ASSOC);
    
        return $request;

    }

}




?>
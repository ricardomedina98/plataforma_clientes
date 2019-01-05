<?php
class Connection{
    
    static public function connect(){
        $link=new PDO('mysql:dbname=plataforma_clientes;host=localhost','root','1234'); 
        return $link;
    }
}

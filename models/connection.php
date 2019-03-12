<?php
class Connection{
    
    static public function connect(){
        $link=new PDO('mysql:dbname=plataforma_clientes;host=127.0.0.1','root','030498'); 
        return $link;
    }
}

<?php
class Connection{
    
    static public function connect(){
        $link=new PDO('mysql:dbname=plataforma_clientes;host=192.168.88.118','root','030498'); 
        return $link;
    }
}

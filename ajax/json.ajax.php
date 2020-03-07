<?php
//header('Content-Type: application/json');

    class AjaxJSON{

        public static function readJsonCities(){

            $json_file = file_get_contents("json_files/cities.json");
    
            $json_parse = json_encode($json_file, true);
    
            $pattern = "/^.*\r\n\r\n/s";
    
            $json_parse = preg_replace($pattern,'',$json_file);
    
            echo $json_parse;
    
        }
    
        public static function readJsonStates(){
    
            $json_file = file_get_contents("json_files/states.json");
    
            $json_parse = json_encode($json_file, true);
    
            $pattern="/^.*\r\n\r\n/s";
            
            $json_parse=preg_replace($pattern,'',$json_file);
    
            echo $json_parse;
            
        }

    }


    if(isset($_GET['cities'])){
        $businessAddress = new AjaxJSON();        
        $businessAddress -> readJsonCities();
    }

    if(isset($_GET['states'])){
        $businessAddress = new AjaxJSON();        
        $businessAddress -> readJsonStates();
    }

?>
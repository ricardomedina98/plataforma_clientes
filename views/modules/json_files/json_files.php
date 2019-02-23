<?php

header_remove($value2);
header('Content-Type: application/json');

class Json_Files{
    
    public static function readJsonCities(){

        $json_file = file_get_contents("views/modules/json_files/cities.json");

        $json_parse = json_encode($json_file, true);

        $pattern = "/^.*\r\n\r\n/s";

        $json_parse = preg_replace($pattern,'',$json_file);

        echo $json_parse;

    }

    public static function readJsonStates(){

        $json_file = file_get_contents("views/modules/json_files/states.json");

        $json_parse = json_encode($json_file, true);

        $pattern="/^.*\r\n\r\n/s";
        
        $json_parse=preg_replace($pattern,'',$json_file);

        echo $json_parse;
        
    }
}

if($value2 == "cities"){

    $cities = new Json_Files();
    $cities ->readJsonCities();



} else if($value2 == "states"){

    $states = new Json_Files();
    $states -> readJsonStates();

}
?>


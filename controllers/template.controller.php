<?php

class ControllerTemplate{

    public static function template(){
        include 'views/template.php';
    }

    public static function controllergetTotal(){
        $request = TemplateModel::modelgetTotal();

        return $request;
    }
}

?>
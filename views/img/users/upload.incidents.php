<?php
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$options=array(
    'user_dirs' => true
);

class IncidentsUploadHandler extends UploadHandler {

    protected function initialize() {
        parent::initialize();
    }


    protected function get_user_id() {
        $id_user = (isset($_REQUEST['id_user'])) ? $_REQUEST['id_user'] : $_GET['id_user'];
        $path_id = $id_user;
        return $path_id;
    }

    protected function get_user_path() {
        if ($this->options['user_dirs']) {
            $id_type = (isset($_REQUEST['id_type'])) ? $_REQUEST['id_type'] : $_GET['id_type'];
            $path_user = $id_type.'/'.$this->get_user_id().'/incidents'.'/';
            return $path_user;
        }
        return '';
    }

}

$incidents = new IncidentsUploadHandler($options);
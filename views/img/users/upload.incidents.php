<?php
error_reporting(E_ALL | E_STRICT);
require('UploadHandlerVideo.php');
$options=array(
    'user_dirs' => true
);

class IncidentsUploadHandler extends UploadHandlerVideo {

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
            $path_user = $id_type.'/'.$this->get_user_id().'/incidents'.'/'.$_REQUEST["id_incident"].'/';
            return $path_user;
        }
        return '';
    }

    protected function generate_filename($filename = "")
            {

                $extension = "";
                if ( $filename != "" )
                {
                    $extension = pathinfo($filename , PATHINFO_EXTENSION);

                    if ( $extension != "" )
                    {
                        $extension = "." . $extension;
                    }
                }
                $name = md5(date('Y-m-d H:i:s:u')) . $extension;
                return $name;
            }

}

$incidents = new IncidentsUploadHandler($options);
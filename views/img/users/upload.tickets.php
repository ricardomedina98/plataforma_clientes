<?php
error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');
$options=array(
    'user_dirs' => true,
    
);

$upload_handler = new uploadHandler($options);
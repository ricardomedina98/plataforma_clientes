<?php

require_once "../controllers/contact.controller.php";
require_once "../models/contact.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";




class ContactAjax{

    public $id_contactProduct;

    public function ajaxShowOneProduct(){       
        
        $request = ContactController::controllerShowOneProduct($this->id_contactProduct);

        echo json_encode($request, true);

    }

    public function ajaxDeleteProduct(){       
        
        $request = ContactController::controllerDeleteProduct($this->id_contactProduct);

        echo json_encode($request, true);

    }

}

if(isset($_POST["id_contactProductEdit"])){
    $incidents = new ContactAjax();
    $incidents -> id_contactProduct = $_POST['id_contactProductEdit'];
    $incidents ->ajaxShowOneProduct();
}

if(isset($_POST["id_contactProductDelete"])){
    $incidents = new ContactAjax();
    $incidents -> id_contactProduct = $_POST['id_contactProductDelete'];
    $incidents ->ajaxDeleteProduct();
}




?>
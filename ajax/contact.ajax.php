<?php

require_once "../controllers/contact.controller.php";
require_once "../models/contact.model.php";
require_once "../models/helper.php";
require_once "../models/connection.php";




class ContactAjax{

    public $id_contactProduct;

    public $id_contactFamily;

    public $id_relationship;

    public function ajaxShowOneProduct(){       
        
        $request = ContactController::controllerShowOneProduct($this->id_contactProduct);

        echo json_encode($request, true);

    }

    public function ajaxDeleteProduct(){       
        
        $request = ContactController::controllerDeleteProduct($this->id_contactProduct);

        echo json_encode($request, true);

    }

    public function ajaxShowContacts(){       
        
        $request = ContactController::controllershowContactsExcept($this->id_contactFamily);

        echo json_encode($request, true);

    }

    public function ajaxShowOwners(){       
        
        $request = ContactController::controllerDeleteProduct($this->id_contactProduct);

        echo json_encode($request, true);

    }

    public function ajaxShowOneRelationship(){       
        
        $request = ContactController::controllerShowOneRelationship($this->id_relationship);

        echo json_encode($request, true);

    }

    public function ajaxDeleteMemberFamily(){       
        
        $request = ContactController::controllerDeleteMemberFamily($this->id_relationship);

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

if(isset($_POST["id_contactFamily"])){
    $memberFamily = new ContactAjax();
    $memberFamily -> id_contactFamily = $_POST['id_contactFamily'];
    $memberFamily ->ajaxShowContacts();
}

if(isset($_POST["id_relationship"])){
    $memberFamily = new ContactAjax();
    $memberFamily -> id_relationship = $_POST['id_relationship'];
    $memberFamily ->ajaxShowOneRelationship();
}

if(isset($_POST["id_familymember_delete"])){
    $memberFamily = new ContactAjax();
    $memberFamily -> id_relationship = $_POST['id_familymember_delete'];
    $memberFamily ->ajaxDeleteMemberFamily();
}



?>
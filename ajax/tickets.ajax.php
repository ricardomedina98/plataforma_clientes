<?php

    require_once "../controllers/contact.controller.php";
    require_once "../models/contact.model.php";
    require_once "../models/helper.php";
    class AjaxTickets{

        public $id_user;
        public $folio;
        public $caja;
        public $seller;
        public $totalAmount;
        public $photoTicket;

        

        public function ajaxAddTicket(){
            $datos = array("id_user" => $this->id_user,
                            "folio" => $this->folio, 
                            "caja" => $this->caja,
                            "seller" => $this->seller,
                            "totalAmount" => $this->totalAmount,
                            "photoTicket" => $this->photoTicket);

            $request = ContactController::controllerAddTicket($datos);
            echo $request;
        }

        public $id_user_tickets;
         

        public function ajaxShowTickets(){

            $datos = array("id_user_ticket" => $this->id_user_tickets);

            $request = ContactController::controllerShowTickets($datos);

            echo json_encode($request);

        }

        public $id_ticket;

        public function ajaxDeleteTicket(){

            $datos = array("id_ticket" => $this->id_ticket);

            $request = ContactController::controllerDeleteTicket($datos);

            echo json_encode($request);

        }

        public $id_user_delete;

        public function ajaxDeleteContact(){

            $datos = array("id_user_delete" => $this->id_user_delete);

            $request = ContactController::controllerDeleteContact($datos);

            echo json_encode($request);

        }
    }

    if(isset($_POST['folioTicket'])){
        $tickets = new AjaxTickets();
        $tickets -> folio = $_POST['folioTicket'];
        $tickets -> caja = $_POST['cajaTicket'];
        $tickets -> seller = $_POST['sellerTicket'];
        $tickets -> totalAmount = $_POST['montoTotal'];
        $tickets -> photoTicket = $_FILES['dataImageTicket']['tmp_name'];
        $tickets -> id_user = $_POST['id_user'];
        $tickets ->ajaxAddTicket();
    }

    if(isset($_POST['id_user_ticket'])){
        $ticketsShow_obj = new AjaxTickets();
        $ticketsShow_obj -> id_user_tickets = $_POST['id_user_ticket'];
        $ticketsShow_obj -> ajaxShowTickets();
    }

    if(isset($_POST['id_ticket'])){
        $ticketsShow_obj = new AjaxTickets();
        $ticketsShow_obj -> id_ticket = $_POST['id_ticket'];
        $ticketsShow_obj -> ajaxDeleteTicket();
    }

    if(isset($_POST['id_user_delete'])){
        $contactDelete = new AjaxTickets();
        $contactDelete -> id_user_delete = $_POST['id_user_delete'];
        $contactDelete -> ajaxDeleteContact();
    }

?>
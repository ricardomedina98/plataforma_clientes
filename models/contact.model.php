<?php

require_once "connection.php";


class ContactModel{

    public static function modelshowContacts($base, $tope){

        $showContacts = Connection::connect() -> prepare("SELECT contact.id_contact, profile_photo, name_contact, first_surname, second_surname, email, mobile_phone FROM contacts contact INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact limit :base, :tope");
        

        $showContacts->bindParam(":base", $base, PDO::PARAM_INT);
        $showContacts->bindParam(":tope", $tope, PDO::PARAM_INT);

        $showContacts -> execute();        
        
        $request = $showContacts -> fetchAll(PDO::FETCH_ASSOC);
    
        return $request;

    }

    public static function modelCountContacts(){

        $countContacts = Connection::connect() -> prepare("SELECT count(contact.id_contact=ab_cont.id_contact) total FROM contacts contact INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact");

        $countContacts -> execute();

        $totalContacts = $countContacts -> fetch(PDO::FETCH_ASSOC);

        return $totalContacts['total'];
    }

    public static function modelprofileContact($value){

        $stmt = Connection::connect() -> prepare('SELECT contact.id_contact, name_contact, first_surname, second_surname,
		state, city, street, colony, local,
        profile_photo, alias, email, birthday, date_registration, mobile_phone, frequency, perfil_facebook, url_facebook, comments, ab_cont.seller, type_business, name_business
        FROM contacts contact
        INNER JOIN about_contact ab_cont ON contact.id_contact = ab_cont.id_contact
        INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact
        WHERE contact.id_contact=:id_contact');
        
        $stmt->bindParam(':id_contact', $value, PDO::PARAM_INT);

        $stmt -> execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    public static function modelAddConatct($data){
        $connection = Connection::connect();
        $connection->beginTransaction();
        $stmt = $connection->prepare("insert into contacts(name_contact, first_surname, second_surname) values (:name_contact, :first_surname, :second_surname)");

            
        $stmt->bindParam(':name_contact', $data['nameContact'], PDO::PARAM_STR);
        $stmt->bindParam(':first_surname', $data['surName1Contact'], PDO::PARAM_STR);
        $stmt->bindParam(':second_surname', $data['surName2Contact'], PDO::PARAM_STR);

        $stmt->execute();
        $rowsAffected = $stmt->rowCount();

        $id = (int)$connection->lastInsertId();

        if($rowsAffected>0){
            $nameFolder = "contactos";

            if(!empty($data['profile_photo'])){
                $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, $data['profile_photo'], $imageDataBase = null);
            } else {
                $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, 'views/img/users/default/anonymous.jpg', $imageDataBase = null);
            }
            $aboutContact = $connection->prepare("insert into about_contact(id_contact, profile_photo, alias, email, birthday, 
                                        date_registration, mobile_phone, frequency, perfil_facebook, url_facebook, seller, comments, type_business, name_business) 
            values (:id_contact, :profile_photo, :alias, :email, :birthday, :date_registration, :mobile_phone, :frequency, :facebook, :urlFacebook, :seller, :comments, :type_business, :name_business)");

            $birthday = Helper::fixDate($data['birthdayContact']);
            $date_registration = Helper::fixDate($data['dateRegistration']);

            $aboutContact->bindParam(':id_contact', $id, PDO::PARAM_STR);
            $aboutContact->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
            $aboutContact->bindParam(':alias', $data['aliasContact'], PDO::PARAM_STR);
            $aboutContact->bindParam(':email', $data['emailContact'], PDO::PARAM_STR);
            $aboutContact->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $aboutContact->bindParam(':date_registration', $date_registration, PDO::PARAM_STR);
            $aboutContact->bindParam(':mobile_phone', $data["phoneContact"], PDO::PARAM_STR);                
            $aboutContact->bindParam(':frequency', $data['frequencyContact'], PDO::PARAM_STR);
            $aboutContact->bindParam(':facebook', $data['facebook'], PDO::PARAM_STR);
            $aboutContact->bindParam(':urlFacebook', $data['urlFacebook'], PDO::PARAM_STR);
            $aboutContact->bindParam(':seller', $data['sellerContact'], PDO::PARAM_STR);
            $aboutContact->bindParam(':comments', $data['commentsContact'], PDO::PARAM_STR);
            $aboutContact->bindParam(':type_business', $data['business_type'], PDO::PARAM_STR);
            $aboutContact->bindParam(':name_business', $data['business_name'], PDO::PARAM_STR);

            $addressContact = $connection->prepare("insert into contact_address(id_contact, state, city, colony, street, local) 
                                                    values (:id_contact, :state, :city, :colony, :street, :local)");

            $addressContact->bindParam(':id_contact', $id, PDO::PARAM_INT);
            $addressContact->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
            $addressContact->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
            $addressContact->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
            $addressContact->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
            $addressContact->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);
            
            $contact_business = $connection->prepare("insert into contact_business(id_contact, id_business) values (:id_contact, (select id_business from business where commercial_name = :business_name))");
            $contact_business->bindParam(':id_contact', $id, PDO::PARAM_INT);
            $contact_business->bindParam(':business_name', $data['business_name'], PDO::PARAM_STR);

            if(!$contact_business->execute()){
                $contact_businessAlt = $connection->prepare("insert into contact_business(id_contact) values (:id_contact)");
                $contact_businessAlt->bindParam(':id_contact', $id, PDO::PARAM_INT);
                $contact_businessAlt->execute();
            }

            if($aboutContact->execute() && $addressContact->execute()){
                $connection->commit();
                $result['id'] = $id;
                $result['nameFolder'] = $nameFolder;
                $result['result'] = 'OK';
                return $result;
            } else {
                (isset($dataDirectory['directory'])) ? unlink($dataDirectory['directory']): null;
                return $result['result'] = 'ERROR';
            }
            
        } else {            
            (isset($dataDirectory['directory'])) ? unlink($dataDirectory['directory']): null;
            return $result['result'] = 'ERROR';
        }
    }
    
    public static function modelUpdateContact($data){
        $nameFolder = "contactos";

        $connection = Connection::connect();
        $connection->beginTransaction();

        $contact = $connection->prepare("update contacts set name_contact = :name_contact, first_surname = :first_surname, second_surname = :second_surname where id_contact = :id_contact");

        $contact->bindParam(':id_contact', $data['id_user'], PDO::PARAM_STR);
        $contact->bindParam(':name_contact', $data['nameContact'], PDO::PARAM_STR);
        $contact->bindParam(':first_surname', $data['surName1Contact'], PDO::PARAM_STR);
        $contact->bindParam(':second_surname', $data['surName2Contact'], PDO::PARAM_STR);

        if(isset($data['profile_photo'])){
            $stmtimageDataBase = $connection->query('select profile_photo from about_contact where id_contact='.$data['id_user']);
            $imageDataBase = $stmtimageDataBase->fetch(PDO::FETCH_ASSOC);
            $dataDirectory = Helper::createDirectoryImage($nameFolder, $data['id_user'], $data['profile_photo'], $imageDataBase["profile_photo"]);

            

            $aboutContact = $connection->prepare("update about_contact set profile_photo = :profile_photo, alias = :alias, email = :email, birthday = :birthday, date_registration = :date_registration, mobile_phone = :mobile_phone, frequency = :frequency, perfil_facebook = :facebook, url_facebook = :urlFacebook, seller = :seller, type_business = :type_business, name_business = :name_business, comments = :comments where id_contact = :id_contact;");
            $aboutContact->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
            
        } else {
            $aboutContact = $connection->prepare("update about_contact set alias = :alias, email = :email, birthday = :birthday, date_registration = :date_registration, mobile_phone = :mobile_phone, frequency = :frequency, perfil_facebook = :facebook, url_facebook = :urlFacebook, seller = :seller, type_business = :type_business, name_business = :name_business, comments = :comments where id_contact = :id_contact;");
        }
        

        /*profile_photo = :profile_photo, */
        $birthday = Helper::fixDate($data['birthdayContact']);
        $date_registration = Helper::fixDate($data['dateRegistration']);

        
        $aboutContact->bindParam(':id_contact', $data['id_user'], PDO::PARAM_INT);
        $aboutContact->bindParam(':alias', $data['aliasContact'], PDO::PARAM_STR);
        $aboutContact->bindParam(':email', $data['emailContact'], PDO::PARAM_STR);
        $aboutContact->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $aboutContact->bindParam(':date_registration', $date_registration, PDO::PARAM_STR);
        $aboutContact->bindParam(':mobile_phone', $data["phoneContact"], PDO::PARAM_STR);                
        $aboutContact->bindParam(':frequency', $data['frequencyContact'], PDO::PARAM_STR);
        $aboutContact->bindParam(':facebook', $data['facebook'], PDO::PARAM_STR);
        $aboutContact->bindParam(':urlFacebook', $data['urlFacebook'], PDO::PARAM_STR);
        $aboutContact->bindParam(':seller', $data['sellerContact'], PDO::PARAM_STR);
        $aboutContact->bindParam(':comments', $data['commentsContact'], PDO::PARAM_STR);
        $aboutContact->bindParam(':type_business', $data['business_type'], PDO::PARAM_STR);
        $aboutContact->bindParam(':name_business', $data['business_name'], PDO::PARAM_STR);
        
        $contactAddress = $connection->prepare("update contact_address set state = :state, city = :city, street = :street, colony = :colony, local = :local where id_contact = :id_contact;");
        
        $contactAddress->bindParam(':id_contact', $data['id_user'], PDO::PARAM_INT);
        $contactAddress->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
        $contactAddress->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
        $contactAddress->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
        $contactAddress->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
        $contactAddress->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);
        
        $contact_business = $connection->prepare("update contact_business set id_business = (select id_business from business where commercial_name = :business_name) where id_contact = :id_contact");
        $contact_business->bindParam(':id_contact', $data['id_user'], PDO::PARAM_INT);
        $contact_business->bindParam(':business_name', $data['business_name'], PDO::PARAM_STR);

        $empalmes = $contact_business->execute();

        if($contact->execute() && $aboutContact->execute() && $contactAddress->execute()){
            if(!empty($imageDataBase["profile_photo"])){
                $imageBackup = new Helper();
                $imageBackup->deleteBackup($imageDataBase["profile_photo"]);
            }
            $connection->commit();
            return true;
        }else {
            $connection->rollback();
            if(!empty($dataDirectory['pathImage'])){
                $imageRestored = new Helper();
                $imageRestored ->restoreImage($imageDataBase["profile_photo"]);
            }
            
            return false;
        }
    }

    public static function modelDeleteContact($id_user){

        $connection = Connection::connect();
        $connection->beginTransaction();

        $deleteContact = $connection->prepare("delete from contacts where id_contact = :id_contact");
        $deleteContactAddres = $connection->prepare("delete from contact_address where id_contact = :id_contact");
        $deleteContactAbout = $connection->prepare("delete from about_contact where id_contact = :id_contact");
        $deleteTickets = $connection->prepare("delete from tickets where id_contact = :id_contact");
        $deleteBus = $connection->prepare("delete from contact_business where id_contact = :id_contact");
        $incidents = $connection->prepare("delete from incidents where id_contact = :id_contact");
        

        
        $deleteContact->bindParam(":id_contact", $id_user);
        $deleteContactAddres->bindParam(":id_contact", $id_user);
        $deleteContactAbout->bindParam(":id_contact", $id_user);
        $deleteTickets->bindParam(":id_contact", $id_user);
        $deleteBus->bindParam(":id_contact", $id_user);
        $incidents->bindParam(":id_contact", $id_user);
        

        $e = $deleteBus->execute();
        $b = $deleteContactAddres->execute();
        $c = $deleteContactAbout->execute();
        $d = $deleteTickets->execute();
        $u = $incidents->execute();
        $a = $deleteContact->execute();
        
        if($a && $b && $c && $d && $e && $u){
            $deleteFolderUser = new Helper();
            $deleteFolderUser->deleteDirectoryContact($id_user, "contactos");
            $connection->commit();
            return true;
        } else {
            $connection->rollback();
            return false;
        }


    }

    public static function modelSearchContacts($base, $tope, $where){

        $searchContacts = Connection::connect() -> prepare("SELECT contact.id_contact, profile_photo, name_contact, first_surname, second_surname, email, mobile_phone 
        FROM contacts contact 
        INNER JOIN about_contact ab_cont ON contact.id_contact=ab_cont.id_contact 
        INNER JOIN contact_address address_cont ON contact.id_contact = address_cont.id_contact ".$where);


        $searchContacts -> execute();
        
        $request = $searchContacts -> fetchAll(PDO::FETCH_ASSOC);

        $request['countResult'] = $searchContacts -> rowCount();
    
        return $request;
        
    }

    public static function modelGetContact($value){
        $connection = Connection::connect();
        $stmt = $connection->prepare("select  business.id_business, commercial_name, fiscal_name, 
        profile_photo, email, 
        phones_business, dateRegistration
        from business
        INNER JOIN aboutbusiness about on about.id_business = business.id_business
        INNER JOIN contact_business cont_bus on cont_bus.id_business = business.id_business where cont_bus.id_contact = :id_contact");

        $stmt->BindParam(":id_contact", $value);

        $stmt->execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);
    }

    /*Ajax Tickets */

    public static function modelAddTicket($data){
        $connection = Connection::connect();

        $ticket = $connection->prepare("insert into tickets(photo_ticket, folio, branch, seller, totalAmount, id_contact) values (:photo_ticket, :folio, :branch, :seller, :totalAmount, :id_contact)");

        $imageTicket = Helper::createDirectoryTicket("tickets", $data['id_user'], $data['photoTicket']);

        $ticket->bindParam(':id_contact', $data['id_user'], PDO::PARAM_INT);
        $ticket->bindParam(':photo_ticket', $imageTicket, PDO::PARAM_STR);
        $ticket->bindParam(':folio', $data['folio'], PDO::PARAM_STR);
        $ticket->bindParam(':branch', $data['caja'], PDO::PARAM_STR);
        $ticket->bindParam(':seller', $data['seller'], PDO::PARAM_STR);
        $ticket->bindParam(':totalAmount', $data['totalAmount'], PDO::PARAM_STR);

        if($ticket->execute()){
            return true;
        } else {
            $imageTicketFinal = '../'.$imageTicket;
            unlink($imageTicketFinal);
            return false;
        }

        
    }

    public static function modelShowTickets($datos){

        $connection = Connection::connect();

        $showTickets = $connection->prepare("select id_ticket, photo_ticket, folio, branch, seller, totalAmount from tickets where id_contact = :id_contact");

        $showTickets->bindParam(':id_contact', $datos['id_user_ticket']);

        if($showTickets->execute()){
            return $showTickets->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }

    }

    public static function modelDeleteTicket($datos){

        $connection = Connection::connect();

        $connection->beginTransaction();

        $deleteTicket = $connection->prepare("delete from tickets where id_ticket = :id_ticket");

        $deleteTicket -> bindParam(":id_ticket", $datos['id_ticket']);

        $TicketImage = $connection->query("select photo_ticket from tickets where id_ticket = ".$datos['id_ticket']);
        
        $TicketImage->execute();

        $deleteTicket-> execute();

        $pathImage = $TicketImage->fetch();


        $rowsAffected = $deleteTicket->rowCount();

        if($rowsAffected>0){
            $deleteImage = new Helper();
            $deleteImage -> deleteImage($pathImage['photo_ticket']);
            $connection->commit();
            return true;
        } else {
            $deleteTicket->rollback();
            return false;
        }

    }

    public static function modelAddIncident($datos){

        $connection = Connection::connect();

        $addIncident = $connection->prepare("insert into incidents(id_contact, subject, description, dateIncident, timeIncident, place, personal_involved) values (:id_contact,:subject,:description,:dateIncident,:timeIncident,:place,:personal_involved)");

        $time = Helper::fixTime($datos['time']);
        $date = Helper::fixDate($datos['date']);

        $addIncident -> bindParam(":id_contact", $datos['id_contact'], PDO::PARAM_INT);
        $addIncident -> bindParam(":subject", $datos['subject'], PDO::PARAM_STR);
        $addIncident -> bindParam(":description", $datos['description'], PDO::PARAM_STR);
        $addIncident -> bindParam(":dateIncident", $date, PDO::PARAM_STR);
        $addIncident -> bindParam(":timeIncident", $time, PDO::PARAM_STR);
        $addIncident -> bindParam(":place", $datos['place'], PDO::PARAM_STR);
        $addIncident -> bindParam(":personal_involved", $datos['personal'], PDO::PARAM_STR);
        

        if($addIncident -> execute()){            
            return true;
        } else {
            return false;
        }

    }

    public static function modelShowIncidents($data){

        $connection = Connection::connect();

        $showIncidents = $connection->prepare("select id_incident, id_contact, subject, description, dateIncident, timeIncident, place, personal_involved from incidents where id_contact = :id_contact;");

        $showIncidents -> bindParam(":id_contact", $data, PDO::PARAM_INT);

        $showIncidents->execute();

        $showIncidents = $showIncidents->fetchAll(PDO::FETCH_ASSOC);

        return $showIncidents;
    }

    public static function modelShowOneIncidents($datos){

        $connection = Connection::connect();


        $showOneIncident = $connection->prepare("select id_incident, id_contact, subject, description, dateIncident, timeIncident, place, personal_involved from incidents where id_incident = :id_incident;");

        $showOneIncident -> bindParam(":id_incident", $datos['id_incident'], PDO::PARAM_INT);

        $showOneIncident->execute();

        $showOneIncident = $showOneIncident->fetch(PDO::FETCH_ASSOC);

        $showOneIncident['dateIncident'] = Helper::ConvertDate($showOneIncident['dateIncident']);

        $showOneIncident['timeIncident'] = Helper::convertToAMPM($showOneIncident['timeIncident']);

        return $showOneIncident;
    }
    
    public static function modelUpdateIncident($data){

        $connection = Connection::connect();

        $updateIncident = $connection->prepare("update incidents set subject = :cause, description = :description, dateIncident = :date, timeIncident = :time, place = :place, personal_involved = :personal where id_incident = :id_incident and id_contact = :id_user;");

        $time = Helper::fixTime($data['time']);
        $date = Helper::fixDate($data['date']);

        $updateIncident -> bindParam(":id_user", $data['id_user'], PDO::PARAM_INT);

        $updateIncident -> bindParam(":id_incident", $data['id_incident'], PDO::PARAM_INT);

        $updateIncident -> bindParam(":cause", $data["cause"], PDO::PARAM_STR);

        $updateIncident -> bindParam(":description", $data["description"], PDO::PARAM_STR);

        $updateIncident -> bindParam(":date", $date, PDO::PARAM_STR);

        $updateIncident -> bindParam(":time", $time, PDO::PARAM_STR);

        $updateIncident -> bindParam(":place", $data["place"], PDO::PARAM_STR);

        $updateIncident -> bindParam(":personal", $data["personal"], PDO::PARAM_STR);

        if($updateIncident->execute()){
            return true;
        } else {
            return false;
        }

    }

    public static function modelDeleteIncident($data){

        $connection = Connection::connect();

        $deleteIncident = $connection->prepare("delete from incidents where id_incident = :id_incident;");

        $deleteIncident -> bindParam(":id_incident", $data['id_incident'], PDO::PARAM_INT);

        $deleteIncident->execute();

        $rowsAffected = $deleteIncident->rowCount();

        if($rowsAffected > 0){
            return true;
        } else {
            return false;
        }

    }

    public static function modelDeleteOwner($data){

    }

}

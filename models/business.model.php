<?php
    class BusinessModel{

        public static function modeladdBusiness($data){
            $connection = Connection::connect();
            $connection->beginTransaction();
            $stmt = $connection->prepare("insert into business(commercial_name, fiscal_name, type_business) values (:commercial_name, :fiscal_name, :type_business)");

                
            $stmt->bindParam(':commercial_name', $data['businessName'], PDO::PARAM_STR);
            $stmt->bindParam(':fiscal_name', $data['fiscalName'], PDO::PARAM_STR);
            $stmt->bindParam(':type_business', $data['typeBusiness'], PDO::PARAM_STR);


            $resultStmt = $stmt->execute();

            $id = (int)$connection->lastInsertId();

            if($resultStmt){
                $nameFolder = "negocios";

                if(!empty($data['profile_photo'])){
                    $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, $data['profile_photo'], $imageDataBase = null);
                } else {
                    $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, 'views/img/users/default/business.jpg', $imageDataBase = null);
                }
                $aboutBusiness = $connection->prepare("insert into aboutBusiness(id_business, profile_photo, phone_business, invoice, business_antiquity, 
                customer_antiquity, timeBusinessI, timeBusinessF, perfil_facebook, url_facebook, 
                email, url_googlemaps, comments, phones_business, days_available, how_know_us, frequency, dateRegistration) 
                
                values (:id_business, :profile_photo, :phone_business, :invoice, :business_antiquity, :customer_antiquity, :timeBusinessI, :timeBusinessF, :perfil_facebook, 
                :url_facebook, :email, :url_googlemaps, :comments, :phones_business, :days_available, :how_know_us, :frequency, :dateRegistration)");
                
                $timeBusinessI = Helper::fixTime($data['timePickerI']);
                $timeBusinessF = Helper::fixTime($data['timePickerF']);
                $dateRegistration = Helper::fixDate($data['dateRegistration']);
                $businessAntiquity = Helper::fixDate($data['businessAntiquity']);
                $businessCustomer = Helper::fixDate($data['businessCustomer']);

                $phones = null;
                if(!empty($data['phonesBusiness'])){
                    $phones = Helper::ArrayToString($data['phonesBusiness']);
                }

                $days_available = null;
                if(!empty($data['daysAvailable'])){
                    $days_available = Helper::ArrayToString($data['daysAvailable']);
                }
                
                $how_know_us = null;
                if(!empty($data['comunication'])){
                    $how_know_us = Helper::ArrayToString($data['comunication']);
                }
                

                $aboutBusiness->bindParam(':id_business', $id, PDO::PARAM_INT);
                $aboutBusiness->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':invoice', $data['invoice'], PDO::PARAM_BOOL);
                $aboutBusiness->bindParam(':business_antiquity', $businessAntiquity, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':customer_antiquity', $businessCustomer, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':timeBusinessI', $timeBusinessI, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':timeBusinessF', $timeBusinessF, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':perfil_facebook', $data['facebook'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':url_facebook', $data['urlFacebook'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':email', $data['emailBusiness'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':url_googlemaps', $data['urlMaps'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':comments', $data['commentsBusiness'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':phones_business', $phones, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':days_available', $days_available, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':how_know_us', $how_know_us, PDO::PARAM_STR);
                $aboutBusiness->bindParam(':frequency', $data['frequencyBusiness'], PDO::PARAM_STR);
                $aboutBusiness->bindParam(':dateRegistration', $dateRegistration, PDO::PARAM_STR);

                $aboutBusiness->bindParam(':phone_business', $data['phoneBusiness'], PDO::PARAM_STR);
                

                

                $addressBusiness = $connection->prepare("insert into business_address(id_business, state, city, colony, street, local) 
                                                        values (:id_business, :state, :city, :colony, :street, :local)");

                $addressBusiness->bindParam(':id_business', $id, PDO::PARAM_INT);
                $addressBusiness->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
                $addressBusiness->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
                $addressBusiness->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
                $addressBusiness->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
                $addressBusiness->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);


                if($aboutBusiness->execute() && $addressBusiness->execute()){
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
                return $result['result'] = 'ERROR';
            }
        }

        public static function modelprofileBusiness($value){
            $connection = Connection::connect();
            $connection->beginTransaction();
            $stmt = $connection->prepare("select  business.id_business, commercial_name, fiscal_name, type_business, 
            profile_photo, invoice, business_antiquity, customer_antiquity, email, timeBusinessI, 
            timeBusinessF, perfil_facebook, url_facebook, url_googlemaps, phones_business, days_available, 
            how_know_us, frequency, comments, dateRegistration, state, city, street, colony, local, phone_business
            from business
            INNER JOIN aboutBusiness about on about.id_business = business.id_business
            INNER JOIN business_address address on address.id_business = business.id_business where business.id_business = :id_business");

            $stmt->BindParam(":id_business", $value);

            $stmt->execute();

            return $stmt -> fetch(PDO::FETCH_ASSOC);
        }

        public static function modelShowBusiness($base, $tope){

            $showBusiness = Connection::connect() -> prepare("select  business.id_business, commercial_name, fiscal_name, 
            profile_photo, email, 
            phone_business
            from business
            INNER JOIN aboutBusiness about on about.id_business = business.id_business limit :base, :tope");
        

            $showBusiness->bindParam(":base", $base, PDO::PARAM_INT);
            $showBusiness->bindParam(":tope", $tope, PDO::PARAM_INT);

            $showBusiness -> execute();        
            
            $request = $showBusiness -> fetchAll(PDO::FETCH_ASSOC);
        
            return $request;

        }

        public static function modelUpdateBusiness($data){

            $nameFolder = "negocios";

            $connection = Connection::connect();
            $connection->beginTransaction();

            $business = $connection->prepare("update business set commercial_name = :commercial_name, fiscal_name = :fiscal_name, type_business = :type_business where id_business = :id_business");

            $business->bindParam(':id_business', $data['id_user'], PDO::PARAM_INT);
            $business->bindParam(':commercial_name', $data["businessName"], PDO::PARAM_STR);
            $business->bindParam(':fiscal_name', $data["fiscalName"], PDO::PARAM_STR);
            $business->bindParam(':type_business', $data["typeBusiness"], PDO::PARAM_STR);

            if(isset($data['profile_photo'])){
                $stmtimageDataBase = $connection->query('select profile_photo from aboutBusiness where id_business = '.$data['id_user']);
                $imageDataBase = $stmtimageDataBase->fetch(PDO::FETCH_ASSOC);
                $dataDirectory = Helper::createDirectoryImage($nameFolder, $data['id_user'], $data['profile_photo'], $imageDataBase["profile_photo"]);
                
                $aboutBusiness = $connection->prepare("update aboutBusiness set profile_photo = :profile_photo, invoice = :invoice, business_antiquity = :business_antiquity, customer_antiquity = :customer_antiquity, email = :email, timeBusinessI = :timeBusinessI, 
                timeBusinessF = :timeBusinessF, perfil_facebook = :perfil_facebook, url_facebook = :url_facebook, url_googlemaps = :url_googlemaps, phones_business = :phones_business, days_available = :days_available, 
                how_know_us = :how_know_us, frequency = :frequency, comments = :comments, dateRegistration = :dateRegistration, phone_business = :phone_business where id_business = :id_business");
                $aboutBusiness->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
                
            } else {
                $aboutBusiness = $connection->prepare("update aboutBusiness set invoice = :invoice, business_antiquity = :business_antiquity, customer_antiquity = :customer_antiquity, email = :email, timeBusinessI = :timeBusinessI, 
                timeBusinessF = :timeBusinessF, perfil_facebook = :perfil_facebook, url_facebook = :url_facebook, url_googlemaps = :url_googlemaps, phones_business = :phones_business, days_available = :days_available, 
                how_know_us = :how_know_us, frequency = :frequency, comments = :comments, dateRegistration = :dateRegistration, phone_business = :phone_business where id_business = :id_business");
            }
            

            $timeBusinessI = Helper::fixTime($data['timePickerI']);
            $timeBusinessF = Helper::fixTime($data['timePickerF']);
            $dateRegistration = Helper::fixDate($data['dateRegistration']);
            $businessAntiquity = Helper::fixDate($data['businessAntiquity']);
            $businessCustomer = Helper::fixDate($data['businessCustomer']);

            $phones = null;
            if(!empty($data['phonesBusiness'])){
                $phones = Helper::ArrayToString($data['phonesBusiness']);
            }

            $days_available = null;
            if(!empty($data['daysAvailable'])){
                $days_available = Helper::ArrayToString($data['daysAvailable']);
            }
            
            $how_know_us = null;
            if(!empty($data['comunication'])){
                $how_know_us = Helper::ArrayToString($data['comunication']);
            }
            
            $aboutBusiness->bindParam(':id_business', $data['id_user'], PDO::PARAM_INT);
            $aboutBusiness->bindParam(':invoice', $data['invoice'], PDO::PARAM_BOOL);
            $aboutBusiness->bindParam(':business_antiquity', $businessAntiquity, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':customer_antiquity', $businessCustomer, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':timeBusinessI', $timeBusinessI, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':timeBusinessF', $timeBusinessF, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':perfil_facebook', $data['facebook'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':url_facebook', $data['urlFacebook'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':email', $data['emailBusiness'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':url_googlemaps', $data['urlMaps'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':comments', $data['commentsBusiness'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':phones_business', $phones, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':days_available', $days_available, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':how_know_us', $how_know_us, PDO::PARAM_STR);
            $aboutBusiness->bindParam(':frequency', $data['frequencyBusiness'], PDO::PARAM_STR);
            $aboutBusiness->bindParam(':dateRegistration', $dateRegistration, PDO::PARAM_STR);

            $aboutBusiness->bindParam(':phone_business', $data["phoneBusiness"], PDO::PARAM_STR);

            
            
            
            $businessAddress = $connection->prepare("update business_address set state = :state, city = :city, street = :street, colony = :colony, local = :local where id_business = :id_business;");
            
            $businessAddress->bindParam(':id_business', $data['id_user'], PDO::PARAM_INT);
            $businessAddress->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
            $businessAddress->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
            $businessAddress->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
            $businessAddress->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
            $businessAddress->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);


            if($business->execute() && $aboutBusiness->execute() && $businessAddress->execute()){
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

        public static function modelTableAddressAlt($id){
            $showTable = Connection::connect() -> prepare("select * from alternatives_address_business where id_business = :id_business");

            $showTable->bindParam(":id_business", $id, PDO::PARAM_INT);

            $showTable -> execute();        
            
            $request = $showTable -> fetchAll(PDO::FETCH_ASSOC);
        
            return $request;
        }

        public static function modelTableOneAddressAlt($data){
            
            $showTable = Connection::connect() -> prepare("select * from alternatives_address_business where id_alt_address = :id_alt_address");

            $showTable->bindParam(":id_alt_address", $data['id_user_address'], PDO::PARAM_INT);

            $showTable -> execute();        
            
            $request = $showTable -> fetch(PDO::FETCH_ASSOC);
        
            return $request;
        }

        public static function modelAddAddressAlt($data){
            
            
            $stmt = Connection::connect()->prepare("insert into alternatives_address_business(id_business, name_business, phone_business, state, city, street, colony, local) values (:id_business, :name_business, :phone_business, :state, :city, :street, :colony, :local)");            
                
            $stmt->bindParam(':id_business', $data['id_business'], PDO::PARAM_STR);
            $stmt->bindParam(':name_business', $data['nameBusiness'], PDO::PARAM_STR);
            $stmt->bindParam(':phone_business', $data['phoneBusiness'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $data['addressStatemodal'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['addressCitymodal'], PDO::PARAM_STR);
            $stmt->bindParam(':street', $data['streetAddress'], PDO::PARAM_STR);
            $stmt->bindParam(':colony', $data['colonyAddress'], PDO::PARAM_STR);
            $stmt->bindParam(':local', $data['localAddress'], PDO::PARAM_STR);

            if($stmt->execute()){
                return true;
            } else {
                return false;
            }
                


        }

        public static function modelUpdateAddressAlt($data){
            $stmt = Connection::connect()->prepare("update alternatives_address_business set name_business = :name_business, phone_business = :phone_business , state = :state, 
            city = :city, street = :street, colony = :colony, local = :local where id_business = :id_business and id_alt_address = :id_alt_address;");            
                
            $stmt->bindParam(':id_business', $data['id_business'], PDO::PARAM_STR);
            $stmt->bindParam(':id_alt_address', $data['id_alt_address'], PDO::PARAM_STR);
            $stmt->bindParam(':name_business', $data['nameBusiness'], PDO::PARAM_STR);
            $stmt->bindParam(':phone_business', $data['phoneBusiness'], PDO::PARAM_STR);
            $stmt->bindParam(':state', $data['addressStatemodal'], PDO::PARAM_STR);
            $stmt->bindParam(':city', $data['addressCitymodal'], PDO::PARAM_STR);
            $stmt->bindParam(':street', $data['streetAddress'], PDO::PARAM_STR);
            $stmt->bindParam(':colony', $data['colonyAddress'], PDO::PARAM_STR);
            $stmt->bindParam(':local', $data['localAddress'], PDO::PARAM_STR);


            if($stmt->execute() && ($stmt->rowCount())>0){
                return true;
            } else {
                return false;
            }
        }

        public static function modelDeleteBusiness($id_user){

            $connection = Connection::connect();
            $connection->beginTransaction();

            $deleteContact = $connection->prepare("delete from aboutBusiness where id_business = :id_business");
            $deleteContactAddres = $connection->prepare("delete from business_address where id_business = :id_business");
            $deleteContactAbout = $connection->prepare("delete from friends_family_business where id_business = :id_business");
            $deleteTickets = $connection->prepare("delete from referenced_business where id_business = :id_business");
            $deleteBus = $connection->prepare("delete from business where id_business = :id_business");
            $deleteRelation = $connection->prepare("delete from contact_business where id_business = :id_business");
            $deleteRelation2 = $connection->prepare("delete from owner_business where id_business = :id_business;");
            
            $deleteContact->bindParam(":id_business", $id_user);
            $deleteContactAddres->bindParam(":id_business", $id_user);
            $deleteContactAbout->bindParam(":id_business", $id_user);
            $deleteTickets->bindParam(":id_business", $id_user);
            $deleteBus->bindParam(":id_business", $id_user);
            $deleteRelation->bindParam(":id_business", $id_user);
            $deleteRelation2->bindParam(":id_business", $id_user);
            

            
            $b = $deleteContact->execute();
            $c = $deleteContactAddres->execute();
            $d = $deleteContactAbout->execute();
            $a = $deleteTickets->execute();
            $f = $deleteRelation->execute();
            $j = $deleteRelation2->execute();
            $e = $deleteBus->execute();                                    
            
            
            if($a && $b && $c && $d && $e && $f && $j){
                $deleteFolderUser = new Helper();
                
                $connection->commit();
                $deleteFolderUser->deleteDirectoryContact($id_user, "negocios");
                return true;
            } else {
                $connection->rollback();
                return false;
            }

        }

        public static function modelSearchBusiness($base, $tope, $where){

            $searchBusiness = Connection::connect() -> prepare("select  business.id_business, commercial_name, fiscal_name, 
            profile_photo, email, 
            phone_business
            from business
            INNER JOIN aboutBusiness about on about.id_business = business.id_business ".$where." limit :base, :tope    ");
    
            
            $searchBusiness->bindParam(":base", $base, PDO::PARAM_INT);
            $searchBusiness->bindParam(":tope", $tope, PDO::PARAM_INT);

            $searchBusiness -> execute();
            
            $request = $searchBusiness -> fetchAll(PDO::FETCH_ASSOC);
    
            $request['countResult'] = $searchBusiness -> rowCount();
        
            return $request;
            
        }

        public static function modelCountBusiness(){
            $countBusiness = Connection::connect() -> prepare("select count(id_business) total from business");

            $countBusiness -> execute();

            $totalBusiness = $countBusiness -> fetch(PDO::FETCH_ASSOC);

            return $totalBusiness['total'];
        }

        /* AJAX */

        public static function modelShowBusinessAjax(){

            $showBusiness = Connection::connect() -> prepare("select commercial_name
            from business
            INNER JOIN aboutBusiness about on about.id_business = business.id_business");

            $showBusiness -> execute();        
            
            $request = $showBusiness -> fetchAll(PDO::FETCH_ASSOC);
        
            return $request;

        }

    }

?>
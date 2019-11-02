<?php
class OwnerModel{

    public static function modelAddOwn($data){
        $connection = Connection::connect();
        $connection->beginTransaction();
        $stmt = $connection->prepare("insert into owners(name_owner, first_surname, second_surname) values (:name_owner, :first_surname, :second_surname)");

            
        $stmt->bindParam(':name_owner', $data['nameOwner'], PDO::PARAM_STR);
        $stmt->bindParam(':first_surname', $data['surName1Owner'], PDO::PARAM_STR);
        $stmt->bindParam(':second_surname', $data['surName2Owner'], PDO::PARAM_STR);
    
        if($stmt->execute()){
            $id = (int)$connection->lastInsertId(); 
            $nameFolder = "duenos";

            if(!empty($data['profile_photo'])){
                $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, $data['profile_photo'], $imageDataBase = null);
            } else {
                $dataDirectory = Helper::createDirectoryImage($nameFolder, $id, 'views/img/users/default/anonymous.jpg', $imageDataBase = null);
            }
            $aboutOwner = $connection->prepare("insert into aboutowners(id_owner, profile_photo, alias, birthday, date_registration, mobile_phone, perfil_facebook, url_facebook, frequency, email, comments, type_business, name_business) 
            values (:id_owner, :profile_photo, :alias, :birthday, :date_registration, :mobile_phone, :perfil_facebook, :url_facebook, :frequency, :email, :comments, :type_business, :name_business)");

            $birthday = Helper::fixDate($data['birthday']);
            $date_registration = Helper::fixDate($data['dateRegistration']);

            $aboutOwner->bindParam(':id_owner', $id, PDO::PARAM_STR);
            $aboutOwner->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':alias', $data['aliasOwner'], PDO::PARAM_STR);
            
            $aboutOwner->bindParam(':birthday', $birthday, PDO::PARAM_STR);
            $aboutOwner->bindParam(':date_registration', $date_registration, PDO::PARAM_STR);
            $aboutOwner->bindParam(':mobile_phone', $data["phoneOwner"], PDO::PARAM_STR);                
            $aboutOwner->bindParam(':frequency', $data['frequency'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':perfil_facebook', $data['facebook'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':url_facebook', $data['urlFacebook'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':email', $data['email'], PDO::PARAM_STR);            
            $aboutOwner->bindParam(':comments', $data['comments'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':type_business', $data['business_type'], PDO::PARAM_STR);
            $aboutOwner->bindParam(':name_business', $data['business_name'], PDO::PARAM_STR);


            $addressOwner = $connection->prepare("insert into address_owner(id_owner, state, city, colony, street, local) 
                                                    values (:id_owner, :state, :city, :colony, :street, :local)");

            $addressOwner->bindParam(':id_owner', $id, PDO::PARAM_INT);
            $addressOwner->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
            $addressOwner->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
            $addressOwner->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
            $addressOwner->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
            $addressOwner->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);


            $habitsOwner = $connection->prepare("insert into buying_habits(id_owner, products, days_buy) values (:id_owner, :products, :days_buy)");

            $products = null;
            if(!empty($data['mercancia'])){
                $products = Helper::ArrayToString($data['mercancia']);
            }
            
            $days_buys = null;
            if(!empty($data['daysAvailable'])){
                $days_buys = Helper::ArrayToString($data['daysAvailable']);
            }

            $competencias = null;
            if(!empty($data['competencias'])){
                $competencias = Helper::ArrayToString($data['competencias']);
            }
            
            if(!empty($data['comunication'])){
                $comunicacion = Helper::ArrayToString($data['comunication']);
            }
            
            $habitsOwner->bindParam(':id_owner', $id, PDO::PARAM_INT);
            $habitsOwner->bindParam(':products', $products, PDO::PARAM_STR);
            $habitsOwner->bindParam(':days_buy', $days_buys, PDO::PARAM_STR);


            $departamentsOwner = $connection->prepare("insert into departaments(id_owner, name_departament, orderby) 
                                                            values (:id_owner, :name_departament, :orderby)");
             
            
            $departamentsOwner->bindParam(':id_owner', $id, PDO::PARAM_INT);
            $departamentsOwner->bindParam(':name_departament', $competencias, PDO::PARAM_STR);
            $departamentsOwner->bindParam(':orderby', $comunicacion, PDO::PARAM_STR);


            $owner_business = $connection->prepare("insert into owner_business(id_owner, id_business) values (:id_owner, (select id_business from business where commercial_name = :business_name))");
            $owner_business->bindParam(':id_owner', $id, PDO::PARAM_INT);
            $owner_business->bindParam(':business_name', $data['business_name'], PDO::PARAM_STR);

            if(!$owner_business->execute()){
                $owner_businessAlt = $connection->prepare("insert into owner_business(id_owner) values (:id_owner)");
                $owner_businessAlt->bindParam(':id_owner', $id, PDO::PARAM_INT);
                $owner_businessAlt->execute();
            }


            if($aboutOwner->execute() && $addressOwner->execute() && $habitsOwner->execute() && $departamentsOwner->execute()){
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

    public static function modelshowOwners($base, $tope){
        $showOwners = Connection::connect() -> prepare("select own.id_owner, name_owner, first_surname, second_surname, profile_photo, mobile_phone, email
        from owners own 
        inner join aboutowners ab on own.id_owner = ab.id_owner limit :base, :tope");

        $showOwners->bindParam(":base", $base, PDO::PARAM_INT);
        $showOwners->bindParam(":tope", $tope, PDO::PARAM_INT);

        $showOwners -> execute();        
        
        $request = $showOwners -> fetchAll(PDO::FETCH_ASSOC);
    
        return $request;
    }

    public static function modelShowProfile($value){

        $showOwners = Connection::connect() -> prepare("select ab.id_owner, name_owner, first_surname, second_surname, profile_photo, alias, birthday, date_registration, mobile_phone, perfil_facebook, url_facebook, frequency, email, comments, state, city, street, colony, local, products, days_buy, name_departament, orderby, type_business, name_business from owners own 
        inner join aboutowners ab on own.id_owner = ab.id_owner
        inner join address_owner ad on own.id_owner = ad.id_owner
        inner join buying_habits hb on own.id_owner = hb.id_owner
        inner join departaments dep on own.id_owner = dep.id_owner where own.id_owner = :id_owner");

        $showOwners->bindParam(":id_owner", $value, PDO::PARAM_INT);        

        $showOwners -> execute();        
        
        $request = $showOwners -> fetch(PDO::FETCH_ASSOC);
    
        return $request;

    }

    public static function modelGetBusiness($value){

        $connection = Connection::connect();
        $stmt = $connection->prepare("select business.id_business, commercial_name, fiscal_name, 
        profile_photo, email, 
        phones_business, dateRegistration
        from business
        INNER JOIN aboutbusiness about on about.id_business = business.id_business
        INNER JOIN owner_business own_bus on own_bus.id_business = business.id_business where own_bus.id_owner = :id_owner");

        $stmt->BindParam(":id_owner", $value);

        $stmt->execute();

        return $stmt -> fetch(PDO::FETCH_ASSOC);

    }

    public static function modelUpdateOwner($data){

        $nameFolder = "duenos";

        $connection = Connection::connect();
        $connection->beginTransaction();

        $owner = $connection->prepare("update owners set name_owner = :name_owner, 
                                        first_surname = :first_surname, 
                                        second_surname = :second_surname where id_owner = :id_owner");

        $owner->bindParam(':id_owner', $data['id_user'], PDO::PARAM_STR);
        $owner->bindParam(':name_owner', $data['nameOwner'], PDO::PARAM_STR);
        $owner->bindParam(':first_surname', $data['surName1Owner'], PDO::PARAM_STR);
        $owner->bindParam(':second_surname', $data['surName2Owner'], PDO::PARAM_STR);

        if(isset($data['profile_photo'])){
            $stmtimageDataBase = $connection->query('select profile_photo from aboutowners where id_owner='.$data['id_user']);
            $imageDataBase = $stmtimageDataBase->fetch(PDO::FETCH_ASSOC);
            $dataDirectory = Helper::createDirectoryImage($nameFolder, $data['id_user'], $data['profile_photo'], $imageDataBase["profile_photo"]);

            

            $aboutOwner = $connection->prepare("update aboutowners set profile_photo = :profile_photo, alias = :alias, birthday = :birthday, date_registration = :date_registration,
            mobile_phone = :mobile_phone, perfil_facebook = :perfil_facebook, url_facebook = :url_facebook, frequency = :frequency,
            email = :email, comments = :comments, type_business = :type_business, name_business = :name_business where id_owner = :id_owner");
            $aboutOwner->bindParam(':profile_photo', $dataDirectory['pathImage'], PDO::PARAM_STR);
            
        } else {
            $aboutOwner = $connection->prepare("update aboutowners set alias = :alias, birthday = :birthday, date_registration = :date_registration,
            mobile_phone = :mobile_phone, perfil_facebook = :perfil_facebook, url_facebook = :url_facebook, frequency = :frequency,
            email = :email, comments = :comments, type_business = :type_business, name_business = :name_business where id_owner = :id_owner");
        }
        

        /*profile_photo = :profile_photo, */
        $birthday = Helper::fixDate($data['birthday']);
        $date_registration = Helper::fixDate($data['dateRegistration']);

        
        $aboutOwner->bindParam(':id_owner', $data['id_user'], PDO::PARAM_INT);
        $aboutOwner->bindParam(':alias', $data["aliasOwner"], PDO::PARAM_STR);
        $aboutOwner->bindParam(':email', $data["emailOwner"], PDO::PARAM_STR);
        $aboutOwner->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $aboutOwner->bindParam(':date_registration', $date_registration, PDO::PARAM_STR);
        $aboutOwner->bindParam(':mobile_phone', $data["phoneOwner"], PDO::PARAM_STR);                
        $aboutOwner->bindParam(':frequency', $data["frequency"], PDO::PARAM_STR);
        $aboutOwner->bindParam(':perfil_facebook', $data["facebook"], PDO::PARAM_STR);
        $aboutOwner->bindParam(':url_facebook', $data['urlFacebook'], PDO::PARAM_STR);        
        $aboutOwner->bindParam(':comments', $data["commentsOwner"], PDO::PARAM_STR);
        $aboutOwner->bindParam(':type_business', $data['business_type'], PDO::PARAM_STR);
        $aboutOwner->bindParam(':name_business', $data['business_name'], PDO::PARAM_STR);
        
        $ownerAddress = $connection->prepare("update address_owner set state = :state, city = :city, street = :street, colony = :colony, local = :local where id_owner = :id_owner;");
        
        $ownerAddress->bindParam(':id_owner', $data['id_user'], PDO::PARAM_INT);
        $ownerAddress->bindParam(':state', $data['addressState'], PDO::PARAM_STR);
        $ownerAddress->bindParam(':city', $data['addressCity'], PDO::PARAM_STR);
        $ownerAddress->bindParam(':colony', $data['addressColony'], PDO::PARAM_STR);
        $ownerAddress->bindParam(':street', $data['addressStreet'], PDO::PARAM_STR);
        $ownerAddress->bindParam(':local', $data['addressLocal'], PDO::PARAM_STR);

        $days = null;
        if(!empty($data["daysAvailable"])){
            $days = Helper::ArrayToString($data["daysAvailable"]);
        }
        
        $mercancia = null;
        if(!empty($data["mercancia"])){
            $mercancia = Helper::ArrayToString($data["mercancia"]);
        }
        

        $buying_habits = $connection->prepare("update buying_habits set products = :products, days_buy = :days_buy where id_owner = :id_owner");
        $buying_habits->bindParam(':id_owner', $data['id_user'], PDO::PARAM_INT);
        $buying_habits->bindParam(':products', $mercancia, PDO::PARAM_STR);
        $buying_habits->bindParam(':days_buy', $days, PDO::PARAM_STR);

        $comunicacion = null;
        if(!empty($data["comunication"])){
            $comunicacion = Helper::ArrayToString($data["comunication"]);
        }

        $competencias = null;
        if(!empty($data["competencias"])){
            $competencias = Helper::ArrayToString($data["competencias"]);
        }
        

        $departaments = $connection->prepare("update departaments set name_departament = :name_departament, orderby = :orderby where id_owner = :id_owner");
        $departaments->bindParam(':id_owner', $data['id_user'], PDO::PARAM_INT);
        $departaments->bindParam(':name_departament', $competencias, PDO::PARAM_STR);
        $departaments->bindParam(':orderby', $comunicacion, PDO::PARAM_STR);



        $owner_business = $connection->prepare("update owner_business set id_business = (select id_business from business where commercial_name = :business_name) where id_owner = :id_owner");
        $owner_business->bindParam(':id_owner', $data['id_user'], PDO::PARAM_INT);
        $owner_business->bindParam(':business_name', $data['business_name'], PDO::PARAM_STR);

        $relation = $owner_business->execute();


        if($owner->execute() && $aboutOwner->execute() && $ownerAddress->execute() && $buying_habits->execute() && $departaments->execute()){
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

    public static function modelDeleteOwner($data){

        $connection = Connection::connect();
        $connection->beginTransaction();

        $departaments = $connection->prepare("delete from departaments where id_owner = :id_owner");
        $address_owner = $connection->prepare("delete from address_owner where id_owner = :id_owner");
        $buying_habits = $connection->prepare("delete from buying_habits where id_owner = :id_owner");
        $aboutowners = $connection->prepare("delete from aboutowners where id_owner = :id_owner");
        $owner_business = $connection->prepare("delete from owner_business where id_owner = :id_owner");
        $owners = $connection->prepare("delete from owners where id_owner = :id_owner");

        $departaments->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);
        $address_owner->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);
        $buying_habits->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);
        $aboutowners->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);
        $owner_business->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);
        $owners->bindParam(':id_owner', $data['id_owner_delete'], PDO::PARAM_INT);

        $a = $departaments->execute();
        $b = $address_owner->execute();
        $c = $buying_habits->execute();
        $d = $aboutowners->execute();
        $e = $owner_business->execute();
        $f = $owners->execute();

        $id_user = $data['id_owner_delete'];

        if($a && $b && $c && $d && $e && $f){
            $deleteFolderUser = new Helper();
            $deleteFolderUser->deleteDirectoryContact($id_user, "duenos");
            $connection->commit();
            return true;
        } else {
            $rollback->rollback();
            return false;
        }

    }

}
?>
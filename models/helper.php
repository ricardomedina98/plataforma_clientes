<?php
class Helper{
    public static function fixDate($date){
        $dateFiexed = null;
        if(!empty($date)){

            $arrayDate = explode('/', $date);
            $day = $arrayDate[0];
            $month = $arrayDate[1];
            $year = $arrayDate[2];

            $dateFiexed = $year.'-'.$month.'-'.$day;
        }
        
        return $dateFiexed;
    }

    public static function ConvertDate($date){
        $dateFiexed = null;
        if(!empty($date)){

            date_default_timezone_set('America/Monterrey');
            $dateFiexed = new DateTime($date);
            $dateFiexed = $dateFiexed->format("d/m/Y");

        }
        
        return $dateFiexed;
    }

    public static function ConvertDateTime($date){
        $dateFiexed = null;
        if(!empty($date)){

            date_default_timezone_set('America/Monterrey');
            $dateFiexed = new DateTime($date);
            $dateFiexed = $dateFiexed->format("d/m/Y h:i A");

        }
        
        return $dateFiexed;
    }

    public static function fixDateTime($date){
        $dateFiexed = null;
        if(!empty($date)){

            date_default_timezone_set('America/Monterrey');
            $dateFiexed = new DateTime(str_replace("/", "-",$date));
            $dateFiexed = $dateFiexed->format("Y-m-d H:i:s");

        }
        
        return $dateFiexed;
    }

    public static function createDirectoryImage($nameFolder, $idUser, $temp, $imageDataBase = null){

        $dirBase = "views/img/users/".$nameFolder;
                
        if(!is_dir($dirBase)){
            //Directory does not exist, so lets create it.
            mkdir($dirBase, 0755);
        }
        $dirUser = $dirBase.'/'.$idUser;

        if(!is_dir($dirUser)){
            //Directory does not exist, so lets create it.
            mkdir($dirUser, 0755);
        }

        $random = rand(1, 999);
        
        /*Modificacion de la foto */
        $pathImage = $dirUser."/"."profile".$random.".jpg";

        if(!is_null($imageDataBase)){
            if(file_exists($imageDataBase)){
                copy($imageDataBase, ($imageDataBase.'.bak'));
            }
        }


        list($ancho, $alto) = getimagesize($temp);

        $nuevoAncho = 500;
        $nuevoAlto = 500;

        $origen = imagecreatefromjpeg($temp);

        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

        imagejpeg($destino, $pathImage);

        $dataDirectory['pathImage'] = $pathImage;
        $dataDirectory['directory'] = $destino;

        return $dataDirectory;

    }


    public static function createDirectoryTicket($nameFolder, $idUser, $temp){

        $dirTicket = "views/img/users/contactos/".$idUser.'/'.$nameFolder;

        if(!is_dir('../'.$dirTicket)){
            
            mkdir(('../'.$dirTicket), 0755);

        }

        $random = rand(1, 999);
        
        /*Modificacion de la foto */
        $pathImage = $dirTicket."/"."ticket".$random.".jpg";

        if(isset($imageDataBase)){
            if(!is_null($imageDataBase)){
                if(file_exists($imageDataBase)){
                    copy($imageDataBase, ($imageDataBase.'.bak'));
                }
            }
        }

        $pathImageFinal = '../'.$pathImage;

        move_uploaded_file($temp, $pathImageFinal);

        $dataDirectory = $pathImage;        

        return $dataDirectory;

    }

    public static function restoreImage($pathImage){
        if(file_exists($pathImage) && copy(($pathImage.'.bak'), $pathImage.'.temp')){
            copy(($pathImage.'.bak'), $pathImage);
            copy(($pathImage.'.temp'), $pathImage.'.bak');
            unlink($pathImage.'.temp');
            unlink($pathImage.'.bak');
            return true;
        } else {
            return false;
        }
        
    }

    public function deleteBackup($pathImage){
        try{
            if(file_exists($pathImage.'.bak')){
                unlink($pathImage.'.bak');
                unlink($pathImage);
            }
        } catch(Exception $e){
            
        }
        
    }

    public static function deleteImage($pathImage){

        $pathImageFinal = "../".$pathImage;
        if(file_exists($pathImageFinal)){
            unlink($pathImageFinal);
        }
    }

    public static function deleteDirectoryContact($id_user, $folder){
        $pathDirectory = "../views/img/users/".$folder."/".$id_user;
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($pathDirectory, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST) as $path) {
            $path->isDir() && !$path->isLink() ? rmdir($path->getPathname()) : unlink($path->getPathname());
        }
        rmdir($pathDirectory);
        
    }

    public static function fixTime($time){
        $dbFormat = null;
        if(!empty($time)){
            $dbFormat = date('H:i:s', strtotime($time));
        }
        return $dbFormat;
        
    }

    public static function ArrayToString($array){
        $string = null;
        if(!empty($array)){
            $string = implode(",", $array);
        }

        return $string;
    }

    public static function StringToArray($string){

        $array = null;
        if(!empty($string)){
            $array = explode(",", $string);
        }

        return $array;

    }

    public static function timeAgo($fechaInicio,$fechaFin){
        $fecha1 = new DateTime($fechaInicio);
        $fecha2 = new DateTime($fechaFin);
        $fecha = $fecha1->diff($fecha2);
        $tiempo = "";
            
        //años
        if($fecha->y > 0)
        {
            $tiempo .= $fecha->y;
                
            if($fecha->y == 1)
                $tiempo .= " año, ";
            else
                $tiempo .= " años ";
        }
            
        //meses
        if($fecha->m > 0)
        {
            $tiempo .= $fecha->m;
                
            if($fecha->m == 1)
                $tiempo .= " mes, ";
            else
                $tiempo .= " meses ";
        }
        /*
        //dias
        if($fecha->d > 0)
        {
            $tiempo .= $fecha->d;
                
            if($fecha->d == 1)
                $tiempo .= " día, ";
            else
                $tiempo .= " días ";
        }
        
        //horas
        if($fecha->h > 0)
        {
            $tiempo .= $fecha->h;
                
            if($fecha->h == 1)
                $tiempo .= " hora, ";
            else
                $tiempo .= " horas, ";
        }
            
        //minutos
        if($fecha->i > 0)
        {
            $tiempo .= $fecha->i;
                
            if($fecha->i == 1)
                $tiempo .= " minuto";
            else
                $tiempo .= " minutos";
        }
        
        else if($fecha->i == 0) //segundos
            $tiempo .= $fecha->s." segundos";
        */
        return $tiempo;
    }

    public static function CalculateAge($fechaInicio,$fechaFin){
        $fecha1 = new DateTime($fechaInicio);
        $fecha2 = new DateTime($fechaFin);
        $fecha = $fecha1->diff($fecha2);
        $tiempo = "";
            
        
        //años
        if($fecha->y > 0)
        {
            $tiempo .= $fecha->y;
                
            if($fecha->y == 1)
                $tiempo .= " año, ";
            else
                $tiempo .= " años ";
        }
        /*  
        //meses
        if($fecha->m > 0)
        {
            $tiempo .= $fecha->m;
                
            if($fecha->m == 1)
                $tiempo .= " mes, ";
            else
                $tiempo .= " meses ";
        }
        
        //dias
        if($fecha->d > 0)
        {
            $tiempo .= $fecha->d;
                
            if($fecha->d == 1)
                $tiempo .= " día, ";
            else
                $tiempo .= " días ";
        }
        
        //horas
        if($fecha->h > 0)
        {
            $tiempo .= $fecha->h;
                
            if($fecha->h == 1)
                $tiempo .= " hora, ";
            else
                $tiempo .= " horas, ";
        }
            
        //minutos
        if($fecha->i > 0)
        {
            $tiempo .= $fecha->i;
                
            if($fecha->i == 1)
                $tiempo .= " minuto";
            else
                $tiempo .= " minutos";
        }
        
        else if($fecha->i == 0) //segundos
            $tiempo .= $fecha->s." segundos";
        */
        return $tiempo;
    }

    public static function days(){
        $days = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');

        return $days;
    }

    public static function optionsComunication(){
        $days = array('Redes Sociales', 'Internet', 'Publicidad');

        return $days;
    }

    public static function ordersComunication(){
        $orders = array('Telefono', 'Correo', 'Whatsapp', 'Visita');

        return $orders;
    }

    public static function convertToAMPM($datetime){

        $newDateTime = null;
        if(!empty($datetime)){
            $newDateTime = date('h:i A', strtotime($datetime));
        }
        return $newDateTime;
        
    }

    public static function RangeDateFix($dateTimeContract){
        //16/02/2019 02:00 PM - 23/03/2019 02:00 PM

        $dateFiexed = null;
        if(!empty($dateTimeContract)){

            $dates = explode('-', $dateTimeContract);
            $dates = array(trim($dates[0]), trim($dates[1]));

            
            date_default_timezone_set('America/Monterrey');

            $startContract = new DateTime(str_replace("/", "-",$dates[0]));
            //$startDate = $startContract->format('Y-m-d');
            //$startTime = $startContract->format('H:i');

            $endContract = new DateTime(str_replace("/", "-",$dates[1]));
            //$endDate = $endContract->format('Y-m-d');
            //$endTime = $endContract->format('H:i');

            $dateFiexed = array('Start' => $startContract->format("Y-m-d H:i:s"), 
                                'End' => $endContract->format("Y-m-d H:i:s"));

           
        }
        
        return $dateFiexed;

    }

    public static function ConvertRangeDatesStart($start_contract){

        $dateFiexed = null;

        if(!empty($start_contract)){

            date_default_timezone_set('America/Monterrey');

            $startContract = new DateTime($start_contract);
                

            $dateFiexed = ($startContract->format("d/m/Y h:i A"));
        }

        return $dateFiexed;
        

    }

    public static function ConvertRangeDatesEnd($end_contract){

        $dateFiexed = null;

        if(!empty($end_contract)){

            date_default_timezone_set('America/Monterrey');            
    
            $endContract = new DateTime($end_contract);

            $dateFiexed = ($endContract->format("d/m/Y h:i A"));
        }

        return $dateFiexed;
        

    }

    public static function CalculateMonth($mes){
        if ($mes=="January") $mes="Enero";
        if ($mes=="February") $mes="Febrero";
        if ($mes=="March") $mes="Marzo";
        if ($mes=="April") $mes="Abril";
        if ($mes=="May") $mes="Mayo";
        if ($mes=="June") $mes="Junio";
        if ($mes=="July") $mes="Julio";
        if ($mes=="August") $mes="Agosto";
        if ($mes=="September") $mes="Setiembre";
        if ($mes=="October") $mes="Octubre";
        if ($mes=="November") $mes="Noviembre";
        if ($mes=="December") $mes="Diciembre";
        return $mes;
    }


    public static function ConvertRangeDatesEndName($end_contract){

        $dateFiexed = null;

        if(!empty($end_contract)){

            setlocale(LC_ALL,"es_ES");
            
            date_default_timezone_set('America/Monterrey');  
            
            
    
            $endContract = new DateTime($end_contract);
            $month = self::CalculateMonth($endContract->format("F"));
            $day = self::CalculateMonth($endContract->format("d"));
            $dateFiexed = $day."/".$month.($endContract->format("/Y h:i A"));
        }

        return $dateFiexed;
        
    }

    public static function terminateOrNotStringtoDate($endDate)
    {
        date_default_timezone_set('America/Monterrey');  
        $crtDate = new DateTime(date("Y-m-d H:i:s"));
        $termDate = new DateTime($endDate);
        $remaining = date_diff($crtDate, $termDate);
        $remaining = $remaining->format("%R%a");
        return $remaining;
    }

    public static function CalculateTime($fechaFin){

        date_default_timezone_set('America/Monterrey');  

        $fecha1 = new DateTime(date("Y-m-d H:i:s"));
        $fecha2 = new DateTime($fechaFin);
        $fecha = $fecha1->diff($fecha2);

        $remaining = date_diff($fecha1, $fecha2);
        $remaining = $remaining->format("%R%a");
        $tiempo = "";
            
        
        //años 
        /*
        if($fecha->y > 0)
        {
            $tiempo .= $fecha->y;
                
            if($fecha->y == 1)
                $tiempo .= " año, ";
            else
                $tiempo .= " años ";
        }
          
        //meses
        if($fecha->m > 0)
        {
            $tiempo .= $fecha->m;
                
            if($fecha->m == 1)
                $tiempo .= " mes, ";
            else
                $tiempo .= " meses ";
        }
        */
        //dias
        if($fecha->d > 0)
        {
            $tiempo .= $fecha->d;
                
            if($fecha->d == 1)
                $tiempo .= " día, ";
            else
                $tiempo .= " días ";
        }
        
        //horas
        if($fecha->h > 0)
        {
            $tiempo .= $fecha->h;
                
            if($fecha->h == 1)
                $tiempo .= " hora, ";
            else
                $tiempo .= " horas, ";
        }
            
        //minutos
        if($fecha->i > 0)
        {
            $tiempo .= $fecha->i;
                
            if($fecha->i == 1)
                $tiempo .= " minuto";
            else
                $tiempo .= " minutos";
        }

        //segundos

        /*
        else if($fecha->i == 0) {
            $tiempo .= $fecha->s." segundos";
        }
        */  
        
        return $tiempo = array('time' => $tiempo, 'remaining' => $remaining, 'daysRemaining' => $fecha->d);
    }




}

?>
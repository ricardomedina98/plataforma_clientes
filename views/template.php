<?php
    ob_start();
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Alcon Supermarket</title>

    <?php
        $url = Routes::getRoute();
    ?>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="<?php echo $url;?>assets/template.js"></script>


</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
  

    <?php
        if(isset($_SESSION['login']) && $_SESSION['login'] == true){

            echo '<div class="wrapper">';
            /*=============================================
            HEADER
            =============================================*/
            include 'modules/header.php';
            /*=============================================
            SIDEBAR
            =============================================*/
            include 'modules/sidebar.php';

            /*=============================================
            CONTENIDO
            =============================================*/

            $views = array();
            $value1 = null;
            $value2 = null;


            if(isset($_GET['view'])){

                $views = explode("/", $_GET["view"]);

                $value1 = $views[0];

                if(isset($views[1])){
                    $value2 = $views[1];
                }

                /* SECCION DE CONTACTOS Y AGREGAR CONTACTO */
                if($value1=="contactos" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')){
                    $value3 = explode("-", $value2);

                    if($value3[0] == "pagina") {                    
                        $pagination = $value3[1];
                        include "modules/contacts.php";              
                    } else if($value1=="contactos" && $value2=="buscar"){
                        
                        include "modules/searchContact.php";

                    } elseif(!empty($value2)) {

                        $id = ContactController::controllerprofileContact($value2);

                        if($id['id_contact'] == $value2){
                            include "modules/profile_contact.php";
                        } else {
                            include "modules/404.php";
                        }                    

                    } elseif($value1=="contactos") {

                        include "modules/contacts.php";

                    } else {
                        
                        include "modules/404.php";  
                    }

                } 
                
                elseif($value1=="agregarContacto" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')) {

                    include "modules/addContact.php";
                    
                } 
                
                
                /* SECCION DE NEGOCIOS Y AGREGAR NEGOCIOS */
                elseif($value1=="negocios" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')) {

                    $value3 = explode("-", $value2);

                    if($value3[0] == "pagina") {                    
                        $pagination = $value3[1];
                        include "modules/businesses.php";              
                    } else if($value1=="negocios" && $value2=="buscar"){
                        
                        include "modules/searchBusiness.php";

                    } else if(!empty($value2)) {

                        $id = BusinessController::controllerprofileBusiness($value2);

                        if($id['id_business'] == $value2){

                            include "modules/profile_business.php";

                        } else {
                            include "modules/404.php";
                        }                    

                    } elseif($value1=="negocios") {

                        include "modules/businesses.php";

                    } else {
                        
                        include "modules/404.php";  
                    }
                } 
                
                
                elseif($value1=="agregarNegocio" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')) {

                    include "modules/addBusiness.php";
                    
                }
                
                
                
                /* SECCION DE DUEÑOS Y AGREGAR DUEÑOS */
                elseif($value1=="duenos" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')) {

                    $value3 = explode("-", $value2);

                    if($value3[0] == "pagina") {                    
                        $pagination = $value3[1];
                        include "modules/owners.php";
                    } else if($value1=="duenos" && $value2=="buscar"){

                        include "modules/searchOwner.php";

                    } else if(!empty($value2)) {

                        $id = OwnerController::controllerShowProfile($value2);

                        if($id['id_owner'] == $value2){

                            include "modules/profile_owner.php";

                        } else {
                            include "modules/404.php";
                        }                    

                    } elseif($value1=="duenos") {

                        include "modules/owners.php";

                    } else {
                        
                        include "modules/404.php";  
                    }
                } 

                elseif($value1=="agregarDueno" && ($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador')) {

                    include "modules/addOwner.php";
                    
                }

                
                elseif($value1=="usuarios" && $_SESSION['type_user'] == 'Administrador') {

                    include "modules/users.php";
                    
                }
                

                elseif($value1=="productos" && $_SESSION['type_user'] == 'Administrador') {

                    include "modules/products.php";
                    
                }

                elseif($value1=="empleados" && $_SESSION['type_user'] == 'Administrador' || $_SESSION['type_user'] == 'Recursos Humanos') {

                    $value3 = explode("-", $value2);
                    if($value3[0] == "descargar"){

                        $file = $value3[1]; 
                        $idEmployeePDF =  $value3[2];
                        
                        include "modules/employee_pdf.php";
                        
                    } else {
                        include "modules/employees.php";
                    }
                    
                    
                }
                
                elseif($value1=="salir") {

                    include "modules/log_out.php";

                }
                
                elseif($value1=="inicio") {

                    include "modules/home.php";

                } else {

                    include "modules/404.php";  
                    
                }
                

                
            

            } else {
                include "modules/home.php";
            }
            

            include 'modules/footer.php';


            
        } else {

            include 'modules/login.php';

        }?>

</div>

<script src="<?php echo $url;?>assets/alerts.js"></script>


</body>
</html>

<?php
ob_end_flush();
?>
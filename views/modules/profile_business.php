<?php


$updateBusiness = BusinessController::controllerUpdateBusiness();

$addressUpdate = new BusinessController();
$addressUpdate -> controllerUpdateAlt();

$addressAlt = new BusinessController();
$addressAlt -> controllerAddAddressAlt();
            

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Perfil

        <small>Perfil Negocio</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Perfil Negocio</li>

      </ol>
    </section>

    <section class="content">

        <div id="alert">
            
        </div>

        <div class="row">

            <div class="col-md-3">

                    <div class="box box-primary">

                        <div class="box-body box-profile">

                            <?php

                            $requestBusiness = BusinessController::controllerprofileBusiness($value2);


                            echo '

                            <img class="profile-user-img img-responsive img-rounded imgProfileView" src="' . $url . $requestBusiness['profile_photo'] . '">

                            <h3 class="profile-username text-center">' . $requestBusiness['commercial_name'] .'</h3>';
                            
                            if (!empty($requestBusiness['fiscal_name'])) {
                                echo '
                                    <p class="text-muted text-center">' . $requestBusiness['fiscal_name'] . '</p>
                                ';
                            }

                            if(!empty($requestBusiness["dateRegistration"]) || !empty($requestBusiness["timeBusinessI"]) || !empty($requestBusiness["timeBusinessF"]) || !empty($requestBusiness["invoice"])){
                                echo '
                                <ul class="list-group list-group-unbordered">
                                ';

                                if (!empty($requestBusiness["dateRegistration"])) {
                                    $dateCurrent = date('Y-m-d');
                                    echo '
                                        <li class="list-group-item">
                                            <b>Fecha de Registro</b> <span class="pull-right"><span class="text-muted">('.Helper::ConvertDate($requestBusiness['dateRegistration']).') </span>' . Helper::timeAgo($requestBusiness['dateRegistration'], $dateCurrent) . '</span>
                                        </li>
                                    ';
                                }
                                

                                if (!empty($requestBusiness["timeBusinessI"]) || !empty($requestBusiness["timeBusinessF"])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Horario</b> <span class="pull-right">' . Helper::convertToAMPM($requestBusiness["timeBusinessI"]).' a '. Helper::convertToAMPM($requestBusiness["timeBusinessF"]).'</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestBusiness['frequency'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Frecuencia</b> <span class="pull-right">' . $requestBusiness['frequency'] . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestBusiness['invoice'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Factura</b> <span class="pull-right">' . ($requestBusiness['invoice'] ? 'SI':'NO') . '</span>
                                        </li>
                                    ';
                                }

                                echo '</ul>';
                            }
                            ?>
                        </div>
                        
                    </div>

                    <?php

                    if(!empty($requestBusiness["city"]) || !empty($requestBusiness["street"]) || !empty($requestBusiness["colony"]) || !empty($requestBusiness["local"]) || !empty($requestBusiness["state"]) || !empty($requestBusiness['email'])  || !empty($requestBusiness['perfil_facebook']) && !empty($requestBusiness['url_facebook']) || !empty($requestBusiness['comments'])){

                        echo '
                        <div class="box box-primary">
                            <div class="box-header with-border">';
                            if(empty($requestBusiness["alias"])){
                                echo '<h3 class="box-title">Sobre el negocio</h3>';
                            } else {
                                echo '<h3 class="box-title">Sobre '.$requestBusiness["alias"].'</h3>';
                            }
                        echo '</div>';

                        echo '
                        <div class="box-body">';

                        if(!empty($requestBusiness["city"]) || !empty($requestBusiness["street"]) || !empty($requestBusiness["colony"]) || !empty($requestBusiness["local"]) || !empty($requestBusiness["state"])){
                            echo '
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion</strong>

                            <p class="text-muted">
                                '.$requestBusiness["street"].' '.$requestBusiness["colony"].' '.$requestBusiness["local"].' '.$requestBusiness["city"].' '.$requestBusiness["state"].' 
                            </p>

                            <hr>';
                        }

                        if (!empty($requestBusiness['email'])) {
                            echo '
                                <strong><i class="fa fa-envelope margin-r-5"></i> Correo</strong>
                                <br>

                                <span class="text-muted">' . $requestBusiness['email'] . '</span>


                                <hr>
                            ';
                        }

                        if (!empty($requestBusiness['perfil_facebook']) && !empty($requestBusiness['url_facebook'])) {
                            echo '
                            <strong><i class="fa fa-facebook-official margin-r-5"></i>Facebook</strong>
                            <br>
                            <span class="text-muted">' . $requestBusiness['perfil_facebook'] . '</span> <a href="' . $requestBusiness['url_facebook'] . '" target="_blank" class="pull-right">Ver</a>

                            <hr>
                            ';
                        }

                        if (!empty($requestBusiness['comments'])) {
                            echo '
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Comentarios</strong>

                            <p>' . $requestBusiness['comments'] . '</p>
                            ';
                        }

                        echo '
                            </div>
                        
                        </div>';
                    }
                    ?>  

                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Descargar Datos</h3>

                            <div class="box-body text-center">

                                <form method="post">
                                    <input name="" id="" class="btn btn-block btn-danger" type="submit" value="PDF">
                                </form>
                                
                            </div>
                            
                        </div>
                    </div>
                    
            </div>
            
                
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#informacion" data-toggle="tab">Informacion</a></li>
                        <li ><a id="fotosUpload" href="#fotos" data-toggle="tab">Fotos</a></li>
                        <li><a href="#direccionAlt" data-toggle="tab">Direcciones Alternas</a></li>
                        <!--<li><a href="#amigos" data-toggle="tab">Amigos o Familiares</a></li>
                        <li><a href="#referidos" data-toggle="tab">Referidos</a></li>-->
                        <li><a href="#editar" data-toggle="tab">Editar</a></li>
                        
                    </ul>
                </div>

                <div class="tab-content">

                    <div class="active tab-pane" id="informacion">
                        <div class="box box-primary">

                            <div class="box-body">
                                <?php
                                    $dateCurrent = date('Y-m-d');
                                    if(!empty($requestBusiness["timeBusinessI"]) || !empty($requestBusiness["timeBusinessF"])){
                                        echo '<h4 class="information">Horario</h4><span>' . Helper::convertToAMPM($requestBusiness["timeBusinessI"]).' a '.Helper::convertToAMPM($requestBusiness["timeBusinessF"]).'</span>';
                                    }

                                    if(!empty($requestBusiness["days_available"])){
                                        echo '<h4 class="information">Dias Disponibles</h4><span>'.($requestBusiness["days_available"]).'</span>';
                                    }

                                    if(!empty($requestBusiness["how_know_us"])){
                                        echo '<h4 class="information">¿Como supo de nosotros?</h4><span>'.$requestBusiness["how_know_us"].'</span>';
                                    }

                                    if(!empty($requestBusiness["business_antiquity"])){
                                        echo '<h4 class="information">Antiguedad del Negocio:</h4><span>'.(Helper::timeAgo($requestBusiness["business_antiquity"], $dateCurrent)).'</span>';   
                                    }

                                    if(!empty($requestBusiness["customer_antiquity"])){
                                        echo '<h4 class="information">Antiguedad como cliente</h4><span>'.(Helper::timeAgo($requestBusiness["customer_antiquity"], $dateCurrent)).'</span>';
                                    }
                                    
                                ?>
                            </div>

                        </div>
            

                    </div>

                    <div class="tab-pane" id="fotos">
                        
                        <div class="post">
   
                            <div class="row ">
                                <div class="col-sm-12">
                                    <div class="timeline-body" id="photosContact">

                                    <!--Preview photos-->
                                                                   
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                        
                    </div>
                    

                    <div class="tab-pane" id="editar">
                        <form class="form-horizontal" id="fileupload" method="POST" enctype="multipart/form-data">

                            <div class="form-group">

                                <label for="photoprofileContact" class="col-sm-2 control-label">Foto de Perfil</label>
                                        
                                <?php 
                                echo '
                                <div class="col-sm-3 col-lg-8" style="text-align: center;">                                    
                                    <img class="img-responsive imgProfile" src="' . $url . $requestBusiness['profile_photo'] . '">

                                    <button class="btn btn-default" type="button" id="btnChangePhotoContact" name="btnChangePhotoContact">Cambiar foto de perfil</button>
                                    
                                    <div id="uploadImage">
                                        <img class="previewImage">
                                        <input id="dataImageProfile" name="imageProfileBusiness" type="file">
                                    </div>
                                    
                                </div>
                                
                            </div>';

                            echo '
                            
                            <div class="form-group">

                                <label for="nameBusiness" class="col-sm-2 control-label">Nombre</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="businessName" name="businessName" placeholder="Nombre Comercial" type="text" autocomplete="off" value="'.$requestBusiness['commercial_name'].'">
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="fiscalName" name="fiscalName" placeholder="Nombre Fiscal" type="text" autocomplete="off" value="'.$requestBusiness['fiscal_name'].'">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="typeBusiness" class="col-sm-2 control-label">Tipo de Negocio</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="typeBusiness" name="typeBusiness" placeholder="Tipo de Negocio" type="text" autocomplete="off" value="'.$requestBusiness['type_business'].'">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="phoneBusiness" class="col-sm-2 control-label">Telefono del Negocio</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="phoneBusiness" name="phoneBusiness" type="text" autocomplete="off" value="'.$requestBusiness['phone_business'].'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="invoice" class="col-sm-2 control-label">Factura</label>
                                <div class="col-sm-3">
                                    <select id="invoice" name="invoice" class="form-control">
                                        <option value="">Selecciona una opcion</option>    
                                        <option value="1" '.($requestBusiness['invoice'] ? "selected" : "").'>Si</option>
                                        <option value="0" '.($requestBusiness['invoice'] ? "" : "selected").'>No</option>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Registro</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="dateRegistration" name="dateRegistration"
                                            type="text" autocomplete="off" value="'.(Helper::ConvertDate($requestBusiness['dateRegistration'])).'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="comunication" class="col-sm-2 control-label">¿Como supo de nosotros?</label>
                                
                                <div class="col-sm-3">
                                    <select class="form-control" id="comunication" name="comunication[]" multiple="multiple" style="width: 100%">';
                                    try{

                                        $optionsComUser = Helper::StringToArray($requestBusiness['how_know_us']);
                                        $optionsCom = Helper::optionsComunication();
                                        for ($d=0; $d < count($optionsComUser); $d++) { 

                                            if($optionsCom[$d] == $optionsComUser[$d]){ 
                                                $option = $optionsCom[$d];
                                                echo '<option value="'.$optionsCom[$d].'" selected>'.$optionsCom[$d].'</option>';
                                            } 

                                            if($optionsCom[$d] !== $option){
                                                echo '<option value="'.$optionsComUser[$d].'" selected>'.$optionsComUser[$d].'</option>';
                                            }
                                        }

                                    }catch(Exception $exception){

                                    }
                                    
                                    echo '
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="daysAvailable" class="col-sm-2 control-label">Dias Disponibles</label>
                                
                                <div class="col-sm-4">
                                    <select class="form-control" id="daysAvailable" name="daysAvailable[]" multiple="multiple" style="width: 100%">';

                                    try{

                                        $optionsDays = Helper::StringToArray($requestBusiness['days_available']);
                                        $days = Helper::days();
                                        for ($d=0; $d < count($days); $d++) { 
                                            
                                            for ($i=0; $i < count($optionsDays); $i++) { 
                                                if($days[$d] == $optionsDays[$i]){ 
                                                    $day = $days[$d];
                                                    echo '<option value="'.$days[$d].'" selected>'.$days[$d].'</option>';
                                                } else {
                                                    
                                                }
                                            }
                                            
                                            if($days[$d] !== $day){
                                                echo '<option value="'.$days[$d].'" >'.$days[$d].'</option>';
                                            }
                                            

                                        }

                                    } catch(E_WARNING $exception){

                                    }
                                    

                                    echo '
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="timePickerI" class="col-sm-2 control-label">Horario</label>

                                <div class="col-sm-2">
                                    <input class="form-control time ui-timepicker-input" id="timePickerI" name="timePickerI" type="text" autocomplete="off" value="'.$requestBusiness['timeBusinessI'].'">
                                </div>

                                <div class="col-sm-2">
                                    <input class="form-control time ui-timepicker-input" id="timePickerF" name="timePickerF" type="text" autocomplete="off" value="'.$requestBusiness['timeBusinessF'].'">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="frequencyBusiness" class="col-sm-2 control-label">Frecuencia de Compra</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="frequencyBusiness" name="frequencyBusiness" placeholder="Frecuencia"
                                        type="text" autocomplete="off" value="'.$requestBusiness['frequency'].'">
                                </div>

                            </div>

                            <br>

                            <div class="form-group">

                                <label for="businessAntiquity" class="col-sm-2 control-label">Antiguedad del Negocio</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="businessAntiquity" name="businessAntiquity"
                                            type="text" autocomplete="off" value="'.(Helper::ConvertDate($requestBusiness['business_antiquity'])).'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="businessCustomer" class="col-sm-2 control-label">Antiguedad como Cliente</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="businessCustomer" name="businessCustomer"
                                            type="text" autocomplete="off" value="'.(Helper::ConvertDate($requestBusiness['customer_antiquity'])).'">
                                    </div> 
                                </div>

                            </div>

                            

                            <div class="form-group">
                                <label for="phoneBusiness" class="col-sm-2 control-label">Telefonos del Negocio</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>

                                            <select class="form-control" id="phonesBusiness" name="phonesBusiness[]" multiple="multiple" style="width: 100%">';

                                            $phones = Helper::StringToArray($requestBusiness['phones_business']);
                                            foreach ($phones as $phone) {
                                                echo '<option value="'.$phone.'" selected>'.$phone.'</option>';
                                            }
                                            echo '

                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="emailBusiness" class="col-sm-2 control-label">Correo</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="emailBusiness" name="emailBusiness" placeholder="Correo electronico"
                                            type="email" autocomplete="off" value="'.$requestBusiness['email'].'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="urlMaps" class="col-sm-2 control-label">Google Maps</label>

                                <div class="col-sm-7">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-map" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="urlMaps" name="urlMaps" placeholder="URL del Google Maps" type="text" autocomplete="off" value="'.$requestBusiness['url_googlemaps'].'">
                                    </div>
                                </div>

                            </div>
                            
                            <div class="form-group">
                                <label for="profileFacebook" class="col-sm-2 control-label">Facebook</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="profileFacebook" name="facebook" placeholder="Perfil de Facebook" type="text" autocomplete="off" value="'.$requestBusiness['perfil_facebook'].'">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="URLFacebook" name="urlFacebook" placeholder="URL del Perfil" type="text" autocomplete="off" value="'.$requestBusiness['url_facebook'].'">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label for="addressStreet" class="col-sm-2 control-label">Direccion</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreet" name="addressStreet" placeholder="Calle" type="text" autocomplete="off" value="'.$requestBusiness['street'].'">
                                </div>
                
                                <div class="col-sm-3">
                                    <input class="form-control" id="addressColony" name="addressColony" placeholder="Colonia" type="text" autocomplete="off" value="'.$requestBusiness['colony'].'">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressLocal" name="addressLocal" placeholder="Local" type="text" autocomplete="off" value="'.$requestBusiness['local'].'">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="addressStreet" class="col-sm-2 control-label"></label>
                                
                                <select class="col-sm-3" id="addressState" name="addressState" title="Selecciona un estado" data-live-search="true">
                                    <input id="valState" value="' . $requestBusiness['state'] . '" hidden>
                                </select>

                                <select class="col-sm-3" id="addressCity" name="addressCity" title="Selecciona un ciudad" data-live-search="true">
                                <input id="valCity" value="' . $requestBusiness['city'].'" hidden>
                                </select>

                            </div>
                            
                            <br>

                            <div class="form-group">

                                <label for="commentsBusiness" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <textarea name="commentsBusiness" id="commentsBusiness" cols="80" rows="5">'.$requestBusiness['comments'].'</textarea>

                                </div>

                            </div>

                            <br>
                            ';
                            ?>


                            <div class="form-group">

                                <label for="inputfilephoto" class="col-sm-2 control-label">Fotos</label>
                                

                                <div class="row ">
                                
                                    <div class="col-sm-8 col-md-9 images-gallery">
                                    
                                        <div class="timeline-body" id="photosContactUpload">
                                        
                                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                            <div class="row fileupload-buttonbar">
                                                <div class="col-lg-12">
                                                    <!-- The fileinput-button span is used to style the file input field as button -->
                                                    <span class="btn btn-success fileinput-button">
                                                        <i class="glyphicon glyphicon-plus"></i>
                                                        <span>Seleccionar archivos</span>
                                                        <input type="file" id="inputUpload" name="files[]" multiple>
                                                    </span>
                                                    <button class="btn btn-primary start">
                                                        <i class="glyphicon glyphicon-upload"></i>
                                                        <span>Subir</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning cancel">
                                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                                        <span>Cancelar</span>
                                                    </button>
                                                    <button type="button" class="btn btn-danger delete">
                                                        <i class="glyphicon glyphicon-trash"></i>
                                                        <span>Eliminar</span>
                                                    </button>
                                                    <input type="checkbox" class="toggle">
                                                    <!-- The global file processing state -->
                                                    <span class="fileupload-process"></span>
                                                </div>
                                                
                                                <?php                                                
                                                    echo '
                                                    <input type="hidden" id="id_user" name="id_user" value="'.$requestBusiness['id_business'].'">
                                                    <input type="hidden" id="id_type" name="id_type" value="negocios">';
                                                ?>
                                                <!--Dropzone-->
                                                
                                                <div id="dropzone" class="fade">Suelta tus archivos aqui</div>
                                                <!-- The global progress state -->
                                                <div class="col-lg-5 fileupload-progress fade">
                                                    <!-- The global progress bar -->
                                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                    </div>
                                                    <!-- The extended global progress state -->
                                                    <div class="progress-extended">&nbsp;</div>
                                                </div>
                                            </div>

                                            <!-- The table listing the files available for upload/download -->
                                            <table role="presentation" id="tableShowImages" class="table table-striped"><tbody class="files"></tbody></table>
                             
                                        </div>

                                        
                                    </div>

                                </div>

                                <div class="form-group ">
                                    <div class="col-sm-offset-2 col-sm-3">
                                        <button type="submit" id="saveBusinessEdit" name="saveBusinessEdit" class="btn btn-primary">Guardar cambios</button>
                                    </div>

                                    <div class="col-sm-3 pull-right">
                                        <button type="submit" id="deleteBusinessEdit" name="deleteBusinessEdit" class="btn btn-danger">Eliminar negocio</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                            
                    </div>

                    <div class="tab-pane" id="direccionAlt">
                   
                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title">Direcciones alternas o sucursales/ Mercado sobre ruedas/ Comedores</h3>
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalSucursales" id="btnAgregarDirAlt">Agregar direccion alterna</button>
                            </div>

                            <div class="box-body">
        
                                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                
                                    <thead>
                                    
                                        <tr>
                                            
                                            <th style="width:10px">#</th>
                                            <th>Nombre Negocio</th>
                                            <th>Telefono</th>
                                            <th>Local</th>  
                                            <th>Calle</th> 
                                            <th>Colonia</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>                                            
                                            <th>Acciones</th>
                                
                                        </tr> 
                            
                                    </thead>
                            
                                    <tbody>

                                        <?php
                                            $resultAddressAlt = BusinessController::controllershowAddressAlt($requestBusiness['id_business']);
                                            
                                            foreach ($resultAddressAlt as $key => $valueAlt) {
                                                echo '
                                                <tr>
                                                <td>'.($key+1).'</td>
                                                <td>'.$valueAlt['name_business'].'</td>
                                                <td>'.$valueAlt['phone_business'].'</td>
                                                <td>'.$valueAlt['local'].'</td>
                                                <td>'.$valueAlt['street'].'</td>
                                                <td>'.$valueAlt['colony'].'</td>                                            
                                                <td>'.$valueAlt['city'].'</td>
                                                <td>'.$valueAlt['state'].'</td>                                                                                                                                                         
                                                <td>
                                    
                                                    <div class="btn-group">
                                                        
                                                        <button class="btn btn-warning btnEditUser" idUser="'.$valueAlt['id_alt_address'].'" data-toggle="modal" data-target="#modalEditSucursales"><i class="fa fa-pencil"></i></button>
                                        
                                                        <button class="btn btn-danger btnDeleteUser"><i class="fa fa-times"></i></button>
                                        
                                                    </div>  
                                    
                                                </td>
                                    
                                                </tr>';
                                            }
                                            
                                        ?>
                                    
                                        
                            
                                    </tbody>
                        
                                </table>
                        
                            </div>

                        </div>
                        
                        
                    

                        <div class="col-sm-12">
                            <iframe id="iframeGoogleMaps" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                    </div>

                    <div class="tab-pane" id="amigos">

                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title">Amigos o Familiares que nos compren</h3>
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalFamilia" id="btnAgregarFam">Agregar amigos o familiares</button>
                            </div>

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                
                                    <thead>
                                    
                                        <tr>
                                            
                                            <th style="width:10px">#</th>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Relacion</th>                            
                                            <th>Acciones</th>
                                
                                        </tr> 
                            
                                    </thead>
                            
                                    <tbody>
                                    
                                        <tr>
                                            <td>1</td>
                                            <td>Jose Ricardo</td>
                                            <td>Medina</td>
                                            <td>Lopez</td>
                                            <td>Amigo</td>
                                            <td>
                                
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                
                                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                
                                            </div>  
                                
                                            </td>
                                
                                        </tr>
                            
                                    </tbody>
                        
                                </table>

                                
                            </div>

                        </div>

                    </div>
                    
                    <div class="tab-pane" id="referidos">

                        <div class="box box-primary">

                            <div class="box-header with-border">
                                <h3 class="box-title">Referidos</h3>
                                <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalReferidos" id="btnAgregarRef">Agregar referidos</button>
                            </div>

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                
                                    <thead>
                                    
                                        <tr>
                                            
                                            <th style="width:10px">#</th>
                                            <th>Nombre Referido</th>
                                            <th>Telefono</th>
                                            <th>Calle</th> 
                                            <th>Colonia</th>
                                            <th>Ciudad</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                
                                        </tr> 
                            
                                    </thead>
                            
                                    <tbody>
                                    
                                        <tr>
                                            <td>1</td>
                                            <td>Jose Ricardo</td>
                                            <td>8184706021</td>
                                            <td>15 de Mayo</td>  
                                            <td>Valles de Solidaridad</td>
                                            <td>Monterrey</td>   
                                            <td>Nuevo Leon</td>
                                                                                              
                                            <td>
                                
                                            <div class="btn-group">
                                                
                                                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                
                                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                
                                            </div>  
                                
                                            </td>
                                
                                        </tr>

                            
                                    </tbody>
                        
                                </table>

                            </div>

                        </div>
                    
                    </div>
                    
                        
                </div>
    
            </div>
                
        </div>
            
    </section>

</div>




<script>
    $('#modalTicket').on('show.bs.modal', event => {
        
    });
</script>

<?php

    if(isset($updateBusiness)){
        if($updateBusiness){

            echo '<script> 
                showAlert("Correcto!", "Informacion actualizada correctamente", true);
                
            </script>';
    
           }else {
    
            echo '<script> 
                showAlert("Error!", "La informacion se pudo actualizar correctamente", false);
            </script>';
    
        }
    }

    
    
?>


<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Procesando...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Subir</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <img style="height: 60px;" src="{%=file.thumbnailUrl%}">
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>Descargar</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}<?php echo '&id_type=negocios&id_user='.$requestBusiness['id_business']; ?>"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Eliminar</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancelar</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>


<!-- MODAL AGREGAR NEGOCIO ALTERNO-->
<div id="modalSucursales" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <form role="form" method="post" id="form-addressAlt" enctype="multipart/form-data">
        <div class="modal-content">

        <div class="modal-header text-center" style="background-color: #3c8dbc; color: white;">

            <button type="button" class="close" data-dismiss="modal" style="color: black; margin-right: 0px; font-size: xx-large;">&times;</button>

            <h4 class="modal-title">Direcciones Alternas o Sucursales</h4>

        </div>

        <?php
            echo '<input type="hidden" id="id_business" name="id_business" value="'.$requestBusiness['id_business'].'">';
            
        ?>

        <div class="modal-body">
            
                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre Negocio</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="nameBusiness" name="nameBusiness" placeholder="Nombre del negocio" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefono</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="phoneBusiness" name="phoneBusiness" placeholder="Telefono" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Local</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="localAddress" name="localAddress" placeholder="Local" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Calle</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="streetAddress" name="streetAddress" placeholder="Calle" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Colonia</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="colonyAddress" name="colonyAddress" placeholder="Colonia" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Estado y Ciudad</label>

                        <select class="col-sm-4" id="addressStatemodal" name="addressStatemodal" data-live-search="true">

                            
                            
                        </select>
                        
                        <select class="col-sm-4" id="addressCitymodal" name="addressCitymodal" data-live-search="true">

                            
                            
                        </select>


                    </div>

                </div>
            
            
            
        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="submit" name="btnAddAddressAlt" id="btnAddAddressAlt" class="btn btn-primary pull-right" value="btnAddAddressAlt">Agregar</button>

        </div>
        

        </div>
    </form>

  </div>
</div>

<!-- MODAL EDITAR NEGOCIO ALTERNO-->
<div id="modalEditSucursales" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <form role="form" method="post" enctype="multipart/form-data">
        <div class="modal-content">

        <div class="modal-header text-center" style="background-color: #3c8dbc; color: white;">

            <button type="button" class="close" data-dismiss="modal" style="color: black; margin-right: 0px; font-size: xx-large;">&times;</button>

            <h4 class="modal-title">Direcciones Alternas o Sucursales</h4>

        </div>
        <?php
                echo '<input type="hidden" id="id_alt_address" name="id_alt_address">';
        ?>

        <div class="modal-body">

            
            
                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nombre Negocio</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="nameeditBusiness" name="nameBusiness" placeholder="Nombre del negocio" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Telefono</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="phoneeditBusiness" name="phoneBusiness" placeholder="Telefono" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Local</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="localeditAddress" name="localAddress" placeholder="Local" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Calle</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="streeteditAddress" name="streetAddress" placeholder="Calle" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Colonia</label>

                        <div class="col-sm-6">
                            <input class="form-control" id="colonyeditAddress" name="colonyAddress" placeholder="Colonia" type="text" autocomplete="off">
                        </div>


                    </div>

                </div>

                <div class="row" style="margin-top: 15px;">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Estado y Ciudad</label>

                        <select class="col-sm-4" id="addressStateeditmodal" name="addressStatemodal" data-live-search="true">

                            <input id="valStateEdit" hidden>
                            
                        </select>
                        
                        <select class="col-sm-4" id="addressCityeditmodal" name="addressCitymodal" data-live-search="true">

                            <input id="valCitiesEdit" hidden>
                            
                        </select>


                    </div>

                </div>
            
            
            
        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="submit"  name="btnUpdAddressAlt" id="btnUpdAddressAlt" value="btnUpdAddressAlt" class="btn btn-primary pull-right">Guardar cambios</button>

        </div>

        </div>
    </form>


  </div>
</div>


<!-- MODAL AGREGAR AMIGOS Y FAMILIA-->
<div id="modalFamilia" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color: #3c8dbc; color: white;">

        <button type="button" class="close" data-dismiss="modal" style="color: black; margin-right: 0px; font-size: xx-large;">&times;</button>

        <h4 class="modal-title">Amigos o familiares que compren</h4>

      </div>

      <div class="modal-body">

        <form role="form" method="post" enctype="multipart/form-data">
        
            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombres</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="nameFriends" name="nameFriends" placeholder="Nombres" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Apellido Paterno</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="surNameP" name="surNameP" placeholder="Apellido Paterno" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Apellido Materno</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="surNameM" name="surNameM" placeholder="Apellido Materno" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Relacion</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="streetAddress" name="streetAddress" placeholder="Relacion" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

        
        </form>
        
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary pull-right">Agregar</button>

      </div>

    </div>

  </div>
</div>


<!-- MODAL AGREGAR REFERIDOS-->
<div id="modalReferidos" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <div class="modal-content">

      <div class="modal-header text-center" style="background-color: #3c8dbc; color: white;">

        <button type="button" class="close" data-dismiss="modal" style="color: black; margin-right: 0px; font-size: xx-large;">&times;</button>

        <h4 class="modal-title">Referidos</h4>

      </div>

      <div class="modal-body">

        <form role="form" method="post" enctype="multipart/form-data">
        
            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Nombre Referido</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="nameRef" name="nameRef" placeholder="Nombre del referido" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Telefono</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="phoneRef" name="phoneRef" placeholder="Telefono" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Local</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="localAddress" name="localAddress" placeholder="Local" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Calle</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="streetAddress" name="streetAddress" placeholder="Calle" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Colonia</label>

                    <div class="col-sm-6">
                        <input class="form-control" id="colonyAddress" name="colonyAddress" placeholder="Colonia" type="text" autocomplete="off">
                    </div>


                </div>

            </div>

            <div class="row" style="margin-top: 15px;">

                <div class="form-group">
                    <label class="col-sm-3 control-label">Estado y Ciudad</label>

                    <select class="col-sm-4" id="addressStatemodalRef" name="addressStatemodal" data-live-search="true">

                        
                        
                    </select>
                    
                    <select class="col-sm-4" id="addressCitymodalRef" name="addressCitymodal" data-live-search="true">

                        
                        
                    </select>


                </div>

            </div>
        
        </form>
        
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary pull-right">Agregar</button>

      </div>

    </div>

  </div>
</div>
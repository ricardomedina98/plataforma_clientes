<?php

$updateContact = ContactController::controllerUpdateContact();

$addIncident = ContactController::controllerAddIncident();

$updateIncident = ContactController::controllerUpdateIncident();

$addProduct = ContactController::controllerAddProduct();

$updateProduct = ContactController::controllerUpdateProduct();

$own_business = ContactController::controllerGetOwnBusiness();

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Perfil

        <small>Perfil Contacto</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Perfil Contacto</li>

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
                            $dateCurrent = date('Y-m-d');
                            $requestContact = ContactController::controllerprofileContact($value2);
                            echo '

                            <img class="profile-user-img img-responsive img-rounded imgProfileView" src="' . $url . $requestContact['profile_photo'] . '">

                            <h3 class="profile-username text-center">' . $requestContact['name_contact'] . ' ' . $requestContact['first_surname'] . ' ' . $requestContact['second_surname'] . '</h3>';
                            
                            if (!empty($requestContact['alias'])) {
                                echo '
                                    <p class="text-muted text-center">' . $requestContact['alias'] . '</p>
                                ';
                            }

                            if(!empty($requestContact['date_registration']) || !empty($requestContact['mobile_phone']) || !empty($requestContact['frequency']) || !empty($requestContact['birthday'])){
                                echo '
                                <ul class="list-group list-group-unbordered">
                                ';

                                if (!empty($requestContact['date_registration'])) {
                                    
                                    echo '
                                        <li class="list-group-item">
                                            <b>Fecha de Registro</b> <span class="pull-right"><span class="text-muted">('.Helper::ConvertDate($requestContact['date_registration']).') </span>' . Helper::timeAgo($requestContact['date_registration'], $dateCurrent) . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestContact['mobile_phone'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Celular</b> <span class="pull-right">' . $requestContact['mobile_phone'] . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestContact['frequency'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Frecuencia</b> <span class="pull-right">' . $requestContact['frequency'] . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestContact['birthday'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Fecha de Nacimiento</b> <span class="pull-right"><span class="text-muted">('.Helper::ConvertDate($requestContact['birthday']).') </span>' . Helper::CalculateAge($requestContact['birthday'], $dateCurrent).'</span>
                                        </li>
                                    ';
                                }

                                echo '</ul>';
                            }
                            ?>
                        </div>
                        
                    </div>

                    <?php

                    if(!empty($requestContact["city"]) || !empty($requestContact["street"]) || !empty($requestContact["colony"]) || !empty($requestContact["local"]) || !empty($requestContact["state"]) || !empty($requestContact['email'])  || !empty($requestContact['perfil_facebook']) && !empty($requestContact['url_facebook']) || !empty($requestContact['comments'])){

                        echo '
                        <div class="box box-primary">
                            <div class="box-header with-border">';
                            if(empty($requestContact["alias"])){
                                echo '<h3 class="box-title">Sobre el contacto</h3>';
                            } else {
                                echo '<h3 class="box-title">Sobre '.$requestContact["alias"].'</h3>';
                            }
                        echo '</div>';

                        echo '
                        <div class="box-body">';

                        if(!empty($requestContact["city"]) || !empty($requestContact["street"]) || !empty($requestContact["colony"]) || !empty($requestContact["local"]) || !empty($requestContact["state"])){
                            echo '
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion</strong>

                            <p class="text-muted">
                                '.$requestContact["street"].' '.$requestContact["colony"].' '.$requestContact["local"].' '.$requestContact["city"].' '.$requestContact["state"].' 
                            </p>

                            <hr>';
                        }

                        if (!empty($requestContact['email'])) {
                            echo '
                                <strong><i class="fa fa-envelope margin-r-5"></i> Correo</strong>
                                <br>

                                <span class="text-muted">' . $requestContact['email'] . '</span>


                                <hr>
                            ';
                        }

                        if (!empty($requestContact['perfil_facebook']) && !empty($requestContact['url_facebook'])) {
                            echo '
                            <strong><i class="fa fa-facebook-official margin-r-5"></i>Facebook</strong>
                            <br>
                            <span class="text-muted">' . $requestContact['perfil_facebook'] . '</span> <a href="' . $requestContact['url_facebook'] . '" target="_blank" class="pull-right">Ver</a>

                            <hr>
                            ';
                        }

                        if (!empty($requestContact['comments'])) {
                            echo '
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Comentarios sobre el contacto</strong>

                            <p>' . $requestContact['comments'] . '</p>
                            ';
                        }

                        echo '
                            </div>
                        
                        </div>';
                    }
                    ?> 
                    <?php
                        $business_contact = ContactController::controllerGetBussines($requestContact['id_contact']);
                        if(!empty($business_contact)){
                            echo '
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Negocio</h3>
                                    
                                    <div class="box-body text-center">   
                                        <ul class="users-list clearfix">
                                        <li class="col-xs-12">
                                        <a href="'.$url.'negocios/'.$business_contact['id_business'].'" target="_blank"> <img src="'.$url.$business_contact['profile_photo'].'" alt="User Image" style="width: 150px; height: 150px; "></a>
                                        ';

                                        if(!empty($business_contact['commercial_name'])){
                                            echo '<a class="users-list-name" href="'.$url.'negocios/'.$business_contact['id_business'].'">'.$business_contact['commercial_name'].'</a>';
                                        } else {
                                            echo '<a class="users-list-name" href="'.$url.'negocios/'.$business_contact['id_business'].'">Nombre Desconocido</a>';
                                        }

                                        if(!empty($business_contact['phone_business'])){
                                            echo '
                                            <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                                            <span class="users-list-nametext-muted small">'.$business_contact['phone_business'].'</span>
                                            ';
                                        } else {
                                            echo '
                                            <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                                            <span class="text-muted small">Desconocido</span>
                                            ';
                                        }

                                        if(!empty($business_contact['email'])){
                                            echo '
                                            <br>
                                            <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                                            <span class="text-muted small text-truncate">'.$business_contact['email'].'</span>

                                            ';
                                        } else {
                                            echo '
                                            <br>
                                            <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                                            <span class="text-muted small">Desconocido</span>
                                            ';
                                        }
                                        echo '
                                        </li>
                                        </ul>
                                    </div>
                                    
                                </div>
                            </div> 
                            ';
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
                        <li class="active"><a id="fotosUpload" href="#fotos" data-toggle="tab">Fotos</a></li>
                        <li><a href="#ticket" data-toggle="tab">Ticket</a></li>
                        <li><a href="#incidents" data-toggle="tab">Incidentes</a></li>
                        <li><a href="#productos" data-toggle="tab">Productos</a></li>
                        <li><a href="#editar" data-toggle="tab">Editar</a></li>
                    </ul>
                </div>

                <div class="tab-content">

                    <div class="active tab-pane" id="fotos">
                        
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
                                    <img class="img-responsive imgProfile" src="' . $url . $requestContact['profile_photo'] . '">

                                    <button class="btn btn-default" type="button" id="btnChangePhotoContact" name="btnChangePhotoContact">Cambiar foto de perfil</button>
                                    
                                    <div id="uploadImage">
                                        <img class="previewImage">
                                        <input id="dataImageProfile" name="imageProfileContact" type="file">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="nameContact" class="col-sm-2 control-label">Nombres</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameContact" name="nameContact" placeholder="Nombre" type="text" value="' . $requestContact['name_contact'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1Contact" name="surName1Contact" placeholder="Apellido Paterno" type="text" value="' . $requestContact['first_surname'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2Contact" name="surName2Contact" placeholder="Apellido Materno" type="text" value="' . $requestContact['second_surname'] . '" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="aliasContact" class="col-sm-2 control-label">Apodo</label>

                                <div class="col-sm-5">
                                    <input class="form-control" id="aliasContact" name="aliasContact" placeholder="Apodo" type="text" value="' . $requestContact['alias'] . '" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="own_business" class="col-sm-2 control-label">¿Donde compra?</label>

                                <div class="col-sm-3">
                                    <select class="form-control" id="own_business" name="own_business[]" multiple="multiple">
                                    ';

                                    $own_business_contact = ContactController::controllerGetContactOwnBusiness($requestContact['id_contact']);                                    
                                    foreach ($own_business as $key_business => $business) {

                                        foreach ($own_business_contact as $key_bus_contact => $business_contact) {
                                            if($business_contact['id_own_business'] === $business['id_own_business']) {

                                                $id_own_business = $business_contact['id_own_business'];
                                                echo '<option value="'.$business_contact['id_own_business'].'" selected>'.$business_contact['name_business'].'</option>';

                                            }
                                        }

                                        if($business['id_own_business'] !== $id_own_business) {
                                            echo '<option value="'.$business['id_own_business'].'">'.$business['name_business'].'</option>';
                                        }
                                    }

                                    echo '
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="sellerContact" class="col-sm-2 control-label">Vendedora</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="sellerContact" name="sellerContact" placeholder="Vendedora" value="' . $requestContact['seller'] . '" type="text" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-2 control-label">Frecuencia</label>

                                <div class="col-sm-5">
                                    <input class="form-control" id="frequencyContact" name="frequencyContact" placeholder="Frecuencia" type="text" value="' . $requestContact['frequency'] . '" autocomplete="off">
                                </div>

                            </div>

                            

                            <div class="form-group">
                                <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Registro</label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="dateRegistration" name="dateRegistration" data-mask="dd/mm/yyyy" type="text" value="' . Helper::ConvertDate($requestContact['date_registration']) . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">
                                <label for="phoneContact" class="col-sm-2 control-label">Celular</label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="phoneContact" name="phoneContact" type="text" value="' . $requestContact['mobile_phone'] . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="emailContact" class="col-sm-2 control-label">Correo</label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="emailContact" name="emailContact" placeholder="Correo electronico" type="email" value="' . $requestContact['email'] . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="birthdayContact" class="col-sm-2 control-label">Fecha de Nacimiento</label>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="birthdayContact" name="birthdayContact" type="text" value="' . Helper::ConvertDate($requestContact['birthday']) . '" autocomplete="off">
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
                                        <input class="form-control" id="profileFacebook" name="facebook" placeholder="Perfil de Facebook" type="text" value="' . $requestContact['perfil_facebook'] . '" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="URLFacebook" name="urlFacebook" placeholder="URL del Perfil" type="text" value="' . $requestContact['url_facebook'] . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>                            

                            <div class="form-group">

                                <label for="addressStreet" class="col-sm-2 control-label">Direccion</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreet" name="addressStreet" placeholder="Calle" type="text" value="' . $requestContact['street'] . '" autocomplete="off">
                                </div>
                
                                <div class="col-sm-3">
                                    <input class="form-control" id="addressColony" name="addressColony" placeholder="Colonia" type="text" value="' . $requestContact['colony'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressLocal" name="addressLocal" placeholder="Local" type="text" value="' . $requestContact['local'] . '" autocomplete="off">
                                </div>

                                

                            </div>

                            <div class="form-group">
                                <label for="addressStreet" class="col-sm-2 control-label"></label>

                                <input id="valState" value="' . $requestContact['state'] . '" hidden>
                                <select class="col-sm-3" id="addressState" name="addressState" data-live-search="true">
                                    
                                </select>

                                <input id="valCity" value="' . $requestContact['city'].'" hidden>
                                <select class="col-sm-3" id="addressCity" name="addressCity" data-live-search="true">
                                    
                                </select>
                                

                            </div>

                            <br>
                            

                            
                            <div class="form-group">
                               
                                <label for="aliasContact" class="col-sm-2 control-label">Negocio</label>

                                <div class="col-sm-5">
                                    
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <div class="typeahead__query">
                                                <input class="js-typeahead-business form-control" name="business_name" type="search" value="' . $requestContact['name_business'].'" placeholder="Nombre del Negocio" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                 
                            </div>

                            <div class="form-group">
                               
                                <label for="aliasContact" class="col-sm-2 control-label">Tipo de Negocio</label>

                                <div class="col-sm-5">

                                    <input class="form-control" name="business_type" type="search" value="' . $requestContact['type_business'].'" placeholder="Tipo de Negocio" autocomplete="off">

                                </div>
                                 
                            </div>
                            

                            <br>
                            
                            <div class="form-group">

                                <label for="commentsContact" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <textarea name="commentsContact" id="commentsContact" cols="80" rows="5">' . $requestContact['comments'] . '</textarea>

                                </div>
                                

                            </div>

                            <br>
                            ';
                            ?>


                            <div class="form-group">

                                <label for="inputfilephoto" class="col-sm-2 control-label">Fotos</label>
                                
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
                                                <input type="hidden" id="id_user" name="id_user" value="'.$requestContact['id_contact'].'">
                                                <input type="hidden" id="id_type" name="id_type" value="contactos">';
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

                                    
                                

                                

                                <div class="form-group ">
                                    <div class="col-sm-offset-2 col-sm-3">
                                        <button type="submit" id="saveContactEdit" name="saveContactEdit" class="btn btn-primary">Guardar cambios</button>
                                    </div>

                                    <div class="col-sm-3 pull-right">
                                        <button type="submit" id="deleteContactEdit" name="deleteContactEdit" class="btn btn-danger">Eliminar Contacto</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                            
                    </div>

                    <div class="tab-pane" id="ticket">
                        
                        <div class="post">
                                
                            <div class="row">
                                <div class="col-sm-12">

                                    <!-- Button trigger modal -->
                                    <div class="col-md-2 col-md-offset-5">
                                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalTicket">
                                            Agregar ticket
                                        </button>
                                    </div>
                                    
                                </div>

                            </div>
                                    
                            <div class="row" id="photoTicket">
                                
                                
                            </div>
  
                        </div>
                        
                    </div>

                    <div class="tab-pane" id="incidents">

                        <div class="post">
                                
                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="box box-primary">

                                        <div class="box-body">
                    
                                            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                            
                                                <thead>
                                                
                                                    <tr>
                    
                                                        <th style="width:10px">#</th>
                                                        <th>Causa</th>                                           
                                                        <th>Fecha</th>
                                                        <th>Hora</th>
                                                        <th>Lugar</th>
                                                        <th>Personal Involucrado</th>
                                                        <th>Acciones</th>
                                            
                                                    </tr> 
                                        
                                                </thead>
                                        
                                                <tbody>

                                                    <?php
                                                        $resultIncidents = ContactController::controllerShowIndicents($requestContact['id_contact']);
                                                        
                                                        foreach ($resultIncidents as $key => $valueInc) {
                                                            echo '
                                                            <tr>
                                                                <td>'.($key+1).'</td>
                                                                <td>'.$valueInc['subject'].'</td>
                                                                <td>'.Helper::ConvertDate($valueInc['dateIncident']).'</td>
                                                                <td>'.Helper::convertToAMPM($valueInc['timeIncident']).'</td>
                                                                <td>'.$valueInc['place'].'</td>
                                                                <td>'.$valueInc['personal_involved'].'</td>
                                                                                                                                                                                                                        
                                                                <td>
                                                    
                                                                    <div class="row">

                                                                        <div class="col-12 text-center">

                                                                            <button class="btn btn-success btnViewIncident" style="width: 60px" idViewIncident="'.$valueInc['id_incident'].'" data-toggle="modal" data-target="#modalViewIncidents"><i class="fa fa-eye"></i></button>

                                                                            <button class="btn btn-warning btnEditIncident" style="width: 60px" idEditIncident="'.$valueInc['id_incident'].'" data-toggle="modal" data-target="#modalEditIncidents"><i class="fa fa-pencil"></i></button>
                                                            
                                                                            <button class="btn btn-danger btnDeleteIncident" style="width: 60px" idDeleteIncident="'.$valueInc['id_incident'].'"><i class="fa fa-times"></i></button>
                                                                        
                                                                        </div>
                                                                        
                                                                        
                                                        
                                                                    </div>  
                                                    
                                                                </td>
                                                
                                                            </tr>';
                                                        }
                                                        
                                                        
                                                    ?>
                                                
                                                    
                                        
                                                </tbody>
                                    
                                            </table>

                                            <div class="box-header with-border">
                                                <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#modalAddIncidents">Agregar Incidente</button>
                                            </div>
                                    
                                        </div>

                                    </div>
                                    
                                </div>

                            </div>
                                    
                            <div class="row" id="photoTicket">
                                
                                
                            </div>
  
                        </div>
                    
                    </div>

                    <div class="tab-pane" id="productos">
                        <div class="post">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="box box-primary">

                                        <div class="box-body">

                                            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                                            
                                                <thead>
                                                
                                                    <tr>

                                                        <th style="width:10px">#</th>
                                                        <th>Producto</th>
                                                        <th>Marca</th>
                                                        <th>Cantidad</th>
                                                        <th>Corte</th>
                                                        <th>Acciones</th>
                                            
                                                    </tr> 

                                                </thead>

                                                <tbody>

                                                <?php

                                                    $showProducts = ContactController::controllerShowProducts($requestContact['id_contact']);

                                                    foreach ($showProducts as $key => $valueProduct) {
                                                        echo '
                                                        <tr>
                                                            <td>'.($key+1).'</td>
                                                            <td>'.$valueProduct['name_product'].'</td>
                                                            <td>'.$valueProduct['brand'].'</td>
                                                            <td>'.$valueProduct['quantity'].'</td>
                                                            <td>'.$valueProduct['cut'].'</td>
                                                                                                                                                                                                                    
                                                            <td>
                                                
                                                                <div class="row">

                                                                    <div class="col-12 text-center">                                                                        

                                                                        <button class="btn btn-warning btnEditProduct" style="width: 40px" idEditProduct="'.$valueProduct['id_contact_product'].'" data-toggle="modal" data-target="#modalEditProducts"><i class="fa fa-pencil"></i></button>
                                                        
                                                                        <button class="btn btn-danger btnDeleteProduct" style="width: 40px" idDeleteProduct="'.$valueProduct['id_contact_product'].'"><i class="fa fa-times"></i></button>
                                                                    
                                                                    </div>
                                                                    
                                                                    
                                                    
                                                                </div>  
                                                
                                                            </td>
                                            
                                                        </tr>';
                                                    }
                                                
                                                ?>

                                                </tbody>

                                            </table>

                                            <div class="box-header with-border">
                                                <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#modalAddProducts">Agregar producto</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>
                        
                </div>
    
            </div>
                
        </div>
            
    </section>

</div>



<!-- MODAL TICKET -->
<div class="modal fade" id="modalTicket" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                <h4 class="modal-title" id="modelTitleId">Agregar Ticket</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div id="alertModal">
            
                    </div>

                    <div class="col-sm-12">
                        <form id="formTicket" method="post" enctype=multipart/form-data>
                            <div class="row">
                                <div class="form-group">
                                    <label for="frequencyContact" class="col-sm-2 control-label">Ticket</label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="folioTicket" name="folioTicket" placeholder="Folio" type="text" autocomplete="off">
                                    </div>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="cajaTicket" name="cajaTicket" placeholder="Caja" type="text" autocomplete="off">
                                    </div>

                                </div>
                            </div>
                            
                            <div class="row" style="margin-top: 15px;">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label"></label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="sellerTicket" name="sellerTicket" placeholder="Vendedora" type="text" autocomplete="off">
                                    </div>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="montoTotal" name="montoTotal" placeholder="Monto Total" type="text" autocomplete="off">
                                    </div>

                                </div>

                            </div>
                            
                            <div class="row">

                                <div class="col-md-12 text-center">

                                    <div class="upload-btn-wrapper">
                                        <input type="file" name="dataImageTicket" id="dataImageTicket" />
                                        <button type="button" class="btn btn-primary btnSelectTicket" >Seleccionar ticket</button>
                                    </div>

                                </div>

                                <img id="previewTicket">

                            </div>
                            <?php
                                echo '
                                <input type="hidden" id="id_user" name="id_user" value="'.$requestContact['id_contact'].'">
                                <input type="hidden" id="id_type" name="id_type" value="contactos">';
                            ?>

                        </form>
                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="addTicket" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR INCIDENTES -->
<div class="modal fade" id="modalAddIncidents" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Agregar Incidente</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formAddIncidents" class="form-horizontal" method="post" enctype=multipart/form-data>
                            <?php

                                echo '<input type="hidden" id="id_contact" name="id_contact" value="'.$requestContact['id_contact'].'">';

                            ?>
                            
                            
                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-2 control-label">Causa</label>

                                <div class="col-sm-8">
                                    <input class="form-control" id="subjectIncident" name="subjectIncident" placeholder="Causa" type="text" autocomplete="off">
                                </div>

                            </div>
                            

                            <div class="form-group">
                                <label for="dateRegistrationModal" class="col-sm-2 control-label">Fecha</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="dateRegistrationModal" name="dateRegistration" type="text" autocomplete="off">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="timePickerI" class="col-sm-2 control-label">Hora</label>

                                <div class="col-sm-2">
                                    <input class="form-control time ui-timepicker-input" id="timePickerI" name="timePickerI" type="text" autocomplete="off">
                                </div>                               

                            </div>

                            <div class="form-group">
                                <label for="placeIncident" class="col-sm-2 control-label">Lugar</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="placeIncident" name="placeIncident" placeholder="Lugar" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="personalIncident" class="col-sm-2 control-label">Personal Involucrado</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="personalIncident" name="personalIncident" placeholder="Personal Involucrado" type="text" autocomplete="off">
                                </div>

                            </div>

                                                        

                            <div class="form-group">

                                <label for="commentsContactIncident" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <textarea name="commentsIncident" id="commentsContactIncident" cols="85" rows="4"></textarea>

                                </div>

                            </div>
                            
                            
                            

                        </form>

                    </div>

                    <?php

                        

                    ?>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="addIncident" class="btn btn-primary">Agregar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR INCIDENTES -->
<div class="modal fade" id="modalEditIncidents" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Editar Incidente</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formEditIncidents" class="form-horizontal" method="post" enctype=multipart/form-data>
                        <div class="form-group">
                                <label for="frequencyContact" class="col-sm-2 control-label">Causa</label>

                                <div class="col-sm-8">
                                    <input class="form-control" id="subjectEditIncident" name="subjectIncident" placeholder="Causa" type="text" autocomplete="off">
                                </div>

                            </div>
                            

                            <div class="form-group">
                                <label for="dateRegistrationModal" class="col-sm-2 control-label">Fecha</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="dateRegistrationModalEdit" name="dateRegistration" type="text" autocomplete="off">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="timePickerI" class="col-sm-2 control-label">Hora</label>

                                <div class="col-sm-2">
                                    <input class="form-control time ui-timepicker-input" id="timePickerEdit" name="timePickerI" type="text" autocomplete="off">
                                </div>                               

                            </div>

                            <div class="form-group">
                                <label for="placeIncident" class="col-sm-2 control-label">Lugar</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="placeEditIncident" name="placeIncident" placeholder="Lugar" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="personalIncident" class="col-sm-2 control-label">Personal Involucrado</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="personalEditIncident" name="personalIncident" placeholder="Personal Involucrado" type="text" autocomplete="off">
                                </div>

                            </div>

                                                        

                            <div class="form-group">

                                <label for="commentsContactIncident" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <textarea name="commentsIncident" id="commentsEditIncident" cols="85" rows="4"></textarea>

                                </div>

                            </div>

                            <div class="row" style="margin-top: 15px"></div>

                                <div class="form-group">

                                <label for="inputfilephoto" class="col-sm-2 control-label">Evidencia</label>
                                

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
                                                        <input type="file" id="inputUploadIncident" name="files[]" multiple>
                                                    </span>
                                                    <button class="btn btn-primary start">
                                                        <i class="glyphicon glyphicon-upload"></i>
                                                        <span>Subir</span>
                                                    </button>
                                                    <button type="reset" class="btn btn-warning cancel">
                                                        <i class="glyphicon glyphicon-ban-circle"></i>
                                                        <span>Cancelar</span>
                                                    </button>
                                                    <!-- The global file processing state -->
                                                    <span class="fileupload-process"></span>
                                                </div>
                                                
                                                <?php                                                
                                                    echo '
                                                    <input type="hidden" id="id_user_edit" name="id_user" value="'.$requestContact['id_contact'].'">
                                                    <input type="hidden" id="id_type_edit" name="id_type" value="contactos">
                                                    <input type="hidden" id="id_incident_edit" name="id_incident">';
                                                ?>
                                                <!--Dropzone-->
                                                
                                                <div id="dropzoneIncident" class="fade">Suelta tus archivos aqui</div>
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
                                            <table role="presentation" id="tableShowIncidents" class="table table-striped"><tbody class="files filesIncidents"></tbody></table>
                             
                                        </div>

                                        
                                    </div>

                                </div>

                            </div>

                        </form>

                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="editIncident" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VER INCIDENTES -->
<div class="modal fade" id="modalViewIncidents" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Ver Incidente</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formViewIncidents" class="form-horizontal" method="post" enctype=multipart/form-data>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Incidente</label>

                                <div class="col-sm-8">
                                    <p id="subjectViewIncident" ></p>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Fecha</label>

                                <div class="col-sm-8">
                                    <p id="dateViewIncident" ></p>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Hora</label>

                                <div class="col-sm-8">
                                    <p id="timeViewIncident" ></p>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Lugar</label>

                                <div class="col-sm-8">
                                    <p id="placeViewIncident" ></p>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Personal Involucrado</label>

                                <div class="col-sm-8">
                                    <p id="personalViewIncident" ></p>
                                </div>

                            </div>
                        
                        
                        

                            <div class="form-group">

                                <label for="commentsContact" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <p id="commentsViewIncident" ></p>

                                </div>

                            </div>

                        

                        

                            <div class="form-group">

                                <label for="inputfilephoto" class="col-sm-2 control-label">Evidencia</label>
                                

                                <div class="row ">

                                    <div class="col-12">

                                        <div id="showImagesIncidents">

                                            
                                        
                                        
                                        </div>

                                        
                                    
                                    </div>

                                </div>
                                
                            </div>

                            

                        </form>

                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR PRODUCTOS -->
<div class="modal fade" id="modalAddProducts" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Agregar Producto</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formAddProducts" class="form-horizontal" method="post" enctype=multipart/form-data>
                            <?php

                                echo '<input type="hidden" id="id_contact" name="id_contact" value="'.$requestContact['id_contact'].'">';

                            ?>
                            
                            
                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Producto</label>

                                <div class="col-sm-6">
                                    <input class="form-control" id="name_product" name="name_product" placeholder="Nombre del producto" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Marca</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="brand" name="brand" placeholder="Cantidad unitaria" type="text" autocomplete="off">
                                </div>  

                            </div>
                            
                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Cantidad</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="quantity" name="quantity" placeholder="Cantidad total" type="text" autocomplete="off">
                                </div>  

                            </div>

                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Corte</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="cut" name="cut" placeholder="Corte" type="text" autocomplete="off">
                                </div>  

                            </div>
                            

                        </form>

                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="addProduct" class="btn btn-primary">Agregar producto</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR PRODUCTOS -->
<div class="modal fade" id="modalEditProducts" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Modificar Producto</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formEditProducts" class="form-horizontal" method="post" enctype=multipart/form-data>
                            <?php

                                echo '<input type="hidden" id="id_contact" name="id_contact" value="'.$requestContact['id_contact'].'">';

                            ?>
                            <input type="hidden" id="id_contact_product" name="id_contact_product">
                            
                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Producto</label>

                                <div class="col-sm-6">
                                    <input class="form-control" id="name_productEdit" name="name_productEdit" placeholder="Nombre del producto" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Marca</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="brandEdit" name="brandEdit" placeholder="Cantidad unitaria" type="text" autocomplete="off">
                                </div>  

                            </div>
                            
                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Cantidad</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="quantityEdit" name="quantityEdit" placeholder="Cantidad total" type="text" autocomplete="off">
                                </div>  

                            </div>

                            <div class="form-group">
                                <label for="frequencyContact" class="col-sm-4 control-label">Corte</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="cutEdit" name="cutEdit" placeholder="Corte" type="text" autocomplete="off">
                                </div>  

                            </div>


                        </form>

                    </div>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="updateProduct" class="btn btn-primary">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalTicket').on('show.bs.modal', event => {
        
    });
</script>

<script id="template-upload-incidents" type="text/x-tmpl">
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
<script id="template-download-incidents" type="text/x-tmpl">
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
                <button class="btn btn-danger delete deleteEdit" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}<?php echo '&id_type=contactos&id_user='.$requestContact['id_contact']; ?>"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
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

<?php

    if(isset($updateContact)){
        if($updateContact){

            echo '<script> 
                showAlert("Correcto!", "Informacion actualizada correctamente", true);
                
            </script>';
    
           }else {
    
            echo '<script> 
                showAlert("Error!", "La informacion se pudo actualizar correctamente", false);
            </script>';
    
        }
    }

    if(isset($updateIncident)){
        if($updateIncident){

            echo '<script> 
                showAlert("Correcto!", "Informacion actualizada correctamente", true);
                
            </script>';
    
        } else {
    
            echo '<script> 
                showAlert("Error!", "La informacion se pudo actualizar correctamente", false);
            </script>';
    
        }
    }

    if(isset($addIncident)){
        if($addIncident){

            echo '<script> 
                showAlert("Correcto!", "Incidente agregado correctamente", true);
                
            </script>';
    
           }else {
    
            echo '<script> 
                showAlert("Error!", "Error al agregar el incidente", false);
            </script>';
    
        }
    }

    if(isset($addProduct)){
        if($addProduct){

            echo '<script> 
                showAlert("Correcto!", "Producto agregado correctamente", true);
                
            </script>';
    
           }else {
    
            echo '<script> 
                showAlert("Error!", "Error al agregar el producto", false);
            </script>';
    
        }
    }


    if(isset($updateProduct)){
        if($updateProduct){

            echo '<script> 
                showAlert("Correcto!", "Producto actualizado correctamente", true);
                
            </script>';
    
           }else {
    
            echo '<script> 
                showAlert("Error!", "Error al actualizar el producto", false);
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
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}<?php echo '&id_type=contactos&id_user='.$requestContact['id_contact']; ?>"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
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

<!-- MODAL AGREGAR AMIGOS NEGOCIO-->
<div id="modalShowBusiness" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    
    <div class="modal-content">

      <div class="modal-header text-center" style="background-color: #3c8dbc; color: white;">

        <button type="button" class="close" data-dismiss="modal" style="color: black; margin-right: 0px; font-size: xx-large;">&times;</button>

        <h4 class="modal-title">Amigos o familiares que compren</h4>

      </div>

      <div class="modal-body">
        
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary pull-right">Agregar</button>

      </div>

    </div>

  </div>
</div>


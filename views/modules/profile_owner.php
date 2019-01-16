<?php

$updateOwner = OwnerController::controllerUpdateOwner();

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Perfil

        <small>Perfil Dueño</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo $url;?>inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Perfil Dueño</li>

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
                            $requestOwner = OwnerController::controllerShowProfile($value2);
                            echo '

                            <img class="profile-user-img img-responsive img-rounded imgProfileView" src="' . $url . $requestOwner['profile_photo'] . '">

                            <h3 class="profile-username text-center">' . $requestOwner['name_owner'] . ' ' . $requestOwner['first_surname'] . ' ' . $requestOwner['second_surname'] . '</h3>';
                            
                            if (!empty($requestOwner['alias'])) {
                                echo '
                                    <p class="text-muted text-center">' . $requestOwner['alias'] . '</p>
                                ';
                            }

                            if(!empty($requestOwner['date_registration']) || !empty($requestOwner['mobile_phone']) || !empty($requestOwner['frequency']) || !empty($requestOwner['birthday'])){
                                echo '
                                <ul class="list-group list-group-unbordered">
                                ';

                                if (!empty($requestOwner['date_registration'])) {
                                    
                                    echo '
                                        <li class="list-group-item">
                                            <b>Fecha de Registro</b> <span class="pull-right"><span class="text-muted">('.Helper::ConvertDate($requestOwner['date_registration']).') </span>' . Helper::timeAgo($requestOwner['date_registration'], $dateCurrent) . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestOwner['mobile_phone'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Celular</b> <span class="pull-right">' . $requestOwner['mobile_phone'] . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestOwner['frequency'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Frecuencia</b> <span class="pull-right">' . $requestOwner['frequency'] . '</span>
                                        </li>
                                    ';
                                }

                                if (!empty($requestOwner['birthday'])) {
                                    echo '
                                        <li class="list-group-item">
                                            <b>Fecha de Nacimiento</b> <span class="pull-right"><span class="text-muted">('.Helper::ConvertDate($requestOwner['birthday']).') </span>' . Helper::CalculateAge($requestOwner['birthday'], $dateCurrent).'</span>
                                        </li>
                                    ';
                                }

                                echo '</ul>';
                            }
                            ?>
                        </div>
                        
                    </div>

                    <?php

                    if(!empty($requestOwner["city"]) || !empty($requestOwner["street"]) || !empty($requestOwner["colony"]) || !empty($requestOwner["local"]) || !empty($requestOwner["state"]) || !empty($requestOwner['email'])  || !empty($requestOwner['perfil_facebook']) && !empty($requestOwner['url_facebook']) || !empty($requestOwner['comments'])){

                        echo '
                        <div class="box box-primary">
                            <div class="box-header with-border">';
                            if(empty($requestOwner["alias"])){
                                echo '<h3 class="box-title">Sobre el contacto</h3>';
                            } else {
                                echo '<h3 class="box-title">Sobre '.$requestOwner["alias"].'</h3>';
                            }
                        echo '</div>';

                        echo '
                        <div class="box-body">';

                        if(!empty($requestOwner["city"]) || !empty($requestOwner["street"]) || !empty($requestOwner["colony"]) || !empty($requestOwner["local"]) || !empty($requestOwner["state"])){
                            echo '
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Direccion</strong>

                            <p class="text-muted">
                                '.$requestOwner["street"].' '.$requestOwner["colony"].' '.$requestOwner["local"].' '.$requestOwner["city"].' '.$requestOwner["state"].' 
                            </p>

                            <hr>';
                        }

                        if (!empty($requestOwner['email'])) {
                            echo '
                                <strong><i class="fa fa-envelope margin-r-5"></i> Correo</strong>
                                <br>

                                <span class="text-muted">' . $requestOwner['email'] . '</span>


                                <hr>
                            ';
                        }

                        if (!empty($requestOwner['perfil_facebook']) && !empty($requestOwner['url_facebook'])) {
                            echo '
                            <strong><i class="fa fa-facebook-official margin-r-5"></i>Facebook</strong>
                            <br>
                            <span class="text-muted">' . $requestOwner['perfil_facebook'] . '</span> <a href="' . $requestOwner['url_facebook'] . '" target="_blank" class="pull-right">Ver</a>

                            <hr>
                            ';
                        }

                        if (!empty($requestOwner['comments'])) {
                            echo '
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Comentarios sobre el contacto</strong>

                            <p>' . $requestOwner['comments'] . '</p>
                            ';
                        }

                        echo '
                            </div>
                        
                        </div>';
                    }
                    ?>  

                    <?php
                        $business_contact = OwnerController::controllerGetBussiness($requestOwner['id_owner']);
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
                        <!--<li><a href="#ticket" data-toggle="tab">Ticket</a></li>-->
                        <!--<li><a href="#incidents" data-toggle="tab">Incidentes</a></li>-->
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
                                    <img class="img-responsive imgProfile" src="' . $url . $requestOwner['profile_photo'] . '">

                                    <button class="btn btn-default" type="button" id="btnChangePhotoContact" name="btnChangePhotoContact">Cambiar foto de perfil</button>
                                    
                                    <div id="uploadImage">
                                        <img class="previewImage">
                                        <input id="dataImageProfile" name="imageProfileOwner" type="file">
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="nameOwner" class="col-sm-2 control-label">Nombres</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameOwner" name="nameOwner" placeholder="Nombre" type="text" value="' . $requestOwner['name_owner'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1Owner" name="surName1Owner" placeholder="Apellido Paterno" type="text" value="' . $requestOwner['first_surname'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2Owner" name="surName2Owner" placeholder="Apellido Materno" type="text" value="' . $requestOwner['second_surname'] . '" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="aliasOwner" class="col-sm-2 control-label">Apodo</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="aliasOwner" name="aliasOwner" placeholder="Apodo" type="text" value="' . $requestOwner['alias'] . '" autocomplete="off">
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Registro</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="dateRegistration" name="dateRegistration"
                                            type="text" autocomplete="off" value="'.Helper::ConvertDate($requestOwner['date_registration']).'">
                                    </div>
                                </div>

                            </div>

                            
                            <div class="form-group">
                                <label for="phoneOwner" class="col-sm-2 control-label">Celular</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="phoneOwner" name="phoneOwner" type="text" value="' . $requestOwner['mobile_phone'] . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>



                            <div class="form-group">

                                <label for="competencias" class="col-sm-2 control-label">Mercancia que compra</label>
                                
                                <div class="col-sm-4">
                                    <select class="form-control" id="mercancia" name="mercancia[]" multiple="multiple">';

                                    $products = Helper::StringToArray($requestOwner['products']);
                                    for ($p=0; $p < count($products); $p++) {
                                        echo '<option value="'.$products[$p].'" selected>'.$products[$p].'</option>';
                                    }

                                    echo '
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="mercancia" class="col-sm-2 control-label">Competencias por Departamento</label>
                                
                                <div class="col-sm-4">
                                    <select class="form-control" id="competencias" name="competencias[]" multiple="multiple">';

                                    $competencias = Helper::StringToArray($requestOwner['name_departament']);
                                    for ($c=0; $c < count($competencias); $c++) {
                                        echo '<option value="'.$competencias[$c].'" selected>'.$competencias[$c].'</option>';
                                    }

                                    echo'

                                    </select>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="daysAvailable" class="col-sm-2 control-label">Dias de compra</label>
                                
                                <div class="col-sm-4">
                                    <select class="form-control" id="daysAvailable" name="daysAvailable[]" multiple="multiple">
                                        ';
                                        
                                        try{

                                            $optionsDays = Helper::StringToArray($requestOwner['days_buy']);
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

                                <label for="comunication" class="col-sm-2 control-label">Pedido los hace:</label>
                                
                                <div class="col-sm-4">
                                    <select class="form-control" id="comunication" name="comunication[]" multiple="multiple">
                                        ';
                                        
                                        try{

                                            $optionsComUser = Helper::StringToArray($requestOwner['orderby']);
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
                                <label for="frequencyBusiness" class="col-sm-2 control-label">Frecuencia de Compra</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="frequency" name="frequency" placeholder="Frecuencia"
                                        type="text" autocomplete="off" value="'.$requestOwner['frequency'].'">
                                </div>

                            </div>

                            <br>

                            <div class="form-group">
                                <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Nacimiento</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="birthday" name="birthday"
                                            type="text" autocomplete="off" value="'.Helper::ConvertDate($requestOwner['birthday']).'">
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="emailOwner" class="col-sm-2 control-label">Correo</label>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="emailOwner" name="emailOwner" placeholder="Correo electronico" type="email" value="' . $requestOwner['email'] . '" autocomplete="off">
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
                                        <input class="form-control" id="profileFacebook" name="facebook" placeholder="Perfil de Facebook" type="text" value="' . $requestOwner['perfil_facebook'] . '" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </div>
                                        <input class="form-control" id="URLFacebook" name="urlFacebook" placeholder="URL del Perfil" type="text" value="' . $requestOwner['url_facebook'] . '" autocomplete="off">
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">

                                <label for="addressStreet" class="col-sm-2 control-label">Direccion</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreet" name="addressStreet" placeholder="Calle" type="text" value="' . $requestOwner['street'] . '" autocomplete="off">
                                </div>
                
                                <div class="col-sm-3">
                                    <input class="form-control" id="addressColony" name="addressColony" placeholder="Colonia" type="text" value="' . $requestOwner['colony'] . '" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressLocal" name="addressLocal" placeholder="Local" type="text" value="' . $requestOwner['local'] . '" autocomplete="off">
                                </div>

                                

                            </div>

                            <div class="form-group">
                                <label for="addressStreet" class="col-sm-2 control-label"></label>

                                <input id="valState" value="' . $requestOwner['state'] . '" hidden>
                                <select class="col-sm-3" id="addressState" name="addressState" data-live-search="true">
                                    
                                </select>

                                <input id="valCity" value="' . $requestOwner['city'].'" hidden>
                                <select class="col-sm-3" id="addressCity" name="addressCity" data-live-search="true">
                                    
                                </select>
                                

                            </div>

                            <br>
                            

                            
                            <div class="form-group">
                               
                                <label for="aliasOwner" class="col-sm-2 control-label">Negocio</label>

                                <div class="col-sm-5">
                                    
                                    <div class="typeahead__container">
                                        <div class="typeahead__field">
                                            <div class="typeahead__query">
                                                <input class="js-typeahead-business form-control" name="business_name" type="search" value="' . $requestOwner['name_business'].'" placeholder="Nombre del Negocio" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                 
                            </div>

                            <div class="form-group">
                               
                                <label for="aliasOwner" class="col-sm-2 control-label">Tipo de Negocio</label>

                                <div class="col-sm-5">

                                    <input class="form-control" name="business_type" type="search" value="' . $requestOwner['type_business'].'" placeholder="Tipo de Negocio" autocomplete="off">

                                </div>
                                 
                            </div>
                            

                            <br>
                            
                            <div class="form-group">

                                <label for="commentsOwner" class="col-sm-2 control-label">Comentarios</label>

                                <div class="col-sm-8">

                                    <textarea name="commentsOwner" id="commentsOwner" cols="80" rows="5">' . $requestOwner['comments'] . '</textarea>

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
                                                <input type="hidden" id="id_user" name="id_user" value="'.$requestOwner['id_owner'].'">
                                                <input type="hidden" id="id_type" name="id_type" value="duenos">';
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
                                        <button type="submit" id="saveOwnerEdit" name="saveOwnerEdit" class="btn btn-primary">Guardar cambios</button>
                                    </div>

                                    <div class="col-sm-3 pull-right">
                                        <button type="submit" id="deleteOwnerEdit" name="deleteOwnerEdit" class="btn btn-danger">Eliminar Dueño</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                            
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

    if(isset($updateOwner)){
        if($updateOwner){

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
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}<?php echo '&id_type=duenos&id_user='.$requestOwner['id_owner']; ?>"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
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

<!-- MODAL AGREGAR AMIGOS Y FAMILIA-->
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


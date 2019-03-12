<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Agregar

            <small>Agregar Dueño</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo $url; ?>inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

            <li class="active">Agregar Dueño</li>

        </ol>

    </section>

    <section class="content">

        <div id="alert">
            
        </div>


        <div class="row">

            <div class="tab-pane active" id="editar">
                <form id="form_contact" class="form-horizontal" method="POST" enctype="multipart/form-data">

                    <div class="form-group">

                        <label for="photoprofileOwner" class="col-sm-2 control-label">Foto de Perfil</label>


                        <div class="col-sm-7 col-lg-8" style="text-align: center;">

                            <div id="uploadImageAdd">
                                <img class="previewImage">  
                                <input type="file" id="dataImageProfile" name="imageProfileOwner" >
                                
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="nameContact" class="col-sm-2 control-label">Nombres</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="nameOwner" name="nameOwner" placeholder="Nombre" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="surName1Owner" name="surName1Owner" placeholder="Apellido Paterno" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="surName2Owner" name="surName2Owner" placeholder="Apellido Materno" type="text" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="aliasOwner" class="col-sm-2 control-label">Apodo</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="aliasOwner" name="aliasOwner" placeholder="Apodo" type="text" autocomplete="off">
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
                                    type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="phoneOwner" class="col-sm-2 control-label">Celular</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="phoneOwner" name="phoneOwner" type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="competencias" class="col-sm-2 control-label">Mercancia que compra</label>
                        
                        <div class="col-sm-3">
                            <select class="form-control" id="mercancia" name="mercancia[]" multiple="multiple">

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="mercancia" class="col-sm-2 control-label">Competencias por Departamento</label>
                        
                        <div class="col-sm-3">
                            <select class="form-control" id="competencias" name="competencias[]" multiple="multiple">

                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="daysAvailable" class="col-sm-2 control-label">Dias de compra</label>
                        
                        <div class="col-sm-4">
                            <select class="form-control" id="daysAvailable" name="daysAvailable[]" multiple="multiple">
                                <?php
                                
                                    $optionDays = Helper::days();
                                    foreach ($optionDays as $option) {
                                        echo '<option value="'.$option.'">'.$option.'</option>';
                                    }
                                
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="comunication" class="col-sm-2 control-label">Pedido los hace:</label>
                        
                        <div class="col-sm-3">
                            <select class="form-control" id="comunication" name="comunication[]" multiple="multiple">
                                <?php
                                
                                $ordersCom = Helper::ordersComunication();
                                foreach ($ordersCom as $option) {
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="frequencyBusiness" class="col-sm-2 control-label">Frecuencia de Compra</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="frequency" name="frequency" placeholder="Frecuencia"
                                type="text" autocomplete="off">
                        </div>

                    </div>

                    <br>

                    <div class="form-group">
                        <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Cumpleaños</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="birthday" name="birthday"
                                    type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    
                    <div class="form-group">
                        <label for="emailBusiness" class="col-sm-2 control-label">Correo</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="email" name="email" placeholder="Correo electronico"
                                    type="email" autocomplete="off">
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
                                <input class="form-control" id="profileFacebook" name="facebook" placeholder="Perfil de Facebook" type="text" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-link" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="URLFacebook" name="urlFacebook" placeholder="URL del Perfil" type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>


                    <div class="form-group">

                        <label for="addressStreet" class="col-sm-2 control-label">Direccion</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="addressStreet" name="addressStreet" placeholder="Calle" type="text" autocomplete="off">
                        </div>
        
                        <div class="col-sm-3">
                            <input class="form-control" id="addressColony" name="addressColony" placeholder="Colonia" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="addressLocal" name="addressLocal" placeholder="Local" type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="addressStreet" class="col-sm-2 control-label"></label>
                        
                        <select class="col-sm-3" id="addressState" name="addressState" title="Selecciona un estado" data-live-search="true">
                            
                        </select>

                        <select class="col-sm-3" id="addressCity" name="addressCity" title="Selecciona un ciudad" data-live-search="true">
                            
                        </select>

                    </div>

                    <br>

                    <div class="form-group">
                        
                        <label for="business_name" class="col-sm-2 control-label">Negocio</label>

                        <div class="col-sm-5">
                            
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="js-typeahead-business form-control" name="business_name" type="search" placeholder="Nombre del Negocio" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                            
                    </div>

                    <div class="form-group">
                        
                        <label for="aliasContact" class="col-sm-2 control-label">Tipo de Negocio</label>

                        <div class="col-sm-5">

                            <input class="form-control" name="business_type" type="search" placeholder="Tipo de Negocio" autocomplete="off">

                        </div>
                            
                    </div>
                    
                    <br>

                    <div class="form-group">

                        <label for="comments" class="col-sm-2 control-label">Comentarios</label>

                        <div class="col-sm-8">

                            <textarea name="comments" id="comments" cols="80" rows="5"></textarea>

                        </div>

                    </div>

                    <br>

                    <?php
                    
                        $newOwner = new OwnerController();
                        $newOwner -> controllerAddOwn();
                    
                    ?>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <input type="submit" name="saveOwner" class="btn btn-primary" value="Agregar dueño">
                        </div>

                        <div class="col-sm-2">
                            <input type="submit" name="saveShowOwner" class="btn btn-primary" value="Agregar y dueño">
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </section>

</div>


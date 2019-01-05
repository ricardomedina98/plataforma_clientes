<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Agregar

            <small>Agregar Negocio</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo $url; ?>inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

            <li class="active">Agregar Negocio</li>

        </ol>

    </section>



    <section class="content">

        <div id="alert">
            
        </div>


        <div class="row">

            <div class="tab-pane active" id="editar">
                <form id="form_contact" class="form-horizontal" method="POST" enctype="multipart/form-data">

                    <div class="form-group">

                        <label for="photoprofileBusiness" class="col-sm-2 control-label">Foto de Perfil</label>


                        <div class="col-sm-7 col-lg-8" style="text-align: center;">

                            <div id="uploadImageAdd">
                                <img class="previewImage">  
                                <input type="file" id="dataImageProfile" name="imageProfileBusiness" >
                                
                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="nameBusiness" class="col-sm-2 control-label">Nombre</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="businessName" name="businessName" placeholder="Nombre Comercial" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="fiscalName" name="fiscalName" placeholder="Nombre Fiscal" type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="typeBusiness" class="col-sm-2 control-label">Tipo de Negocio</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="typeBusiness" name="typeBusiness" placeholder="Tipo de Negocio" type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="phoneBusiness" class="col-sm-2 control-label">Telefono del Negocio</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="phoneBusiness" name="phoneBusiness" type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="invoice" class="col-sm-2 control-label">Factura</label>
                        <div class="col-sm-2">
                            <select id="invoice" name="invoice" class="form-control">
                                <option value="">Selecciona una opcion</option>    
                                <option value="1">Si</option>
                                <option value="0">No</option>
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
                                    type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="comunication" class="col-sm-2 control-label">¿Como supo de nosotros?</label>
                        
                        <div class="col-sm-3">
                            <select class="form-control" id="comunication" name="comunication[]" multiple="multiple">
                                <?php
                                
                                $optionCom = Helper::optionsComunication();
                                foreach ($optionCom as $option) {
                                    echo '<option value="'.$option.'">'.$option.'</option>';
                                }
                                
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="form-group">

                        <label for="daysAvailable" class="col-sm-2 control-label">Dias Disponibles</label>
                        
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

                        <label for="timePickerI" class="col-sm-2 control-label">Horario</label>

                        <div class="col-sm-1">
                            <input class="form-control time ui-timepicker-input" id="timePickerI" name="timePickerI" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-1">
                            <input class="form-control time ui-timepicker-input" id="timePickerF" name="timePickerF" type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="frequencyBusiness" class="col-sm-2 control-label">Frecuencia de Compra</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="frequencyBusiness" name="frequencyBusiness" placeholder="Frecuencia"
                                type="text" autocomplete="off">
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
                                    type="text" autocomplete="off">
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
                                    type="text" autocomplete="off">
                            </div> 
                        </div>

                    </div>

                    

                    <div class="form-group">
                        <label for="phoneBusiness" class="col-sm-2 control-label">Telefonos del Negocio</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>

                                    <select class="form-control" id="phonesBusiness" name="phonesBusiness[]" multiple="multiple">

                                </select>
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
                                <input class="form-control" id="emailBusiness" name="emailBusiness" placeholder="Correo electronico"
                                    type="email" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="urlMaps" class="col-sm-2 control-label">Google Maps</label>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-map" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="urlMaps" name="urlMaps" placeholder="URL del Google Maps" type="text" autocomplete="off">
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

                        <label for="commentsBusiness" class="col-sm-2 control-label">Comentarios</label>

                        <div class="col-sm-8">

                            <textarea name="commentsBusiness" id="commentsBusiness" cols="80" rows="5"></textarea>

                        </div>

                    </div>

                    <br>

                    <?php
                    
                        $newBusiness = new BusinessController();
                        $newBusiness -> controllerAddBusiness();
                    
                    ?>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <input type="submit" name="saveBusiness" class="btn btn-primary" value="Agregar negocio">
                        </div>

                        <div class="col-sm-2">
                            <input type="submit" name="saveShowBusiness" class="btn btn-primary" value="Agregar y mostrar">
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </section>

</div>


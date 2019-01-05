<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Agregar

            <small>Agregar Contacto</small>

        </h1>

        <ol class="breadcrumb">

            <li><a href="<?php echo $url; ?>inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

            <li class="active">Agregar Contactos</li>

        </ol>

    </section>



    <section class="content">

        <div id="alert">
            
        </div>


        <div class="row">

            <div class="tab-pane active" id="editar">
                <form id="form_contact" class="form-horizontal" method="POST" enctype="multipart/form-data">

                    <div class="form-group">

                        <label for="photoprofileContact" class="col-sm-2 control-label">Foto de Perfil</label>


                        <div class="col-sm-7 col-lg-8" style="text-align: center;">

                            <div id="uploadImageAdd">
                                <img class="previewImage">  
                                <input type="file" id="dataImageProfile" name="imageProfileContact" >
                                
                            </div>

                        </div>

                    </div>

                    <div class="form-group">
                        <label for="nameContact" class="col-sm-2 control-label">Nombres</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="nameContact" name="nameContact" placeholder="Nombre" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="surName1Contact" name="surName1Contact" placeholder="Apellido Paterno" type="text" autocomplete="off">
                        </div>

                        <div class="col-sm-3">
                            <input class="form-control" id="surName2Contact" name="surName2Contact" placeholder="Apellido Materno" type="text" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="aliasContact" class="col-sm-2 control-label">Apodo</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="aliasContact" name="aliasContact" placeholder="Apodo" type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="sellerContact" class="col-sm-2 control-label">Vendedora</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="sellerContact" name="sellerContact" placeholder="Vendedora"
                                type="text" autocomplete="off">
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="frequencyContact" class="col-sm-2 control-label">Frecuencia</label>

                        <div class="col-sm-3">
                            <input class="form-control" id="frequencyContact" name="frequencyContact" placeholder="Frecuencia"
                                type="text" autocomplete="off">
                        </div>

                    </div>

                    

                    <div class="form-group">
                        <label for="dateRegistration" class="col-sm-2 control-label">Fecha de Registro</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="dateRegistration" name="dateRegistration" type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>




                    <div class="form-group">
                        <label for="phoneContact" class="col-sm-2 control-label">Celular</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="phoneContact" name="phoneContact" type="text" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="emailContact" class="col-sm-2 control-label">Correo</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </div>
                                <input class="form-control" id="emailContact" name="emailContact" placeholder="Correo electronico"
                                    type="email" autocomplete="off">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="birthdayContact" class="col-sm-2 control-label">Fecha de Nacimiento</label>

                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input class="form-control" id="birthdayContact" name="birthdayContact" type="text" autocomplete="off">
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
                        
                        <label for="aliasContact" class="col-sm-2 control-label">Negocio</label>

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

                        <label for="commentsContact" class="col-sm-2 control-label">Comentarios</label>

                        <div class="col-sm-8">

                            <textarea name="commentsContact" id="commentsContact" cols="80" rows="5"></textarea>

                        </div>

                    </div>

                    <br>

                    <?php
                        $newContact = new ContactController();
                        $newContact->controllerAddContact();
                    ?>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-2">
                            <input type="submit" name="saveContact" class="btn btn-primary" value="Agregar contacto">
                        </div>

                        <div class="col-sm-2">
                            <input type="submit" name="saveShowContact" class="btn btn-primary" value="Agregar y mostrar">
                        </div>
                    </div>

                </form>

            </div>

        </div>

    </section>

</div>


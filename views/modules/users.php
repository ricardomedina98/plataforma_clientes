        
<?php

    $addUser = UserController::controllerAddUser();

    $updateUser = UserController::controllerUpdateUser();

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar usuarios</li>
    
    </ol>

  </section>

  <section class="content">

    <div id="alert">
            
    </div>

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
          
          Agregar usuario

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

            <?php
                $users = UserController::controllerShowUsers();
                foreach ($users as $key => $user) {
                    
                    echo '
                    <tr>

                        <td>'.($key+1).'</td>
                        <td>'.$user["name_user"].'</td>
                        <td>'.$user["user_name"].'</td>
                        <td>'.$user["type_user"].'</td>
                        ';

                        if($user["type_user"] != "Administrador"){

                            if($user["status"] == 1){
                                echo '
                                    <td class="text-center"><button class="btn btn-success btn-xs btnStatus" idUser="'.$user["id_user"].'" status="0" >Activado</button></td>
                                ';
                            } else {
                                echo '
                                    <td class="text-center"><button class="btn btn-danger btn-xs btnStatus" idUser="'.$user["id_user"].'" status="1">Desactivado</button></td>
                                ';
                            }

                        } else {
                            echo '
                                    <td class="text-center"><span class="label label-success label-xs">Activo</span></td>
                                ';
                        }

                        
                        

                        echo '
                        <td>'.$user["last_logged"].'</td>
                        <td>
        
                        <div class="btn-group">
                            
                            <button class="btn btn-warning btnEdituser" idUser="'.$user["id_user"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
        
                            <button class="btn btn-danger btnDeleteuser" idUser="'.$user["id_user"].'" typeUser="'.$user["type_user"].'"><i class="fa fa-times"></i></button>
        
                        </div>  
        
                        </td>
    
                    </tr>
                    ';
                }
            ?>
            


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nameUser" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="userName" id="userNameAdd" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="userPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="newProfile" required>
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Monitoreo">Monitoreo</option>

                  <option value="Recursos Humanos">Recursos Humanos</option>

                </select>

              </div>

            </div>

          </div>

        </div>



        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <input type="hidden" id="id_userEdit" name="id_userEdit">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="nameEditUser" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="userEditName" value="" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="userEditPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" id="editarPerfil" name="newEditProfile">

                  <option value="Administrador">Administrador</option>

                  <option value="Monitoreo">Monitoreo</option>

                  <option value="Recursos Humanos">Recursos Humanos</option>

                </select>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>

      </form>

    </div>

  </div>

</div>


<?php
if(isset($addUser)){
    echo '<script> 
            deleteAlters();
        </script>';
    
    if($addUser){

        echo '<script> 
                showAlert("Correcto!", "El usuario se ha registrado exitosamente", true);
        
        </script>';
    
    
    
    } else {
    
        echo '<script> 
                showAlert("Error!", "Error al guardar el usuario", false);
        
        </script>';
    }
}

if(isset($updateUser)){
    echo '<script> 
        deleteAlters();
    </script>';
    if($updateUser == "true"){
        echo '<script> 
                showAlert("Correcto!", "El usuario se ha actualizado exitosamente", true);
        
        </script>';
        
    
    
    } else if($updateUser == "admin"){

        echo '<script> 
            showAlert("Error!", "Debe de existir al menos un administrador en la base de datos", false);

        </script>';

    } else {
    
        echo '<script> 
                showAlert("Error!", "Error al modificar el usuario", false);
        
        </script>';
    }
}


?>

<?php
    $url = Routes::modelRoute();
    $tope = 18;

    if(isset($pagination)){
        $base = ($pagination-1)*$tope;
              
    } else {
        $pagination = 1;
        $base = 0;
    }

    $contacts = ContactController::controllershowContacts($base, $tope);
    
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Contactos

        <small>Administrar contactos</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Contacto</li>

      </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title">Buscar Contacto</h3>

            </div>

            <div class="box-body">

              <div class="row">

              
                <form method="POST" action="buscar" id="formContacts">

                    <div class="container-fluid">

                        <div class="row" style="margin-top:10px; margin-bottom: 5px;">
                            <div class="form-group">

                                <div class="col-sm-3">

                                    <input class="form-control" id="searchText" name="searchText" placeholder="Ingrese el contacto a buscar" type="text">

                                </div>

                                <div class="col-sm-1 text-center filter">

                                    Filtros

                                </div>

                                <div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterSQL" id="filterSQL">
                                            <option value="">Seleccione un filtro</option>
                                            <option value="searchNames">Nombres</option>
                                            <option value="searchSurNames">Apellidos</option>
                                            <option value="searchAlias">Alias</option>
                                            <option value="searchEmail">Correo</option>

                                        </select>
                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterState" id="addressState" data-live-search="true">                                            

                                        </select>
                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterCity" id="addressCity" data-live-search="true">                                            

                                        </select>
                                    </div>
                                    
                                </div>

                                <div class="col-sm-2 text-center">
                                    <button type="submit" name="searchContact" class="btn btn-primary">Buscar</button>
                                
                                </div>

                            </div>
                        </div>
                    
                    </div>

                </form>

              </div>

            </div>

        </div>  

      <!-- USERS LIST -->
      <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">Todos los contactos</h3>

        </div>

        <div class="box-body no-padding">

          <ul class="users-list clearfix">

            <?php

            if(!empty($contacts)){

              foreach ($contacts as $key => $contact) {
                echo '
                <li class="col-lg-2 col-md-3 col-sm-6 col-xs-12" style="height: 240px;">
                  <a href="'.$url.'contactos/'.$contact['id_contact'].'"> <img src="'.$url.$contact['profile_photo'].'" alt="User Image" style="width: 150px; height: 150px;"></a>
                  ';

                  if(!empty($contact['name_contact'] || $contact['first_surname'] || $contact['second_surname'])){
                    echo '<a class="users-list-name" href="'.$url.'contactos/'.$contact['id_contact'].'">'.$contact['name_contact'].' '.$contact['first_surname'].' '.$contact['second_surname'].'</a>';
                  } else {
                    echo '<a class="users-list-name" href="'.$url.'contactos/'.$contact['id_contact'].'">Nombre Desconocido</a>';
                  }

                  if(!empty($contact['mobile_phone'])){
                    echo '
                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small">'.$contact['mobile_phone'].'</span>
                    ';
                  } else {
                    echo '
                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small">Desconocido</span>
                    ';
                  }

                  if(!empty($contact['email'])){
                    echo '
                    <br>
                    <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small text-truncate">'.$contact['email'].'</span>

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
                ';
                
              }

            } else {
              echo '
                <section class="content">

                  <div class="error-page">
                    
                    <h2 class="headline text-primary">404</h2> 

                    <div class="error-content">

                      <h3>

                        <i class="fa fa-search text-primary"></i> 

                        Ops! Aun no tienes contactos registrados.

                      </h3>

                      <p>
                      
                        Ingresa al menú lateral y allí podrás registrar contactos. También puedes regresar haciendo <a href="'.$url.'agregarContacto">click aquí.</a>
                      
                      </p>

                    </div>

                  </div>  

                </section>
              ';
            }

              
            ?>

            

          </ul>

          <div class="text-center">

            
            <?php
                $totalContacts = ContactController::controllerCountContacts();  
                
                if($totalContacts>0){

                    $pagContactos = ceil($totalContacts/$tope);

                    if($pagContactos > 4){

                        if($pagination == 1){

                            echo '<ul class="pagination">';

                            for ($i=1; $i <= 4; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'contactos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'contactos/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'contactos/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            
                            echo '</ul>';

                        } else if(
                            $pagination != $pagContactos && 
                            $pagination != 1 &&
                            $pagination <  ($pagContactos/2) &&
                            $pagination < ($pagContactos-3)
                        ){ 

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'contactos/pagina-'.($pagination-1).'">&laquo;</a></li>';

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'contactos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'contactos/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'contactos/pagina-'.($numPageActual+1).'">&raquo;</a></li>';                                
                            
                            echo '</ul>';

                        } elseif($pagination != $pagContactos && 
                                $pagination != 1 &&
                                $pagination >=  ($pagContactos/2) &&
                                $pagination < ($pagContactos-3)
                        ){
                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'contactos/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'contactos/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'contactos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '<li><a href="'.$url.'contactos/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            echo '</ul>';


                        } else {

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'contactos/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'contactos/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=($pagContactos-3); $i <= $pagContactos; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'contactos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            }                         
                            echo '</ul>';

                        }

                        
                    } else {

                        echo '<ul class="pagination">';

                        for ($i=1; $i <= $pagContactos ; $i++) { 
                            echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'contactos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                        } 

                        echo '</ul>';
                    }

                }
                
                

                
            ?>
          </div>
          
                 
        </div>
      </div>

    </section>
    
</div>
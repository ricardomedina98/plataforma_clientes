<?php
    $url = Routes::getRoute();
    $tope = 18;

    if(isset($pagination)){
        $base = ($pagination-1)*$tope;
              
    } else {
        $pagination = 1;
        $base = 0;
    }

    $owners = OwnerController::controllerShowOwners($base, $tope);
    
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Dueños

        <small>Administrar dueños</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="<?php echo $url;?>inicio"><i class="fa fa-dashboard"></i>Inicio</a></li>

        <li class="active">Dueños</li>

      </ol>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="box box-info">

            <div class="box-header with-border">

              <h3 class="box-title">Buscar dueño</h3>

            </div>

            <div class="box-body">

              <div class="row">

              
                <form method="POST" action="buscar" id="formContacts">

                    <div class="container-fluid">

                        <div class="row" style="margin-top:10px; margin-bottom: 5px;">
                            <div class="form-group">

                                <div class="col-sm-3">

                                    <input class="form-control" id="searchText" name="searchText" placeholder="Ingrese el dueño a buscar" type="text">

                                </div>

                                <div class="col-sm-1 text-center filter">

                                    Filtros

                                </div>

                                <div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterSQL" id="filterSQLOwners">
                                            <option value="">Seleccione un filtro</option>
                                            <option value="searchNames">Nombres</option>
                                            <option value="searchSurNames">Apellidos</option>                                            
                                            <option value="searchAlias">Alias</option>                                            
                                            <option value="searchPhone">Celular</option>
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

          <h3 class="box-title">Todos los negocios</h3>

        </div>

        <div class="box-body no-padding">

          <ul class="users-list clearfix">

            <?php

            if(!empty($owners)){

              foreach ($owners as $key => $owner) {
                echo '
                <li class="col-lg-2 col-md-3 col-sm-6 col-xs-12" style="height: 240px;">
                  <a href="'.$url.'duenos/'.$owner['id_owner'].'"> <img src="'.$url.$owner['profile_photo'].'" alt="User Image" style="width: 150px; height: 150px;"></a>
                  ';

                  if(!empty($owner['name_owner'] || $owner['first_surname'] || $owner['second_surname'])){
                    echo '<a class="users-list-name" href="'.$url.'duenos/'.$owner['id_owner'].'">'.$owner['name_owner'].' '.$owner['first_surname'].' '.$owner['second_surname'].'</a>';
                  } else {
                    echo '<a class="users-list-name" href="'.$url.'duenos/'.$owner['id_owner'].'">Nombre Desconocido</a>';
                  }

                  if(!empty($owner['mobile_phone'])){
                    echo '
                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small">'.$owner['mobile_phone'].'</span>
                    ';
                  } else {
                    echo '
                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small">Desconocido</span>
                    ';
                  }

                  if(!empty($owner['email'])){
                    echo '
                    <br>
                    <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                    <span class="text-muted small text-truncate">'.$owner['email'].'</span>

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
                
                if(count($owners)>0){

                    $pagContactos = ceil(count($owners)/$tope);

                    if($pagContactos > 4){

                        if($pagination == 1){

                            echo '<ul class="pagination">';

                            for ($i=1; $i <= 4; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'duenos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'duenos/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'duenos/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            
                            echo '</ul>';

                        } else if(
                            $pagination != $pagContactos && 
                            $pagination != 1 &&
                            $pagination <  ($pagContactos/2) &&
                            $pagination < ($pagContactos-3)
                        ){ 

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'duenos/pagina-'.($pagination-1).'">&laquo;</a></li>';

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'duenos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'duenos/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'duenos/pagina-'.($numPageActual+1).'">&raquo;</a></li>';                                
                            
                            echo '</ul>';

                        } elseif($pagination != $pagContactos && 
                                $pagination != 1 &&
                                $pagination >=  ($pagContactos/2) &&
                                $pagination < ($pagContactos-3)
                        ){
                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'duenos/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'duenos/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'duenos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '<li><a href="'.$url.'duenos/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            echo '</ul>';


                        } else {

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'duenos/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'duenos/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=($pagContactos-3); $i <= $pagContactos; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'duenos/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            }                         
                            echo '</ul>';

                        }

                        
                    } else {

                        echo '<ul class="pagination">';

                        for ($i=1; $i <= $pagContactos ; $i++) { 
                            echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'duenos/pagina-'.$i.'">'.$i.'</a>
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
<?php
    $url = Routes::getRoute();
    $tope = 18;

    if(isset($pagination)){
        $base = ($pagination-1)*$tope;
              
    } else {
        $pagination = 1;
        $base = 0;

    }

    $businesses = BusinessController::controllerSearchBusiness($base, $tope);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Negocios

        <small>Administrar negocios</small>

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

              <h3 class="box-title">Buscar negocios</h3>

            </div>

            <div class="box-body">

              <div class="row">

              
                <form method="POST" action="buscar" id="formBusiness">
                    <div class="container-fluid">

                        <div class="row" style="margin-top:10px; margin-bottom: 5px;">
                            <div class="form-group">

                                <div class="col-sm-3">

                                    <input class="form-control" id="searchText" name="searchText" placeholder="Ingrese el contacto a buscar" type="text" value="<?php if(!empty($_POST['searchText'])) {echo $_POST['searchText'];} else { echo "";}?>">

                                </div>

                                <div class="col-sm-1 text-center filter">Filtros</div>

                                <div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterSQL" id="filterSQLBusiness">
                                            <option value="">Seleccione un filtro</option>
                                            <option value="searchComercialName">Nombre Comercial</option>
                                            <option value="searchNameFiscal">Nombre Fiscal</option>                                            
                                            <option value="searchEmail">Correo</option>
                                            <option value="searchPhone">Telefono</option>
                                        </select>   
                                        
                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterState" id="addressState" data-live-search="true">
                                            <?php
                                                //echo '<input id="valState" value="' . $business['state'] . '" hidden>';
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" name="filterCity" id="addressCity" data-live-search="true">  

                                            <?php
                                                //echo '<input id="valCity" value="' . $business['city'].'" hidden>';
                                            ?>                                          

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

          <h3 class="box-title">Negocios encontrados</h3>

        </div>

        <div class="box-body no-padding">

          <ul class="users-list clearfix">

            <?php

            if(!empty($_POST)){

                if($businesses['countResult']>0){
                    
                    foreach ($businesses as $key => $business) {

                        if($key !== 'countResult'){

                            echo '
                            <li class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                            <a href="'.$url.'negocios/'.$business['id_business'].'"> <img src="'.$url.$business['profile_photo'].'" alt="User Image" style="width: 150px; height: 150px;"></a>
                            ';
        
                            if(!empty($business['commercial_name'])){
                                echo '<a class="users-list-name" href="'.$url.'negocios/'.$business['id_business'].'">'.$business['commercial_name'].'</a>';
                            } else {
                                echo '<a class="users-list-name" href="'.$url.'negocios/'.$business['id_business'].'">Nombre Desconocido</a>';
                            }
        
                            if(!empty($business['phone_business'])){
                                echo '
                                <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                                <span class="users-list-nametext-muted small">'.$business['phone_business'].'</span>
                                ';
                            } else {
                                echo '
                                <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"></span>
                                <span class="text-muted small">Desconocido</span>
                                ';
                            }
        
                            if(!empty($business['email'])){
                                echo '
                                <br>
                                <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                                <span class="text-muted small text-truncate">'.$business['email'].'</span>
            
                                ';
                            } else {
                                echo '
                                <br>
                                <span class="fa fa-envelope fa-fw text-muted" data-toggle="tooltip"></span>
                                <span class="text-muted small">Desconocido</span>
                                ';
                            }


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
      
                              Ops! No se encontraron resultados
      
                            </h3>
      
                            <p>
                            
                              Ingresa al seccion de negocios y allí podrás buscar.
                            
                            </p>
      
                          </div>
      
                        </div>  
      
                      </section>
                    ';
                  }

            } else {
                echo '
                      <section class="content">
      
                        <div class="error-page">
                          
                        <h2 class="headline text-primary"><i class="fa fa-search text-primary"></i> </h2> 
      
                          <div class="error-content">
      
                            <h3>                                    
      
                              Comienza a buscar
      
                            </h3>

                            <p>
                                Ingresa en el caudro de texto lo que desees buscar y selecciona algun filtro si deseas buscar algo mas especifico.
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

                $totalContacts = $businesses['countResult']; 
                
                if($totalContacts>1){

                    $pagContactos = ceil($totalContacts/$tope);

                    if($pagContactos > 4){

                        if($pagination == 1){

                            echo '<ul class="pagination">';

                            for ($i=1; $i <= 4; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'negocios/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'negocios/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'negocios/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            
                            echo '</ul>';

                        } else if(
                            $pagination != $pagContactos && 
                            $pagination != 1 &&
                            $pagination <  ($pagContactos/2) &&
                            $pagination < ($pagContactos-3)
                        ){ 

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'negocios/pagina-'.($pagination-1).'">&laquo;</a></li>';

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'negocios/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '  <li><a>...</a></li>
                                    <li><a href="'.$url.'negocios/pagina-'.$pagContactos.'">'.$pagContactos.'</a></li>
                                    <li><a href="'.$url.'negocios/pagina-'.($numPageActual+1).'">&raquo;</a></li>';                                
                            
                            echo '</ul>';

                        } elseif($pagination != $pagContactos && 
                                $pagination != 1 &&
                                $pagination >=  ($pagContactos/2) &&
                                $pagination < ($pagContactos-3)
                        ){
                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'negocios/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'negocios/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=$numPageActual; $i <= ($numPageActual+3); $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'negocios/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            } 

                            echo '<li><a href="'.$url.'negocios/pagina-'.($pagination+1).'">&raquo;</a></li>';
                            echo '</ul>';


                        } else {

                            $numPageActual = $pagination;

                            echo '<ul class="pagination">';
                            echo '<li><a href="'.$url.'negocios/pagina-'.($numPageActual-1).'">&laquo;</a></li>
                                <li><a href="'.$url.'negocios/pagina-1">1</a></li>
                                <li><a>...</a></li>'; 
                            
                            

                            for ($i=($pagContactos-3); $i <= $pagContactos; $i++) { 
                                echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'negocios/pagina-'.$i.'">'.$i.'</a>
                                </li>';
                            }                         
                            echo '</ul>';

                        }

                        
                    } else {

                        echo '<ul class="pagination">';

                        for ($i=1; $i <= $pagContactos ; $i++) { 
                            echo '<li '.($pagination==$i ? 'class="active"' : '').'>
                                    <a href="'.$url.'negocios/pagina-'.$i.'">'.$i.'</a>
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

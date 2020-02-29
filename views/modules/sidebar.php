<?php
    $url = Routes::getRoute();
    ob_start();
?>

<aside class="main-sidebar">

  <section class="sidebar">

    <ul class="sidebar-menu" data-widget="tree">
      
        <li>
            <a href="<?php echo $url; ?>inicio/"><i class="fa fa-home" aria-hidden="true"></i> <span>Inicio</span></a>
        </li>
        
        <?php

            if($_SESSION['type_user'] == 'Monitoreo' || $_SESSION['type_user'] == 'Administrador'){

                echo '

                <li><a href="'.$url.'propios/"><i class="fa fa-building" aria-hidden="true"></i> <span>Negocios propios</span></a></li>

                <li><a href="'.$url.'negocios/"><i class="fa fa-briefcase" aria-hidden="true"></i> <span>Negocios</span></a></li>

                <li><a href="'.$url.'duenos/"><i class="fa fa-user" aria-hidden="true"></i></i> <span>Dueños</span></a></li>

                <li><a href="'.$url.'contactos/"><i class="fa fa-address-card" aria-hidden="true"></i> <span>Contactos</span></a></li>

                <li class="treeview menu">
                    <a href="#">
                        <i class="fa fa-plus" aria-hidden="true"></i>  <span>Agregar</span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="'.$url.'agregarNegocio/"><i class="fa fa-circle-o"></i> Agregar Negocio</a></li>
                        <li><a href="'.$url.'agregarDueno/"><i class="fa fa-circle-o"></i> Agregar Dueño</a></li>
                        <li><a href="'.$url.'agregarContacto/"><i class="fa fa-circle-o"></i> Agregar Contacto</a></li>
                    </ul>
                </li>
                
                ';

            }

            if($_SESSION['type_user'] == 'Administrador'){

                echo '<li><a href="'.$url.'usuarios"><i class="fa fa-users" aria-hidden="true"></i> <span>Usuarios</span></a></li>';

            }

            if($_SESSION['type_user'] == 'Recursos Humanos' || $_SESSION['type_user'] == 'Administrador'){
                echo '<li><a href="'.$url.'empleados/"><i class="fa fa-file-text" aria-hidden="true"></i> <span>Empleados</span></a></li>';
            }?>
        

        

        


    </ul>

  </section>

</aside>
<?php
ob_end_flush();
?>
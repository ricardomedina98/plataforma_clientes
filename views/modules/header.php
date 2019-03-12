<?php
ob_start();
?>
<header class="main-header">


    <a href="<?php echo $url; ?>inicio/" class="logo">

        <!-- mini logo 50x50 pixels -->
        <span class="logo-mini">
            <b>A</b>LC
        </span>

        <!-- logo normal -->
        <span class="logo-lg">
            <b>ALCON</b>
        </span>

    </a>


    <nav class="navbar navbar-static-top" role="navigation">

        <!--BUTTON NAVEGATION-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

            <span class="sr-only">Toggle navigation</span>

        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    
                        <img src="<?php echo $url; ?>views/img/users/default/anonymous.jpg" class="user-image">

                        <span class="hidden-xs"><?php echo $_SESSION["name_user"]; ?></span>

                    </a>

                    <!-- Dropdown-toggle -->

                    <ul class="dropdown-menu">
                        
                        <li class="user-body">

                            <span><b>Usuario: </b><?php echo $_SESSION["user_name"]; ?></span>

                            <br>

                            <span><b>Tipo de Usuario: </b><?php echo $_SESSION["type_user"]; ?></span>

                            <div class="pull-right">

                                <a href="<?php echo $url; ?>salir" class="btn btn-default btn-flat">Salir</a>

                            </div>
                        
                        </li>

                    </ul>

                </li>

            </ul>
                
        </div>

    </nav>
    
</header>
<?php
ob_end_flush();
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>

        Tablero

        <small>Panel de Control</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Tablero</li>

      </ol>
      
    </section>

    <?php
        $getTotal = ControllerTemplate::controllergetTotal();
        
    ?>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Secciones</h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>Negocios</h3>

                    <p><?php echo $getTotal['business'];?> negocios registardos</p>
                </div>
                <div class="icon">
                    <i class="fa fa-briefcase"></i>
                </div>
                <a href="<?php echo $url;?>negocios/" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3>Dueños</h3>

                    <p><?php echo $getTotal['owners'];?> dueños registrados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users"></i>
                    </div>
                    <a href="<?php echo $url;?>duenos/" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-4 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3>Contactos</h3>

                    <p><?php echo $getTotal['contacts'];?> contactos registrados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-address-card"></i>
                    </div>
                    <a href="<?php echo $url;?>contactos/" class="small-box-footer">Ver mas <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
        </div>

      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
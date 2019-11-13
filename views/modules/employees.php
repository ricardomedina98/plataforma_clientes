<?php

    $addEmployee = EmployeeController::controllerCreateEmployee();    

    $updateEmployee = EmployeeController::controllerUpdateEmployee();

?>
<div class="content-wrapper">

    <section class="content-header">

        <h1>
        
            Empleados

        </h1>

        <ol class="breadcrumb">
        
            <li><a href="<?php echo $url; ?>inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Empleados</li>

        </ol>

    </section>

<section class="content">

    <div id="alert">
            
    </div>

    <div class="box">

        <div class="box-header with-border">
  
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddEmployee">
                
                Agregar empleado

            </button>

            <button class="btn btn-success" data-toggle="modal" data-target="#modalAgregarUsuario">
                
                Descargar en Excel

            </button>

        </div>

        <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                <thead>

                <tr>

                    <th style="width:10px">#</th>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Vencimiento del contrato</th>
                    <!-- <th>Descargas</th> -->
                    <th>Acciones</th>

                </tr>

                </thead>

                <tbody>

                <?php

                    $resultContracts = EmployeeController::controllerShowEmployees();                                        
                                        
                    foreach ($resultContracts as $key => $valueEmpl) {
                        echo '
                            <tr>
                                <td>'.($key+1).'</td>';
                                if(!empty($valueEmpl['num_employee'])){
                                    echo '<td>'.$valueEmpl['num_employee'].'</td>';
                                } else {
                                    echo '<td>No asignado</td>';
                                }                                                                

                                echo '<td>'.$valueEmpl["name_employee"].'</td>
                                <td>'.$valueEmpl["first_surname"].'</td>
                                <td>'.$valueEmpl["second_surname"].'</td>';
                                $date = Helper::CalculateTime($valueEmpl["end_contract"]);
                                $dateName = Helper::ConvertRangeDatesEndName($valueEmpl["end_contract"]);

                                if($date["remaining"]<"0"){
                                    echo '<td><span class="label label-danger">'.$dateName.' <span style="font-weight: bold;"> ('.$date['time'].') </span></span></td>';
                                } else if($date["remaining"] === "+0"){
                                    echo '<td><span class="label label-warning">'.$dateName.' <span style="font-weight: bold;"> (Hoy) </span></span></td>';
                                } else if($date["remaining"]  === "-0"){
                                    echo '<td><span class="label label-warning">'.$dateName.' <span style="font-weight: bold;"> ('.$date['time'].') </span></span></td>';
                                } else {
                                    echo '<td><span>'.$dateName.' <span style="font-weight: bold;">(Dias Restantes '.$date['daysRemaining'].') </span></span></td>';
                                }
                                // echo '
                                // <td>
                    
                                //     <div class="row">
        
                                //         <div class="col-12 text-center">
                                                
                                //             <button class="btn btn-success btnDownloadContract" style="width: 60px" idDownloadContract="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalViewEmployee"><i class="fa fa-download"></i></button>

                                //             <button class="btn btn-danger btnDownloadContractRed" style="width: 60px" idDownloadContract="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalViewEmployee"><i class="fa fa-download"></i></button>                                            
                                        
                                //         </div>
                                        
                                //      </div>  
                    
                                // </td>';
                                
                                echo '
                                <td>
                    
                                    <div class="row">
        
                                        <div class="col-12 text-center">                                                                                            

                                            <button class="btn btn-primary btnShowFormats" style="width: 40px; margin-right: 10px;" idShowFormats="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalShowFormats"><i class="fa fa-file-text"></i></button>

                                            <button class="btn btn-warning btnEditEmployee" style="width: 40px; margin-right: 10px;" idEditEmployee="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalEditEmployee"><i class="fa fa-pencil"></i></button>
                            
                                            <button class="btn btn-danger btnDeleteEmployee" style="width: 40px; margin-right: 10px;" idDeleteEmployee="'.$valueEmpl['id_employee'].'"><i class="fa fa-times"></i></button>
                                        
                                        </div>
                                        
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

<!-- MODAL AGREGAR EMPLEADOS -->
<div class="modal fade" tabindex="-1" id="modalAddEmployee" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Agregar Empleado</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formAddEmployee" class="form-horizontal" method="post" enctype=multipart/form-data>
                            

                            <input type="hidden" name="AddEmployee">
                            
                            <div class="form-group">

                                <label for="num_employee" class="col-sm-3 control-label">Numero</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="num_employee" name="num_employee" placeholder="Numero de Empleado" type="text" autocomplete="off">
                                </div>

                            </div>  
                                                        
                            <div class="form-group required">
                                
                                <label for="nameContact" class="col-sm-3 control-label">Nombre</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameEmployee" name="nameEmployee" placeholder="Nombre" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1Employee" name="surName1Employee" placeholder="Apellido Paterno" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2Employee" name="surName2Employee" placeholder="Apellido Materno" type="text" autocomplete="off">
                                </div>

                                

                            </div>


                            <div class="form-group required">
                                <label for="sexEmployee" class="col-sm-3 control-label">Sexo</label>
                                
                                <select class="col-sm-3" id="sexEmployee" name="sexEmployee" title="Selecciona un sexo">                                    
                                    <option value="H">HOMBRE</option>
                                    <option value="M">MUJER</option>                                    
                                </select>

                            </div>

                            <div class="form-group required">
                                <label for="civil_status" class="col-sm-3 control-label">Estado Civil</label>
                                
                                <select class="col-sm-3" id="civil_status" name="civil_status" title="Estado Civil">                                    
                                                                      
                                </select>

                            </div>

                            <div class="form-group required">
                                <label for="position_employee" class="col-sm-3 control-label">NSS</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="nss_employee" name="nss_employee" placeholder="NSS de Empleado" type="text" autocomplete="off">                                    
                                </div>                                                                
                                
                            </div>

                            <div class="form-group required">
                                <label for="birthdayEmployee" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="birthdayEmployee" name="birthdayEmployee" type="text" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            


                            <div class="form-group required">
                                <label for="position_employee" class="col-sm-3 control-label">Puesto</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="category_employee" name="category_employee" placeholder="Categoria" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="position_employee" name="position_employee" placeholder="Puesto del Empleado" type="text" autocomplete="off">
                                </div>
                            </div>

                        </form>

                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="addEmployee" class="btn btn-primary">Agregar empleado</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR EMPLEADOS -->
<div class="modal fade" tabindex="-1" id="modalEditEmployee" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Editar Empleado</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="col-sm-12">
                        <form id="formEditEmployee" class="form-horizontal" method="post" enctype=multipart/form-data>

                            <input type="hidden" id="id_employee" name="id_employee">
                            <input type="hidden" name="updateEmployee">
                            
                            <div class="form-group required">
                                
                                <label for="contract_createdEdit" class="col-sm-3 control-label">Fecha Creacion de Contrato</label>
                                
                                <div class="col-sm-3">
                                    <input class="form-control" id="contract_createdEdit" name="contract_created" placeholder="Creacion de Contrato" type="text" autocomplete="off" readonly >
                                </div>

                            </div>
                            
                            <div class="form-group">

                                <label for="num_employeeEdit" class="col-sm-3 control-label">Numero de Empleado</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="num_employeeEdit" name="num_employee" placeholder="Numero de Empleado" type="text" autocomplete="off">
                                </div>

                            </div>                           
                            
                            <div class="form-group required">
                                <label for="nameEmployeeEdit" class="col-sm-3 control-label">Nombre</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameEmployeeEdit" name="nameEmployee" placeholder="Nombre" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1EmployeeEdit" name="surName1Employee" placeholder="Apellido Paterno" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2EmployeeEdit" name="surName2Employee" placeholder="Apellido Materno" type="text" autocomplete="off">
                                </div>

                            </div>


                            <div class="form-group required">
                                <label for="sexEmployeeEdit" class="col-sm-3 control-label">Sexo</label>
                                
                                <select class="col-sm-3" id="sexEmployeeEdit" name="sexEmployee" title="Seleccione un sexo">                                    
                                    <option value="H">HOMBRE</option>
                                    <option value="M">MUJER</option>                                    
                                </select>

                            </div>

                            <div class="form-group required">

                                <label for="civil_statusEdit" class="col-sm-3 control-label">Estado Civil</label>
                                
                                <select class="col-sm-3" id="civil_statusEdit" name="civil_status" title="Estado Civil">                                    
                                                                      
                                </select>

                            </div>

                            <div class="form-group required">

                                <label for="nss_employeeEdit" class="col-sm-3 control-label">NSS de Empleado</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="nss_employeeEdit" name="nss_employee" placeholder="NSS de Empleado" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group required">

                                <label for="birthdayEmployeeEdit" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" id="birthdayEmployeeEdit" name="birthdayEmployee" type="text" autocomplete="off">
                                    </div>
                                </div>

                            </div>
                            

                            <div class="form-group required">

                                <label for="addressCityPlaceBirthEdit" class="col-sm-3 control-label">Lugar de Nacimiento</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="addressCityPlaceBirthEdit" name="addressCityPlaceBirth" placeholder="Ciudad" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStatePlaceBirthEdit" name="addressStatePlaceBirth" placeholder="Estado" type="text" autocomplete="off">
                                </div>                                                                

                            </div>
                            
                            <br>

                            <div class="form-group required">

                                <label for="position_employeeEdit" class="col-sm-3 control-label">Puesto del Empleado</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="position_employeeEdit" name="position_employee" placeholder="Puesto del Empleado" type="text" autocomplete="off">
                                </div>
                            </div>

                            <br>

                            <div class="form-group required">

                                <label for="addressStreetEdit" class="col-sm-3 control-label">Direccion</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreetEdit" name="addressStreet" placeholder="Calle" type="text" autocomplete="off">
                                </div>
                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressColonyEdit" name="addressColony" placeholder="Colonia" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-2">
                                    <input class="form-control" id="addressCodePostalEdit" name="addressCodePostal" placeholder="Codigo Postal" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="addressCityAEdit" class="col-sm-3 control-label"></label>
                                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressCityAEdit" name="addressCityA" placeholder="Ciudad" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="addressStateAEdit" name="addressStateA" placeholder="Estado" type="text" autocomplete="off">
                                </div> 

                            </div>

                            <br>

                            <div class="form-group required">
                            
                                <label for="dateTimeContractEdit" class="col-sm-3 control-label">Fecha y Hora de Contrato</label>
                                
                                <div class="col-sm-5">
                                    <input class="form-control" type="text" id="dateTimeContractEdit" name="dateTimeContract" value="01/01/2018 - 01/15/2018" />
                                </div>

                                
                            </div>

                            <br>

                            <div class="form-group required">
                            
                                <label for="weekly_balanceEdit" class="col-sm-3 control-label">Sueldo Semanal</label>
                                
                                <div class="col-sm-3">
                                    <input class="form-control" id="weekly_balanceEdit" name="monthly_balance" placeholder="Sueldo Semanal" type="text" autocomplete="off">
                                </div>

                            </div>


                            <div class="form-group required">
                            
                                <label for="punctuality_awardEdit" class="col-sm-3 control-label">Premio de Puntualidad</label>
                                
                                <div class="col-sm-3">
                                    <input class="form-control" id="punctuality_awardEdit" name="punctuality_award" placeholder="Premio de Puntualidad" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group required">
                            
                                <label for="attendance_prizeEdit" class="col-sm-3 control-label">Premio de Asistencia</label>
                                
                                <div class="col-sm-3">
                                    <input class="form-control" id="attendance_prizeEdit" name="attendance_prize" placeholder="Premio de Asistencia" type="text" autocomplete="off">
                                </div>

                            </div>

                        </form>

                    </div>

                    <?php

                    

                    ?>

                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="EditEmployee" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FORMATOS EMPLEADOS -->
<div class="modal fade" tabindex="-1" id="modalShowFormats" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelTitleId">Formatos</h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <form id="formFormatEmployee" class="form-horizontal" method="post" enctype=multipart/form-data>
                            <div class="box">
                                <div class="box-header">
                                <h3 class="box-title">Striped Full Width Table</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body no-padding">
                                <table class="table table-striped">
                                    <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                    </tr>
                                    <tr>
                                    <td>1.</td>
                                    <td>Update software</td>
                                    <td>
                                        <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-red">55%</span></td>
                                    </tr>
                                    <tr>
                                    <td>2.</td>
                                    <td>Clean database</td>
                                    <td>
                                        <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-yellow" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-yellow">70%</span></td>
                                    </tr>
                                    <tr>
                                    <td>3.</td>
                                    <td>Cron job running</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-primary" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light-blue">30%</span></td>
                                    </tr>
                                    <tr>
                                    <td>4.</td>
                                    <td>Fix and squish bugs</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-green">90%</span></td>
                                    </tr>
                                </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


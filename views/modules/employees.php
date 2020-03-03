<?php

    $addEmployee = EmployeeController::controllerCreateEmployee();    

    $updateEmployee = EmployeeController::controllerUpdateEmployee();

    $createContract = EmployeeController::controllerCreateContract();

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

                                if(!empty($valueEmpl['end_contract'])){
                                    
                                    $dateName = Helper::ConvertRangeDatesEndName($valueEmpl["end_contract"]);
                                    echo '<td><span>'.$dateName.'</span></td>';
                                } else {
                                    echo '<td>Sin contrato</td>';
                                }

                                                             
                                
                                echo '
                                <td>
                    
                                    <div class="row">
        
                                        <div class="col-12 text-center">              
                                ';  
                                if(empty($valueEmpl['id_contract'])) {
                                    echo '

                                            <button class="btn btn-success btnCreateContract" style="width: 40px; margin-right: 10px;" idCreateContract="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalCreateContract"><i class="fa fa-plus"></i></button>
                                    ';
                                } else {
                                    echo '
                                        <button class="btn btn-primary btnShowFormats" style="width: 40px; margin-right: 10px;" idShowFormats="'.$valueEmpl['id_employee'].'" data-toggle="modal" data-target="#modalShowFormats"><i class="fa fa-file-text"></i></button>
                                    ';
                                }
                                
                                echo '
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

                            <input type="hidden" name="addEmployee">

                            <div class="form-group">

                                <label for="num_employee" class="col-sm-3 control-label">Numero</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="num_employee" name="num_employee" placeholder="Numero de Empleado" type="text" autocomplete="off">
                                </div>

                            </div> 

                            <div class="form-group required">
                
                                <label for="nameContact" class="col-sm-3 control-label">Nombre</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameEmployeeModal" name="nameEmployee" placeholder="Nombre" type="text" autocomplete="off" required>
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1EmployeeModal" name="surName1Employee" placeholder="Apellido Paterno" type="text" autocomplete="off" required>
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2EmployeeModal" name="surName2Employee" placeholder="Apellido Materno" type="text" autocomplete="off" required>
                                </div>                                                

                            </div>

                            <div class="form-group required">
                                <label for="sexEmployee" class="col-sm-3 control-label">Sexo</label>
                                
                                <select class="col-sm-3" id="sexEmployee" name="sexEmployee" title="Seleccione un sexo" required>                                    
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
                                <label for="position_employee" class="col-sm-3 control-label">Puesto</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="category_employee" name="category_employee" placeholder="Area" type="text" autocomplete="off" required>
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="position_employee" name="position_employee" placeholder="Puesto del Empleado" type="text" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="form-group required">
                                <label for="position_employee" class="col-sm-3 control-label">NSS</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="nss_employee" name="nss_employee" placeholder="NSS de Empleado" type="text" autocomplete="off" required>                                    
                                </div>                                                                
                                
                            </div>

                            <br>

                            <div class="form-group required">

                                <label for="addressStreet" class="col-sm-3 control-label">Domicilio</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreet" name="addressStreet" placeholder="Calle" type="text" autocomplete="off" required>
                                </div>
                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressColony" name="addressColony" placeholder="Colonia" type="text" autocomplete="off" required>
                                </div>

                                <div class="col-sm-2">
                                    <input class="form-control" id="addressCodePostal" name="addressCodePostal" placeholder="Codigo Postal" type="text" autocomplete="off" required>
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="addressStreet" class="col-sm-3 control-label"></label>
                                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressCity_add" name="addressCity" placeholder="Ciudad" type="text" autocomplete="off" required>
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="addressState" name="addressState" placeholder="Estado" type="text" autocomplete="off" required>
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

                            <input type="hidden" id="id_employee_edit" name="id_employee">
                            <input type="hidden" name="updateEmployee">
                            
                            
                            <div class="form-group">

                                <label for="num_employee" class="col-sm-3 control-label">Numero</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="num_employee_edit" name="num_employee" placeholder="Numero de Empleado" type="text" autocomplete="off">
                                </div>

                            </div> 

                            <div class="form-group required">
                
                                <label for="nameContact" class="col-sm-3 control-label">Nombre</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="nameEmployeeModal_edit" name="nameEmployee" placeholder="Nombre" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName1EmployeeModal_edit" name="surName1Employee" placeholder="Apellido Paterno" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-3">
                                    <input class="form-control" id="surName2EmployeeModal_edit" name="surName2Employee" placeholder="Apellido Materno" type="text" autocomplete="off">
                                </div>                                                

                            </div>

                            <div class="form-group required">
                                <label for="sexEmployee" class="col-sm-3 control-label">Sexo</label>
                                
                                <select class="col-sm-3" id="sexEmployee_edit" name="sexEmployee" title="Seleccionar un sexo">                                    
                                    <option value="H">HOMBRE</option>
                                    <option value="M">MUJER</option>                                    
                                </select>

                            </div>

                            <div class="form-group required">

                                <label for="civil_status" class="col-sm-3 control-label">Estado Civil</label>
                                
                                <select class="col-sm-3" id="civil_status_edit" name="civil_status" title="Estado Civil">                                    
                                                                      
                                </select>

                            </div>

                            <div class="form-group required">
                                <label for="position_employee" class="col-sm-3 control-label">Puesto</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="category_employee_edit" name="category_employee" placeholder="Area" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="position_employee_edit" name="position_employee" placeholder="Puesto del Empleado" type="text" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group required">
                                <label for="position_employee" class="col-sm-3 control-label">NSS</label>

                                <div class="col-sm-4">
                                    <input class="form-control" id="nss_employee_edit" name="nss_employee" placeholder="NSS de Empleado" type="text" autocomplete="off">                                    
                                </div>                                                                
                                
                            </div>

                            <br>

                            <div class="form-group required">

                                <label for="addressStreet" class="col-sm-3 control-label">Domicilio</label>

                                <div class="col-sm-3">
                                    <input class="form-control" id="addressStreet_edit" name="addressStreet" placeholder="Calle" type="text" autocomplete="off">
                                </div>
                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressColony_edit" name="addressColony" placeholder="Colonia" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-2">
                                    <input class="form-control" id="addressCodePostal_edit" name="addressCodePostal" placeholder="Codigo Postal" type="text" autocomplete="off">
                                </div>

                            </div>

                            <div class="form-group">

                                <label for="addressStreet" class="col-sm-3 control-label"></label>
                                
                                <div class="col-sm-4">
                                    <input class="form-control" id="addressCity_edit" name="addressCity" placeholder="Ciudad" type="text" autocomplete="off">
                                </div>

                                <div class="col-sm-4">
                                    <input class="form-control" id="addressState_edit" name="addressState" placeholder="Estado" type="text" autocomplete="off">
                                </div> 

                            </div>

                        </form>

                    </div>

                    
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
                <h4 class="modal-title">Contrato: <span style="font-weight: bold" id="modalShowFormatsName"></span></h4>
                
            </div>
            <div class="modal-body">
                <div id="alertModal"></div>
                <div class="container-fluid">
                    <div class="col-sm-12">
                        <form id="formFormatEmployee" class="form-horizontal" method="post" enctype=multipart/form-data>
                            <div class="container-fluid">
                                <input type="hidden" id="id_employee_edit_contract" name="id_employee">

                                <div class="form-group required">

                                    <label for="begin_contract_edit_contract" class="col-sm-3 control-label">Inicio de Contrato</label>

                                    <div class="col-sm-3">
                                        <input class="form-control" id="begin_contract_edit_contract" name="begin_contract" required disabled/>
                                    </div>

                                </div> 

                                <div class="form-group required">

                                    <label for="dateTimeContractEditC" class="col-sm-3 control-label">Fecha y Hora de Contrato</label>

                                    <div class="col-sm-6">
                                        <input class="form-control" id="dateTimeContractEditC" name="dateTimeContractEditC" required/>
                                    </div>

                                    <div class="col-sm-3">
                                    <button class="btn btn-success" type="button" id="btn_renovate_contract" style="width: 40px; margin-right: 10px;"><i class="fa fa-refresh"></i></button>
                                    </div>

                                </div> 

                                <div class="form-group required">
                
                                    <label for="daily_balance_contract" class="col-sm-3 control-label">Sueldo Diario</label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="daily_balance_contract" name="daily_balance" placeholder="Sueldo Diario" type="number" autocomplete="off" required>
                                    </div>                                           

                                </div>

                                <div class="form-group required">
                        
                                    <label for="weekly_balance_contract" class="col-sm-3 control-label">Salario Semanal</label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="weekly_balance_contract" name="weekly_balance" placeholder="Salario Semanal" type="number" autocomplete="off" required>
                                    </div>                                           

                                </div>

                                <div class="form-group required">
                        
                                    <label for="punctuality_award_contract" class="col-sm-3 control-label">Premio Puntualidad</label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="punctuality_award_contract" name="punctuality_award" placeholder="Importe Semanal" type="number" autocomplete="off" required>
                                    </div>                                           

                                </div>

                                <div class="form-group required">
                        
                                    <label for="assistance_award_contract" class="col-sm-3 control-label">Premio Asistencia</label>

                                    <div class="col-sm-4">
                                        <input class="form-control" id="assistance_award_contract" name="assistance_award" placeholder="Importe Semanal" type="number" autocomplete="off" required>
                                    </div>                                           

                                </div>

                                <br>

                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" style="color: black" data-parent="#accordion" href="#collapseOne" aria-expanded="false" >
                                            Información del Empelado
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" class="collapsed" aria-expanded="false">
                                        <div class="box-body">
                                            <div class="row">
                                    
                                                <div class="col-sm-2">
                                                    <div class="row">
                                                        <b>Numero</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="num_employee_contract"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">

                                                    <div class="row">
                                                        <b>Nombre completo:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="full_name_contract"></p>
                                                    </div>

                                                </div>


                                                <div class="col-sm-3">

                                                    <div class="row">
                                                        <b>Sexo:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="sex_contract"></p>
                                                    </div>

                                                </div>

                                                <div class="col-sm-3">

                                                    <div class="row">
                                                        <b>Estado Civil:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="civil_status_contract"></p>
                                                    </div>

                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-sm-3">

                                                    <div class="row">
                                                        <b>Area:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="category_contract"></p>
                                                    </div>

                                                </div>

                                                <div class="col-sm-3">

                                                    <div class="row">
                                                        <b>Puesto:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="position_contract"></p>
                                                    </div>

                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>NSS:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="nss_employee_contract"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>Calle:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="street_contract">15 de Mayo</p>
                                                    </div>
                                                </div>

                                            </div>
                                            <br>
                                            <div class="row">

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>Colonia:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="colony_contract"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>C.P:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="postal_code_contract"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>Ciudad:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="city_contract"></p>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="row">
                                                        <b>Estado:</b>
                                                    </div>

                                                    <div class="row">
                                                        <p id="state_contract">Nuevo Leon</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>    
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button style="margin-right: 10px" type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <div class="btn-group" style="margin-right: 10px">
                    <button type="button" class="btn btn-success">Descargar</button>
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#">Contrato Renovacion</a></li>
                        <li><a href="#">Contrato Inicial</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Contrato Indeterminado</a></li>
                        <li><a href="#">Contrato Determinado</a></li>
                        <li><a href="#">Constancia</a></li>
                        <li><a href="#">Finiquito</a></li>
                        <li class="divider"></li>
                        <li><a href="#">G. FILOSOFIA</a></li>
                        <li><a href="#">J. PREMIO PRODUCTIVIDAD</a></li>
                        <li><a href="#">K. COMPROMISOS ESPECIFICOS</a></li>
                        <li><a href="#">L. CUESTIONARIO</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Confidencialidad</a></li>
                        <li><a href="#">Contancia lectura de reglamento</a></li>
                        <li><a href="#">Examen antidoping</a></li>
                    </ul>
                </div>
                <button style="margin-right: 10px" type="submit" id="editFormat" class="btn btn-primary">Actualizar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL CREAR CONTRATOS -->
<div class="modal fade" tabindex="-1" id="modalCreateContract" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Crear Contrato: <span id="modalNameCreateC" style="font-weight: bold;"></span></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form id="formCreateContract" class="form-horizontal" method="post" enctype=multipart/form-data>

                        <input type="hidden" id="id_employee_createC" name="id_employee">
                        <input type="hidden" id="begin_contract_create" name="begin_contract">
                        <input type="hidden" id="end_contract_create" name="end_contract">
                        <input type="hidden" name="createContract">

                        <div class="form-group required">

                            <label for="num_employee" class="col-sm-3 control-label">Fechas</label>

                            <div class="col-sm-9">
                                <input class="form-control" type="text" id="dateTimeContractCreate" name="dates"/>
                            </div>

                        </div> 

                        <div class="form-group required">
                
                            <label for="daily_balance" class="col-sm-3 control-label">Sueldo Diario</label>

                            <div class="col-sm-4">
                                <input class="form-control" name="daily_balance" placeholder="Sueldo Diario" value="130" type="number" autocomplete="off">
                            </div>                                           

                        </div>

                        <div class="form-group required">
                
                            <label for="weekly_balance" class="col-sm-3 control-label">Salario Semanal</label>

                            <div class="col-sm-4">
                                <input class="form-control" name="weekly_balance" placeholder="Salario Semanal" value="910" type="number" autocomplete="off">
                            </div>                                           

                        </div>

                        <div class="form-group required">
                
                            <label for="punctuality_award" class="col-sm-3 control-label">Premio Puntualidad</label>

                            <div class="col-sm-4">
                                <input class="form-control" name="punctuality_award" placeholder="Premio Puntualidad" type="number" autocomplete="off">
                            </div>                                           

                        </div>

                        <div class="form-group required">
                
                            <label for="assistance_award" class="col-sm-3 control-label">Premio Asistencia</label>

                            <div class="col-sm-4">
                                <input class="form-control" name="assistance_award" placeholder="Premio Asistencia" type="number" autocomplete="off">
                            </div>                                           

                        </div>

                    </form>
                </div>  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btnCreateContractDownload" class="btn btn-success">Crear y descargar</button>
                <button type="submit" id="btnCreateContractModal" class="btn btn-primary">Crear contrato</button>
            </div>
        </div>
    </div>
</div>
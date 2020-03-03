$(document).ready(function(){

    $('#civil_status_edit').selectpicker({
        noneSelectedText : 'Estado Civil'
    });

    $('#sexEmployee').selectpicker({
        noneSelectedText : 'Seleccione un sexo'
    }); 

    $('#sexEmployee_edit').selectpicker({
        noneSelectedText : 'Seleccione un sexo'
    }); 

    loadSexEmployee($("#sexEmployee"), $("#civil_status"));

    $("#sexEmployee").change(function(){
        loadSexEmployee($(this), $("#civil_status"));
    });
    $("#sexEmployee_edit").change(function(){
        loadSexEmployee($(this), $("#civil_status_edit"));
    });

    $('#begin_contract_edit_contract').datepicker({
        autoclose: true,
        maxViewMode: 'years',
        language: 'es',
        format: 'dd/MM/yyyy',
        startDate: '-50y'        
    });

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    moment.locale('es');


    $('#dateTimeContractEditC, #dateTimeContractCreate').daterangepicker({    
//        "startDate": moment().startOf('hour'),
//        "endDate": moment().startOf('hour').add(28, 'day'),
        "timePicker": true,        
        "locale": {
            "format": "DD/MMMM/YYYY hh:mm A",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "a",
            "customRangeLabel": "Custom",
            "weekLabel": "S",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },    
        "opens": "right",
        "drops": "down"
    });

    $('form[id="formAddEmployee"]').validate({
        rules: {            
            nameEmployee: 'required',
            surName1Employee: 'required',
            surName2Employee: 'required',
            sexEmployee: 'required',
            civil_status: 'required',
            category_employee: 'required',
            position_employee: 'required',
            nss_employee: 'required',
            addressStreet: 'required',
            addressColony: 'required',
            addressCodePostal: 'required',
            addressCity: 'required',
            addressState: 'required'
        },
        messages: {            
            nameEmployee: 'El campo es requerido',
            surName1Employee: 'El campo es requerido',
            surName2Employee: 'El campo es requerido',
            sexEmployee: 'El campo es requerido',
            civil_status: 'El campo es requerido',
            category_employee: 'El campo es requerido',
            position_employee: 'El campo es requerido',
            nss_employee: 'El campo es requerido',
            addressStreet: 'El campo es requerido',
            addressColony: 'El campo es requerido',
            addressCodePostal: 'El campo es requerido',
            addressCity: 'El campo es requerido',
            addressState: 'El campo es requerido'
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('form[id="formEditEmployee"]').validate({
        rules: {            
            nameEmployee: 'required',
            surName1Employee: 'required',
            surName2Employee: 'required',
            sexEmployee: 'required',
            civil_status: 'required',
            category_employee: 'required',
            position_employee: 'required',
            nss_employee: 'required',
            addressStreet: 'required',
            addressColony: 'required',
            addressCodePostal: 'required',
            addressCity: 'required',
            addressState: 'required'
        },
        messages: {            
            nameEmployee: 'El campo es requerido',
            surName1Employee: 'El campo es requerido',
            surName2Employee: 'El campo es requerido',
            sexEmployee: 'El campo es requerido',
            civil_status: 'El campo es requerido',
            category_employee: 'El campo es requerido',
            position_employee: 'El campo es requerido',
            nss_employee: 'El campo es requerido',
            addressStreet: 'El campo es requerido',
            addressColony: 'El campo es requerido',
            addressCodePostal: 'El campo es requerido',
            addressCity: 'El campo es requerido',
            addressState: 'El campo es requerido'
        },
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('form[id="formFormatEmployee"]').validate({
        rules: {
            begin_contract: 'required',
            dateTimeContractEditC: 'required',
            daily_balance: 'required',
            weekly_balance: 'required',
            punctuality_award: 'required',
            assistance_award: 'required',

        },
        messages: {
            begin_contract: 'El campo es requerido',
            dateTimeContractEditC: 'El campo es requerido',
            daily_balance: 'El campo es requerido',
            weekly_balance: 'El campo es requerido',
            punctuality_award: 'El campo es requerido',
            assistance_award: 'El campo es requerido',

        },
        submitHandler: function(form) {
            
            let dates_current = $('#dateTimeContractEditC').data('daterangepicker');

            let data = {
                'id_employee' : $("#id_employee_edit_contract").val(),
                'begin_contract': moment(dates_current.startDate).format('YYYY/MM/DD HH:mm:ss'),
                'end_contract': moment(dates_current.endDate).format('YYYY/MM/DD HH:mm:ss'),
                'daily_balance': $('#daily_balance_contract').val(),
                'weekly_balance': $('#weekly_balance_contract').val(),
                'punctuality_award': $('#punctuality_award_contract').val(),
                'assistance_award': $('#assistance_award_contract').val()
            };


            let formData = new FormData;
            for (let key in data ) {
                formData.append(key, data[key]);
            }

            console.log(formData);


            $.ajax({
                url: getURL() + "ajax/employee.ajax.php",
                method:"POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(response){

                    console.log(response);

                    if(response) {
                        showAlertModal("Correcto!", "Infromación actualizada correctamente", true);
                    } else {
                        showAlertModal("Error!", "Hubo un error al guardar la información", false);
                    }


                }

            });
        }
    });

    $('form[id="formCreateContract"]').validate({
        rules: {            
            dates: 'required',
            daily_balance: 'required',
            weekly_balance: 'required',
            punctuality_award: 'required',
            assistance_award: 'required'
        },
        messages: {
            dates: 'El campo es requerido',            
            daily_balance: 'El campo es requerido',
            weekly_balance: 'El campo es requerido',
            punctuality_award: 'El campo es requerido',
            assistance_award: 'El campo es requerido'
        },
        submitHandler: async function(form){
            let date = $("#dateTimeContractCreate").val().split('-');    
            let begin_contract = await moment(moment(date[0]).toDate()).format('YYYY/MM/DD HH:mm:ss');
            let end_contract = await moment(moment(date[1]).toDate()).format('YYYY/MM/DD HH:mm:ss');
            $('#begin_contract_create').val(begin_contract);
            $('#end_contract_create').val(end_contract);    
            form.submit();
        }
    });
});

function loadSexEmployee(sexEmployee, civilStatus){  

        let value = $(sexEmployee).val();
        let civil_status = $(civilStatus);
        $(civil_status).empty();
        if(value === "H"){
            $(civil_status).append('<option value="CASADO">CASADO</option>');
            $(civil_status).append('<option value="SOLTERO">SOLTERO</option>  ');
        }else if(value === "M"){
            $(civil_status).append('<option value="CASADA">CASADA</option>');
            $(civil_status).append('<option value="SOLTERA">SOLTERA</option>  ');
        }
        $(sexEmployee).selectpicker('refresh');    
        $(civil_status).selectpicker('refresh');    
}


$("#addEmployee").click(function(){
    $("#formAddEmployee").submit();
});

$("#EditEmployee").click(function(){
    $("#formEditEmployee").submit();
});


$(".btnEditEmployee").click(function (){

    let id_employee = $(this).attr("idEditEmployee");	 

    console.log(id_employee);

    $("#id_employee").val(id_employee);
        

    let data = new FormData();
    data.append("id_employeeEdit", id_employee);
    
    $.ajax({
        url: getURL() + "ajax/employee.ajax.php",
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(response){
        
            $("#id_employee_edit").val(response.id_employee);

            $("#num_employee_edit").val(response.num_employee);
            
            $("#nameEmployeeModal_edit").val(response.name_employee);
            $("#surName1EmployeeModal_edit").val(response.first_surname);
            $("#surName2EmployeeModal_edit").val(response.second_surname);
            
            $("#sexEmployee_edit [value='" + response.sex + "']").attr("selected", true);
            loadSexEmployee($("#sexEmployee_edit"), $("#civil_status_edit"));           
            $("#civil_status_edit [value='" + response.civil_status + "']").attr("selected", true);
            $("#civil_status_edit").selectpicker('refresh');    

            $("#category_employee_edit").val(response.category);
            $("#position_employee_edit").val(response.position);
            
            $("#nss_employee_edit").val(response.nss_employee);

            $("#addressStreet_edit").val(response.street);
            $("#addressColony_edit").val(response.colony);
            $("#addressCodePostal_edit").val(response.postal_code);
            $("#addressCity_edit").val(response.city);
            $("#addressState_edit").val(response.state);

            
        }

    });
    
});



$(".btnDeleteEmployee").click(function (e){
    e.preventDefault();

    swal({
        title: "Estas seguro?",
        text: "Se eliminara el empleado y toda su informacion",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar"        
      }).then((result) => {

          if(result.value) {


            var data = new FormData();
            data.append("id_employeeDelete", $(this).attr("iddeleteemployee"));
                        
            $.ajax({
                url:getURL()+"ajax/employee.ajax.php",
                method:"POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){  
                    
                    if(respuesta) {
                        location.href = getURL() + "empleados/";
                    }
                                        
                    
                }
        
            });
            
          }
      })
});


$(".btnCreateContract").click(function (e){
    e.preventDefault();

    let id_employee = $(this).attr("idCreateContract");	 
    let data = new FormData();
    data.append("id_employeeEdit", id_employee);


    $("#id_employee_createC").val(id_employee);

    $.ajax({
        url: getURL() + "ajax/employee.ajax.php",
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(response){                          
            
            $("#modalNameCreateC").text(response.name_employee + ' ' + response.first_surname + ' ' + response.second_surname);
                        
        }

    });
    
    let date_start =  moment();
    let date_end = null;
    
    while(date_start.day() === 0 || date_start.format('DD/MM') === '25/12' || date_start.format('DD/MM') === '01/01') {        
        date_start = date_start.add(1, 'day');
    }

    date_end = moment(date_start).add(15, 'day');    

    while (date_end.day() === 4 || date_end.day() === 5 || date_end.day() === 6 || date_end.day() === 0
           || date_end.format('DD/MM') === '25/12' || date_end.format('DD/MM') === '01/01') {        
        date_end = date_end.add(1, 'day');
    }    

    $('#dateTimeContractCreate').data('daterangepicker').setStartDate(date_start.startOf('hour'));
    $('#dateTimeContractCreate').data('daterangepicker').setEndDate(date_end.startOf('hour'));
});

$("#btnCreateContractModal").click(async function(){    
    $("#formCreateContract").submit();
});

$('.btnShowFormats').click( function(e) {
    e.preventDefault();

    let id_employee = $(this).attr("idShowFormats");

    $("#id_employee_edit_contract").val(id_employee);
        
    let data = new FormData();
    data.append("id_employeeEdit", id_employee);
    
    $.ajax({
        url: getURL() + "ajax/employee.ajax.php",
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(response){                          

            $("#id_employee_edit_contract").val(response.id_employee);
            $("#begin_contract_edit_contract").datepicker("setDate", moment(response.contract_created).format('DD/MM/yyyy'));            

            $('#dateTimeContractEditC').data('daterangepicker').setStartDate( moment(response.begin_contract));
            $('#dateTimeContractEditC').data('daterangepicker').setEndDate(moment(response.end_contract));

            $("#daily_balance_contract").val(response.daily_balance);
            $("#weekly_balance_contract").val(response.weekly_balance);
            $("#punctuality_award_contract").val(response.punctuality_award);
            $("#assistance_award_contract").val(response.assistance_award);

            $("#num_employee_contract").text(response.num_employee);
            
            $("#full_name_contract").text(response.name_employee + ' ' + response.first_surname + ' ' + response.second_surname);
            $("#modalShowFormatsName").text(response.name_employee + ' ' + response.first_surname + ' ' + response.second_surname);
            
                
            if(response.sex === 'H') {
                $("#sex_contract").text("Hombre");
            } else if(response.sex === 'M') {
                $("#sex_contract").text("Mujer");
            }
            
            $("#civil_status_contract").text(response.civil_status);

            $("#category_contract").text(response.category);

            $("#position_contract").text(response.position);

            $("#nss_employee_contract").text(response.nss_employee);

            $("#street_contract").text(response.street);

            $("#colony_contract").text(response.colony);

            $("#postal_code_contract").text(response.postal_code);

            $("#city_contract").text(response.city);

            $("#state_contract").text(response.state);
                        
        }

    });
});

// $('#begin_contract_edit_contract').change(function() {
//     $('#btn_download').prop('disabled', true);
// });


$("#btn_renovate_contract").click(function (){

    let dates_current = $('#dateTimeContractEditC').data('daterangepicker');

    let date_start =  moment(dates_current.endDate).add(1, 'day');
    let date_end = null;    
    
    while(date_start.day() === 0 || date_start.format('DD/MM') === '25/12' || date_start.format('DD/MM') === '01/01') {        
        date_start = date_start.add(1, 'day');
    }

    date_end = moment(date_start).add(28, 'day');    

    while (date_end.day() === 4 || date_end.day() === 5 || date_end.day() === 6 || date_end.day() === 0
           || date_end.format('DD/MM') === '25/12' || date_end.format('DD/MM') === '01/01') {        
        date_end = date_end.add(1, 'day');
    }    

    $('#dateTimeContractEditC').data('daterangepicker').setStartDate(date_start.startOf('hour'));
    $('#dateTimeContractEditC').data('daterangepicker').setEndDate(date_end.startOf('hour'));

});

$('#editFormat').click( function(e) {
    $('#formFormatEmployee').submit();
});


$('#modalAddEmployee').on('hidden.bs.modal', function () {
    $('#formAddEmployee').validate().resetForm();
});

$('#modalEditEmployee').on('hidden.bs.modal', function () {
    $('#formEditEmployee').validate().resetForm();
    $('#formEditEmployee input').removeClass('error');
});

$('#modalCreateContract').on('hidden.bs.modal', function () {
    $('#formCreateContract').validate().resetForm();
    $('#formCreateContract input').removeClass('error');
});

$(document).ready(function(){

    $('#civil_statusEdit').selectpicker({
        noneSelectedText : 'Estado Civil'
    });

    $('#sexEmployee').selectpicker({
        noneSelectedText : 'Seleccione un sexo'
    }); 

    $('#sexEmployeeEdit').selectpicker({
        noneSelectedText : 'Seleccione un sexo'
    }); 

    loadSexEmployee($("#sexEmployee"), $("#civil_status"));

    $("#sexEmployee").change(function(){
        loadSexEmployee($(this), $("#civil_status"));
    });
    $("#sexEmployeeEdit").change(function(){
        loadSexEmployee($(this), $("#civil_statusEdit"));
    });

    $('#start_contractDate, #end_contractDate, #birthdayEmployeeEdit').datepicker({
        autoclose: true,
        maxViewMode: 'years',
        language: 'es',
        format: 'dd/mm/yyyy',
        startDate: '-50y'
    });

    $('#contract_created').datetimepicker({
        format: 'DD/MM/YYYY hh:mm A',
        locale: moment.locale('es'),
        defaultDate: moment()
    });  
    $('#contract_createdEdit').datetimepicker({
        format: 'DD/MM/YYYY hh:mm A',
        locale: moment.locale('es')        
    });   
    
    
    $("#start_contractTime, #end_contractTime").timepicker({ 'scrollDefault': 'now', 'step': 1 });    
    
    
    $('#dateTimeContract, #dateTimeContractEdit').daterangepicker({    
        "startDate": moment().startOf('hour'),
        "endDate": moment().startOf('hour').add(28, 'day'),
        "timePicker": true,
        "locale": {
            "format": "DD/MM/YYYY hh:mm A",
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
                "Ju",
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
        "opens": "center",
        "drops": "up"
    });

});

function loadSexEmployee(sexEmployee, civilStatus){  

        var value = $(sexEmployee).val();        
		console.log('TCL: loadSexEmployee -> value', value)
        var civil_status = $(civilStatus);
        $(civil_status).empty();
        if(value == "H"){
            $(civil_status).append('<option value="CASADO">CASADO</option>');
            $(civil_status).append('<option value="SOLTERO">SOLTERO</option>  ');
        }else if(value == "M"){
            $(civil_status).append('<option value="CASADA">CASADA</option>');
            $(civil_status).append('<option value="SOLTERA">SOLTERA</option>  ');
        }
        $(sexEmployee).selectpicker('refresh');    
        $(civil_status).selectpicker('refresh');    
}


$("#addEmployee").click(function(){
    $("#formAddEmployee").submit();
});


$(".btnEditEmployee").click(function (){

    var id_employee = $(this).attr("idEditEmployee");	 

    $("#id_employee").val(id_employee);
    
    var urlWeb = getURL() + "ajax/contracts.ajax.php";

    var data = new FormData();
    data.append("id_employeeEdit", id_employee);
    
    $.ajax({
        url:urlWeb,
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){  
            console.log("​respuesta", respuesta)
        
            $("#id_employee").val(respuesta.id_employee);              
            
            $('#contract_createdEdit').data("DateTimePicker").date(new Date(respuesta.contract_created));
            $('#contract_createdEdit').data("DateTimePicker").disable();            

            $("#num_employeeEdit").val(respuesta.num_employee);
            
            $("#nameEmployeeEdit").val(respuesta.nameEmployee);
            $("#surName1EmployeeEdit").val(respuesta.surName1Employee);
            $("#surName2EmployeeEdit").val(respuesta.surName2Employee);
            
            

            $("#sexEmployeeEdit [value='" + respuesta.sexEmployee + "']").attr("selected", true); 
            loadSexEmployee($("#sexEmployeeEdit"), $("#civil_statusEdit"));           
            $("#civil_statusEdit [value='" + respuesta.civil_status + "']").attr("selected", true);
            $("#civil_statusEdit").selectpicker('refresh');    

            $("#nss_employeeEdit").val(respuesta.nss_employee);            
            
            $("#birthdayEmployeeEdit").datepicker("setDate", respuesta.birthdayEmployee);

            $("#addressCityPlaceBirthEdit").val(respuesta.addressCityPlaceBirth);
            $("#addressStatePlaceBirthEdit").val(respuesta.addressStatePlaceBirth);

            $("#position_employeeEdit").val(respuesta.position_employee);

            $("#addressStreetEdit").val(respuesta.addressStreet);
            $("#addressColonyEdit").val(respuesta.addressColony);
            $("#addressCodePostalEdit").val(respuesta.addressCodePostal);
            $("#addressCityAEdit").val(respuesta.addressCityA);
            $("#addressStateAEdit").val(respuesta.addressStateA);       

            $('#dateTimeContractEdit').data('daterangepicker').setStartDate(respuesta.start_contract);
            $('#dateTimeContractEdit').data('daterangepicker').setEndDate(respuesta.end_contract);

            $("#weekly_balanceEdit").val(respuesta.weekly_balance);
            $("#punctuality_awardEdit").val(respuesta.punctuality_award);
            $("#attendance_prizeEdit").val(respuesta.attendance_prize);
            
        }

    });
    
});
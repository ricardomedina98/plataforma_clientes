
$(document).ready(function(){
    $('#addressStatemodal').selectpicker({
        noneSelectedText : 'Seleccione una estado'
    }); 
    $('#addressCitymodal').selectpicker({
        noneSelectedText : 'Seleccione una ciudad'
    });

    $('#addressStatemodalRef').selectpicker({
        noneSelectedText : 'Seleccione una estado'
    }); 
    $('#addressCitymodalRef').selectpicker({
        noneSelectedText : 'Seleccione una ciudad'
    });

    $('#addressStateeditmodal').selectpicker({
        noneSelectedText : 'Seleccione una estado'
    }); 
    $('#addressCityeditmodal').selectpicker({
        noneSelectedText : 'Seleccione una ciudad'
    });
    

    $(".tablas").DataTable({
        "language":{
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        responsive: true        
    });
});




var statesSuc = $('#addressStatemodal');
var citiesSuc = $('#addressCitymodal');
var valStateSuc = $('#valStateSuc');
var valCitiesSuc = $('#valCitiesSuc');

var statesRef = $('#addressStatemodalRef');
var citiesRef = $('#addressCitymodalRef');
var valStateFam = $('#valStateFam');
var valCitiesFam = $('#valCitiesFam');

var statesEdit = $('#addressStateeditmodal');
var citiesEdit = $('#addressCityeditmodal');
var valStateEdit = $('#valStateEdit');
var valCitiesEdit = $('#valCitiesEdit');

$('#btnAgregarDirAlt').click(function(){

    loadStates(statesSuc, citiesSuc, valStateSuc, valCitiesSuc);    
});

$('#btnAgregarRef').click(function(){

    loadStates(statesRef, citiesRef, valStateFam, valCitiesFam); 
});


$(statesSuc).change(function(){    
    $(citiesSuc).empty();
    var val =$(this).val();
    loadCities(val, citiesSuc);
});

$(statesRef).change(function(){    
    $(citiesRef).empty();
    var val =$(this).val();
    loadCities(val, citiesRef);
});


$(statesEdit).change(function(){    
    $(citiesEdit).empty();
    var val =$(this).val();
    loadCities(val, citiesEdit);
});


function loadStates(statesP, citiesP, valStateP, valCitiesP){
    var urlStates = window.location.protocol+"//"+ window.location.hostname + "/jsonFiles/states";    

    $.ajax({
        url: urlStates,
        type:'GET',
        cache: false,
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(respuesta){     
            var estados = statesP;
            for (i in respuesta) {
                var estadosNombre = '<option value="'+respuesta[i].NOM_ENT+'">'+respuesta[i].NOM_ENT+'</option>';
                estados.append(estadosNombre);
            }

            var selectedState = $(valStateP).val();
            $(estados).val(selectedState);
            $(estados).selectpicker('refresh');

            loadCities(selectedState, citiesP, valCitiesP);
            
        }
    })
}

function loadCities(val, citiesP, valCitiesP){

    var urlCities = window.location.protocol+"//"+ window.location.hostname + "/jsonFiles/cities";

    $.ajax({
        url: urlCities,
        type:'GET',
        cache: false,
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(respuesta){            
            var ciudades = citiesP;                        
            for (i in respuesta) {
                if(respuesta[i].NOM_ENT == val){
                    var estadosCiudades = '<option value="'+respuesta[i].NOM_MUN+'">'+respuesta[i].NOM_MUN+'</option>';
                    ciudades.append(estadosCiudades);
                } 
            }
            var selectedCity = $(valCitiesP).val();     
            
            

            $(ciudades).val(selectedCity);             
            $(ciudades).selectpicker('refresh');
            
    
        }
    })

}









$("#deleteBusinessEdit").click(function (e){
    e.preventDefault();

    swal({
        title: "Estas seguro?",
        text: "Se eliminara el negocio y toda su informacion incluyendo imagenes",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar"        
      }).then((result) => {

          if(result.value) {

            var urlWeb = window.location.protocol+"//"+ window.location.hostname+"/ajax/business.ajax.php";
            var url = window.location.protocol+"//"+ window.location.hostname + "/";

            var data = new FormData();
            data.append("id_business_delete", $("#id_user").val());
            
            
            
            $.ajax({
                url:urlWeb,
                method:"POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){  
                                        
                    location.href = url + "negocios/";
                    
                }
        
            });
            
          }
      })
});

loadStates(statesEdit, citiesEdit, valStateEdit, valCitiesEdit); 


$(".btnEditUser").click(function(){
    
    
    var urlWeb = window.location.protocol+"//"+ window.location.hostname+"/ajax/business.ajax.php";
    var idAddress = $(this).attr("idUser");
    
    var data = new FormData();
    data.append("id_user_address", idAddress);
    $.ajax({
        url:urlWeb,
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){  
            
            $("#nameeditBusiness").val(respuesta.name_business);
            $("#phoneeditBusiness").val(respuesta.phone_business);
            $("#localeditAddress").val(respuesta.local);
            $("#streeteditAddress").val(respuesta.street);
            $("#colonyeditAddress").val(respuesta.colony);
            $("#valStateEdit").val(respuesta.state);
            $("#valCitiesEdit").val(respuesta.city);
            $("#id_alt_address").val(respuesta.id_alt_address);
            
            loadStates(statesEdit, citiesEdit, valStateEdit, valCitiesEdit);   
            
            
        }

    });
    
});
/*

$("#btnAddAddressAlt").click(function(){
    $("#form-addressAlt").submit();
});

$("#btnAddAddressAlt").on("submit", function(e) {

});

*/
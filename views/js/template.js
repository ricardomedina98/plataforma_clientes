$(document).ready(function(){

    $('#dateRegistrationModalEdit').datepicker({
        autoclose: true,
        maxViewMode: 'years',
        language: 'es',
        format: 'dd/mm/yyyy',
        startDate: '-50y'
    });

    $('#dateRegistration, #dateRegistrationModal, #birthdayContact, #birthday, #birthdayEmployee, #businessCustomer, #businessAntiquity').datepicker({
        autoclose: true,
        maxViewMode: 'years',
        language: 'es',
        format: 'dd/mm/yyyy',
        startDate: '-50y'
    });



    $("#timePickerI, #timePickerF, #timePickerEdit").timepicker({ 'step': 30 });    

    $("#comunication").select2({
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $("#mercancia").select2({
        minimumResultsForSearch: -1,
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']
    });

    $("#competencias").select2({
        minimumResultsForSearch: -1,
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']
    });

    

    $("#daysAvailable").select2({
        width: '100%',
        tags: true,
        tokenSeparators: [',', ' ']
    });
    $("#phonesBusiness").select2({
        width: '100%',
        tags: true
    });

    
    
    $('#addressStatePlaceBirth').selectpicker({
        noneSelectedText : 'Estado de Nacimiento'
    });
    $('#addressCityPlaceBirth').selectpicker({
        noneSelectedText : 'Ciudad de Nacimiento'
    });

    
    $('#addressState').selectpicker({
        noneSelectedText : 'Seleccione un estado'
    }); 
    $('#addressCity').selectpicker({
        noneSelectedText : 'Seleccione una ciudad'
    });

    var urlStates = getURL()+"ajax/json.ajax.php";    

    var data = new FormData();
    data.append("states", true);

    $.ajax({
        url:urlStates,
        data: data,
        type:'POST',
        cache: false,        
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(respuesta){            
            var estados = $('#addressState');
            var optionDefaul = '<option value="">Seleccione un estado</option>';
            estados.append(optionDefaul);
            for (i in respuesta) {                
                var estadosNombre = '<option value="'+respuesta[i].NOM_ENT+'">'+respuesta[i].NOM_ENT+'</option>';
                estados.append(estadosNombre);
            }            
            
            var selectedState = $("#valState").val();
            $(estados).val(selectedState);
            $(estados).selectpicker('refresh');

            laodCitys(selectedState);
            
        }
    }) 

    let url = window.location;
    let sub_url = window.origin + '/' + window.location.pathname.split('/')[1] + '/' + window.location.pathname.split('/')[2] + '/';    
    
    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        return this.href == url || this.href == sub_url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        return this.href == url || this.href == sub_url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
});


function getURL(){
    var getUrl = window.location;
    var baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1]; 
    return baseurl + '/';
}


$('#addressState').change(function(){
    $('#addressCity').empty();
    var val =$('#addressState').val();
    laodCitys(val);
});

function laodCitys(val){
    var data = new FormData();
    data.append("cities", true);

    var urlCities = getURL()+"ajax/json.ajax.php";
    
    $.ajax({
        url:urlCities,
        data: data,
        type:'POST',
        cache: false,
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(respuesta){            
            var ciudades = $('#addressCity');
            var optionDefaul = '<option value="">Seleccione una ciudad</option>';
            ciudades.append(optionDefaul);
            for (i in respuesta) {
                if(respuesta[i].NOM_ENT == val){
                    var estadosCiudades = '<option value="'+respuesta[i].NOM_MUN+'">'+respuesta[i].NOM_MUN+'</option>';
                    ciudades.append(estadosCiudades);
                } 
            }
            var selectedCity = $('#valCity').val();                 

            $(ciudades).val(selectedCity);             
            $(ciudades).selectpicker('refresh');
            
    
        }
    })
}


$('#fileupload').fileupload({
    dropZone: $('#dropzone'),
    url: getURL()+'views/img/users/upload.images.php',
    drop: function (e, data) {
        $.each(data.files, function (index, file) {
            console.log('Dropped file: ' + file.name);
        });
    },
    change: function (e, data) {
        
        $.each(data.files, function (index, file) {
            console.log('Selected file: ' + file.name);
        });
    },
    fileInput: $('#inputUpload')
});


$("#dataImageProfile").change(function() { 

    deleteAlters();
    
    var imageProfile = this.files[0];

    if(imageProfile["type"] != "image/jpeg"){
        $("#dataImageProfile").val("");
        showAlert("Formato Incorrecto", "La imagen debe estar en formato JPEG", false);
    } else if(imageProfile["size"] > 2000000){
        $("#dataImageProfile").val("");
        showAlert("Tamaño demasiado grande","La imagen no debe de pesar mas de 2mb", false);
    } else {
        var dataImage = new FileReader;
        dataImage.readAsDataURL(imageProfile);

        $(dataImage).on("load", function(event){

            var routeImage = event.target.result;

            $(".previewImage").attr("src", routeImage);

        })
    }

});

$("#btnChangePhotoContact").click(function() {
  $(".imgProfile").toggle();
  $("#uploadImage").toggle();
});


$("#filterSQL").change(function(){

    var filter = $(this).val();

    if(filter == "searchNames"){
        $("#searchText").attr("placeholder", "Ingrese los nombres a buscar");
    } else if(filter == "searchSurNames"){
        $("#searchText").attr("placeholder", "Ingrese los apellidos a buscar");
    } else if(filter == "searchAlias"){
        $("#searchText").attr("placeholder", "Ingrese el alias a buscar");
    } else if(filter == "searchEmail"){
        $("#searchText").attr("placeholder", "Ingrese el correo a buscar");
    } else {
        $("#searchText").attr("placeholder", "Ingrese el contacto a buscar");
    }

});

$("#filterSQLBusiness").change(function(){

    var filter = $(this).val();

    if(filter == "searchNames"){
        $("#searchText").attr("placeholder", "Ingrese los negocios a buscar");
    } else if(filter == "searchSurNames"){
        $("#searchText").attr("placeholder", "Ingrese los apellidos a buscar");
    } else if(filter == "searchAlias"){
        $("#searchText").attr("placeholder", "Ingrese el alias a buscar");
    } else if(filter == "searchEmail"){
        $("#searchText").attr("placeholder", "Ingrese el correo a buscar");
    } else {
        $("#searchText").attr("placeholder", "Ingrese el contacto a buscar");
    }

});







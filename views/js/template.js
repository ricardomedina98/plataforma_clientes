import $ from 'jquery'
import 'admin-lte'
import 'bootstrap'
import 'bootstrap-datepicker'
import 'bootstrap-timepicker'
import 'bootstrap-select'

import 'blueimp-file-upload'

import 'select2'

import './../css/styles.scss'


$(document).ready(function(){

    
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

    $("#mercancia, #competencias").select2({
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

    

    $("#addressState").on("change", function() {
        $('#addressCity').empty();
        let val =$('#addressState').val();
        console.log(val);
        loadCitys(val);
    });

    $("#filterSQL").change(function(){

        let filter = $(this).val();
    
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
    
        let filter = $(this).val();
    
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

    loadStates();
});



$("#btnChangePhotoBusiness").click(function() {
    $(".imgProfile").toggle();
    $("#uploadImage").toggle();
});


$("#btnChangePhotoOwner").click(function() {
    $(".imgProfile").toggle();
    $("#uploadImage").toggle();
});



export function getURL(){
    let getUrl = window.location;
    let baseurl =  getUrl.origin + '/' +getUrl.pathname.split('/')[1]; 
    return baseurl + '/';
}

export function loadCitys(val){

    $.ajax({
        url:getURL()+"ajax/json.ajax.php",
        data: 'cities=true',
        type:'GET',
        cache: false,
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(response){            
            let ciudades = $('#addressCity');
            let optionDefault = '<option value="">Seleccione una ciudad</option>';
            ciudades.append(optionDefault);
            for (let i in response) {
                if(response[i].NOM_ENT == val){
                    let estadosCiudades = '<option value="'+response[i].NOM_MUN+'">'+response[i].NOM_MUN+'</option>';
                    ciudades.append(estadosCiudades);
                } 
            }
            let selectedCity = $('#valCity').val();                 

            $(ciudades).val(selectedCity);             
            $(ciudades).selectpicker('refresh');            
    
        }
    })
}


export function loadStates() {

    $.ajax({
        url: getURL()+"ajax/json.ajax.php",
        data: 'states=true',
        type:'GET',
        cache: false,        
        contentType:false,
        processData: false,
        dataType: 'json',
        success: function(response){              
            let estados = $('#addressState');
            let optionDefaul = '<option value="">Seleccione un estado</option>';
            estados.append(optionDefaul);
            for (let i in response) {                
                let estadosNombre = '<option value="'+response[i].NOM_ENT+'">'+response[i].NOM_ENT+'</option>';
                estados.append(estadosNombre);
            }            
            
            let selectedState = $("#valState").val();
            $(estados).val(selectedState);
            $(estados).selectpicker('refresh');

            loadCitys(selectedState);
            
        }
    }) 
}





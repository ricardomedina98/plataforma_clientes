/*Validacion formulario */

$("#formOwners").on("submit", function(){

    var searchText = $("#searchText").val();
    var state = $("#addressState").val();    

    var expresion = /^[a-zA-Z0-9]*$/;
    var filterSQL = $("#filterSQL").val();


    if(filterSQL != "" && isEmpty(searchText)){

        return false;

    } else if(!isEmpty(searchText) && filterSQL != ""){

        return true;

    } else if(!isEmpty(searchText)){

        if(!expresion.test(searchText)){

            return false;

        }

        return true;
        
    } else if(state != "" || filterSQL != ""){

        return true;
        
    }

    return false;
    
})


function isEmpty(str){
    return !str.replace(/\s+/, '').length;
}


$("#filterSQLOwners").change(function(){

    var filter = $(this).val();

    if(filter == "searchNames"){
        $("#searchText").attr("placeholder", "Ingrese los dueños a buscar");
    } else if(filter == "searchSurNames"){
        $("#searchText").attr("placeholder", "Ingrese los apellidos a buscar");
    } else if(filter == "searchAlias"){
        $("#searchText").attr("placeholder", "Ingrese el alias a buscar");
    } else if(filter == "searchEmail"){
        $("#searchText").attr("placeholder", "Ingrese el correo a buscar");
    } else {
        $("#searchText").attr("placeholder", "Ingrese el dueño a buscar");
    }

});
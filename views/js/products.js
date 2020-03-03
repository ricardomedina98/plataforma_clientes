$("#filterSQLProducts").change(function(){

    let filter = $(this).val();

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
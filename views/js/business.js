/*Validacion formulario */

$("#formBusiness").on("submit", function(){

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


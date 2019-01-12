$(".btnEdituser").click(function (){

    var id_user = $(this).attr("iduser");

    $("#id_userEdit").val(id_user);
    
    var urlWeb = getURL() + "ajax/user.ajax.php";

    var data = new FormData();
    data.append("id_user", id_user);
    
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

            $("#editarNombre").val(respuesta.name_user);
            $("#editarUsuario").val(respuesta.user_name);
            $("#editarPerfil [value='" + respuesta.type_user + "']").attr("selected", true);
        }

    });
    
});

$(".btnDeleteuser").click(function(e) {
    e.preventDefault();
    var id_user = $(this).attr("iduser");
    var type_user = $(this).attr("typeuser");

    
  
    swal({
      title: "Estas seguro?",
      text: "Se eliminara el usuario",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, eliminar"
    }).then(result => {
      if (result.value) {
        var urlWeb = getURL() + "ajax/user.ajax.php";
  
        var data = new FormData();
        data.append("id_user_delete", id_user);
        data.append("type_user", type_user);
  
        $.ajax({
            url: urlWeb,
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta) {

                deleteAlters();

                if(respuesta == '"admin"'){       

                    showAlert("Error!", "Debe de existir al menos un administrador en la base de datos", false);

                } else if(respuesta == "true"){

                    location.href = getURL() + "usuarios";
d
                } else {

                    showAlert("Error!", "Error al eliminar el usuario", false);
                } 
                
            }
        });
      }
    });
  });

$("#userNameAdd").change(function(){

    $("#alertExistUser").remove();
    
    var urlWeb = getURL() + "ajax/user.ajax.php";

	var name_user = $(this).val();

	var data = new FormData();
	data.append("user_name", name_user);

	 $.ajax({
	    url:urlWeb,
	    method:"POST",
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
	    	if(respuesta){

	    		$("#userNameAdd").parent().after('<div id="alertExistUser"><br><div class="alert alert-warning">Este usuario ya existe en la base de datos</div></div>');

	    		$("#userNameAdd").val("");

	    	}

	    }

	})
})

$(document).on("click", ".btnStatus", function() {
    var id_user = $(this).attr("iduser");
    var status = $(this).attr("status");

    var urlWeb = getURL() + "ajax/user.ajax.php";

    var data = new FormData();
    data.append("id_user_status", id_user);
  	data.append("status", status);

    $.ajax({
	    url:urlWeb,
	    method:"POST",
	    data: data,
	    cache: false,
	    contentType: false,
	    processData: false,
	    dataType: "json",
	    success:function(respuesta){
		    console.log("​respuesta", respuesta)

	    }

    })
    
    if(status == 0){

        $(this).removeClass('btn-success');
        $(this).addClass('btn-danger');
        $(this).html('Desactivado');
        $(this).attr('status',1);

    }else{

        $(this).addClass('btn-success');
        $(this).removeClass('btn-danger');
        $(this).html('Activado');
        $(this).attr('status',0);

    }
  

});
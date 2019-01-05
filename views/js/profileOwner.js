$("#deleteOwnerEdit").click(function (e){
    e.preventDefault();

    swal({
        title: "Estas seguro?",
        text: "Se eliminara el dueño y toda su informacion incluyendo imagenes",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar"        
      }).then((result) => {

          if(result.value) {

            var urlWeb = getURL()+"ajax/business.ajax.php";
            var url = getURL()+"";

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
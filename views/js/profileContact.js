$(document).ready(function(){
    
    showTickets();
    loadImages();

    $(".disabled a").on('click', function(){
        e.preventDefault();
    });
});




$('#fileupload')

    .bind('fileuploadsubmit', function (e, data) {

        var array = $('#fileupload').serializeArray();

        var id_user = $('#id_user').val();
        var id_type = $('#id_type').val();
        var jsonData = {'id_type':id_type,'id_user': id_user};

        jsonData['Data'] = array;

        console.log(jsonData);


        'use strict';

        $('#fileupload').fileupload({
            uploadTemplateId: "template-upload",
            downloadTemplateId: "template-download",
            formData: jsonData
        })
    })

    .bind('fileuploadadded', function (e, data) {
        console.log(data);
    })
  
  .bind('dragover', function (e) {
    var dropZone = $('#dropzone'),
        timeout = window.dropZoneTimeout;
    if (timeout) {
        clearTimeout(timeout);
    } else {
        dropZone.addClass('in');
    }
    var hoveredDropZone = $(e.target).closest(dropZone);
    dropZone.toggleClass('hover', hoveredDropZone.length);
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);


    
});

function loadImages(){
    // Load existing files:
    var id_user = $('#id_user').val();
    var id_type = $('#id_type').val();
    var jsonData = {'id_type':id_type,'id_user': id_user};

    

    $('#fileupload').addClass('fileupload-processing');
    $.ajax({
        data: jsonData,
        url: getURL()+'views/img/users/upload.images.php',
        dataType: 'json',
        context: $('#fileupload')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
        $('#tableShowImages tr').remove();
    }).done(function (files) {
        loadImagesHome(files);
        $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: files});
    });
}
  
function loadImagesHome(files){
    $('#photosContact').empty();
    
    $('#photosContact').lightGallery({
        showThumbByDefault: false
    });

    var photosContact = $('#photosContact');
    for (i in files['files']) {
        
        var html = '<a href="'+ files['files'][i].url +'"><img class="imagesContact" src="'+files['files'][i].thumbnailUrl+'"></a>';
        photosContact.append(html);
        photosContact.data('lightGallery').destroy(true);
        photosContact.lightGallery();
       
    }
}

$("#fotosUpload").click(function(){
    loadImages();
});


$(document).bind('drop dragover', function (e) {
    e.preventDefault();
});

/* Tickets*/
$("#dataImageTicket").change(function() {     

    deleteAlters();
    
    var imageTicket = this.files[0];
    console.log(imageTicket);
  
    if(imageTicket["type"] != "image/jpeg"){
        $("#dataImageTicket").val("");
        showAlertModal("Formato Incorrecto", "La imagen debe estar en formato JPEG", false);
    } else if(imageTicket["size"] > 5000000){
        $("#dataImageTicket").val("");
        showAlertModal("Tamaño demasiado grande","La imagen no debe de pesar mas de 2mb", false);
    } else {
        var dataImage = new FileReader;
        dataImage.readAsDataURL(imageTicket);
  
        $(dataImage).on("load", function(event){
  
            var routeImage = event.target.result;
  
            $("#previewTicket").attr("src", routeImage);
  
        })
  
    }
  
});

$( "#addTicket" ).click(function() {

    var folio = $("#folioTicket").val();
    var cajaTicket = $("#cajaTicket").val();
    var sellerTicket = $("#sellerTicket").val();
    var montoTotal = $("#montoTotal").val();
    var previewTicket = $("#previewTicket").attr("src"); 
    
    if(folio != "" && cajaTicket != "" && sellerTicket != "" && montoTotal != "" && previewTicket != null && previewTicket != ""){
        $( "#formTicket" ).submit();
    } else {
        return false;
    }
    
});

$( "#formTicket" ).submit(function (e){
    

    deleteAlters();

    e.preventDefault();
    var urlWeb = getURL()+"ajax/tickets.ajax.php";
    
    $.ajax({
        url:urlWeb,
        method:"POST",
        data: new FormData(this),
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){            
            if(respuesta){
                console.log();
                $("#formTicket")[0].reset();
                $("#dataImageTicket").val("");                
                $("#previewTicket").attr("src", "");
                $('#modalTicket').modal('hide');
                showAlert("Correcto!", "Tickets guardado correctamente", true);
                showTickets();
            } else {
                showAlertModal("Error!", "Hubo un error al guardar el ticket", false);
            }
        }

    });
});

function showTickets(){
    
    var urlWeb = getURL()+"ajax/tickets.ajax.php";
    var url = getURL();    

    var data = new FormData();
    data.append("id_user_ticket", $("#id_user").val());

    $('#photoTicket').empty();
    
    $('#photoTicket').lightGallery({
        selector: '.imageTicket'
    });

    $.ajax({
        url:urlWeb,
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){            
            
            var tickets = JSON.parse(respuesta);                                
            
            var photosTickets = $("#photoTicket");
            
            for (i in tickets) {
                var html = '<div class="col-xs-3 col-md-4" ><div class="thumbnail"><button class="close" id_ticket="'+ tickets[i].id_ticket +'">x</button><div class="imageTicket text-center" data-src="'+ url + tickets[i].photo_ticket + '"><img src="'+ url + tickets[i].photo_ticket + '" alt=""></div><div class="caption text-center"><div class="title_folio">Folio: <span style="font-weight: bold;">' + tickets[i].folio + '</span></div><div class="title_total">Monto Total: <span style="font-weight: bold;">' + tickets[i].totalAmount + '</span></div><div class="title_seller">Vendedora: <span style="font-weight: bold;">' + tickets[i].seller + '</span></div><div class="title_caja">Caja: <span style="font-weight: bold;">' + tickets[i].branch + '</span></div></div></div></div>';            
                photosTickets.append(html);
            }

            photosTickets.data('lightGallery').destroy(true);
            photosTickets.lightGallery({
                selector: '.imageTicket'
            });

        }

    });

}

$("#photoTicket").on('click', '.close', function(){    

    var btnClose =  $(this);    

    var urlWeb =getURL()+"/ajax/tickets.ajax.php";

    var data = new FormData();
    data.append("id_ticket", $(this).attr("id_ticket"));

    $.ajax({
        url:urlWeb,
        method:"POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success:function(respuesta){                  
            if(respuesta){                 
                $(btnClose).parents(".col-md-4").remove();
                $('#photoTicket').data('lightGallery').destroy(true);
                $('#photoTicket').lightGallery({
                    selector: '.imageTicket'
                });
            }

        }

    });

});

$("#deleteContactEdit").click(function (e){
    e.preventDefault();

    swal({
        title: "Estas seguro?",
        text: "Se eliminara el contacto y toda su informacion incluyendo imagenes",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar"        
      }).then((result) => {

          if(result.value) {

            var urlWeb = getURL()+"ajax/tickets.ajax.php";
            

            var data = new FormData();
            data.append("id_user_delete", $("#id_user").val());
            console.log(data);
            
            $.ajax({
                url:urlWeb,
                method:"POST",
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success:function(respuesta){  
                    
                    console.log(respuesta);
                    location.href = getURL() + "contactos/";
                    
                }
        
            });
            
          }
      })
});

var urlType = getURL()+"ajax/showBussines.ajax.php";
console.log(getURL());
$.typeahead({
    input: ".js-typeahead-business",
    order: "asc",
    offset: true,
    hint: true,
    source: {

        ajax: {
            url: urlType,
            callback:{
                done: function (data, textStatus, jqXHR) {
                    console.log(textStatus);
                    console.log(data);
                    return data;
                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                },
                always :function (data, textStatus, jqXHR) {
                    console.log(textStatus);
                },
                then: function (jqXHR, textStatus) {
                    console.log(textStatus);
                }
            }
        }

    },
    callback: {
        onClickBefore: function () { 
            console.log("Click");
        }
    }
});

/* Validacion formulario */







/*Validacion formulario 

$("#form_contact").on("submit", function(){
    console.log("Hola");
    return false;
  })

  */
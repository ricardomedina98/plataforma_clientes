import { getURL, loadStates } from './template'
import { showAlert, deleteAlters, showAlertModal } from "./alerts";
import 'lightgallery'
import 'lg-fullscreen'
import 'lg-video'
import 'lg-zoom'
import 'lg-thumbnail'
import 'jquery-typeahead'
import 'select2'
import 'lightgallery'

import 'blueimp-file-upload'
import 'blueimp-load-image'
import 'blueimp-tmpl'
import 'blueimp-file-upload/js/jquery.fileupload'
import 'blueimp-file-upload/js/jquery.fileupload-audio'
import 'blueimp-file-upload/js/jquery.fileupload-image'
import 'blueimp-file-upload/js/jquery.fileupload-process'
import 'blueimp-file-upload/js/jquery.fileupload-ui'
import 'blueimp-file-upload/js/jquery.fileupload-validate'
import 'blueimp-file-upload/js/jquery.fileupload-video'

$(document).ready(function () {

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
    

    $(".disabled a").on("click", function () {
        e.preventDefault();
    });    

    $("#btnChangePhotoContact").click(function() {
        $(".imgProfile").toggle();
        $("#uploadImage").toggle();
    });

    $('#own_business').select2({
        width: '100%',
        tags: true,
        theme: "classic",
        tokenSeparators: [',', ' '],
        placeholder: "Seleccione un local",
    });

    $('#dateRegistrationModalEdit').datepicker({
        autoclose: true,
        maxViewMode: 'years',
        language: 'es',
        format: 'dd/mm/yyyy',
        startDate: '-50y'
    });

    $("#dataImageTicket").change(function () {
        deleteAlters();
    
        let imageTicket = this.files[0];
    
        if (imageTicket["type"] != "image/jpeg") {
            $("#dataImageTicket").val("");
            showAlertModal(
                "Formato Incorrecto",
                "La imagen debe estar en formato JPEG",
                false
            );
        } else if (imageTicket["size"] > 5000000) {
            $("#dataImageTicket").val("");
            showAlertModal(
                "Tamaño demasiado grande",
                "La imagen no debe de pesar mas de 2mb",
                false
            );
        } else {
            var dataImage = new FileReader();
            dataImage.readAsDataURL(imageTicket);
    
            $(dataImage).on("load", function (event) {
                var routeImage = event.target.result;
    
                $("#previewTicket").attr("src", routeImage);
            });
        }
    });

    $('#destination').change(function() {

        let urlMemberFamily;
        let data = new FormData();
        let id_contact = $('#id_user').val();
        
        let selects = $('#id_relation_destination');  
        $(selects).empty();     
        
        if($(this).val() === 'contact') {        
            urlMemberFamily = getURL()+"ajax/contact.ajax.php"; 
            data.append("id_contactFamily", id_contact); 
            $.ajax({
                url:urlMemberFamily,
                data: data,
                type:'POST',
                cache: false,        
                contentType:false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){                    
                                                                
                    respuesta.forEach(contacto => {
                        
                        if(contacto.name_contact || contacto.first_surname || contacto.second_surname) {
                            let selectionRelationship = '<option value="'+contacto.id_contact+'">'+contacto.name_contact+ ' ' + contacto.first_surname + ' ' + contacto.second_surname + ' </option>';
                            if(contacto.alias) {
                                selectionRelationship += '('+contacto.alias+')';
                            }
                            selects.append(selectionRelationship);
                        }
    
                    });          
                    
                    $(selects).selectpicker("refresh");
                    $('.dropdown-menu').css("margin-bottom","");
                }
            });
        } else if($(this).val() === 'owner') {
            urlMemberFamily = getURL()+"ajax/owner.ajax.php"; 
            data.append("owner", true); 
            $.ajax({
                url:urlMemberFamily,
                data: data,
                type:'POST',
                cache: false,        
                contentType:false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){                    
                    
                    respuesta.forEach(owner => {
                        console.log(owner);
                        if(owner.name_owner || owner.first_surname || owner.second_surname) {
                            let selectionRelationship = '<option value="'+owner.id_owner+'">'+owner.name_owner+ ' ' + owner.first_surname + ' ' + owner.second_surname +'</option>';
                            selects.append(selectionRelationship);
                        }
                    });          
                    
                    $(selects).selectpicker("refresh");
                    $('.dropdown-menu').css("margin-bottom","");
                    
                }
            });
        }
    });
    
    $('#destination_update').change(function() {
    
        let urlMemberFamily;
        let data = new FormData();
        let id_contact = $('#id_user').val();
        
        let selects = $('#id_relation_destination_update');  
        $(selects).empty();     
        
        if($(this).val() === 'contact') {        
            urlMemberFamily = getURL()+"ajax/contact.ajax.php"; 
            data.append("id_contactFamily", id_contact); 
            $.ajax({
                url:urlMemberFamily,
                data: data,
                type:'POST',
                cache: false,        
                contentType:false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){                    
                                                                
                    respuesta.forEach(contacto => {
                        
                        if(contacto.name_contact || contacto.first_surname || contacto.second_surname) {
                            let selectionRelationship = '<option value="'+contacto.id_contact+'">'+contacto.name_contact+ ' ' + contacto.first_surname + ' ' + contacto.second_surname + ' </option>';
                            if(contacto.alias) {
                                selectionRelationship += '('+contacto.alias+')';
                            }
                            selects.append(selectionRelationship);
                        }
    
                    });          
                    
                    $(selects).selectpicker("refresh");
                    if($("#id_relation_destination_selected").val() !== null) {
                        $(selects).selectpicker('val', $("#id_relation_destination_selected").val());
                    }
                    $('.dropdown-menu').css("margin-bottom","");
                }
            });
        } else if($(this).val() === 'owner') {
            urlMemberFamily = getURL()+"ajax/owner.ajax.php"; 
            data.append("owner", true); 
            $.ajax({
                url:urlMemberFamily,
                data: data,
                type:'POST',
                cache: false,        
                contentType:false,
                processData: false,
                dataType: 'json',
                success: function(respuesta){                    
                    
                    respuesta.forEach(owner => {
                        
                        if(owner.name_owner || owner.first_surname || owner.second_surname) {
                            let selectionRelationship = '<option value="'+owner.id_owner+'">'+owner.name_owner+ ' ' + owner.first_surname + ' ' + owner.second_surname +'</option>';
                            selects.append(selectionRelationship);
                        }
                    });          
                    
                    $(selects).selectpicker("refresh");
                    if($("#id_relation_destination_selected").val() !== null) {
                        $(selects).selectpicker('val', $("#id_relation_destination_selected").val());
                    }
                    $('.dropdown-menu').css("margin-bottom","");
                    
                }
            });
        }
        
        
    });    

    $("#fotosUpload").click(function () {
        loadImages();
    });

    $("#dataImageProfile").change(function() { 

        deleteAlters();
        
        let imageProfile = this.files[0];
    
        if(imageProfile.type !== "image/jpeg"){
            $("#dataImageProfile").val("");
            showAlert("Formato Incorrecto", "La imagen debe estar en formato JPEG", false);
        } else if(imageProfile["size"] > 2000000){
            $("#dataImageProfile").val("");
            showAlert("Tamaño demasiado grande","La imagen no debe de pesar mas de 2mb", false);
        } else {
            let dataImage = new FileReader;
            dataImage.readAsDataURL(imageProfile);
    
            $(dataImage).on("load", function(event){
    
                let routeImage = event.target.result;
    
                $(".previewImage").attr("src", routeImage);
    
            })
        }
    
    });

    


    $("#fileupload")
    .bind("fileuploadsubmit", function (e, data) {
        let array = $("#fileupload").serializeArray();

        let id_user = $("#id_user").val();
        let id_type = $("#id_type").val();
        let jsonData = {
            id_type: id_type,
            id_user: id_user
        };

        jsonData["Data"] = array;


        $("#fileupload").fileupload({
            uploadTemplateId: "template-upload",
            downloadTemplateId: "template-download",
            formData: jsonData
        });
    })

    .bind("fileuploadadded", function (e, data) {

    })

    .bind("dragover", function (e) {
        var dropZone = $("#dropzone"),
            timeout = window.dropZoneTimeout;
        if (timeout) {
            clearTimeout(timeout);
        } else {
            dropZone.addClass("in");
        }
        var hoveredDropZone = $(e.target).closest(dropZone);
        dropZone.toggleClass("hover", hoveredDropZone.length);
        window.dropZoneTimeout = setTimeout(function () {
            window.dropZoneTimeout = null;
            dropZone.removeClass("in hover");
        }, 100);
    }
    );

    $(document).bind("drop dragover", function (e) {
        e.preventDefault();
    });

    /* Tickets*/

    $("#addTicket").click(function () {
        let folio = $("#folioTicket").val();
        let cajaTicket = $("#cajaTicket").val();
        let sellerTicket = $("#sellerTicket").val();
        let montoTotal = $("#montoTotal").val();
        let previewTicket = $("#previewTicket").attr("src");

        if (
            folio != "" &&
            cajaTicket != "" &&
            sellerTicket != "" &&
            montoTotal != "" &&
            previewTicket != null &&
            previewTicket != ""
        ) {
            $("#formTicket").submit();
        } else {
            return false;
        }
    });

    $("#formTicket").submit(function (e) {
        deleteAlters();

        e.preventDefault();

        $.ajax({
            url: getURL() + "ajax/tickets.ajax.php",
            method: "POST",
            data: new FormData(this),
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta) {
                    console.log();
                    $("#formTicket")[0].reset();
                    $("#dataImageTicket").val("");
                    $("#previewTicket").attr("src", "");
                    $("#modalTicket").modal("hide");
                    showAlert("Correcto!", "Tickets guardado correctamente", true);
                    showTickets();
                } else {
                    showAlertModal("Error!", "Hubo un error al guardar el ticket", false);
                }
            }
        });
    });


    $("#photoTicket").on("click", ".close", function () {
        let btnClose = $(this);

        let data = new FormData();
        data.append("id_ticket", $(this).attr("id_ticket"));

        $.ajax({
            url: getURL() + "/ajax/tickets.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (respuesta) {
                if (respuesta) {
                    $(btnClose)
                        .parents(".col-md-4")
                        .remove();
                    $("#photoTicket")
                        .data("lightGallery")
                        .destroy(true);
                    $("#photoTicket").lightGallery({
                        selector: ".imageTicket"
                    });
                }
            }
        });
    });

    $("#deleteContactEdit").click(function (e) {
        e.preventDefault();

        swal({
            title: "Estas seguro?",
            text: "Se eliminara el contacto y toda su informacion incluyendo imagenes",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar"
        }).then(result => {
            if (result.value) {

                let data = new FormData();
                data.append("id_user_delete", $("#id_user").val());            

                $.ajax({
                    url: getURL() + "ajax/tickets.ajax.php",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {
                        console.log(respuesta);
                        location.href = getURL() + "contactos/";
                    }
                });
            }
        });
    });

    $.typeahead({
        input: ".js-typeahead-business",
        order: "asc",
        offset: true,
        hint: true,
        source: {
            ajax: {
                url: getURL() + "ajax/showBussines.ajax.php",
                callback: {
                    done: function (data, textStatus, jqXHR) {
                        return data;
                    }
                }
            }
        }
    });


    $(".btnEditIncident").click(function () {
        
        let id_incident = $(this).attr("ideditincident");
        let id_user = $("#id_user").val();
        let id_type = $("#id_type").val();

        let data = new FormData();
        data.append("id_incident", id_incident);
        $.ajax({
            url: getURL() + "ajax/incidents.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log("​respuesta", respuesta);
                $("#subjectEditIncident").val(respuesta.subject);
                $("#dateRegistrationModalEdit").datepicker("setDate", respuesta.dateIncident);
                $("#timePickerEdit").timepicker("setTime", respuesta.timeIncident);
                $("#placeEditIncident").val(respuesta.place);
                $("#personalEditIncident").val(respuesta.personal_involved);
                $("#commentsEditIncident").val(respuesta.description);
                $("#id_incident_edit").val(respuesta.id_incident);
            }

        });

        let jsonData = {
            id_type: id_type,
            id_user: id_user,
            id_incident: id_incident
        };

        $("#formEditIncidents").addClass("fileupload-processing");
        $.ajax({
                data: jsonData,
                url: getURL() + "views/img/users/upload.incidents.php",
                dataType: "json",
                context: $("#formEditIncidents")[0]
            })
            .always(function () {
                $(this).removeClass("fileupload-processing");
                $("#tableShowIncidents tr").remove();
            })
            .done(function (files) {
                $(this)
                    .fileupload("option", "done")
                    .call(this, $.Event("done"), {
                        result: files
                    });
            });


    });


    $("#formEditIncidents").fileupload({
        filesContainer: $('.filesIncidents'),
        uploadTemplateId: null,
        downloadTemplateId: null,
        uploadTemplate: function (o) {
            let rows = $();
            $.each(o.files, function (index, file) {
                let row = $('<tr class="template-upload fade">' +
                    '<td><span class="preview"></span></td>' +
                    '<td><p class="name"></p>' +
                    '<div class="error"></div>' +
                    '</td>' +
                    '<td><p class="size"></p>' +
                    '<div class="progress"></div>' +
                    '</td>' +
                    '<td>' +
                    (!index && !o.options.autoUpload ?
                        '<button class="btn btn-primary start" disabled>Subir </button>' : '') +
                    (!index ? '<button class="btn btn-warning cancel">Cancelar</button>' : '') +
                    '</td>' +
                    '</tr>');
                row.find('.name').text(file.name);
                row.find('.size').text(o.formatFileSize(file.size));
                if (file.error) {
                    row.find('.error').text(file.error);
                }
                rows = rows.add(row);
            });
            return rows;
        },
        downloadTemplate: function (o) {
            var id_incident = $("#id_incident_edit").val();
            var id_user = $("#id_user_edit").val();
            var rows = $();
            $(o.files).each(function (index, file) {
                var row = $('<tr class="template-download fade">' +
                    '<td><span class="preview"></span></td>' +
                    '<td><p class="name"></p>' +
                    (file.error ? '<div class="error"></div>' : '') +
                    '</td>' +
                    '<td><span class="size"></span></td>' +
                    '<td><button class="btn btn-danger delete">Eliminar</button></td>' +
                    '</tr>');
                row.find('.size').text(o.formatFileSize(file.size));
                if (file.error) {
                    row.find('.name').text(file.name);
                    row.find('.error').text(file.error);
                } else {
                    row.find('.name').append($('<a></a>').text(file.name));
                    if (file.thumbnailUrl) {
                        row.find('.preview').append(
                            $('<a></a>').append(
                                $('<img>').prop('src', file.thumbnailUrl)
                            )
                        );
                    }
                    row.find('a')
                        .attr('data-gallery', '')
                        .attr('download', file.name)
                        .prop('href', file.url);
                    row.find('button.delete')
                        .attr('data-type', file.deleteType)
                        .attr('data-url', file.deleteUrl + "&id_incident=" + id_incident + "&id_type=contactos&id_user=" + id_user);
                }
                rows = rows.add(row);
            });
            return rows;
        },
        dropZone: $("#dropzoneIncident"),
        url: getURL() + "views/img/users/upload.incidents.php",
        drop: function (e, data) {
            $.each(data.files, function (index, file) {
                console.log("Dropped file: " + file.name);
            });
        },
        change: function (e, data) {
            $.each(data.files, function (index, file) {
                console.log("Selected file: " + file.name);
            });
        },
        fileInput: $("#inputUploadIncident")

    });




    $("#formEditIncidents")
        .bind("dragover", function (e) {
            var dropZone = $("#dropzoneIncident"),
                timeout = window.dropZoneTimeout;
            if (timeout) {
                clearTimeout(timeout);
            } else {
                dropZone.addClass("in");
            }
            var hoveredDropZone = $(e.target).closest(dropZone);
            dropZone.toggleClass("hover", hoveredDropZone.length);
            window.dropZoneTimeout = setTimeout(function () {
                        window.dropZoneTimeout = null;
                        dropZone.removeClass("in hover");
                    },
                    100)
                .bind('fileuploadadd', function (e, data) {
                    $("#addIncident").click(function () {
                        let subject = $("#subjectIncident").val();
                        let comments = $("textarea#commentsContactIncident").val();

                        if (subject != "" && comments != "") {
                            data.submit();
                        } else {
                            return false;
                        }

                    });
                })

        });

    $("#addIncident").click(function () {
        $("#formAddIncidents").submit();
    });

    $("#editIncident").click(function () {
        $("#formEditIncidents").submit();
    });



    $(".btnViewIncident").click(function () {
        
        let id_incident = $(this).attr("idviewincident");
        let id_user = $("#id_user").val();
        let id_type = $("#id_type").val();

        let data = new FormData();
        data.append("id_incident", id_incident);
        $.ajax({
            url: getURL() + "ajax/incidents.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log("​respuesta", respuesta)

                $("#subjectViewIncident").text(respuesta.subject);
                $("#commentsViewIncident").text(respuesta.description);
                $("#dateViewIncident").text(respuesta.dateIncident);
                $("#timeViewIncident").text(respuesta.timeIncident);
                $("#placeViewIncident").text(respuesta.place);
                $("#personalViewIncident").text(respuesta.personal_involved);
            }

        });

        let jsonData = {
            id_type: id_type,
            id_user: id_user,
            id_incident: id_incident
        };

        $.ajax({
                data: jsonData,
                url: getURL() + "views/img/users/upload.incidents.php",
                dataType: "json",
                context: $("#fileupload")[0]
            })
            .done(function (files) {

                $("#showImagesIncidents").empty();

                $("#showImagesIncidents").lightGallery({
                    showThumbByDefault: false
                });

                let showImagesIncidents = $("#showImagesIncidents");
                for (let i in files["files"]) {
                    //var extension = (/[.]/.exec(files["files"][i].url)) ? /[^.]+$/.exec(files["files"][i].url) : undefined;
                    if ((/\.(gif|jpg|jpeg|png)$/i).test(files["files"][i].url)) {
                        var html =
                            '<a href="' +
                            files["files"][i].url +
                            '"><img class="imagesIncidents" src="' +
                            files["files"][i].thumbnailUrl +
                            '"></a>';
                        showImagesIncidents.append(html);

                    }

                    if ((/\.(mp4|wmv|webm)$/i).test(files["files"][i].url)) {
                        let html =
                            '<video width="300" class="imagesIncidents" controls>' +
                            '<source src="' + files["files"][i].url + '" type="video/mp4">' +
                            'Your browser does not support HTML5 video. ' +
                            '</video>';
                        showImagesIncidents.append(html);
                    }

                }

                showImagesIncidents.data("lightGallery").destroy(true);
                showImagesIncidents.lightGallery();

            });


    });

    $(".btnDeleteIncident").click(function (e) {
        e.preventDefault();

        swal({
            title: "Estas seguro?",
            text: "Se eliminara el incidente y toda su informacion incluyendo imagenes",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar"
        }).then(result => {
            if (result.value) {            
                let id_incident = $(this).attr("idDeleteIncident");

                let data = new FormData();
                let id_user = $("#id_user").val();
                data.append("id_incident_delete", id_incident);

                $.ajax({
                    url: getURL() + "ajax/incidents.ajax.php",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {                    
                        location.href = getURL() + "contactos/" + id_user;
                    }
                });
            }
        });
    });


    $("#addProduct").click(function () {
        let name_product = $("#name_product").val();
        let quantity_unitary = $("#quantity_unitary").val();
        let quantity_total = $("#quantity_total").val();

        if (
            name_product != "" &&
            quantity_unitary != "" ||
            quantity_total != ""
        ) {
            $("#formAddProducts").submit();
        } else {
            return false;
        }
    });

    $(".btnEditProduct").click(function () {
        
        let id_contact_product = $(this).attr("ideditproduct");

        let data = new FormData();
        data.append("id_contactProductEdit", id_contact_product);
        $.ajax({
            url: getURL() + "ajax/contact.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                console.log(respuesta);
                $("#id_contact_product").val(respuesta.id_contact_product);
                $("#name_productEdit").val(respuesta.name_product);
                $("#brandEdit").val(respuesta.brand);
                $("#quantityEdit").val(respuesta.quantity);
                $("#cutEdit").val(respuesta.cut);
            }

        })
    });


    $("#updateProduct").click(function () {
        let name_product = $("#nameEditproduct").val();
        let quantity_unitary = $("#quantityEditunitary").val();
        let quantity_total = $("#quantityEditTotal").val();

        if (
            name_product != "" &&
            quantity_unitary != "" ||
            quantity_total != ""
        ) {
            $("#formEditProducts").submit();
        } else {
            return false;
        }
    });

    $('.btnDeleteProduct').click(function () {

        swal({
            title: "¿Estas seguro?",
            text: "Se eliminara el producto y toda su informacion",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar"
        }).then(result => {
            if (result.value) {            

                let data = new FormData();
                let id_contact_product = $(this).attr("iddeleteproduct");
                let id_user = $("#id_user").val();
                data.append("id_contactProductDelete", id_contact_product);
                console.log(data);

                $.ajax({
                    url: getURL() + "ajax/contact.ajax.php",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        if (response) {
                            location.href = getURL() + "contactos/" + id_user;
                        }
                    }
                });
            }
        });
    });



    $("#addMemberFamily").click(function () {
        $("#formAddMembersFamily").submit();
    });


    $(".btnEditMemberFamily").click(function () {
        
        let id_relationship = $(this).attr("idEditMemberFamily");

        let data = new FormData();
        data.append("id_relationship", id_relationship);
        $.ajax({
            url: getURL() + "ajax/contact.ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (respuesta) {
                
                $("#id_relation_destination_selected").val(respuesta.id_relation_destination);

                $("#id_relationship").val(respuesta.id_relationship);
                
                $("#id_type_relationship_update").selectpicker('val', respuesta.id_type_relationship);
                
                $("#destination_update").selectpicker('val', respuesta.destination);
                
            }

        })
    });

    $("#modalEditMemberFamily").on("hide.bs.modal", function () {
        $("#id_relation_destination_selected").val(null);

        $("#id_relationship").val(null);
    });

    $("#btneditMemberFamily").click(function () {
        console.log($('#id_relation_destination_update').val());
        if($('#id_type_relationship_update').val() === null && $('#destination_update').val() === null && $('id_relation_destination_update').val() === null) {
            console.log('Faltan campos por llenar');
        } else {
            $("#formEditMembersFamily").submit();
        }
    });


    $(".btnDeleteMemberFamily").click(function (e) {
        e.preventDefault();

        swal({
            title: "¿Estas seguro?",
            text: "Se eliminara el familiar y toda su informacion",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Si, eliminar"
        }).then(result => {
            if (result.value) {

                let data = new FormData();
                data.append("id_familymember_delete", $(this).attr("idDeleteMemberFamily"));
                let id_user = $("#id_user").val();
                    

                $.ajax({
                    url: getURL() + "ajax/contact.ajax.php",
                    method: "POST",
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (respuesta) {

                        if(respuesta) {
                            location.href = getURL() + "contactos/" + id_user;
                        } else {
                            showAlertModal("Error!", "Hubo un error al eliminar el ticket", false);
                        }
                    }
                });
            }
        });
    });

    showTickets();
    loadImages();

});


export function loadImages() {
    // Load existing files:
    let id_user = $("#id_user").val();
    let id_type = $("#id_type").val();
    let jsonData = {
        id_type: id_type,
        id_user: id_user
    };

    $("#fileupload").addClass("fileupload-processing");
    $.ajax({
            data: jsonData,
            url: getURL() + "views/img/users/upload.images.php",
            dataType: "json",
            context: $("#fileupload")[0]
        })
        .always(function () {
            $(this).removeClass("fileupload-processing");
            $("#tableShowImages tr").remove();
        })
        .done(function (files) {
            loadImagesHome(files);
            $(this)
                .fileupload("option", "done")
                .call(this, $.Event("done"), {
                    result: files
                });
        });
}

export function loadImagesHome(files) {
    $("#photosContact").empty();

    $("#photosContact").lightGallery({
        showThumbByDefault: false
    });

    let photosContact = $("#photosContact");
    for (let i in files["files"]) {
        var html =
            '<a href="' +
            files["files"][i].url +
            '"><img class="imagesContact" src="' +
            files["files"][i].thumbnailUrl +
            '"></a>';
        photosContact.append(html);
        photosContact.data("lightGallery").destroy(true);
        photosContact.lightGallery();
    }
}

function showTickets() {

    let data = new FormData();
    data.append("id_user_ticket", $("#id_user").val());

    $("#photoTicket").empty();

    $("#photoTicket").lightGallery({
        selector: ".imageTicket"
    });

    $.ajax({
        url: getURL() + "ajax/tickets.ajax.php",
        method: "POST",
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
            let tickets = JSON.parse(respuesta);

            let photosTickets = $("#photoTicket");

            for (let i in tickets) {
                let html =
                    '<div class="col-xs-3 col-md-4" ><div class="thumbnail"><button class="close" id_ticket="' +
                    tickets[i].id_ticket +
                    '">x</button><div class="imageTicket text-center" data-src="' +
                    getURL() +
                    tickets[i].photo_ticket +
                    '"><img src="' +
                    getURL() +
                    tickets[i].photo_ticket +
                    '" alt=""></div><div class="caption text-center"><div class="title_folio">Folio: <span style="font-weight: bold;">' +
                    tickets[i].folio +
                    '</span></div><div class="title_total">Monto Total: <span style="font-weight: bold;">' +
                    tickets[i].totalAmount +
                    '</span></div><div class="title_seller">Vendedora: <span style="font-weight: bold;">' +
                    tickets[i].seller +
                    '</span></div><div class="title_caja">Caja: <span style="font-weight: bold;">' +
                    tickets[i].branch +
                    "</span></div></div></div></div>";
                photosTickets.append(html);
            }

            photosTickets.data("lightGallery").destroy(true);
            photosTickets.lightGallery({
                selector: ".imageTicket"
            });
        }
    });
}
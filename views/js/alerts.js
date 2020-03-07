
export function showAlert(title, message, tipo) {
    let clasesDefault = "alert alert-dismissible text-center";
    let html;
    if(tipo){
        $("#alert").addClass("alert-success " + clasesDefault);
        html = '<h4><i class="icon fa fa-check"></i> '+title+'</h4> <span>'+message+'</span>';
    } else {
        $("#alert").addClass("alert-error " + clasesDefault);
        html = '<h4><i class="icon fa fa-window-close"></i> '+title+'</h4><span>'+message+'</span>';
    }
    $("#alert").append(html);
    $("#alert").fadeTo(3000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);    
    });   
};


export function showAlertModal(title, message, tipo) {
    $("#alertModal").empty();
    let clasesDefault = "alert alert-dismissible text-center";
    let html;
    if(tipo){
        $("#alertModal").addClass("alert-success " + clasesDefault);
        html = '<h4><i class="icon fa fa-check"></i> '+title+'</h4> <span>'+message+'</span>';
    } else {
        $("#alertModal").addClass("alert-error " + clasesDefault);
        html = '<h4><i class="icon fa fa-window-close"></i> '+title+'</h4> <span>'+message+'</span>';
    }
    $("#alertModal").append(html);
    $("#alertModal").fadeTo(3000, 500).slideUp(500, function(){
        $("#alertModal").slideUp(500);    
    });   
};


export function deleteAlters(){
    $("#alert h4").remove();
    $("#alert span").remove();
}

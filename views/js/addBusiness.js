

$("#businessAntiquity").on("input", function(e) {
    var input = $(this);
    var val = input.val();
  
    if (input.data("lastval") != val) {
      input.data("lastval", val);
  
      //your change action goes here 
      console.log(val);

      if(val>1){
          $("#duration option").val();
      }
    }
  
  });
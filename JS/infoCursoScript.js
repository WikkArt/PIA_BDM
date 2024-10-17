$("#chbCurso").on("click", function() {  
  $(".nivel").prop("checked", this.checked);  
});  

$(".nivel").on("click", function() {  
    if ($(".nivel").length == $(".nivel:checked").length) {  
        $("#chbCurso").prop("checked", true);  
    } else {  
        $("#chbCurso").prop("checked", false);  
    }  
});
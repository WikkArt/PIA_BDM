/* Seleccion de niveles / curso completo */
$("#chbCurso").on("click", function () {  
  $(".nivel").prop("checked", this.checked);  
});  

$(".nivel").on("click", function() {  
    if ($(".nivel").length == $(".nivel:checked").length) {  
        $("#chbCurso").prop("checked", true);  
    } else {  
        $("#chbCurso").prop("checked", false);  
    }  
});

/* Habilitar boton de eliminar al escoger un motivo */
$(document).ready(function () {

    var form = document.getElementById('idFormEliminar');

    if (form){
        form.addEventListener('change', function(e) {
            if (e.target !== e.currentTarget) {
                var btn = document.getElementById('btnEliminarComentario');
                btn.disabled = false;
            }
        }, false);
    }

    /* Quitar seleccion al oprimir 'cancelar' o el boton de 'X  ' */
    $('.close').on('click', function() {
        $('input[type="radio"][name="flexRadioDefault"]').prop('checked', false);
        $('#btnEliminarComentario').prop('disabled', true);
    });

});
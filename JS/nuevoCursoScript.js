function cargarImagen(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
}

function cargarVideo(){
    var input = document.getElementById("video");
    var freader = new FileReader();
    freader.readAsDataURL(input.files[0]);
    freader.onload = function(){
        document.getElementById("idVideo").src=freader.result;
    }
}

function cargarVideoExtra(){
    var input = document.getElementById("videoExtra");
    var freader = new FileReader();
    freader.readAsDataURL(input.files[0]);
    freader.onload = function(){
        document.getElementById("idVideoExtra").src=freader.result;
    }
}

function mostrarAvatar(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };
        reader.readAsDataURL(fileInput.files[0]);
    }
}

$(document).ready(function(){

    $('#btnCurso').click(function(){
        var fotoPromo = $('#').val();
        var categoria = $('#').val();
        var nombreCurso = $('#').val();
        var descripcion = $('#').val();
        var videoNivel1 = $('#').val();
        var nombreNivel = $('#').val();
        var precio = $("#").val();
        var pdf = $('#').val();
        var txt = $("#").val();
        var imagenExtra = $('#').val();
        var videoExra = $('#').val();

        if(fotoPromo == ""){
            alert("No hay ninguna imagen en el campo '', por favor escríbalo.");
            return false;
        }else if(nombreCurso == ""){
            alert("No se ha llenado el campo '', por favor escríbalo.");
            return false;
        }else if(descripcion == ""){
            alert("No se ha llenado el campo '', por favor escríbalo.");
            return false;
        }

        console.log("Foto Promocional: " + nombreNivel);
        console.log("Categoría: " + );
        console.log("Nombre del curso: " + );
        console.log("Descripción: " + );
        console.log("Video del nivel 1: " + );
        console.log("Nombre del nivel 1: " + );
        console.log("Precio: " + );
        console.log("PDF: " + );
        console.log("TXT: " + );
        console.log("Imagen extra: " + );
        console.log("Video extra: " + );
    });
});
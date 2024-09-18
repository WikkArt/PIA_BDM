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
        var videoExtra = $('#').val();

        if(fotoPromo == ""){
            alert("No hay ninguna imagen en el campo 'Foto Promocional', por favor suba una.");
            return false;
        }else if(categoria == ""){
            alert("No se ha llenado el campo 'Categoría', por favor escoja uno.");
            return false;
        }else if(nombreCurso == ""){
            alert("No se ha llenado el campo 'Nombre del curso', por favor escríbalo.");
            return false;
        }else if(descripcion == ""){
            alert("No se ha llenado el campo 'Descripción', por favor escríbalo.");
            return false;
        }else if(videoNivel1 == ""){
            alert("No hay ningún video en el campo 'Video del nivel 1', por favor suba uno.");
            return false;
        }else if(precio == ""){
            alert("No se ha llenado el campo 'Precio', por favor escríbalo.");
            return false;
        }

        console.log("Foto Promocional: " + nombreNivel);
        console.log("Categoría: " + categoria);
        console.log("Nombre del curso: " + nombreCurso);
        console.log("Descripción: " + descripcion);
        console.log("Video del nivel 1: " + videoNivel1);
        console.log("Nombre del nivel 1: " + nombreNivel);
        console.log("Precio: " + precio);
        console.log("PDF: " + pdf);
        console.log("TXT: " + txt);
        console.log("Imagen extra: " + imagenExtra);
        console.log("Video extra: " + videoExtra);
    });
});
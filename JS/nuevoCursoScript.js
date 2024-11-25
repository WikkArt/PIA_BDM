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
    freader.onload = function() {
        document.getElementById("idVideo").src = freader.result;
    }
}

function cargarVideoExtra(){
    var input = document.getElementById("videoExtra");

    var freader = new FileReader();
    freader.readAsDataURL(input.files[0]);
    freader.onload = function() {
        document.getElementById("idVideoExtra").src = freader.result;
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

/* Validaciones de Niveles */

// function completaCampos(nivel) {
//     // Obtener los valores de los campos del nivel que estamos validando
//     const videoNivel = nivel.querySelector("input[type='file'][id^='video']").files.length > 0;  // Verifica si el input de video tiene un archivo
//     const nombreNivel = nivel.querySelector("input[type='text'][id^='txtLevel']").value.trim();
//     const precioNivel = nivel.querySelector("input[type='text'][id^='txtLevelPrice']").value.trim();
//     const linkNivel = nivel.querySelector("input[type='text'][id^='txtLink']").value.trim();
//     const pdfNivel = nivel.querySelector("input[type='file'][id^='filePDF']") ? nivel.querySelector("input[type='file'][id^='filePDF']").files.length > 0 : false;
//     const txtNivel = nivel.querySelector("input[type='file'][id^='fileTXT']") ? nivel.querySelector("input[type='file'][id^='fileTXT']").files.length > 0 : false;
//     const imagenExtraNivel = nivel.querySelector("input[type='file'][id^='imgExtra']") ? nivel.querySelector("input[type='file'][id^='imgExtra']").files.length > 0 : false;  // Verifica si el input de imagen tiene un archivo
//     const videoExtraNivel = nivel.querySelector("input[type='file'][id^='videoExtra']").files.length > 0;

//     // Si ninguno de los campos tiene información, muestra una alerta y retorna false
//     if (!videoNivel && !nombreNivel && !precioNivel && !linkNivel && !pdfNivel && !txtNivel && !imagenExtraNivel && !videoExtraNivel) {
//         alert("Por favor, completa al menos un campo antes de agregar un nuevo nivel.");
//         return false;  // No permite agregar un nuevo nivel
//     }
//     return true;  // Permite agregar un nuevo nivel si hay datos
// }

// // Función para agregar el nuevo nivel
// document.getElementById("btnAgregarNivel").addEventListener("click", function() {
//     // Obtener el nivel actual que se va a clonar
//     let nivelActivo = document.querySelector("#idNivelOverflow");

//     if (completaCampos(nivelActivo)) {
//         // Clonar el nivel existente
//         let contenedor = document.getElementById("idColNiveles");
//         let nuevoNivel = nivelActivo.cloneNode(true);

//         // Limpiar los valores de los campos del nuevo nivel
//         nuevoNivel.querySelector("input[type='file'][id^='video']").value = "";  // Limpiar el input de video
//         nuevoNivel.querySelector("input[type='text'][id^='txtLevel']").value = "";
//         nuevoNivel.querySelector("input[type='text'][id^='txtLevelPrice']").value = "";
//         nuevoNivel.querySelector("input[type='text'][id^='txtLink']").value = "";
//         nuevoNivel.querySelector("input[type='file'][id^='filePDF']").value = "";
//         nuevoNivel.querySelector("input[type='file'][id^='fileTXT']").value = "";
//         nuevoNivel.querySelector("input[type='file'][id^='imgExtra']").value = "";  // Limpiar el input de imagen
//         nuevoNivel.querySelector("#idVideo source").src = "";
//         nuevoNivel.querySelector("#idImagenExtra").src = "Images/ImagenCursoRosa.png";  // Resetear imagen a la predeterminada
//         nuevoNivel.querySelector("input[type='file'][id^='videoExtra']").value = ""; 

//         // Asegurarse de que el nuevo nivel tenga un ID único
//         let nuevoVideo = nuevoNivel.querySelector("video[id^='idVideo']");
//         let nuevoVideoExtra = nuevoNivel.querySelector("video[id^='idVideoExtra']");
//         let nuevoImagenExtra = nuevoNivel.querySelector("img[id^='idImagenExtra']");
        
//         // Generar IDs únicos
//         nuevoVideo.id = "idVideo" + new Date().getTime();
//         nuevoVideoExtra.id = "idVideoExtra" + new Date().getTime();
//         nuevoImagenExtra.id = "idImagenExtra" + new Date().getTime();

//         // Cambiar los IDs de los inputs de tipo file también
//         let inputs = nuevoNivel.querySelectorAll("input[type='file']");
//         inputs.forEach((input) => {
//             let newId = input.id + new Date().getTime();
//             input.id = newId;

//             // Reasignar los eventos correctamente
//             if(input.id.includes("video")) {
//                 input.removeEventListener('change', cargarVideo); // Eliminar evento anterior
//                 input.addEventListener('change', (event) => cargarVideo(event));
//             } 
//             if(input.id.includes("videoExtra")) {
//                 input.removeEventListener('change', cargarVideoExtra); // Eliminar evento anterior
//                 input.addEventListener('change', (event) => cargarVideoExtra(event));
//             } 
//             if(input.id.includes("imgExtra")) {
//                 input.removeEventListener('change', (event) => mostrarAvatar(event, input.id)); // Eliminar evento anterior
//                 input.addEventListener('change', (event) => mostrarAvatar(event, input.id));
//             }
//         });

//         // Insertar el nuevo nivel justo antes del botón de agregar
//         contenedor.insertBefore(nuevoNivel, document.getElementById("btnAgregarNivel"));
//     }
// });

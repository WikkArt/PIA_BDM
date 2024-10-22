// document.getElementById('idVideoPrincipal').addEventListener('ended',handler,false);
//     function handler(e) {
//         // Al terminar el nivel, el usuario será enviado a otra ventana
//         window.location.href = "enviarComentario.html";
//     }

document.getElementById('idVideoPrincipal').addEventListener('ended', handler, false);

function handler(e) {
    // Al terminar el video, se habilitara el boton para finalizarlo
    var btn = document.getElementById('btnFinalNivel');
    btn.disabled = false;
}
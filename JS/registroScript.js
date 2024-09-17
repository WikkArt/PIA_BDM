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

    $('#btnRegister').click(function(){
        var nombre = $('#txtFullname').val();
        var usuario = $('#txtUsername').val();
        var correo = $('#txtEmail').val();
        var contrasena = $('#txtPassword').val();
        var fecha = $('#txtBirthdate').val();
        var genero = "NB";
        var rol = $("#idRol").val();
        var avatar = $('#btnAvatar').val();

        if($('#RBH').is(":checked")){
            genero = "H";
        }else if($('#RBM').is(":checked")){
            genero = "M";
        }

        if(nombre == ""){
            alert("No se ha llenado el campo 'Nombre completo', por favor escríbalo.");
            return false;
        }else if(usuario == ""){
            alert("No se ha llenado el campo 'Nombre de Usuario', por favor escríbalo.");
            return false;
        }else if(correo == ""){
            alert("No se ha llenado el campo 'Correo electrónico', por favor escríbalo.");
            return false;
        }else if(contrasena == ""){
            alert("No se ha llenado el campo 'Contraseña', por favor escríbalo.");
            return false;
        }


        if(usuario.length < 3){
            alert("El nombre de usuario debe contener un mínimo de 3 carácteres.");
            return false;
        }

        regexPattern = /^(?=.*[-\#\$\.\%\&\@\!\+\=\\*])(?=.*[a-zA-Z])(?=.*\d).{8,12}$/;
        if(contrasena.match(regexPattern))
        {
            console.log("Contrasenia aprobada.");
        }
        else{
            alert("La contraseña debe contener un mínimo de 8 carácteres, una mayúscula, una minúscula, un número y un carácter especial.");
            return false;
        }

        if(!isEmail(correo)){
            alert("Escriba su correo correctamente");
            return false;
        }

        if(fecha == "")
        {
            alert("Inserte su fecha de nacimiento.");
            return false;
        }
        if(imagen == "")
        {
            alert("Inserte una foto de perfil.");
            return false;
        }

        if (rol == "") {
            alert("No se ha seleccionado ninguna opción dentro de la lista 'Rol', por favor escoja una");
            return false;
        }

        console.log("Nombre: " + nombre);
        console.log("Usuario: " + usuario);
        console.log("Contra: " + contrasena);
        console.log("Correo: " + correo);
        console.log("Fecha: " + fecha);
        console.log("Genero: " + genero);
        console.log("Rol: " + rol);
        console.log("Privacidad: " + publico);
        console.log("Avatar: " + avatar);
    });

    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});
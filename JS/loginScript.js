$(document).ready(function(){
    $('#btnLogin').click(function(){
        var usuario = $('#txtUsername').val();
        var contrasena = $('#txtLPassword').val();

        if(usuario == ""){
            alert("No se ha llenado el campo 'Nombre de Usuario', por favor escríbalo.");
            return false;
        }else if(contrasena == ""){
            alert("No se ha llenado el campo 'Contraseña', por favor escríbalo.");
            return false;
        }

        console.log("Nombre de usuario: " + usuario);
        console.log("Contraseña: " + usuario);
        
    });
});
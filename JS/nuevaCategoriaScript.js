$(document).ready(function(){
    $('#btnCrearCategoría').click(function(){
        var nombre = $('#txtCategory').val();
        var descripcion = $('#txtDesc').val();

        if(nombre == ""){
            alert("No se ha llenado el campo 'Nombre de la categoría', por favor escríbalo.");
            return false;
        }else if(descripcion == ""){
            alert("No se ha llenado el campo 'Descripción', por favor escríbalo.");
            return false;
        }

        console.log("Nombre de la categoría: " + nombre);
        console.log("Descripción: " + descripcion);
    });
});
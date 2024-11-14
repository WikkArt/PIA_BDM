<?php

require_once("controlador/usuarios_controlador.php");

$controlador = new usuarios();
$respuesta = $controlador->editar();
$usuarioInfo = $respuesta['usuarioInfo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Editar Usuario</title>
    <link rel="stylesheet" href="CSS/editarUsuarioDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body>
    <!--Navegador-->
    <nav id="idNav" class="navbar navbar-expand-lg">
        <button id="btnLogo" class="navbar-brand" type="button">
            <img src="Images/HabimateLogo.png" width="160px"/>
        </button>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idNavLinks" aria-controls="idNavLinks" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="idNavLinks" class="collapse navbar-collapse">
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.html">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=mostrarDatos">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaChats.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div id="idRegister" class="form-box form-value container">
        <h1 class="text">Editar Usuario</h1>
        <form method="POST" action="index.php?controlador=usuarios&accion=editar" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6 col-md-4">
                    <div class="row">
                        <a class="volver" href="#">
                            <button id="btnVolver">Volver al perfíl del usuario</button>
                        </a>
                    </div>

                    <div class="avatar">
                        <?php 
                        if($usuarioInfo['foto'] != null) { ?>
                            <img id="idAvatarSample" class="rounded-circle" alt="Avatar" src="data:image/png;base64,<?=base64_encode($usuarioInfo['foto'])?>">
                        <?php 
                        } else { 
                        ?>
                            <img id="idAvatarSample" src="Images/avatarSampleAmarillo.png" class="rounded-circle" alt="Avatar">
                        <?php 
                        } 
                        ?>
                        <input class="form-control" type="file" id="btnAvatar" name="btnAvatar" 
                               onchange="mostrarAvatar(event, 'idAvatarSample')" accept="image/*">
                        
                        <span id="mimeType" class="mime-info">
                            <?php
                            if($usuarioInfo['mime'] != null) { ?>
                                <?="Formato actual: ".$usuarioInfo['mime']?>
                            <?php 
                            } else { ?>
                                <?="No hay formato de imagen actual"?>
                            <?php } ?>
                        </span>
                        <input type="hidden" id="mimeHidden" name="mimeHidden">
                    </div>
                    
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <h2 class="text">Información Personal</h2>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div id="idInputs" class="inputbox">
                                <label for="ffullname">Nombre completo</label>
                                <input id="txtFullname" name="txtFullname" type="text" value="<?=$usuarioInfo['nombre_completo']?>">
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="fusername">Nombre de Usuario</label>
                                <input id="txtUsername" name="txtUsername" type="text" disabled value="<?=$usuarioInfo['nombre_usuario']?>">
                                <small class="form-text">
                                    Debe contener un mínimo de 3 carácteres.
                                </small>
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="femail">Correo electrónico</label>
                                <input id="txtEmail" name="txtEmail" type="email" value="<?=$usuarioInfo['correo']?>">
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="fpassword">Contraseña</label>
                                <input id="txtPassword" name="txtPassword" type="password" value="<?=$usuarioInfo['contrasena']?>">
                                <small class="form-text">
                                    Debe contener un mínimo de 8 carácteres, una mayúscula,
                                    &nbsp;&nbsp;una minúscula, un número y un carácter especial.
                                </small>
                            </div>
                        </div>

                        <div class="col">
                            <div id="idInputs" class="inputbox item item-2">
                                <label for="fdate">Fecha de Nacimiento: </label> 
                                <input class="inputRegistrar" type="date" id="txtBirthdate" name="ffechanacimiento" value="<?=$usuarioInfo['fecha_nac']?>"/>
                            </div>
                            
                            <label class="subtitle">Género</label>
                            <div id="idRB" name="idRB">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBH" name="inlineRadioOptions" id="inlineRadio1" value="hombre" <?php if($usuarioInfo['genero'] == 'hombre') { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="inlineRadio1">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBM" name="inlineRadioOptions" id="inlineRadio2" value="mujer" <?php if($usuarioInfo['genero'] == 'mujer') { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="inlineRadio1">Mujer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBNB" name="inlineRadioOptions" id="inlineRadio3" value="no binario" <?php if($usuarioInfo['genero'] == 'no binario') { ?> checked <?php } ?>>
                                    <label class="form-check-label" for="inlineRadio1">No binario</label>
                                </div>
                            </div>

                            <label class="subtitle">Rol del usuario</label>
                            <select id="idRol" name="idRol" class="form-select" aria-label="Default select example" disabled>
                                <option class="item item-1" value="" selected>Selecciona un rol</option>
                                <option class="item" id="dropdown" value="1" <?php if($usuarioInfo['rol'] == 'estudiante') { ?> selected <?php } ?>>Estudiante</option>
                                <option class="item" id="dropdown" value="2" <?php if($usuarioInfo['rol'] == 'instructor') { ?> selected <?php } ?>>Instructor</option>
                                <option class="item" id="dropdown" value="3" <?php if($usuarioInfo['rol'] == 'admin') { ?> selected <?php } ?>>Administrador</option>
                            </select>
                            
                            <button id="btnRegister" type="submit">Guardar cambios</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form> 
    </div>

    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!--Archivos externos-->
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/registroScript.js"></script>
</body>
</html>
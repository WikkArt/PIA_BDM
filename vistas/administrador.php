<?php

require_once("controlador/usuarios_controlador.php");

$controlador = new usuarios();
$respuesta = $controlador->mostrarDatos();
$usuarioInfo = $respuesta['usuarioInfo'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Perfíl del usuario</title>
    <link rel="stylesheet" href="CSS/perfilUsuarioDesign.css">
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
                        <a class="nav-link active" href="#">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportesUsuarios.html">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div class="container-fluid">
        <div id="idUsuarioInfo">
            <?php 
            if($usuarioInfo['foto'] != null) { ?>
                <img id="idAvatarSample" class="rounded-circle" alt="Avatar" src="data:image/png;base64,<?=base64_encode($usuarioInfo['foto'])?>">
            <?php 
            } else { 
            ?>
                <img id="idAvatarSample" class="rounded-circle" alt="Avatar" src="Images/avatarSampleAmarillo.png">
            <?php 
            } 
            ?>
            <ul>
                <li class="list-group-item destacado">
                    <h1 class="text" id="nombre_usuario"><?=$usuarioInfo['nombre_usuario']?> <span><?=$usuarioInfo['rol']?></span></h1>
                </li>
                <li class="list-group-item destacado">
                    <h2 class="text" id="nombre_completo"><?=$usuarioInfo['nombre_completo']?></h2>
                </li>
                <li class="list-group-item secundario">
                    <p><strong>Correo:</strong> <span id="correo"><?=$usuarioInfo['correo']?></span></p>
                </li>
                <li class="list-group-item secundario">
                    <p><strong>Fecha de nacimiento:</strong> <span id="fecha_nac"><?=$usuarioInfo['fecha_nac']?></span></p>
                </li>
                <li class="list-group-item secundario">
                    <p><strong>Género:</strong> <span id="genero"><?=strtoupper($usuarioInfo['genero'][0]).substr($usuarioInfo['genero'], 1)?></span></p>
                </li>
                <li class="list-group-item">
                    <a href="index.php?controlador=usuarios&accion=editar">
                        <button id="btnEditarUsuario" type="button">Editar usuario</button>
                    </a>
                    <a href="index.php?accion=crear&controlador=categorias">
                        <button id="btnCategoria" type="button">Crear Categoría</button>
                    </a>
                </li>
            </ul>
        </div>

        <h1 id="idSubtitulo">Categorías</h1>
            
        <div id="idTabla">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre (Categoría)</th>
                    <th>Descripción</th>
                    <th>Nombre (Autor)</th>
                    <th>Fecha de creación</th>
                    <th>Hora de creación</th>
                    <th class="a-header-8">Opciones</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XXX/XXXX/</td>
                    <td>00:00</td>
                    <td class="columna-botones">
                        <button class="eliminar" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                            Eliminar
                        </button>
                        <a href="editarCategoria.html">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XXX/XXXX/</td>
                    <td>00:00</td>
                    <td class="columna-botones">
                        <button class="eliminar" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                            Eliminar
                        </button>
                        <a href="editarCategoria.html">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XXX/XXXX/</td>
                    <td>00:00</td>
                    <td class="columna-botones">
                        <button class="eliminar" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                            Eliminar
                        </button>
                        <a href="editarCategoria.html">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>---</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XXX/XXXX/</td>
                    <td>00:00</td>
                    <td class="columna-botones">
                        <button class="eliminar" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                            Eliminar
                        </button>
                        <a href="editarCategoria.html">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Modal de Eliminacion -->
        <div class="modal fade" id="idEliminarModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Categoría</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="Images/cerrar.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar esta categoría?</p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">
                            Si
                        </button>
                        <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                            No
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script src="JS/bootstrap.min.js"></script>
</body>
</html>
<?php

require_once("controlador/usuarios_controlador.php");

$controlador = new usuarios();
$respuesta = $controlador->mostrarDatos();
$usuarioInfo = $respuesta['usuarioInfo'];

require_once("controlador/categorias_controlador.php");

$categoriaControlador = new categorias();
$categorias = $categoriaControlador->mostrarCategorias();
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
                        <a class="nav-link" href="dashboard.php">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="reportesUsuarios.php">Reportes</a>
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
                        <tr>
                            <th>ID</th>
                            <th>Nombre (Categoría)</th>
                            <th>Descripción</th>
                            <th>Fecha de creación</th>
                            <th>Hora de creación</th>
                            <th class="a-header-8">Opciones</th>
                        </tr>
                    </tr>
                    <tr>
                    <?php if (!empty($categorias)) { 
                        foreach ($categorias as $categoria) { ?>
                            <tr>
                                <td><?= $categoria['id'] ?></td>
                                <td><?= htmlspecialchars($categoria['nombre']) ?></td>
                                <td><?= htmlspecialchars($categoria['descripcion']) ?></td>
                                <td><?= $categoria['fecha'] ?></td>
                                <td><?= $categoria['hora'] ?></td>
                                <td class="columna-botones">
                                    <button class="eliminar" data-bs-toggle="modal" 
                                            data-bs-target="#idEliminarModal" 
                                            data-id="<?= $categoria['id'] ?>" 
                                            data-nombre="<?= htmlspecialchars($categoria['nombre']) ?>">
                                        Eliminar
                                    </button>
                                    <a href="index.php?controlador=categorias&accion=editar&id=<?= $categoria['id'] ?>">
                                        <button class="editar">Editar</button>
                                    </a>
                                </td>
                            </tr>
                    <?php } } else { ?>
                        <tr>
                            <td colspan="6">No se encontraron categorías creadas por este usuario.</td>
                        </tr>
                    <?php } ?>
                    </tr>
                </table>
            </div>

        <!-- Modal de Eliminacion -->
        <div class="modal fade" id="idEliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eliminarModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar esta categoría?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form method="POST" action="index.php?controlador=categorias&accion=eliminar">
                            <input type="hidden" name="id" id="categoriaId" value="">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const eliminarButtons = document.querySelectorAll(".eliminar");
            eliminarButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const categoriaId = this.getAttribute("data-id");
                    document.getElementById("categoriaId").value = categoriaId;
                });
            });
        });
    </script>
</body>
</html>
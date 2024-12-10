<?php 

$nombre_usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
$foto = $_SESSION['foto'];

require_once("controlador/cursos_controlador.php");

$controlador = new cursos();
$cursosActivos = $controlador->mostrardeInstructor();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Perfíl del usuario</title>
    <link rel="stylesheet" href="CSS/tablaCursosDesign.css">
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
                        <a class="nav-link" href="index.php?controlador=cursos&accion=listar">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=mostrarDatos&controlador=usuarios">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=verAlumnosInscritos">Alumnos inscritos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaChats.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=cerrarSesion">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div class="container-fluid">
        <div id="idUsuarioInfo">
            <?php 
            if($foto != null) { ?>
            <img id="idAvatarSample" class="rounded-circle" alt="Avatar" src="data:image/png;base64,<?=base64_encode($foto)?>">
            <?php 
            } else { 
            ?>
            <img id="idAvatarSample" class="rounded-circle" alt="Avatar" src="Images/avatarSampleAmarillo.png">
            <?php 
            } 
            ?>
            <ul>
                <li class="list-group-item destacado">
                    <h1 class="text" id="nombre_usuario"><?=$nombre_usuario?> <span><?=$rol?></span></h1>
                </li>
            </ul>
        </div>

        <h1 id="idSubtitulo">Cursos Creados</h1>

        <div id="idTabla">
            <table>
                <tr>
                    <th class="header-1">Imagen promocional</th>
                    <th class="header-2">Nombre</th>
                    <th>Descripción</th>
                    <th>No. de Niveles</th>
                    <th class="header-4">Opción</th>
                </tr>

                <?php 
                if($cursosActivos != null) {
                    foreach ($cursosActivos as $curso): ?>
                <tr id="<?=$curso["id"]?>">
                    <td class="primerColumna">
                        <img src="data:image/png;base64,<?=base64_encode($curso['foto'])?>"
                        alt="Foto promocional" class="img-fluid">
                    </td>
                    <td>
                        <?= htmlspecialchars($curso['nombre']) ?>
                    </td>
                    <td>
                        <?= htmlspecialchars($curso['descripcion']) ?>
                    </td>
                    <td> 
                        <?= htmlspecialchars($curso['total_niveles']) ?> 
                    </td>
                    <td class="columna-botones">
                        <button class="eliminar" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                            Eliminar
                        </button>
                        <a href="index.php?accion=editar&controlador=cursos&idCurso=<?=$curso["id"]?>">
                            <button class="editar">Editar</button>
                        </a>
                    </td>
                </tr>
                <?php endforeach; } 
                else {?>
                <tr>
                    <td colspan="6">No ha creado ningún curso aún</td>
                <tr>
                <?php } ?>
            </table>
        </div>
        
        <!-- Modal de Eliminacion -->
        <div class="modal fade" id="idEliminarModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Curso</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="Images/cerrar.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Estás seguro de eliminar este curso?</p>
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
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
                </li>
            </ul>
        </div>
        <h1 id="idSubtitulo">Kardex</h1>

        <div class="row">
            <div class="col-3">
                <h3>Filtros</h3>

                <form id="idFiltros">
                    <div class="form-check activos">
                        <div>
                            <label class="form-check-label" for="cbCursoGeneral">
                                Sólo cursos terminados
                            </label>

                            <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                        </div>
                        
                        <div>
                            <label class="form-check-label" for="cbCursoGeneral">
                                Sólo cursos activos
                            </label>

                            <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                        </div>
                    </div>

                    <h5>Fecha de inscripción</h5>
                    <div class="fechas">
                        <div id="idInputs" class="inputbox">
                            <label for="fdate">Desde: </label> 
                            <input type="date" id="txtDateFromG" name="txtDateFromG"/>
                        </div>
                        <div id="idInputs" class="inputbox">
                            <label for="fdate">Hasta: </label> 
                            <input type="date" id="txtDateFromG" name="txtDateFromG"/>
                        </div>
                    </div>

                    <h5>Categorías</h5>
                    <ul class="categorias list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                                <label class="form-check-label" for="cbCursoGeneral">
                                    Categoría 1
                                </label>
                                <button id="btnInfoCategoria" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idCategoriaModal">
                                    <img src="Images/info.png" alt="Información de la categoría">
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                                <label class="form-check-label" for="cbCursoGeneral">
                                    Categoría 2
                                </label>
                                <button id="btnInfoCategoria" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idCategoriaModal">
                                    <img src="Images/info.png" alt="Información de la categoría">
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                                <label class="form-check-label" for="cbCursoGeneral">
                                    Categoría 3
                                </label>
                                <button id="btnInfoCategoria" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idCategoriaModal">
                                    <img src="Images/info.png" alt="Información de la categoría">
                                </button>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                                <label class="form-check-label" for="cbCursoGeneral">
                                    Categoría 4
                                </label>
                                <button id="btnInfoCategoria" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#idCategoriaModal">
                                    <img src="Images/info.png" alt="Información de la categoría">
                                </button>
                            </div>
                        </li>
                    </ul>
                    
                    <a id="idCategoriaG">
                        <button type="submit">Filtrar</button>
                    </a>
                </form>

                <!-- Modal de las Categorias-->
                <div class="modal fade" id="idCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Categoría: Nombre de la Categoría</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <img src="Images/cerrar.png" alt="">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor 
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis 
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                                </p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <label>Nombre de usuario</label>
                                <div>
                                    <label>DD/MMM/AAA</label>
                                    <label>00:00</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="idTabla" class="col-9">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acceso</th>
                        <th>Categoría</th>
                        <th>Fecha de Inscripción</th>
                        <th>Último ingreso</th>
                        <th>Progreso</th>
                        <th>Fecha de finalización</th>
                    </tr>

                    <tr>
                        <td>1</td>
                        <td>---</td>
                        <td>
                            <a href="listaNiveles.php">
                                <button id="btnAccesoCurso">Curso</button>
                            </a>
                        </td>
                        <td>---</td>
                        <td>XX/XX/XXXX</td>
                        <td>XX/XX/XXXX</td>
                        <td>Completo</td>
                        <td>XX/XX/XXXX</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>---</td>
                        <td>
                            <a href="listaNiveles.php">
                                <button id="btnAccesoCurso">Curso</button>
                            </a>
                        </td>
                        <td>---</td>
                        <td>XX/XX/XXXX</td>
                        <td>XX/XX/XXXX</td>
                        <td>Incompleto</td>
                        <td>XX/XX/XXXX</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>---</td>
                        <td>
                            <a href="listaNiveles.php">
                                <button id="btnAccesoCurso">Curso</button>
                            </a>
                        </td>
                        <td>---</td>
                        <td>XX/XX/XXXX</td>
                        <td>XX/XX/XXXX</td>
                        <td>Completo</td>
                        <td>XX/XX/XXXX</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>---</td>
                        <td>
                            <a href="listaNiveles.php">
                                <button id="btnAccesoCurso">Curso</button>
                            </a>
                        </td>
                        <td>---</td>
                        <td>XX/XX/XXXX</td>
                        <td>XX/XX/XXXX</td>
                        <td>Incompleto</td>
                        <td>XX/XX/XXXX</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/perfilIUsuarioScript.js"></script>
</body>
</html>
<?php

require_once("controlador/usuarios_controlador.php");

$controlador = new usuarios();
$infoCurso = $controlador->verCursoInscrito();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Lista de Niveles</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/listaNivelesDesign.css">
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

        <h1 id="idSubtitulo">Curso: <?=$infoCurso[0]['nombre']?></h1>

        <div class="row" id="idMain">
            <div class="instructor-regresar col-3">
                <h3 class="listaNivelesHeaders">Tu instructor</h3>
                
                <div id="infoInstructor">
                    <?php
                    if($infoCurso[0]['fotoIns'] != null) { ?>
                        <img id="idAvatarSample" src="data:image/png;base64,<?=base64_encode($infoCurso[0]['fotoIns'])?>" class="rounded-circle" alt="Avatar">
                    <?php 
                    } else { 
                    ?>
                        <img id="idAvatarSample" src="Images/avatarSampleAmarillo.png" class="rounded-circle" alt="Avatar">
                    <?php 
                    } 
                    ?>
                    <span><?=$infoCurso[0]['instructor']?></span>
                </div>

                <a id="btnRegresar" href="index.php?accion=mostrarDatos&controlador=usuarios" class="btn">
                    <img src="Images/regresarAmarilloClaro.png" alt="">
                    <span>Regresar al perfil</span>
                </a>
            </div>

            <div class="col-6" id="listaNiveles">
                <h3 class="listaNivelesHeaders">Lista de niveles</h3>
                <table>
                    <?php
                    $totalN = 0;
                    $completado = 0;
                    for($i = 0; $i < count($infoCurso); $i++) { 
                    $totalN++; ?>
                    <tr>
                        <td><?=$i+1?></td>
                        <td><?=$infoCurso[$i]['nombreNivel']?></td>
                        <td>.........</td>
                        <?php
                        if($infoCurso[$i]['Completado'] != null) { 
                            $completado++; ?>
                            <td class="NivelCompletado">Completado</td>
                        <?php } else { ?>
                            <td><a class="btn ver" href="index.php?controlador=cursos&accion=mostrarNivel&id=<?=$infoCurso[$i]['idNivel']?>">Ver</a></td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </table>
            </div>

            <div class="porcentaje-final col-3">
                <h3 class="listaNivelesHeaders">Tu Progreso</h3>
                <div id="info">
                    <?php $progreso = ($completado/$totalN) * 100;?>
                    <h2><?=number_format($progreso, 2)?>% <h4>Completado</h4></h2>
                </div>

                <a href="enviarComentario.html">
                    <button>Finalizar Curso</button>
                </a>
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
<?php

require_once("controlador/cursos_controlador.php");

$controlador = new cursos();
$infoNivel = $controlador->mostrarNivel();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Curso</title>
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/vistaNivelDesign.css">
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

        <h1 id="idSubtitulo">Curso: <?=$infoNivel[0]['curso']?></h1>

        <div id="idMain" class="row">

            <a id="idRegresar" href="index.php?controlador=usuarios&accion=verCursoInscrito&idCurso=<?=$infoNivel[0]['idCurso']?>" class="btn">
                <img src="Images/regresar.png" alt="">
            </a>

            <?php
            $link = null;
            $pdf = null;
            $txt = null;
            $videoAdi = null;
            $imagenAdi = null;
            foreach($infoNivel as $recurso) {
                $contenido = $recurso['contenido_adicional'];
                if ($contenido) {
                    if(str_contains($contenido, '.jpg') || str_contains($contenido, '.jpeg') ||
                        str_contains($contenido, '.png')) {
                        $imagenAdi = $contenido;
                    }elseif(str_contains($contenido, '.pdf')) {
                        $pdf = $contenido;
                    }elseif(str_contains($contenido, '.txt')) {
                        $txt = $contenido;
                    }elseif(str_contains($contenido, '.mp4')) {
                        $videoAdi = $contenido;
                    }else{
                        $link = $contenido;
                    }
                    
                }
            }
            ?>

            <div id="videoNivel" class="col-7">
                <div class="video-principal">
                    <video id="idVideoPrincipal" src="<?=$infoNivel[0]['video']?>" 
                    type="video/mp4" controls paused id="idVideo">
                        Tu navegador no soporta la etiqueta 'video'
                    </video>
                </div>

                <div class="video-img-extras">
                    <div class="panel-heading">
                        <a data-bs-toggle="collapse" href="#collapseVideo">
                            <h3 class="panel-title second-subtitle">
                                Video(s) Adicional(es)
                            </h3>
                        </a>
                    </div>

                    <div id="collapseVideo" class="panel-collapse collapse">
                        <div>
                            <?php 
                            if($videoAdi) { ?>
                            <video id="idVideoExtra" src="<?=$videoAdi?>" 
                            type="video/mp4" controls paused>
                                Tu navegador no soporta la etiqueta 'video'
                            </video>
                            <?php } else { ?>
                            <video id="idVideoExtra" src="#" 
                            type="video/mp4" controls paused>
                                Tu navegador no soporta la etiqueta 'video'
                            </video>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="video-img-extras">
                    <div class="panel-heading">
                        <a data-bs-toggle="collapse" href="#collapseImg">
                            <h3 class="panel-title second-subtitle">
                                Imagen(es) Adicional(es)
                            </h3>
                        </a>
                    </div>

                    <div id="collapseImg" class="panel-collapse collapse">
                        <div>
                            <?php 
                            if($imagenAdi) { ?>
                                <img id="idImagenExtra" src="<?=$imagenAdi?>" alt="Imagen extra">
                            <?php } else { ?>
                                <img id="idImagenExtra" src="Images/ImagenCursoMorado.png" alt="Imagen extra">
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div id="idArchivosExtras" class="col-4">
                <div class="level-instructor">
                    <h2>Nivel: <?=$infoNivel[0]['nombre']?></h2>
                    <span><?=$infoNivel[0]['instructor']?></span>
                </div>

                <div>
                    <h3>Contenido Adicional</h3>
                    <div class="extra-content">
                        <h4 class="second-subtitle">Link(s) externo(s)</h4>
                        <table id="idTablaLink">
                            <tr>
                                <td class="td-id">
                                    <div>
                                        1
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if($link) { ?>
                                        <input type="text" id="txtLink" name="txtLink" value="<?=$link?>" disabled>
                                    <?php } else { ?>
                                        <input type="text" id="txtLink" name="txtLink" disabled>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-id">
                                    <div>
                                        2
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="txtLink" name="txtLink" disabled>
                                </td>
                            </tr>
                        </table>

                        <h4 class="second-subtitle">PDF(s)</h4>
                        <table id="idTablaPDF">
                            <tr>
                                <td class="td-id">
                                    <div>
                                        1
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if($pdf) { ?>
                                    <input type="text" disabled value="<?=substr($pdf, strpos($pdf, "_") + 1)?>"/>
                                    <?php } else { ?>
                                    <input type="file" accept=".pdf" disabled/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button id="btnDescargarPDF">Descargar</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-id">
                                    <div>
                                        2
                                    </div>
                                </td>
                                <td>
                                    <input type="file" accept=".pdf" disabled/>
                                </td>
                                <td>
                                    <button id="btnDescargarPDF">Descargar</button>
                                </td>
                            </tr>
                        </table>

                        <h4 class="second-subtitle">TXT(s)</h4>
                        <table id="idTablaTXT">
                            <tr>
                                <td class="td-id">
                                    <div>
                                        1
                                    </div>
                                </td>
                                <td>
                                    <?php
                                    if($txt) { ?>
                                    <input type="text" disabled value="<?=substr($txt, strpos($txt, "_") + 1)?>"/>
                                    <?php } else { ?>
                                    <input type="file" accept=".txt" disabled/>
                                    <?php } ?>
                                </td>
                                <td>
                                    <button id="btnDescargarTXT">Descargar</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="td-id">
                                    <div>
                                        2
                                    </div>
                                </td>
                                <td>
                                    <input type="file" accept=".txt" disabled/>
                                </td>
                                <td>
                                    <button id="btnDescargarTXT">Descargar</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <button id="btnFinalNivel" disabled>
                    Finalizar Nivel
                </button>

            </div>
    
        </div>

    </div>
    
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/vistaNivelScript.js"></script>
</body>
</html>
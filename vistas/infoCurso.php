<?php

require_once("controlador/cursos_controlador.php");

$cursoCtrl = new cursos();
$infoCurso = $cursoCtrl->mostrarInfo();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Información del curso</title>
    <link rel="stylesheet" href="CSS/infoCursoDesign.css">
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
        <div id="idCursoInfo">
            <?php
            if($infoCurso[0]['imagen'] != null) {
            ?>
            <img id="idFotoPromoSample" src="data:image/png;base64,<?=base64_encode($infoCurso[0]['imagen'])?>" 
            alt="Foto promocional del curso">
            <?php } ?>
            <ul>
                <li class="list-group-item destacado">
                    <h1 class="text"> <?=$infoCurso[0]['titulo']?> </h1>
                </li>
                <li class="list-group-item secundario">
                    Instructor: <?=$infoCurso[0]['instructor']?>
                </li>
                <li class="list-group-item secundario categoria">
                    Categoria: <?=$infoCurso[0]['categoria']?>
                </li>
                <div class="lista-desc">
                    <li class="list-group-item secundario">
                        <h3>Descripción</h3>
                    </li>
                    <li class="list-group-item secundario">
                        <p>
                            <?=$infoCurso[0]['descripcion']?>
                        </p>
                    </li>
                </div>
            </ul>
        </div>

        <div id="idInformacion" class="row">
            <div id="izquierda" class="col-5">
                <!--VALORACION-->
                <div class="valoracion">
                    <?php
                    if($infoCurso[0]['valoracion_promedio'] != null) { ?>
                        <h3>Promedio de calificación global: <?=$infoCurso[0]['valoracion_promedio']?>%</h3>
                    <?php }
                    else { ?>
                        <h3>Promedio de calificación global: Sin valoraciones</h3>
                    <?php } ?>
                </div>
                <!--COMENTARIOS-->
                <div class="Comentarios">
                    <h3>Comentarios</h3>

                    <div class="comment-messages">
                        <div id="idComment" class="message">
                            <img id="idAvatar" src="Images/avatarSampleMorado.png" class="rounded-circle">
            
                            <div class="hour-message">
                                <div class="c-datos-boton">
                                    <label class="user-1">Nombre de Usuario 1 
                                        <span id="estrellasCalif" value="5" selected>&#11088; &#11088; &#11088; &#11088; &#11088;</span>
                                    </label>

                                    <button id="idBorrarComentario" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                                        Borrar Comentario
                                    </button>
                                </div>
                                
                                <label class="text">Me sirvió mucho! super recomendado WEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE</label>
                                <label class="hour"> 01/01/24 00:00</label>
                            </div>
                        </div>

                        <div id="idComment" class="message">
                            <img id="idAvatar" src="Images/avatarSampleMorado.png" class="rounded-circle">
            
                            <div class="hour-message">
                                <div class="c-datos-boton">
                                    <label class="user-1">Nombre de Usuario 2
                                        <span id="estrellasCalif" value="5" selected>&#11088;</span>
                                    </label>

                                    <button id="idBorrarComentario" data-bs-toggle="modal" data-bs-target="#idEliminarModal">
                                        Borrar Comentario
                                    </button>
                                </div>
                                
                                <label class="text">Muchas gracias, no aprendí nada</label>
                                <label class="hour"> 01/01/24 00:00</label>
                            </div>
                        </div>

                        <div id="idComment" class="message">
                            <img id="idAvatar" src="Images/avatarSampleMorado.png" class="rounded-circle">
            
                            <div class="deleted-message">
                                <label class="user-1">Nombre de Usuario 3
                                    <span id="estrellasCalif" value="5" selected>&#11088;</span>
                                </label>

                                <div class="delete">
                                    <h6>COMENTARIO ELIMINADO POR INFRIGIR LAS NORMAS DE LA COMUNIDAD</h6>
                        
                                    <div>
                                        <label class="delete-hour"> 01/01/24 00:00</label>
                                        <label class="delete-reason">Discriminación o incitación al odio</label>
                                    </div>
                                </div>
                                
                                <label class="hour"> 01/01/24 00:00</label>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <!-- MODAL PARA ELIMINAR COMENTARIOS -->
                <div class="modal fade" id="idEliminarModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Eliminar comentario</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <img src="Images/cerrar.png" alt="">
                                </button>
                            </div>

                            <form id="idFormEliminar" action="">
                                <div class="modal-body">
                                    <p>
                                        Selecciona el motivo por el que consideras inadecuado el
                                        contenido del comentario:
                                    </p>

                                    <ul class="list-reasons list-group list-group-flush">
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbMotivo" value="option1">
                                            <div>
                                                <label class="form-check-label" for="rbMotivo1">
                                                    No se ajusta al tema
                                                </label>
                                                <p>
                                                    El comentario no se corresponde con una experiencia
                                                    ofrecida en el curso
                                                </p>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbMotivo" value="option2">
                                            <div>
                                                <label class="form-check-label" for="rbMotivo2">
                                                    Spam
                                                </label>
                                                <p>
                                                    El comentario es de un bot o una cuenta falta, o bien
                                                    contiene anuncios y promociones
                                                </p>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbMotivo" value="option3">
                                            <div>
                                                <label class="form-check-label" for="rbMotivo3">
                                                    Acoso o intimidación
                                                </label>
                                                <p>
                                                    El comentario ataca a alguien personalmente.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbMotivo" value="option4">
                                            <div>
                                                <label class="form-check-label" for="rbMotivo4">
                                                    Discriminación o incitación al odio
                                                </label>
                                                <p>
                                                    El comentario incluye lenguaje ofensivo sobre una persona o un grupo
                                                    debido a su identidad.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="rbMotivo" value="option5">
                                            <div>
                                                <label class="form-check-label" for="rbMotivo5">
                                                    Información personal
                                                </label>
                                                <p>
                                                    Contiene información personal, como una dirección o un número de
                                                    teléfono.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <button id="btnCancelarElim" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        Cancelar
                                    </button>
                                    <button id="btnEliminarComentario" disabled>
                                        Eliminar
                                    </button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>

                
            </div>

            <div id="derecha" class="col-7">
                <h2 id="idSubtitulo">Niveles</h2>

                <div class="level">
                    <table>
                        <tr>
                            <th>Selección</th>
                            <th>Nivel</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                        </tr>

                        <?php
                        $precios = array();
                        for($i = 0; $i < count($infoCurso); $i++) {
                        array_push($precios, $infoCurso[$i]['precioNivel']); ?>
                        <tr>
                            <td>
                                <input class="form-check-input nivel" type="checkbox" id="chbNivelSelect" value="">
                            </td>
                            <td><?=$i+1?></td>
                            <td><?=$infoCurso[$i]['nombreNivel']?></td>
                            <td>$<?=$infoCurso[$i]['precioNivel']?> MXN</td>
                        </tr>
                        <?php } ?>
                    </table>

                    <table id="idTablaTotal">
                        <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="chbCurso" value="">
                            </th>
                            <th>CURSO COMPLETO: </th>
                            <th>$<?=(float)array_sum($precios)?> MXN</th>
                        </tr>
                    </table>
                </div>

                <a href="pago.html">
                    <button id="btnPago" type="button">
                        <img src="Images/inscribir_icon.png" width="160px"/> 
                    </button>
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
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/infoCursoScript.js"></script>
</body>
</html>
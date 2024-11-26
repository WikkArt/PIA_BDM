<?php 

$nombre_usuario = $_SESSION['usuario'];
$foto = $_SESSION['foto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Nuevo Curso</title>
    <link rel="stylesheet" href="CSS/cursoDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body id="idNuevoCurso">
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
                        <a class="nav-link" href="index.php?accion=mostrarDatos&controlador=usuarios">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaCursos.php">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaInscritos.php">Alumnos inscritos</a>
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
    <div id="idCurso" class="form-box form-value container">
    <div class="curso-header-user">
                <div class="h-left">
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
                    <h3 id="nombre_usuario"><?=$nombre_usuario?></h3>
                </div>
                <h1 class="text">Nuevo Nivel</h1>
                <div class="h-right">
                    <a class="volver" href="index.php?accion=mostrarDatos&controlador=usuarios">
                        <button id="btnVolver">Volver al perfíl del usuario</button>
                    </a>
                </div>
            </div>
        <form method="POST" action="index.php?accion=agregarNivel&controlador=cursos" enctype="multipart/form-data">
            <div class="row curso-nivel">
                <div class="col-7 nivel" style="margin-top:5vh;">
                    <div id="idNivelOverflow">
                        <h2 class="header-1">Video del Nivel</h2>
                        <div>
                            <video id="idVideo" controls="controls">
                                <source src="">
                            </video>
                            <input type="file" class="form-control" id="video" name="video" 
                            required accept="video/*" onchange="cargarVideo()" >
                            <h2>Información del nivel</h2>
                            <div class="nivel-nombre-precio">
                                <div id="idInputs" class="inputbox nombre-nivel">
                                    <label>Nombre del Nivel</label>
                                    <input type="text" id="txtLevel" name="txtLevel" required>
                                </div>
                                <div class="inputbox precio">
                                    <label class="subtitle">Precio</label>
                                    <div class="input-group">
                                        <div class="input-group-text">MXN $</div>
                                        <input type="text" class="form-control" id="txtLevelPrice" 
                                        name="txtLevelPrice" placeholder="00.00" required>
                                    </div>
                                </div>
                            </div>
                            <h2>Archivos adicionales <span>(Opcional)</span></h2>
                            <div class="archivos">
                                <div class="link-mas">
                                    <div class="col">
                                        <label class="subtitle">Link(s) a una página externa</label>

                                        <div id="idInputs" class="inputbox link">
                                            <input type="text" id="txtLink" name="txtLink">
                                        </div>
                                    </div>
                                    <button id="btnAgregarLink" type="button" class="btn btn-primary">
                                        <img src="Images/agregar.png" alt="Agregar Link">
                                    </button>
                                </div>
                                <div class="pdf-txt">
                                    <div>
                                        <div class="subtitle-mas">
                                            <label class="subtitle">PDF(s)</label>
                                            <button id="btnAgregarPDF" type="button" class="btn btn-primary">
                                                <img src="Images/agregar.png" alt="Agregar PDF">
                                            </button>
                                        </div>
                                        <table id="idTablaPDF">
                                            <tr>
                                                <td>
                                                    <input type="file"  class="form-control" accept=".pdf" name="recurso[]"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div>
                                        <div class="subtitle-mas">
                                            <label class="subtitle">TXT(s)</label>
                                            <button id="btnAgregarTXT" type="button" class="btn btn-primary">
                                                <img src="Images/agregar.png" alt="Agregar TXT">
                                            </button>
                                        </div>
                                        <table id="idTablaTXT">
                                            <tr>
                                                <td>
                                                    <input type="file"  class="form-control" accept=".txt" name="recurso[]"/>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="subtitle-mas">
                                    <label class="subtitle">Imagen(es)</label>
                                    <button id="btnAgregarImagen" type="button" class="btn btn-primary">
                                        <img src="Images/agregar.png" alt="Agregar Imagen">
                                    </button>
                                </div>
                                <table>
                                    <tr>
                                        <th>Opción</th>
                                        <th>Previsualización</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="file" class="form-control" id="imgExtra" name="recurso[]"
                                            accept="image/*" onchange="cargarImagen(event, 'idImagenExtra')" >
                                        </td>
                                        <td>
                                            <img id="idImagenExtra" src="Images/ImagenCursoRosa.png" alt="Foto extra del nivel">
                                        </td>
                                    </tr>
                                </table>
                                <div class="subtitle-mas">
                                    <label class="subtitle">Video(s)</label>
                                    <button id="btnAgregarVideo" type="button" class="btn btn-primary">
                                        <img src="Images/agregar.png" alt="Agregar Video">
                                    </button>
                                </div>
                                <table>
                                    <tr>
                                        <th>Opción</th>
                                        <th>Previsualización</th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="file" class="form-control" id="videoExtra" name="recurso[]" 
                                            accept="video/*" onchange="cargarVideoExtra()" >
                                        </td>
                                        <td>
                                            <video id="idVideoExtra" controls="controls">
                                                <source src="">
                                            </video>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <button id="btnCurso" type="submit">Agregar nivel</button>
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
    <script src="JS/nuevoCursoScript.js"></script>

</body>
</html>
<?php 

$nombre_usuario = $_SESSION['usuario'];
$foto = $_SESSION['foto'];

require_once("controlador/categorias_controlador.php");

$categoriaControlador = new categorias();
$categorias = $categoriaControlador->mostrarCategoriasActivas();

require_once("controlador/cursos_controlador.php");

$cursoCtrl = new cursos();
$resp = $cursoCtrl->editar();
$cursoInfo = $resp['cursoInfo'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Editar Curso</title>
    <link rel="stylesheet" href="CSS/cursoDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body id="idEditarCurso">
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
                        <a class="nav-link" href="index.php?controlador=cursos&accion=mostrardeInstructor">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaInscritos.php">Alumnos inscritos</a>
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
    <div id="idCurso" class="form-box form-value container">
        <form method="POST" action="index.php?controlador=cursos&accion=editar&idCurso=<?=$cursoInfo['id']?>" enctype="multipart/form-data">
            
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
                <h1 class="text">Editar Curso</h1>
                <div class="h-right">
                    <a class="volver" href="index.php?accion=mostrarDatos&controlador=usuarios">
                        <button id="btnVolver">Volver a cursos creados</button>
                    </a>
                </div>
            </div>

            <div class="row curso-nivel" style="justify-content: center;">
                <div class="col-6 curso">
                    <div>
                        <h2 class="header-1">Foto promocional del curso</h2>
                        <?php
                        if($cursoInfo['foto'] != null) { ?>
                        <img id="idFotoPromo" src="data:image/png;base64,<?=base64_encode($cursoInfo['foto'])?>" alt="Foto promocional del curso">
                        <?php 
                        } else {
                        ?>
                        <img id="idFotoPromo" src="Images/ImagenCursoRosa.png" alt="Foto promocional del curso">
                        <?php
                        }
                        ?>
                        <input type="file" class="form-control" id="promo" name="promo"
                        accept="image/*" onchange="cargarImagen(event, 'idFotoPromo')" >
                    </div>

                    <h2>Información del curso</h2>
                    <div>
                        <label class="subtitle">Categoría</label>
                        
                        <select id="idCategoria" name="idCategoria" class="form-select" aria-label="Default select example">
                        <?php
                        if (!empty($categorias)) {
                            foreach ($categorias as $row) {
                                if($cursoInfo['categoria_id'] == $row['id']) {
                                    echo "<option value='" . htmlspecialchars($row['id']) . "' selected>" . htmlspecialchars($row['nombre']) . "</option>";
                                } else {
                                    echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['nombre']) . "</option>";
                                }
                            }
                        } else {
                            echo "<option value=''>No hay categorías disponibles</option>";
                        }
                        ?>
                        </select>
                    </div>

                    <div id="idInputs"  class="inputbox">
                        <label for="">Nombre del Curso</label>
                        <input type="text" id="txtCourse" name="txtCourse" value="<?=$cursoInfo['nombre']?>">
                    </div>
                    
                    <div id="idInputs" class="inputbox">
                        <label for="">Descripción</label>
                        <textarea class="form-control" id="txtDesc" name="txtDesc" rows="8"><?=$cursoInfo['descripcion']?></textarea>
                    </div>
                    
                    <button id="btnCurso" type="submit">Guardar Cambios</button>
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
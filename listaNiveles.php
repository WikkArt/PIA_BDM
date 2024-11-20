<?php 
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['foto'])) {
    echo json_encode(['error' => 'No has iniciado sesión.']);
    exit();
}

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

        <h1 id="idSubtitulo">Curso: Nombre del Curso</h1>

        <div class="row" id="idMain">
            <div class="instructor-regresar col-3">
                <h3 class="listaNivelesHeaders">Tu instructor</h3>
                
                <div id="infoInstructor">
                    <img id="idAvatarSample" src="Images/avatarSampleAmarillo.png" class="rounded-circle" alt="Avatar">
                    <span>Nombre de Usuario</span>
                </div>

                <a id="btnRegresar" href="index.php?accion=mostrarDatos&controlador=usuarios" class="btn">
                    <img src="Images/regresarAmarilloClaro.png" alt="">
                    <span>Regresar al perfil</span>
                </a>
            </div>

            <div class="col-6" id="listaNiveles">
                <h3 class="listaNivelesHeaders">Lista de niveles</h3>
                <table>
                    <tr>
                        <td>1</td>
                        <td>Comencemos</td>
                        <td>10 min</td>
                        <td class="NivelCompletado">Completado</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Nombre Segundo Nivel</td>
                        <td>15 min</td>
                        <td class="NivelCompletado">Completado</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Nombre Tercer Nivel</td>
                        <td>20 min</td>
                        <td class="NivelCompletado">Completado</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Nombre Ultimo Nivel</td>
                        <td>12 min</td>
                        <td><a class="btn ver" href="vistaNivel.html">Ver</a></td>
                    </tr>
                </table>
            </div>

            <div class="porcentaje-final col-3">
                <h3 class="listaNivelesHeaders">Tu Progreso</h3>
                <div id="info">
                    <h2>75% <h4>Completado</h4></h2>
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
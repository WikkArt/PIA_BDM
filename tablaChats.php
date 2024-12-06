<?php 
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['foto'])) {
    echo json_encode(['error' => 'No has iniciado sesión.']);
    exit();
}

$nombre_usuario = $_SESSION['usuario'];
$rol = $_SESSION['rol'];
$foto = $_SESSION['foto'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Lista de chats</title>
    <link rel="stylesheet" href="CSS/tablaChatsDesign.css">
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
                        <a class="nav-link active" href="tablaChats.html">Chat</a>
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

        <h1 id="idSubtitulo">Lista de chats privados</h1>

        <table>
            <tr>
                <th class="header-1">Foto de perfil</th>
                <th class="header-2">Nombre de Usuario</th>
                <th>No. de contacto</th>
                <th class="header-4">Opción</th>
            </tr>

            <tr>
                <td class="primerColumna">
                    <img src="Images/avatarSample.png"
                    alt="Foto de perfil" class="img-fluid rounded-circle">
                </td>
                <td>Fulanito</td>
                <td>1</td>
                <td>
                    <a href="chatPrivado.html" type="submit" name="chat" 
                    class="btn chat-privado">Chatear</a>
                </td>
            </tr>
            <tr>
                <td class="primerColumna">
                    <img src="Images/avatarSampleMorado.png"
                    alt="Foto de perfil" class="img-fluid rounded-circle">
                </td>
                <td>Menganito</td>
                <td>2</td>
                <td>
                    <a href="chatPrivado.html" type="submit" name="chat" 
                    class="btn chat-privado">Chatear</a>
                </td>
            </tr>
            <tr>
                <td class="primerColumna">
                    <img src="Images/avatarSample.png"
                    alt="Foto de perfil" class="img-fluid rounded-circle">
                </td>
                <td>---</td>
                <td>3</td>
                <td>
                    <a href="chatPrivado.html" type="submit" name="chat" 
                    class="btn chat-privado">Chatear</a>
                </td>
            </tr>
            <tr>
                <td class="primerColumna">
                    <img src="Images/avatarSampleMorado.png"
                    alt="Foto de perfil" class="img-fluid rounded-circle">
                </td>
                <td>---</td>
                <td>4</td>
                <td>
                    <a href="chatPrivado.html" type="submit" name="chat" 
                    class="btn chat-privado">Chatear</a>
                </td>
            </tr>
        </table>
    </div>
    
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script>
        function cargarPerfil() {
            fetch('perfil.php')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                        window.location.href = 'login.html';
                        return;
                    }

                    document.getElementById('nombre_usuario').innerHTML = `${data.nombre_usuario} <span>(${data.rol})</span>`;

                    const avatarImg = document.getElementById('idAvatarSample');
                    if (data.foto) {
                        avatarImg.src = `data:${data.mime};base64,${data.foto}`;
                    } else {
                        avatarImg.src = 'Images/avatarSampleAmarillo.png';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        window.onload = cargarPerfil;
    </script>
    <script src="JS/bootstrap.min.js"></script>
</body>
</html>
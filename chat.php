<?php 
    session_start();

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['foto'])) {
        echo json_encode(['error' => 'No has iniciado sesión.']);
        exit();
    }

    $nombre_usuario = $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
    $foto = $_SESSION['foto'];

    require_once("controlador/chat_controlador.php");
    $chatControlador = new chat();
    $respuestaUsuarios = $chatControlador->listarUsuarios();
    $usuarios = $respuestaUsuarios['usuarios']; // Lista de usuarios

    // Si se ha seleccionado un chat, obtener los mensajes
    if (isset($_GET['chatId'])) {
        $chatId = $_GET['chatId'];

        echo "<pre>";
        var_dump($chatId);
        echo "</pre>";

        $respuestaUsuario = $chatControlador->obtenerUsuarioChat($chatId);

        // Verificar si la respuesta es exitosa antes de acceder a 'usuario'
        if ($respuestaUsuario['state']) {
            $usuarioConectado = $respuestaUsuario['usuario']; 
        } else {
            // Si no se encuentra el usuario, manejar el error aquí
            $usuarioConectado = null;
            echo "<script>alert('".$respuestaUsuario['message']."');</script>";
        }

        $respuestaMensajes = $chatControlador->obtenerMensajes($chatId);
        $messages = $respuestaMensajes['messages']; // Mensajes del chat
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Chat privado</title>
    <link rel="stylesheet" href="CSS/chatDesign.css">
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
                        <a class="nav-link" href="chat.php">Chat</a>
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

        <h1 id="idSubtitulo">Chat privado</h1>
        
        <div class="lista-chat row">
            <div class="lista col-5">
                <ul class="list-group list-group-flush">
                    <!-- <li class="list-group-item ">
                        <a href="">
                            <img id="idAvatarLista" src="Images/avatarSample.png" 
                            alt="avatar" class="rounded-circle">
                            <label>Nombre de Usuario</label>
                        </a>
                    </li> -->
                    <?php foreach ($usuarios as $usuario): ?>
                        <li class="list-group-item">
                            <a href="chat.php?chatId=<?=$usuario['nombre_usuario']?>">
                                <img id="idAvatarLista" src="data:image/png;base64,<?=base64_encode($usuario['foto'])?>" alt="avatar" class="rounded-circle">
                                <label><?=$usuario['nombre_usuario']?></label>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="chat col-7">
                <?php if (isset($chatId)): ?>
                    <div class="chat-header">
                        <div class="chat-header-user">
                            <div class="h-left">
                                <div>
                                    <?php if ($usuarioConectado): // Verificamos que $usuarioConectado tenga datos ?>
                                        <img id="idAvatarHeader" src="data:image/png;base64,<?=base64_encode($usuarioConectado['foto'])?>" class="rounded-circle">
                                        <label><?=$usuarioConectado['nombre_usuario']?></label>
                                    <?php else: ?>
                                        <label>Usuario no encontrado.</label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="h-right">
                                <a href="#" type="submit" name="chat" 
                                class="btn chat-privado">Volver al perfil del usuario</a>
                            </div>
                        </div>
                    </div>

                    <div class="chat-messages overflow-auto">
                        <!-- <div id="idChatMensaje" class="message message-usuario-1">
                            <img id="idAvatar1" src="Images/avatarSample.png" 
                            class="rounded-circle">

                            <div class="hour-message">
                                <label class="user-1">Nombre de Usuario 1</label>
                                <label class="text">¡Aquí un mensaje!
                                    YIPEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE
                                </label>
                                <label class="hour">00:00</label>
                            </div>
                        </div>

                        <div id="idChatMensaje" class="message message-usuario-2">
                            <div class="hour-message">
                                <label class="user-2">Nombre de Usuario 2</label>
                                <label class="text">¡Aquí otro mensaje!
                                    AAAAAAAAAAAAAAAAAAAAA
                                </label>
                                <label class="hour">00:00</label>
                            </div>

                            <img id="idAvatar2" src="Images/avatarSampleAmarillo.png" 
                            class="rounded-circle">
                        </div> -->
                        <?php if (!empty($mensajes)): ?>
                            <?php foreach ($messages as $message): ?>
                                <div class="message">
                                    <img class="rounded-circle" src="data:image/png;base64,<?=base64_encode($message['foto'])?>">
                                    <div class="hour-message">
                                        <label class="user"><?=htmlspecialchars($message['nombre_completo'])?></label>
                                        <label class="text"><?=htmlspecialchars($message['texto'])?></label>
                                        <label class="hour"><?=htmlspecialchars($message['fecha'])?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="message">
                                <label>No hay mensajes aún.</label>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <form method="POST" class="chat-input">   
                        <textarea placeholder="Escribe tu mensaje..." name="mensaje"></textarea>
                        <button id="btnEnviar" class="btn btn-primary">Enviar</button>
                    </form>
            
                <?php endif; ?>
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
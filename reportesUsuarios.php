<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Reportes de usuarios</title>
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
                        <a class="nav-link active" href="#">Reportes</a>
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

        <h1 id="idSubtitulo">Intructores</h1>
            
        <div id="idTabla">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Fecha de ingreso</th>
                    <th>No. de Cursos Creados</th>
                    <th>Total de ganancias</th>
                    <th>Estado</th>
                    <th class="a-header-8">Opciones</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XX/XXXX</td>
                    <td>---</td>
                    <td>$000.00 MXN</td>
                    <td>Bloqueado</td>
                    <td class="columna-botones">
                        <button class="bloqueado" disabled>Bloquear</button>
                        <button class="desbloqueado">Desbloquear</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XX/XXXX</td>
                    <td>---</td>
                    <td>$000.00 MXN</td>
                    <td>Desbloqueado</td>
                    <td class="columna-botones">
                        <button class="bloqueado">Bloquear</button>
                        <button class="desbloqueado" disabled>Desbloquear</button>
                    </td>
                </tr>
            </table>
        </div>
        
        <h1 id="idSubtitulo">Estudiantes</h1>
            
        <div id="idTabla">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Fecha de ingreso</th>
                    <th>No. de Cursos Inscritos</th>
                    <th>% de Cursos terminados</th>
                    <th>Estado</th>
                    <th class="a-header-8">Opciones</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XX/XXXX</td>
                    <td>---</td>
                    <td>$000.00 MXN</td>
                    <td>Bloqueado</td>
                    <td class="columna-botones">
                        <button class="bloqueado" disabled>Bloquear</button>
                        <button class="desbloqueado">Desbloquear</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>---</td>
                    <td>---</td>
                    <td>XX/XX/XXXX</td>
                    <td>---</td>
                    <td>$000.00 MXN</td>
                    <td>Desbloqueado</td>
                    <td class="columna-botones">
                        <button class="bloqueado">Bloquear</button>
                        <button class="desbloqueado" disabled>Desbloquear</button>
                    </td>
                </tr>
            </table>
        </div>

    </div>
    
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/reporterUsuariosScript.js"></script>
</body>
</html>
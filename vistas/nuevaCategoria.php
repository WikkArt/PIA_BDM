<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Crear Categoría</title>
    <link rel="stylesheet" href="CSS/categoriaDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body id="idNuevaCategoria">
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
                        <a class="nav-link" href="reportesUsuarios.html">Reportes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=cerrarSesion">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div id="idCategoria" class="form-box form-value container">
        <h1 class="text">Nueva Categoría</h1>
        <a class="volver" href="index.php?accion=mostrarDatos&controlador=usuarios">
            <button id="btnVolver">Volver al perfíl del usuario</button>
        </a>
        <form method="POST" action="index.php?accion=crear&controlador=categorias">
            <div>
                <div id="idInputs" class="inputbox">
                    <label for="fcategory">Nombre de la categoría</label>
                    <input id="txtCategory" name="txtCategory" type="text">
                </div>
                <div id="idInputs" class="inputbox">
                    <label for="femail">Descripción</label>
                    <textarea rows="6" id="txtDesc" name="txtDesc"></textarea>
                </div>
                
                <button id="btnCrearCategoría" type="submit">Crear Categoría</button>
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
    <script src="JS/nuevaCategoriaScript.js"></script>
</body>
</html>
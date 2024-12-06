<?php

require_once("controlador/categorias_controlador.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Editar Categoría</title>
    <link rel="stylesheet" href="CSS/categoriaDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body id="idEditarCategoria">
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
        <h1 class="text">Editar Categoría</h1>
        <a class="volver" href="index.php?accion=mostrarDatos&controlador=usuarios">
            <button id="btnVolver">Volver al perfíl del usuario</button>
        </a>
        <form method="POST" action="index.php?controlador=categorias&accion=editar">
            <input type="hidden" id="categoriaId" name="categoriaId" value="<?= htmlspecialchars($categoria['id']) ?>">
            <div>
                <div id="idInputs" class="inputbox">
                    <label for="txtCategory">Nombre de la categoría</label>
                    <input id="txtCategory" name="txtCategory" type="text" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>
                </div>
                <div id="idInputs" class="inputbox">
                    <label for="txtDesc">Descripción</label>
                    <textarea rows="6" id="txtDesc" name="txtDesc" required><?= htmlspecialchars($categoria['descripcion']) ?></textarea>
                </div>
                <button id="btnCrearCategoría" type="submit">Guardar Cambios</button>
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
</body>
</html>
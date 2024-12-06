<?php
require_once("controlador/categorias_controlador.php");

$categoriaControlador = new categorias();
$categoriasActivas = $categoriaControlador->mostrarCategoriasActivas();

require_once("controlador/cursos_controlador.php");

$cursoControlador = new cursos();
$cursosActivos = $cursoControlador->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboardDesign.css">
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
                        <a class="nav-link active" href="#">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <?php
                    if(isset($_SESSION['usuario'])) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?accion=mostrarDatos&controlador=usuarios">Perfíl</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tablaChats.php">Chat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=cerrarSesion">Cerrar Sesión</a>
                    </li>
                    <?php } else {?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Iniciar Sesión</a>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div class="cuerpo">
        <div class="col-8" id="dashboard">
            <div class="best-courses">
                <h1 class="subtitle">★★★ Lo mejor de Habímate ★★★</h1>
                <div class="courses">
                    <?php
                    foreach ($cursosActivos as $curso): ?>
                    <div class="course" data-description="<?=$curso['descripcion']?>" data-price="$<?=$curso['precio_total']?> MXN" data-publisher="<?=$curso['instructor']?>" data-idcourse="<?=$curso['id']?>">
                        <img src="data:image/png;base64,<?=base64_encode($curso['imagen'])?>" alt=" " class="img-fluid">
                        <h2><?= htmlspecialchars($curso['titulo']) ?></h2>
                        <p><?= htmlspecialchars($curso['categoria']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="bestsellers-courses">
                <h1 class="subtitle">$ $ $ Los más vendidos $ $ $</h1>
                <div class="courses">
                    <?php
                    foreach ($cursosActivos as $curso): ?>
                    <div class="course" data-description="<?=$curso['descripcion']?>" data-price="$<?=$curso['precio_total']?> MXN" data-publisher="<?=$curso['instructor']?>" data-idcourse="<?=$curso['id']?>">
                        <img src="data:image/png;base64,<?=base64_encode($curso['imagen'])?>" alt=" " class="img-fluid">
                        <h2><?= htmlspecialchars($curso['titulo']) ?></h2>
                        <p><?= htmlspecialchars($curso['categoria']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="display-courses">
                <h1 class="subtitle">►►► Inscríbete a... ◄◄◄</h1>
                <div class="courses">
                    <?php
                    foreach ($cursosActivos as $curso): ?>
                    <div class="course" data-description="<?=$curso['descripcion']?>" data-price="$<?=$curso['precio_total']?> MXN" data-publisher="<?=$curso['instructor']?>" data-idcourse="<?=$curso['id']?>">
                        <img src="data:image/png;base64,<?=base64_encode($curso['imagen'])?>" alt=" " class="img-fluid">
                        <h2><?= htmlspecialchars($curso['titulo']) ?></h2>
                        <p><?= htmlspecialchars($curso['categoria']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            
        </div>

        <div id="idModalDashboard" class="modal dashboard">
            <span class="close">×</span>
            <div class="modal-content">
                <h2 id="modal-title"></h2>
                <div>
                    <img id="modal-image" src="" alt="Imagen del Curso">
                    <p id="modal-description"></p>
                    <p id="modal-publisher"></p>
                    
                    <div class="category-price">
                        <p id="modal-category"></p>
                        <p id="modal-price"></p>
                    </div>
                    
                    <a id="modal-idcourse">
                        <button id="btnCurso" type="button">Ver curso</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Busqueda -->
        <div class="col-3" id="Busqueda">
            <h3>Filtros</h3>

            <form id="idFiltros">
                <h5>Búsqueda</h5>
                <div class="buscar-curso">
                    <div id="idInputs" class="inputbox">
                        <input id="txtBuscar" name="txtBuscar" type="text" placeholder="Curso de...">
                    </div>
                </div>

                <h5>Fecha de publicación</h5>
                <div class="fechas">
                    <div id="idInputs" class="inputbox">
                        <label for="fdate">Desde: </label> 
                        <input type="date" id="txtDateFromG" name="txtDateFromG"/>
                    </div>
                    <div id="idInputs" class="inputbox">
                        <label for="fdate">Hasta: </label> 
                        <input type="date" id="txtDateFromG" name="txtDateFromG"/>
                    </div>
                </div>

                <h5>Categorías</h5>
                <ul class="categorias list-group list-group-flush">
                    <?php foreach ($categoriasActivas as $categoria): ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="<?= $categoria['id'] ?>" id="cbCategoria<?= $categoria['id'] ?>">
                            <label class="form-check-label" for="cbCategoria<?= $categoria['id'] ?>">
                                <?= htmlspecialchars($categoria['nombre']) ?>
                            </label>
                            <button id="btnInfoCategoria" type="button" class="btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#idCategoriaModal" 
                                    data-nombre="<?= htmlspecialchars($categoria['nombre']) ?>" 
                                    data-descripcion="<?= htmlspecialchars($categoria['descripcion']) ?>" 
                                    data-usuario="<?= htmlspecialchars($categoria['usuario_creador']) ?>" 
                                    data-fecha="<?= $categoria['fecha_creacion'] ?>" >
                                <img src="Images/info.png" alt="Información de la categoría">
                            </button>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                    <a id="idCategoriaG">
                        <button type="submit">Filtrar</button>
                    </a>
                </form>
                <!-- Modal de las Categorias-->
                <div class="modal fade" id="idCategoriaModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCategoriaTitulo">Categoría</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <img src="Images/cerrar.png" alt="">
                                </button>
                            </div>
                            <div class="modal-body">
                                <p id="modalCategoriaDescripcion"></p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <label id="modalCategoriaUsuario"></label>
                                <div>
                                    <label id="modalCategoriaFecha"></label>
                                    <label id="modalCategoriaHora"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        
    <!-- Footer -->
    <footer>
        <iframe class="footer" src="Footer.html" frameborder="0" scrolling="no"></iframe>
    </footer>

    <!-- Archivos externos -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const infoButtons = document.querySelectorAll("#btnInfoCategoria");
            infoButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const nombre = this.getAttribute("data-nombre");
                    const descripcion = this.getAttribute("data-descripcion");
                    const usuario = this.getAttribute("data-usuario");
                    const fecha = this.getAttribute("data-fecha");
                    const hora = this.getAttribute("data-hora");

                    document.getElementById("modalCategoriaTitulo").textContent = `Categoría: ${nombre}`;
                    document.getElementById("modalCategoriaDescripcion").textContent = descripcion;
                    document.getElementById("modalCategoriaUsuario").textContent = usuario;
                    document.getElementById("modalCategoriaFecha").textContent = fecha;
                    document.getElementById("modalCategoriaHora").textContent = hora;
                });
            });
        });
     </script>
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/dashboard.js"></script>
</body>
</html>

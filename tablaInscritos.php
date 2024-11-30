<?php
require_once("controlador/categorias_controlador.php");

$categoriaControlador = new categorias();
$categoriasActivas = $categoriaControlador->mostrarCategoriasActivas();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Lista de Inscripciones</title>
    <link rel="stylesheet" href="CSS/tablaInscritosDesign.css">
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
                        <a class="nav-link" href="index.php?accion=mostrardeInstructor&controlador=cursos">Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Alumnos inscritos</a>
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
        <div class="row">
            <div class="col-3 filtro">
                <h3>Filtros</h3>

                <form id="idFiltros">
                    <div class="form-check activos">
                        <label class="form-check-label" for="cbCursoGeneral">
                            Sólo cursos activos
                        </label>

                        <input class="form-check-input" type="checkbox" value="" id="cbCursoGeneral">
                    </div>

                    <h5>Fecha de creación</h5>
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
                            <label type="text"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#idCategoriaModal" 
                                    data-nombre="<?= htmlspecialchars($categoria['nombre']) ?>">
                            </label>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
                    <a id="idCategoriaG">
                        <button type="submit">Filtrar</button>
                    </a>
                </form>
            </div>
            
            <div class="col-9">
                <h1 id="idSubtitulo">Nombre del curso</h1>

                <div id="idTabla">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del alumno</th>
                            <th>Fecha de inscripción</th>
                            <th>Nivel de avance</th>
                            <th>Precio pagado</th>
                            <th>Forma de pago</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                    </table>
                </div>
                
                <table id="idTablaIngreso">
                    <tr>
                        <th>INGRESO TOTAL: </th>
                        <th>$000.00</th>
                    </tr>
                </table>

                <h1 id="idSubtitulo">Nombre del curso</h1>

                <div id="idTabla">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del alumno</th>
                            <th>Fecha de inscripción</th>
                            <th>Nivel de avance</th>
                            <th>Precio pagado</th>
                            <th>Forma de pago</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                    </table>
                </div>

                <table id="idTablaIngreso">
                    <tr>
                        <th>INGRESO TOTAL: </th>
                        <th>$000.00</th>
                    </tr>
                </table>

                <h1 id="idSubtitulo">Nombre del curso</h1>

                <div id="idTabla">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Nombre del alumno</th>
                            <th>Fecha de inscripción</th>
                            <th>Nivel de avance</th>
                            <th>Precio pagado</th>
                            <th>Forma de pago</th>
                        </tr>

                        <tr>
                            <td>1</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>---</td>
                            <td>XX/XX/XXXX</td>
                            <td>---</td>
                            <td>$000.00</td>
                            <td>---</td>
                        </tr>
                    </table>
                </div>

                <table id="idTablaIngreso">
                        <th>INGRESO TOTAL: </th>
                        <th>$000.00</th>
                    </tr>
                </table>

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
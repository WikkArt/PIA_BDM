<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Inicio de sesión</title>
    <link rel="stylesheet" href="CSS/loginDesign.css">
    <link rel="stylesheet" href="CSS/bootstrap.min.css">
</head>
<body>
    <!--Navegador-->
    <nav id="idNav" class="navbar navbar-expand-lg">
        <button id="btnLogo" class="navbar-brand" type="button">
            <img src="Images/HabimateLogo2.png" width="160px"/>
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
                        <a class="nav-link active" href="#">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controlador=usuarios&accion=registrar">Registro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div id="idLogin" class="form-box form-value container" >
        <h1 class="text">Iniciar Sesión</h1>

        <form method="POST" action="index.php?accion=iniciarSesion&controlador=usuarios">
            <div id="idInputs" class="inputbox">
                <label for="fLUsername">Nombre de usuario</label>
                <input id="txtUsername" name="txtUsername" type="text" required>
            </div>
        
            <div id="idInputs" class="inputbox">
                <label for="fLPassword">Contraseña</label>
                <input id="txtLPassword" name="txtLPassword" type="password" required>
            </div>
        
            <div id="idCheckbox">
                <input type="checkbox"> Recordar contraseña
            </div>
        
            <button id="btnLogin" type="submit">Ingresar</button>
        </form>
        

        <!-- Modal de Bloqueo -->
        <div class="modal fade" id="idBloquearModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Cuenta bloqueada</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="Images/cerrar.png" alt="">
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="Images/bloqueado.png" alt="">
                        <p>
                            Su cuenta a sido bloqueada debido a que a superado el 
                            número de intentos para escribir la contraseña correcta.
                        </p>
                        <p>
                            Espere a que un administrador desbloquee su cuenta para continuar.
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Archivos externos-->
    <script src="JS/jquery-3.7.1.min.js"></script>
    <script src="JS/bootstrap.min.js"></script>
    <script src="JS/loginScript.js"></script>
</body>
</html>
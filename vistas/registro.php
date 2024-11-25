<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habímate | Registro</title>
    <link rel="stylesheet" href="../CSS/registroDesign.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
</head>
<body>
    <!--Navegador-->
    <nav id="idNav" class="navbar navbar-expand-lg">
        <button id="btnLogo" class="navbar-brand" type="button">
            <img src="../Images/HabimateLogo2.png" width="160px"/>
        </button>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#idNavLinks" aria-controls="idNavLinks" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="idNavLinks" class="collapse navbar-collapse">
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Inicio</a>
                    </li>
                </ul>
            </div>
            <div>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Registro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cuerpo -->
    <div id="idRegister" class="form-box form-value container">
        <h1 class="text">Registro</h1>
        <form method="POST" action="../index.php?accion=registrar&controlador=usuarios" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6 col-md-4 avatar">
                    <img id="idAvatarSample" src="../Images/avatarSample.png" 
                    class="rounded-circle" alt="Avatar">

                    <input class="form-control" type="file" id="btnAvatar" name="btnAvatar" onchange="mostrarAvatar(event, 'idAvatarSample')" accept="image/*">
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <h2 class="text">Información Personal</h2>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div id="idInputs" class="inputbox">
                                <label for="ffullname">Nombre completo</label>
                                <input id="txtFullname" name="txtFullname" type="text" required>
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="fusername">Nombre de Usuario</label>
                                <input id="txtUsername" name="txtUsername" type="text" required>
                                <small class="form-text">
                                    Debe contener un mínimo de 3 carácteres.
                                </small>
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="femail">Correo electrónico</label>
                                <input id="txtEmail" name="txtEmail" type="email" required>
                            </div>
                            <div id="idInputs" class="inputbox">
                                <label for="fpassword">Contraseña</label>
                                <input id="txtPassword" name="txtPassword" type="password" required>
                                <small class="form-text">
                                    Debe contener un mínimo de 8 carácteres, una mayúscula,
                                    &nbsp;&nbsp;una minúscula, un número y un carácter especial.
                                </small>
                            </div>
                        </div>

                        <div class="col">
                            <div id="idInputs" class="inputbox item item-2">
                                <label for="fdate">Fecha de Nacimiento: </label> 
                                <input class="inputRegistrar" type="date" id="txtBirthdate" name="ffechanacimiento"/>
                            </div>
                            
                            <label class="subtitle">Género</label>
                            <div id="idRB" name="idRB">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBH" name="inlineRadioOptions" value="hombre">
                                    <label class="form-check-label" for="RBH">Hombre</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBM" name="inlineRadioOptions" value="mujer">
                                    <label class="form-check-label" for="RBM">Mujer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="RBNB" name="inlineRadioOptions" value="no binario" checked>
                                    <label class="form-check-label" for="RBNB">No binario</label>
                                </div>
                            </div>

                            <label class="subtitle">Rol del usuario</label>
                            <select id="idRol" name="idRol" class="form-select" aria-label="Default select example">
                                <option class="item item-1" value="" selected>Selecciona un rol</option>
                                <option class="item" id="dropdown" value="1">Estudiante</option>
                                <option class="item" id="dropdown"  value="2">Instructor</option>
                                <option class="item" id="dropdown"  value="3">Administrador</option>
                            </select>
                            
                            <button id="btnRegister" type="submit">Confirmar Registro</button>
                        </div>
                    </div>
                </div>
                
            </div>
        </form>
    </div>

    <!--Archivos externos-->
    <script src="../JS/jquery-3.7.1.min.js"></script>
    <script src="../JS/bootstrap.min.js"></script>
    <script src="../JS/registroScript.js"></script>
</body>
</html>
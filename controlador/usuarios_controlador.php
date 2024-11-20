<?php
require_once("modelo/modeloUsuarios.php");

session_start();

class usuarios {
    public $usuarioObj;
    public $vista;
    public $respuesta;

    public function __construct() {
        $this->usuarioObj = new mUsuarios();
    }

    public function iniciarSesion() {
        $this->vista = 'login';

        try{
            if(isset( $_POST['txtUsername']) && isset($_POST['txtLPassword'])){

                $datos = array(
                    "nombre_usuario" =>  $_POST['txtUsername'],
                    "contrasena" =>   $_POST['txtLPassword']
                );
                $result = $this->usuarioObj->iniciarSesion($datos);
                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    $_SESSION['usuario'] = $_POST['txtUsername'];
                    $_SESSION['rol'] = $result['rol'];
                    $info = $this->usuarioObj->obtenerUsuario($_POST['txtUsername']);
                    $_SESSION['foto'] = $info['foto'];
        
                    if ($result['rol'] == 'estudiante') {
                        header('Location: dashboard.html');
                    } else {
                        header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
                    }
                    exit();
                } elseif ($result['resultado'] == 0) {
                    echo "<script>
                            alert('Error: El usuario no existe.');
                            window.history.back();
                          </script>";
                } elseif ($result['resultado'] == 2) {
                    echo "<script>
                            alert('Error: Tu cuenta está bloqueada o eliminada.');
                            window.history.back();
                          </script>";
                } elseif ($result['resultado'] == 3) {
                    echo "<script>
                            alert('Error: Contraseña incorrecta.');
                            window.history.back();
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error en el inicio de sesión: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }

    public function registrar() {
        $this->vista = 'registro';

        try{
            if(isset($_POST['txtUsername']) && isset($_POST['txtPassword'])&& isset($_POST['txtEmail'])){

                if ($_FILES['btnAvatar']['size'] > 0) {
                    $foto = file_get_contents($_FILES['btnAvatar']['tmp_name']);
                    $mime = $_FILES['btnAvatar']['type'];
                } else {
                    $foto = null;
                    $mime = null;
                }

                $datos = array(
                    "nombre_completo" => $_POST['txtFullname'],
                    "nombre_usuario" => $_POST['txtUsername'],
                    "correo" => $_POST['txtEmail'],
                    "contrasena" => $_POST['txtPassword'],
                    "fecha_nac" => $_POST['ffechanacimiento'],
                    "genero" => isset($_POST['inlineRadioOptions']) ? $_POST['inlineRadioOptions'] : 'no binario',
                    "rol" => $_POST['idRol'],
                    "foto" => $foto,
                    "mime" => $mime
                );
                $result = $this->usuarioObj->registrar($datos);

                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    echo "<script>
                            alert('Registro exitoso.');
                            window.location.href = 'index.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('El nombre de usuario o el correo ya están registrados.');
                            window.history.back();
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al registrar el usuario: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }

    public function mostrarDatos() {
        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }

        if($_SESSION['rol'] == 'estudiante') {
            $this->vista = 'estudiante';
        } elseif ($_SESSION['rol'] == 'instructor') {
            $this->vista = 'instructor';
        } elseif ($_SESSION['rol'] == 'admin') {
            $this->vista = 'administrador';
        }

        $nombre_usuario = $_SESSION['usuario'];
        $infoUsuario = $this->usuarioObj->obtenerUsuario($nombre_usuario);
        $this->respuesta = array(
            "state" => true,
            "usuarioInfo" => $infoUsuario
        );
        return $this->respuesta;
    }

    public function editar() {
        $this->vista = "editarUsuario";

        if (!isset($_SESSION['usuario']) || !isset($_SESSION['rol'])) {
            echo json_encode(['error' => 'No has iniciado sesión.']);
            exit();
        }
        $nombre_usuario = $_SESSION['usuario'];

        if(isset($_POST['txtEmail'])&&isset($_POST['txtPassword'])&&isset($_POST['txtFullname'])){
            try {
            if ($_FILES['btnAvatar']['size'] > 0) {
                $foto = file_get_contents($_FILES['btnAvatar']['tmp_name']);
                $mime = $_FILES['btnAvatar']['type'];
            } else {
                $foto = null; 
                $mime = null; 
            }

            $datos = array(
                'nombre_completo' => $_POST['txtFullname'],
                'correo' => $_POST['txtEmail'],
                'contrasena' => $_POST['txtPassword'],
                'fecha_nac' => $_POST['ffechanacimiento'],
                'genero' => $_POST['inlineRadioOptions'],
                'foto' => $foto,
                'mime' => $mime
            );

            $this->usuarioObj->editar($datos, $nombre_usuario);
            header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
            
            } catch (PDOException $e) {
                $this->respuesta = array("state" => false);
                echo "<script>alert('Error: ". $e->getMessage() ."');</script>";
                header('Location: index.php?controlador=usuarios&accion=editar');
            }
        }else{
            $infoUsuario = $this->usuarioObj->obtenerUsuarioEditar($nombre_usuario);
            $this->respuesta = array(
                "state" => true,
                "usuarioInfo" =>$infoUsuario
            );
            return $this->respuesta;
        }
    }
    
}
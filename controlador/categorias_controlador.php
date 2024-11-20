<?php
require_once("modelo/modeloCategorias.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class categorias {
    public $categoriaObj;
    public $vista;
    public $respuesta;

    
    public function mostrarCategoriasActivas() {
        $modelo = new mCategorias();
        return $modelo->obtenerCategoriasActivas();
    }
    public function __construct() {
        $this->categoriaObj = new mCategorias();
    }

    public function crear() {
        $this->vista = 'nuevaCategoria';

        try{
            if(isset($_POST['txtCategory']) && isset($_POST['txtDesc'])){

                $datos = array(
                    "nombre" => $_POST['txtCategory'],
                    "descripcion" => $_POST['txtDesc'],
                    "nombre_usuario" => $_SESSION['usuario']
                );
                $result = $this->categoriaObj->crear($datos);

                $this->respuesta = array("state" => true);
                if ($result['resultado'] == 1) {
                    echo "<script>
                            alert('Categoria creada exitosamente.');
                            window.location.href = 'index.php?controlador=usuarios&accion=mostrarDatos';
                          </script>";
                } else {
                    echo "<script>
                            alert('La categoria ya ha sido registrada.');
                            window.history.back();
                          </script>";
                }
            }
        }catch(PDOException $e){
            $this->respuesta = array("state" => false);
            echo "<script>
                    alert('Error al registrar la categoria: " . $e->getMessage() . "');
                    window.history.back();
                </script>";
        }
        return $this->respuesta;
    }

    public function mostrarCategorias() {
        $categorias = [];
        if (isset($_SESSION['usuario'])) {
            $categorias = $this->categoriaObj->obtenerCategoriasPorUsuario($_SESSION['usuario']);
        }
        return $categorias;
    }
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoria = $this->categoriaObj->obtenerCategoriaPorId($id);
    
            if ($categoria) {
                include 'vistas/editarCategoria.php';
            } else {
                header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['categoriaId'];
            $nombre = $_POST['txtCategory'];
            $descripcion = $_POST['txtDesc'];
    
            $resultado = $this->categoriaObj->actualizarCategoria($id, $nombre, $descripcion);
    
            if ($resultado) {
                header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
            } else {
                echo '<script>alert("Error al actualizar la categoría");</script>';
            }
        }
    }
    
    public function eliminar() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
    
            $modeloCategorias = new mCategorias();
            $exito = $modeloCategorias->eliminarCategoria($id);
    
            if ($exito) {
                header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
                exit();
            } else {
                echo "<script>
                        alert('Error al eliminar la categoría.');
                        window.history.back();
                      </script>";
                exit();
            }
        }
    }
    
}
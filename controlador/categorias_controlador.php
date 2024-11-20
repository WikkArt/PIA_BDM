<?php
require_once("modelo/modeloCategorias.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


class categorias {
    public $categoriaObj;
    public $vista;
    public $respuesta;

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
                // Renderiza la vista con los datos de la categoría
                include 'vistas/editarCategoria.php';
            } else {
                // Redirige si no se encuentra la categoría
                header('Location: index.php?controlador=usuarios&accion=mostrarDatos');
            }
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Maneja la actualización de la categoría
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
        $input = json_decode(file_get_contents('php://input'), true);
        if (isset($input['id'])) {
            $id = $input['id'];
            $resultado = $this->categoriaObj->eliminarCategoria($id);
    
            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar la categoría.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de categoría no proporcionado.']);
        }
    }

    
}